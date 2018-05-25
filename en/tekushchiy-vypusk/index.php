<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Current Issue");?>


<?CModule::IncludeModule("iblock");
$arSelect = Array("ID", "NAME", "DETAIL_PAGE_URL");
$arFilter = Array("IBLOCK_ID"=>15, "ACTIVE" => "Y");
$res = CIBlockElement::GetList(Array('ID'=>"DESC"), $arFilter, false, Array("nPageSize"=>1), $arSelect);?>
<?$ob = $res->GetNextElement(); $arFields = $ob->GetFields();?>

<h1 class="journhead text-right">
     Current Issue: <?=$arFields['NAME']?>
</h1><hr>


<h3 class="col-md-6 journhead text-left text-xs-center">
    <?$arFilterI = Array("IBLOCK_ID"=>14, "PROPERTY_JOURNAL" => $arFields['ID']);
    $resI = CIBlockElement::GetList(Array(), $arFilterI, false, Array("nPageSize"=>10));?>
    Articles count: <?=getSize(14, "PROPERTY_JOURNAL", $arFields['ID'])?>
</h3>
<h3 class="col-md-6 journhead text-right text-xs-center">
    <?$resI = CIBlockElement::GetList(Array('ID' => 'DESC'), $arFilterI, false, Array("nPageSize"=>1), $arSelect);?>
    <?if(getSize(14, "PROPERTY_JOURNAL", $arFields['ID']) > 0):?>
        <?$obI = $resI->GetNextElement();
        $arPropI = $obI->GetProperties();?>
        Total pages: <?=$arPropI['END_PAGE']["VALUE"]?>
        <br>
    <?endif;?>
</h3>



<div class="col-md-12 lefttexter">
    <?CModule::IncludeModule("iblock");
    $arFilter = Array(
        "IBLOCK_ID"=>IntVal(15),
        //">DATE_ACTIVE_FROM"=>date($DB->DateFormatToPHP(CLang::GetDateFormat("SHORT")), time()),
        "ACTIVE"=>"Y",
    );
    $res = CIBlockElement::GetList(Array("ID"=>"DESC", "PROPERTY_PRIORITY"=>"ASC"), $arFilter, Array("IBLOCK_SECTION_ID","NAME", "DATE_ACTIVE_FROM"));?>
    <?if($ar_fields = $res->GetNext()):?>
    	<?$arFilter = Array("IBLOCK_ID"=>14, "PROPERTY_JOURNAL" => $ar_fields["ID"]);?>
        <h2 class="text-center">Table of contents</h2><br/>

		<?$APPLICATION->IncludeComponent(
		"bitrix:news.list", 
		"issue_articles", 
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
			"COMPONENT_TEMPLATE" => "issue_articles",
			"DETAIL_URL" => "",
			"DISPLAY_BOTTOM_PAGER" => "Y",
			"DISPLAY_DATE" => "Y",
			"DISPLAY_NAME" => "Y",
			"DISPLAY_PICTURE" => "Y",
			"DISPLAY_PREVIEW_TEXT" => "Y",
			"DISPLAY_TOP_PAGER" => "N",
			"FIELD_CODE" => array(
				0 => "",
				1 => "",
			),
			"FILTER_NAME" => "arFilter",
			"HIDE_LINK_WHEN_NO_DETAIL" => "N",
			"IBLOCK_ID" => "14",
			"IBLOCK_TYPE" => "issues_en",
			"INCLUDE_IBLOCK_INTO_CHAIN" => "Y",
			"INCLUDE_SUBSECTIONS" => "Y",
			"MESSAGE_404" => "",
			"NEWS_COUNT" => "20",
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
				0 => "START_PAGE",
				1 => "END_PAGE",
				2 => "AUTHORS",
				3 => "",
			),
			"SET_BROWSER_TITLE" => "Y",
			"SET_LAST_MODIFIED" => "N",
			"SET_META_DESCRIPTION" => "Y",
			"SET_META_KEYWORDS" => "Y",
			"SET_STATUS_404" => "N",
			"SET_TITLE" => "N",
			"SHOW_404" => "N",
			"SORT_BY1" => "ACTIVE_FROM",
			"SORT_BY2" => "SORT",
			"SORT_ORDER1" => "DESC",
			"SORT_ORDER2" => "ASC"
		),
		false
		);?>
    <?endif;?>
</div>


<div class="clearfix"></div>
<br><br><br>

<p class="text-left text-xs-center">
    <a href="<?=SITE_DIR?>issues/" class="btn btn-lg btn-primary">
        <span class="glyphicon glyphicon-arrow-left"></span> To issues
    </a>
</p>


<?function getSize($block, $property, $id){
	return CIBlockElement::GetList(array(), array('IBLOCK_ID' => $block, $property => $id), array(), false, array('ID', 'NAME'));
}?>

<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>