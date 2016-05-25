<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
?>
<?
if (SITE_ID == "s1") {
	$work = "TITLE";
	echo "<h1 style=\"text-align: right;\"><span style=\"font-size: 20pt; color: #2f4f4f;\">Организации</span></h1>
	<span style=\"color: #2f4f4f;\"> </span>
	<hr>";
	$APPLICATION->SetTitle("Место работы");
	getSizes("Общее количество авторов", "TITLE", 17, "Общее количество статей");
} else {
	$work = "TITLE_EN";
	echo "<h1 style=\"text-align: right;\"><span style=\"font-size: 20pt; color: #2f4f4f;\">Organizations</span></h1>
	<span style=\"color: #2f4f4f;\"> </span>
	<hr>";
	$APPLICATION->SetTitle("Work");
	getSizes("Total number of authors", "TITLE_EN", 14, "Total number of articles");
}?>
<?
function getSizes($authors, $title, $block, $arText) {
	CModule::IncludeModule("iblock");
	$arSelect = Array("ID", "NAME", "DETAIL_PAGE_URL");
	$arFilter = Array("IBLOCK_ID"=>22);
	$res = CIBlockElement::GetList(Array(), $arFilter, false, Array("nPageSize"=>10), $arSelect);
	while ($ob = $res->GetNextElement()) {
		$arID = array();
		$arFields = $ob->GetFields();
		$arProp = $ob->GetProperties();
		echo "<p><b>", "<a href='", $arFields["DETAIL_PAGE_URL"], "'>", $arProp[$title]['VALUE'], "</a></b><br>";
		echo $authors, ": ", getSize(21, "PROPERTY_WORK", $arFields['ID']), "<br>";
		$arFilterA = Array("IBLOCK_ID"=>21, "PROPERTY_WORK"=>$arFields['ID']);
		$resA = CIBlockElement::GetList(array(), $arFilterA, false, Array("nPageSize"=>10), array('ID', 'NAME'));
		while($obA = $resA->GetNextElement()) {
			$arFieldsA = $obA->GetFields();
			$arID[] = $arFieldsA['ID'];
		}
		echo $arText, ": ", getArticles($arID, $block);
		echo "</p>";
	}
}
?>
<?
function getArticles($authsID, $block_id) {
	$inputArr = array();
	foreach($authsID as $value){
		$arFilter = Array("IBLOCK_ID"=>$block_id, "PROPERTY_AUTHORS" => $value);
		$res = CIBlockElement::GetList(Array(), $arFilter, false, Array("nPageSize"=>5));
		if(getSize($block_id, $value, "PROPERTY_AUTHORS") > 0) {
			while ($ob = $res->GetNextElement()) {
				$arFields = $ob->GetFields();
				$arProp = $ob->GetProperties();
				array_push($inputArr, array("DPURL" => $arFields['DETAIL_PAGE_URL'], "TITLE" => $arProp["TITLE"]["VALUE"]));
			}
		}
	}
	$resultArr = unique_multidim_array($inputArr, "DPURL");
	return count($resultArr);
}
?>
<?
function unique_multidim_array($array, $key) {
	$temp_array = array();
	$i = 0;
	$key_array = array();

	foreach($array as $val) {
		if (!in_array($val[$key], $key_array)) {
			$key_array[$i] = $val[$key];
			$temp_array[$i] = $val;
		}
		$i++;
	}
	return $temp_array;
}
?>
<?
function getSize($block, $property, $id)
{
	return CIBlockElement::GetList(array(), array('IBLOCK_ID' => $block, $property => $id), array(), false, array('ID', 'NAME'));
}
?>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>