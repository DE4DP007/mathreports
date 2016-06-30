<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");?>

<? global $arrFilter;
$arrFilter = Array('PROPERTY_JOURNAL' => 74);?>


<h1 class="journhead text-right">Journal Archive</h1>
<hr>

<?CModule::IncludeModule("iblock");
$arSelect = Array("ID", "NAME", "DETAIL_PAGE_URL");
$arFilter = Array("IBLOCK_ID"=>15);
$res = CIBlockElement::GetList(Array('ID'=>"DESC"), $arFilter, false, Array("nPageSize"=>10), $arSelect);?>

<div class="col-md-7 col-sm-12 lefttexter">
    <h2 class="text-left ">Issues</h2><br>

    <?while ($ob = $res->GetNextElement()) {?>
        <?$arFields = $ob->GetFields();?>
        <p>
            <b><a href="<?=$arFields["DETAIL_PAGE_URL"]?>"><?=$arFields['NAME']?></a></b><br>
            <?$arFilterI = Array("IBLOCK_ID"=>14, "PROPERTY_JOURNAL" => $arFields['ID']);
            $resI = CIBlockElement::GetList(Array(), $arFilterI, false, Array("nPageSize"=>10));?>
            Articles count: <?=getSize(14, "PROPERTY_JOURNAL", $arFields['ID'])?><br>
            <?$resI = CIBlockElement::GetList(Array('ID' => 'DESC'), $arFilterI, false, Array("nPageSize"=>1), $arSelect);?>
            <?if(getSize(14, "PROPERTY_JOURNAL", $arFields['ID']) > 0) {
                $obI = $resI->GetNextElement();
                $arPropI = $obI->GetProperties();?>
                Total pages: <?=$arPropI['END_PAGE']["VALUE"]?>
                <br><hr>
            <?}?>
        </p>
    <?}?>
</div>

<div class="col-md-5 col-sm-12 no-right-pads">
    <h2 class="text-right">Our authors</h2><br>

    <?$APPLICATION->IncludeComponent(
	"bitrix:news.list", 
	"demiAuthPartial", 
	array(
		"ACTIVE_DATE_FORMAT" => "d.m.Y",
		"ADD_SECTIONS_CHAIN" => "Y",
		"AJAX_MODE" => "N",
		"AJAX_OPTION_ADDITIONAL" => "",
		"AJAX_OPTION_HISTORY" => "N",
		"AJAX_OPTION_JUMP" => "N",
		"AJAX_OPTION_STYLE" => "Y",
		"CACHE_FILTER" => "N",
		"CACHE_GROUPS" => "Y",
		"CACHE_TIME" => "36000000",
		"CACHE_TYPE" => "A",
		"CHECK_DATES" => "Y",
		"DETAIL_URL" => "",
		"DISPLAY_BOTTOM_PAGER" => "Y",
		"DISPLAY_DATE" => "Y",
		"DISPLAY_NAME" => "Y",
		"DISPLAY_PICTURE" => "Y",
		"DISPLAY_PREVIEW_TEXT" => "Y",
		"DISPLAY_TOP_PAGER" => "N",
		"FIELD_CODE" => array(
			0 => "",
			1 => "SORT",
			2 => "",
		),
		"FILTER_NAME" => "",
		"HIDE_LINK_WHEN_NO_DETAIL" => "N",
		"IBLOCK_ID" => "21",
		"IBLOCK_TYPE" => "commonblock",
		"INCLUDE_IBLOCK_INTO_CHAIN" => "Y",
		"INCLUDE_SUBSECTIONS" => "Y",
		"MESSAGE_404" => "",
		"NEWS_COUNT" => "5",
		"PAGER_BASE_LINK_ENABLE" => "N",
		"PAGER_DESC_NUMBERING" => "N",
		"PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
		"PAGER_SHOW_ALL" => "N",
		"PAGER_SHOW_ALWAYS" => "N",
		"PAGER_TEMPLATE" => ".default",
		"PAGER_TITLE" => "Новости",
		"PARENT_SECTION" => "",
		"PARENT_SECTION_CODE" => "",
		"PREVIEW_TRUNCATE_LEN" => "",
		"PROPERTY_CODE" => array(
			0 => "FNAME",
			1 => "FNAME_EN",
			2 => "SURNAME",
			3 => "NAME",
			4 => "PATRONIM",
			5 => "ENSURNAME",
			6 => "ENNAME",
			7 => "ENPATRONIM",
			8 => "Description",
			9 => "SHORT_TITLE",
			10 => "",
		),
		"SET_BROWSER_TITLE" => "Y",
		"SET_LAST_MODIFIED" => "N",
		"SET_META_DESCRIPTION" => "Y",
		"SET_META_KEYWORDS" => "Y",
		"SET_STATUS_404" => "N",
		"SET_TITLE" => "Y",
		"SHOW_404" => "N",
		"SORT_BY1" => "RAND", 
		"SORT_ORDER1" => "ASC", 
		"COMPONENT_TEMPLATE" => "demiAuthPartial"
	),
	false
);?>

</div>
<div class="clearfix"></div>

<?function getSize($block, $property, $id) {
	return CIBlockElement::GetList(array(), array('IBLOCK_ID' => $block, $property => $id), array(), false, array('ID', 'NAME'));
}?>


<?
$APPLICATION->SetTitle("Issues");
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>