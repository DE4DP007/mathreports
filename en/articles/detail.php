<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Издания детально");
?><br>
<?$APPLICATION->IncludeComponent(
	"bitrix:news.detail", 
	".default", 
	array(
		"ACTIVE_DATE_FORMAT" => "d.m.Y",
		"ADD_ELEMENT_CHAIN" => "N",
		"ADD_SECTIONS_CHAIN" => "Y",
		"AJAX_MODE" => "N",
		"AJAX_OPTION_ADDITIONAL" => "",
		"AJAX_OPTION_HISTORY" => "N",
		"AJAX_OPTION_JUMP" => "N",
		"AJAX_OPTION_STYLE" => "Y",
		"BROWSER_TITLE" => "-",
		"CACHE_GROUPS" => "Y",
		"CACHE_TIME" => "36000000",
		"CACHE_TYPE" => "A",
		"CHECK_DATES" => "Y",
		"COMPONENT_TEMPLATE" => ".default",
		"DETAIL_URL" => "",
		"DISPLAY_BOTTOM_PAGER" => "Y",
		"DISPLAY_DATE" => "Y",
		"DISPLAY_NAME" => "Y",
		"DISPLAY_PICTURE" => "Y",
		"DISPLAY_PREVIEW_TEXT" => "Y",
		"DISPLAY_TOP_PAGER" => "N",
		"ELEMENT_CODE" => $_REQUEST["ELEMENT_CODE"],
		"ELEMENT_ID" => $_REQUEST["ELEMENT_ID"],
		"FIELD_CODE" => array(
			0 => "",
			1 => "",
		),
		"IBLOCK_ID" => "14",
		"IBLOCK_TYPE" => "issues_en",
		"IBLOCK_URL" => "",
		"INCLUDE_IBLOCK_INTO_CHAIN" => "Y",
		"MESSAGE_404" => "",
		"META_DESCRIPTION" => "-",
		"META_KEYWORDS" => "-",
		"PAGER_BASE_LINK_ENABLE" => "N",
		"PAGER_SHOW_ALL" => "N",
		"PAGER_TEMPLATE" => ".default",
		"PAGER_TITLE" => "Страница",
		"PROPERTY_CODE" => array(
			0 => "TITLE",
			1 => "ANNOTATION",
			2 => "START_PAGE",
			3 => "END_PAGE",
			4 => "FULL_TEXT",
		),
		"SET_BROWSER_TITLE" => "Y",
		"SET_CANONICAL_URL" => "N",
		"SET_LAST_MODIFIED" => "N",
		"SET_META_DESCRIPTION" => "Y",
		"SET_META_KEYWORDS" => "Y",
		"SET_STATUS_404" => "N",
		"SET_TITLE" => "Y",
		"SHOW_404" => "N",
		"USE_PERMISSIONS" => "N",
		"USE_SHARE" => "N"
	),
	false
);?>
<?
$arSelect = Array("ID", "NAME", "DATE_ACTIVE_FROM", "DETAIL_PAGE_URL", "PROPERTY_SECTION", "PROPERTY_FULL_TEXT");
$arFilter = Array("IBLOCK_ID"=>14, "ID" => getCurrentID(14, $_REQUEST["ELEMENT_CODE"]));
$res = CIBlockElement::GetList(Array(), $arFilter, false, Array("nPageSize"=>10), $arSelect);
if(getSize(14, getCurrentID(14, $_REQUEST["ELEMENT_CODE"])) > 0){
	while($ob = $res->GetNextElement())
	{
		$arProp = $ob->GetProperties();
		$arFilterT = Array("IBLOCK_ID"=>20, "ID"=>$arProp['SECTION']["VALUE"]);
		$resT = CIBlockElement::GetList(Array(), $arFilterT, false, Array("nPageSize"=>10));
		if(getSize(20, $arProp['SECTION']["VALUE"]) > 0){
			while($obT = $resT->GetNextElement())
			{
				$arPropT = $obT->GetProperties();
				echo "Section: ", $arPropT["TITLE_EN"]["VALUE"];
			}
		}
		echo "<br>";
		echo "<p>Authors: ";
		foreach($arProp['AUTHORS']['VALUE'] as $value) {
			$arFilterA = Array("IBLOCK_ID"=>21, "ID"=>$value);
			$resA = CIBlockElement::GetList(Array(), $arFilterA, false, Array("nPageSize"=>10));
			while($obA = $resA->GetNextElement())
			{
				$arPropA = $obA->GetProperties();
				$arFieldsA = $obA->GetFields();
				echo "<a href='", $arFieldsA["DETAIL_PAGE_URL"], "'>", $arPropA["FNAME_EN"]["VALUE"], " </a>";
			}
		}
		echo "<br>";
		$arFilterJ = Array("IBLOCK_ID"=>15, "ID"=>$arProp['JOURNAL']['VALUE']);
		$resJ = CIBlockElement::GetList(Array(), $arFilterJ, false, Array("nPageSize"=>10));
		while($obJ = $resJ->GetNextElement())
		{
			$arPropJ = $obJ->GetProperties();
			echo "Issue: ", $arPropJ['TITLE']['VALUE'];
		}
		echo "</p>";
		$resJ = CIBlockElement::GetList(Array(), $arFilterJ, false, Array("nPageSize"=>10));
		while($obJ = $resJ->GetNextElement())
		{
			$arFieldsJ = $obJ->GetFields();
			echo "<a href='", $arFieldsJ["DETAIL_PAGE_URL"], "'>", "← To issue</a>";
		}
	}
}
?>
<?
function getCurrentID($iblock_id, $code)
{
	if(CModule::IncludeModule("iblock"))
	{
		$arFilter = array("IBLOCK_ID"=>$iblock_id, "CODE" => $code);
		$res = CIBlockElement::GetList(array(), $arFilter, false, array("nPageSize"=>1), array('ID'));
		$element = $res->Fetch();
		if($res->SelectedRowsCount() != 1) return '<p>Элемент не найден</p>';
		else return $element['ID'];
	}
}
?>
<?
function getSize($block_id, $id)
{
	return CIBlockElement::GetList(array(), array('IBLOCK_ID' => $block_id, "ID" => $id), array(), false, array('ID', 'NAME'));
}
?>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>