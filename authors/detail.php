<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
?>
<?
if (SITE_ID == "s1") {
	$fname = "FNAME";
	$add_info = "ADD_INFO";
	$work = "WORK";
	echo "<h1 style=\"text-align: right;\"><span style=\"font-size: 20pt; color: #2f4f4f;\">Сведения об авторе</span></h1>
	<span style=\"color: #2f4f4f;\"> </span>
	<hr>";
	$APPLICATION->SetTitle("Сведения об авторе");
} else {
	$fname = "FNAME_EN";
	$add_info = "ADD_INFO_EN";
	$work = "WORK_EN";
	echo "<h1 style=\"text-align: right;\"><span style=\"font-size: 20pt; color: #2f4f4f;\">About the author</span></h1>
	<span style=\"color: #2f4f4f;\"> </span>
	<hr>";
	$APPLICATION->SetTitle("About the author");
}?>
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
		"IBLOCK_ID" => "21",
		"IBLOCK_TYPE" => "commonblock",
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
			0 => $fname,
			1 => $add_info,
			2 => $work,
			3 => "",
			4 => "",
			5 => "",
			6 => "",
			7 => "",
			8 => "",
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
if (SITE_ID == "s1") {
	getArticles(17, "Статьи:", "стр.");
} else {
	getArticles(14, "Article:", "pages");
}
?>
<?
function getArticles($block_id, $article_string, $pages_string) {
	$arSelect = Array("ID", "NAME", "DATE_ACTIVE_FROM", "DETAIL_PAGE_URL", "PROPERTY_START_PAGE", "PROPERTY_END_PAGE", "PROPERTY_JOURNAL");
	$arFilter = Array("IBLOCK_ID"=>$block_id, "PROPERTY_AUTHORS" => getCurrentID(21, $_REQUEST["ELEMENT_CODE"]));
	if(getSize($block_id, getCurrentID(21, $_REQUEST["ELEMENT_CODE"])) > 0) {
		echo "<br><p>", $article_string," </p>";
		$res = CIBlockElement::GetList(Array(), $arFilter, false, Array("nPageSize"=>10), $arSelect);
		while ($ob = $res->GetNextElement()) {
			$arFields = $ob->GetFields();
			$arProp = $ob->GetProperties();
			$arFilterI = Array("ID" => $arProp['JOURNAL']["VALUE"]);
			$resI = CIBlockElement::GetList(Array(), $arFilterI, false, Array("nPageSize" => 10));
			while ($obI = $resI->GetNextElement()) {
				$arPropI = $obI->GetProperties();
				echo "<a href='", $arFields['DETAIL_PAGE_URL'], "'>", $arFields['NAME'];
				echo " // ", $arPropI["TITLE"]["VALUE"], ", ", $pages_string," ", $arProp['START_PAGE']["VALUE"], " - ", $arProp['END_PAGE']["VALUE"], "</a><br>";
			}
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
	return CIBlockElement::GetList(array(), array('IBLOCK_ID' => $block_id, "PROPERTY_AUTHORS" => $id), array(), false, array('ID', 'NAME'));
}
?>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>