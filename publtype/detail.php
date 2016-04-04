<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Типы публикаций детально");
?><br>
<br>
<br>
<br>
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
		"IBLOCK_ID" => "10",
		"IBLOCK_TYPE" => "biblio",
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
			0 => "",
			1 => "",
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

	<br>
	<h4>Список публикаций</h4>
<?
$arSelect = Array("ID", "NAME", "DATE_ACTIVE_FROM", "DETAIL_PAGE_URL");
$arFilter = Array("IBLOCK_ID"=>9, "ACTIVE_DATE"=>"Y", "ACTIVE"=>"Y", "PROPERTY_PUBLTYPE" => getCurrentID(10, $_REQUEST["ELEMENT_CODE"]));
$res = CIBlockElement::GetList(Array(), $arFilter, false, Array("nPageSize"=>10), $arSelect);
$res->NavStart(10);
echo $res->NavPrint("Публикации"), "<br>";
while($ob = $res->GetNextElement())
{
	$arFields = $ob->GetFields();
	echo "<a href='",$arFields['DETAIL_PAGE_URL'], "'>", $arFields['NAME'], "</a>";
	echo "<br>";
}
echo $res->NavPrint("Публикации");
?>
	<br>
	<p>
		<a href="/publtype/">&larr; К типам публикаций</a>
	</p>
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
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>