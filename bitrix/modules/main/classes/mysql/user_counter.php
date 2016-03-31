<?
require_once($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/classes/general/user_counter.php");

class CUserCounter extends CAllUserCounter
{
	public static function Set($user_id, $code, $value, $site_id = SITE_ID, $tag = '', $sendPull = true)
	{
		global $DB, $CACHE_MANAGER;

		$value = intval($value);
		$user_id = intval($user_id);
		if ($user_id < 0 || strlen($code) <= 0)
			return false;

		$rs = $DB->Query("
			SELECT CNT FROM b_user_counter
			WHERE USER_ID = ".$user_id."
			AND SITE_ID = '".$DB->ForSQL($site_id)."'
			AND CODE = '".$DB->ForSQL($code)."'
		");

		if ($rs->Fetch())
		{
			$ssql = "";
			if ($tag != "")
				$ssql = ", TAG = '".$DB->ForSQL($tag)."'";

			$DB->Query("
				UPDATE b_user_counter SET
				CNT = ".$value." ".$ssql."
				WHERE USER_ID = ".$user_id."
				AND SITE_ID = '".$DB->ForSQL($site_id)."'
				AND CODE = '".$DB->ForSQL($code)."'
			");
		}
		else
		{
			$DB->Query("
				INSERT INTO b_user_counter
				(CNT, USER_ID, SITE_ID, CODE, TAG)
				VALUES
				(".$value.", ".$user_id.", '".$DB->ForSQL($site_id)."', '".$DB->ForSQL($code)."', '".$DB->ForSQL($tag)."')
			", true);
		}

		if (self::$counters && self::$counters[$user_id])
		{
			if ($site_id == self::ALL_SITES)
			{
				foreach(self::$counters[$user_id] as $key => $tmp)
				{
					self::$counters[$user_id][$key][$code] = $value;
				}
			}
			else
			{
				if (!isset(self::$counters[$user_id][$site_id]))
					self::$counters[$user_id][$site_id] = array();

				self::$counters[$user_id][$site_id][$code] = $value;
			}
		}

		$CACHE_MANAGER->Clean("user_counter".$user_id, "user_counter");

		if ($sendPull)
			self::SendPullEvent($user_id, $code);

		return true;
	}

	public static function Increment($user_id, $code, $site_id = SITE_ID, $sendPull = true, $increment = 1)
	{
		global $DB, $CACHE_MANAGER;

		$user_id = intval($user_id);
		if ($user_id < 0 || strlen($code) <= 0)
			return false;

		$increment = intval($increment);

		$strSQL = "
			INSERT INTO b_user_counter (USER_ID, CNT, SITE_ID, CODE)
			VALUES (".$user_id.", ".$increment.", '".$DB->ForSQL($site_id)."', '".$DB->ForSQL($code)."')
			ON DUPLICATE KEY UPDATE CNT = CNT + ".$increment;
		$DB->Query($strSQL, false, "FILE: ".__FILE__."<br> LINE: ".__LINE__);

		if (self::$counters && self::$counters[$user_id])
		{
			if ($site_id == self::ALL_SITES)
			{
				foreach(self::$counters[$user_id] as $key => $tmp)
				{
					if (isset(self::$counters[$user_id][$key][$code]))
						self::$counters[$user_id][$key][$code] = self::$counters[$user_id][$key][$code] + $increment;
					else
						self::$counters[$user_id][$key][$code] = $increment;
				}
			}
			else
			{
				if (!isset(self::$counters[$user_id][$site_id]))
					self::$counters[$user_id][$site_id] = array();

				if (isset(self::$counters[$user_id][$site_id][$code]))
					self::$counters[$user_id][$site_id][$code] = self::$counters[$user_id][$site_id][$code] + $increment;
				else
					self::$counters[$user_id][$site_id][$code] = $increment;
			}
		}
		$CACHE_MANAGER->Clean("user_counter".$user_id, "user_counter");

		if ($sendPull)
			self::SendPullEvent($user_id, $code);

		return true;
	}

	/**
	* @deprecated
	*/
	public static function Decrement($user_id, $code, $site_id = SITE_ID, $sendPull = true, $decrement = 1)
	{
		global $DB, $CACHE_MANAGER;

		$user_id = intval($user_id);
		if ($user_id < 0 || strlen($code) <= 0)
			return false;

		$decrement = intval($decrement);

		$strSQL = "
			INSERT INTO b_user_counter (USER_ID, CNT, SITE_ID, CODE)
			VALUES (".$user_id.", -".$decrement.", '".$DB->ForSQL($site_id)."', '".$DB->ForSQL($code)."')
			ON DUPLICATE KEY UPDATE CNT = CNT - ".$decrement;
		$DB->Query($strSQL, false, "FILE: ".__FILE__."<br> LINE: ".__LINE__);

		if (self::$counters && self::$counters[$user_id])
		{
			if ($site_id == self::ALL_SITES)
			{
				foreach(self::$counters[$user_id] as $key => $tmp)
				{
					if (isset(self::$counters[$user_id][$key][$code]))
						self::$counters[$user_id][$key][$code] = self::$counters[$user_id][$key][$code] - $decrement;
					else
						self::$counters[$user_id][$key][$code] = -$decrement;
				}
			}
			else
			{
				if (!isset(self::$counters[$user_id][$site_id]))
					self::$counters[$user_id][$site_id] = array();

				if (isset(self::$counters[$user_id][$site_id][$code]))
					self::$counters[$user_id][$site_id][$code] = self::$counters[$user_id][$site_id][$code] - $decrement;
				else
					self::$counters[$user_id][$site_id][$code] = -$decrement;
			}
		}

		$CACHE_MANAGER->Clean("user_counter".$user_id, "user_counter");

		if ($sendPull)
			self::SendPullEvent($user_id, $code);

		return true;
	}

	public static function IncrementWithSelect($sub_select, $sendPull = true, $arParams = array())
	{
		global $DB, $CACHE_MANAGER, $APPLICATION;

		if (strlen($sub_select) > 0)
		{
			$pullInclude = $sendPull && self::CheckLiveMode();

			if (
				is_array($arParams)
				&& isset($arParams["TAG_SET"])
			)
			{
				$strSQL = "
					INSERT INTO b_user_counter (USER_ID, CNT, SITE_ID, CODE, SENT, TAG) (".$sub_select.")
					ON DUPLICATE KEY UPDATE CNT = CNT + VALUES(CNT), SENT = VALUES(SENT), TAG = '".$DB->ForSQL($arParams["TAG_SET"])."'
				";
			}
			elseif (
				is_array($arParams)
				&& isset($arParams["TAG_CHECK"])
			)
			{
				$strSQL = "
					INSERT INTO b_user_counter (USER_ID, CNT, SITE_ID, CODE, SENT) (".$sub_select.")
					ON DUPLICATE KEY UPDATE CNT = CASE
						WHEN
							TAG = '".$DB->ForSQL($arParams["TAG_CHECK"])."'
						THEN
							CNT

						ELSE
							CNT + VALUES(CNT)
						END,
						SENT = CASE
						WHEN
							TAG = '".$DB->ForSQL($arParams["TAG_CHECK"])."'
						THEN
							SENT
						ELSE
							SENT = VALUES(SENT)
						END
				";
			}
			else
			{
				$strSQL = "
					INSERT INTO b_user_counter (USER_ID, CNT, SITE_ID, CODE, SENT) (".$sub_select.")
					ON DUPLICATE KEY UPDATE CNT = CNT + VALUES(CNT), SENT = VALUES(SENT)
				";
			}

			$DB->Query($strSQL, false, "FILE: ".__FILE__."<br> LINE: ".__LINE__);

			if (
				!is_array($arParams)
				|| !isset($arParams["TAG_SET"])
			)
			{
				self::$counters = false;
				$CACHE_MANAGER->CleanDir("user_counter");
			}

			if ($pullInclude)
			{
				$db_lock = $DB->Query("SELECT GET_LOCK('".$APPLICATION->GetServerUniqID()."_pull', 0) as L");
				$ar_lock = $db_lock->Fetch();
				if($ar_lock["L"] > 0)
				{
					$arSites = Array();
					$res = CSite::GetList(($b = ""), ($o = ""), Array("ACTIVE" => "Y"));
					while($row = $res->Fetch())
					{
						$arSites[] = $row['ID'];
					}

					$strSQL = "
						SELECT distinct pc.CHANNEL_ID, uc.USER_ID, uc.SITE_ID, uc.CODE, uc.CNT
						FROM b_user_counter uc
						INNER JOIN b_pull_channel pc ON pc.USER_ID = uc.USER_ID
						WHERE uc.SENT = '0'
					";

					$res = $DB->Query($strSQL, false, "FILE: ".__FILE__."<br> LINE: ".__LINE__);

					$pullMessage = Array();
					while($row = $res->Fetch())
					{
						CUserCounter::addValueToPullMessage($row, $arSites, $pullMessage);
					}

					$DB->Query("UPDATE b_user_counter SET SENT = '1' WHERE SENT = '0' AND CODE NOT LIKE '**L%'");
					$DB->Query("SELECT RELEASE_LOCK('".$APPLICATION->GetServerUniqID()."_pull')");

					foreach ($pullMessage as $channelId => $arMessage)
					{
						CPullStack::AddByChannel($channelId, Array(
							'module_id' => 'main',
							'command' => 'user_counter',
							'params' => $arMessage,
						));
					}
				}
			}
		}
	}

	public static function Clear($user_id, $code, $site_id = SITE_ID, $sendPull = true, $bMultiple = false)
	{
		global $DB, $CACHE_MANAGER;

		$user_id = intval($user_id);
		if (
			$user_id < 0
			|| strlen($code) <= 0
		)
		{
			return false;
		}

		if (!is_array($site_id))
		{
			$site_id = array($site_id);
		}

		if ($bMultiple)
		{
			$siteToDelete = "";
			$strUpsertSQL = "
				INSERT INTO b_user_counter (USER_ID, SITE_ID, CODE, CNT, LAST_DATE) VALUES ";

			foreach ($site_id as $i => $site_id_tmp)
			{
				if ($i > 0)
				{
					$strUpsertSQL .= ",";
					$siteToDelete .= ",";
				}

				$siteToDelete .= "'".$DB->ForSQL($site_id_tmp)."'";
				$strUpsertSQL .= " (".$user_id.", '".$DB->ForSQL($site_id_tmp)."', '".$DB->ForSQL($code)."', 0, ".$DB->CurrentTimeFunction().") ";
			}
			$strUpsertSQL .= " ON DUPLICATE KEY UPDATE CNT = 0, LAST_DATE = ".$DB->CurrentTimeFunction();

			$strDeleteSQL = "
				DELETE FROM b_user_counter
				WHERE
					USER_ID = ".$user_id."
					".(
						count($site_id) == 1
							? " AND SITE_ID = '".$site_id[0]."' "
							: " AND SITE_ID IN (".$siteToDelete.") "
					)."
					AND CODE LIKE '".$DB->ForSQL($code)."L%'
				";

			$DB->Query($strDeleteSQL, false, "FILE: ".__FILE__."<br> LINE: ".__LINE__);
			$DB->Query($strUpsertSQL, false, "FILE: ".__FILE__."<br> LINE: ".__LINE__);
		}
		else
		{
			$strSQL = "
				INSERT INTO b_user_counter (USER_ID, SITE_ID, CODE, CNT, LAST_DATE) VALUES ";

			foreach ($site_id as $i => $site_id_tmp)
			{
				if ($i > 0)
					$strSQL .= ",";
				$strSQL .= " (".$user_id.", '".$DB->ForSQL($site_id_tmp)."', '".$DB->ForSQL($code)."', 0, ".$DB->CurrentTimeFunction().") ";
			}

			$strSQL .= " ON DUPLICATE KEY UPDATE CNT = 0, LAST_DATE = ".$DB->CurrentTimeFunction();

			$res = $DB->Query($strSQL, false, "FILE: ".__FILE__."<br> LINE: ".__LINE__);
		}

		if (self::$counters && self::$counters[$user_id])
		{
			foreach ($site_id as $site_id_tmp)
			{
				if ($site_id_tmp == self::ALL_SITES)
				{
					foreach(self::$counters[$user_id] as $key => $tmp)
						self::$counters[$user_id][$key][$code] = 0;
					break;
				}
				else
				{
					if (!isset(self::$counters[$user_id][$site_id_tmp]))
						self::$counters[$user_id][$site_id_tmp] = array();

					self::$counters[$user_id][$site_id_tmp][$code] = 0;
				}
			}
		}
		$CACHE_MANAGER->Clean("user_counter".$user_id, "user_counter");

		if ($sendPull)
			self::SendPullEvent($user_id, $code);

		return true;
	}


	public static function DeleteByCode($code)
	{
		global $DB, $APPLICATION, $CACHE_MANAGER;

		if (strlen($code) <= 0)
		{
			return false;
		}

		$pullMessage = Array();
		$bPullEnabled = false;

		if (self::CheckLiveMode())
		{
			$db_lock = $DB->Query("SELECT GET_LOCK('".$APPLICATION->GetServerUniqID()."_pull', 0) as L");
			$ar_lock = $db_lock->Fetch();
			if ($ar_lock["L"] > 0)
			{
				$bPullEnabled = true;

				$arSites = Array();
				$res = CSite::GetList(($b = ""), ($o = ""), Array("ACTIVE" => "Y"));
				while($row = $res->Fetch())
				{
					$arSites[] = $row['ID'];
				}

				$strSQL = "
					SELECT distinct pc.CHANNEL_ID, uc.USER_ID, uc.SITE_ID, uc.CODE, uc.CNT
					FROM b_user_counter uc
					INNER JOIN b_pull_channel pc ON pc.USER_ID = uc.USER_ID
					WHERE uc.CODE LIKE '**%'
				";

				$res = $DB->Query($strSQL, false, "FILE: ".__FILE__."<br> LINE: ".__LINE__);

				while($row = $res->Fetch())
				{
					if ($row["CODE"] == $code)
					{
						continue;
					}

					CUserCounter::addValueToPullMessage($row, $arSites, $pullMessage);
				}
			}
		}

		$DB->Query("DELETE FROM b_user_counter WHERE CODE = '".$code."'", false, "FILE: ".__FILE__."<br> LINE: ".__LINE__);

		self::$counters = false;
		$CACHE_MANAGER->CleanDir("user_counter");

		if ($bPullEnabled)
		{
			$DB->Query("SELECT RELEASE_LOCK('".$APPLICATION->GetServerUniqID()."_pull')");
		}

		foreach ($pullMessage as $channelId => $arMessage)
		{
			CPullStack::AddByChannel($channelId, Array(
				'module_id' => 'main',
				'command' => 'user_counter',
				'params' => $arMessage,
			));
		}
	}

	protected static function dbIF($condition, $yes, $no)
	{
		return "if(".$condition.", ".$yes.", ".$no.")";
	}

	// legacy function
	public static function ClearByUser($user_id, $site_id = SITE_ID, $code = self::ALL_SITES, $bMultiple = false)
	{
		return self::Clear($user_id, $code, $site_id, true, $bMultiple);
	}
}
?>