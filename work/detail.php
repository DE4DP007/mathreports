<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("");
?><?
if (SITE_ID == "s1") {
    $work = "TITLE";
    echo "<h1 style=\"text-align: right;\"><span style=\"font-size: 20pt; color: #2f4f4f;\">Организация</span></h1>
	<span style=\"color: #2f4f4f;\"> </span>
	<hr>";
    $APPLICATION->SetTitle("Место работы");
} else {
    $work = "TITLE_EN";
    echo "<h1 style=\"text-align: right;\"><span style=\"font-size: 20pt; color: #2f4f4f;\">Organization</span></h1>
	<span style=\"color: #2f4f4f;\"> </span>
	<hr>";
    $APPLICATION->SetTitle("Work");
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
		"IBLOCK_ID" => "22",
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
			0 => "$work",
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
<?
if (SITE_ID == "s1") {
	getAuthorsAndArticles("Авторы", "FNAME", 17, "Статьи");
	echo "<br><a href='/work/'>← К организациям";
} else {
	getAuthorsAndArticles("Authors", "FNAME_EN", 14, "Articles");
	echo "<br><a href='/work/'>← To organizations";
}
?>
<?
function getAuthorsAndArticles($string, $value, $arblock, $arString, $title){
	$arSelect = Array("ID", "NAME", "DATE_ACTIVE_FROM", "DETAIL_PAGE_URL");
	$arFilter = Array("IBLOCK_ID"=>21, "PROPERTY_WORK" => getCurrentID(22, $_REQUEST["ELEMENT_CODE"]));
	$res = CIBlockElement::GetList(Array(), $arFilter, false, Array("nPageSize"=>5), $arSelect);
	if(getSize(21, getCurrentID(22, $_REQUEST["ELEMENT_CODE"]), "PROPERTY_WORK") > 0){
		echo "<br><p>", $string, ": </p>";
		while($ob = $res->GetNextElement())
		{
			$arFields = $ob->GetFields();
			$arProp = $ob->GetProperties();
			echo "<a href='", $arFields['DETAIL_PAGE_URL'], "'>", $arProp[$value]["VALUE"], "</a><br>";
			$authsID[] = $arFields['ID'];
		}
		echo "<br><p>", $arString, ": </p>";
		getArticles($authsID, $arblock);
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
	foreach($resultArr as $value) {
		echo "<a href='", $value["DPURL"], "'>", $value["TITLE"], "</a><br>";
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
function getSize($block_id, $id, $value)
{
	return CIBlockElement::GetList(array(), array('IBLOCK_ID' => $block_id, $value => $id), array(), false, array('ID', 'NAME'));
}
?>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>