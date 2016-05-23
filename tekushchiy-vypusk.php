<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Текущий выпуск");
?><h1 style="text-align: right;"><span style="font-size: 20pt;">Текущий выпуск</span></h1>
<hr>
 <?$APPLICATION->IncludeComponent(
	"bitrix:news.list",
	".default",
	Array(
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
		"COMPONENT_TEMPLATE" => ".default",
		"DETAIL_URL" => "",
		"DISPLAY_BOTTOM_PAGER" => "N",
		"DISPLAY_DATE" => "Y",
		"DISPLAY_NAME" => "Y",
		"DISPLAY_PICTURE" => "Y",
		"DISPLAY_PREVIEW_TEXT" => "Y",
		"DISPLAY_TOP_PAGER" => "N",
		"FIELD_CODE" => array(0=>"",1=>"",),
		"FILTER_NAME" => "arrFilter",
		"HIDE_LINK_WHEN_NO_DETAIL" => "N",
		"IBLOCK_ID" => "16",
		"IBLOCK_TYPE" => "issues",
		"INCLUDE_IBLOCK_INTO_CHAIN" => "Y",
		"INCLUDE_SUBSECTIONS" => "Y",
		"MESSAGE_404" => "",
		"NEWS_COUNT" => "1",
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
		"PROPERTY_CODE" => array(0=>"TITLE",1=>"DESCRIPTION",2=>"ARTICLE_COUNT",3=>"PAGES",4=>"ENTitle",5=>"Title",6=>"ENDescription",7=>"Description",8=>"LINK",9=>"EMAIL",10=>"ISBN",11=>"ISSN",12=>"ADRESS",13=>"VAK",14=>"PUBLISHER",15=>"IF_Scopus",16=>"IF_WoS",17=>"IF_RINC",18=>"SCOPUS_LINK",19=>"WOS_LINK",20=>"zbMATH_LINK",21=>"RINC_LINK",22=>"Country",23=>"PHONE",24=>"FAX",25=>"ENTITLE",26=>"ANNOTATION",27=>"ENANNOTATION",28=>"BIBLIODATA",29=>"BIBLIODATAEN",30=>"isOMI",31=>"FULLTEXT",32=>"UDK",33=>"PUBLDATE",34=>"",),
		"SET_BROWSER_TITLE" => "Y",
		"SET_LAST_MODIFIED" => "N",
		"SET_META_DESCRIPTION" => "Y",
		"SET_META_KEYWORDS" => "Y",
		"SET_STATUS_404" => "N",
		"SET_TITLE" => "Y",
		"SHOW_404" => "N",
		"SORT_BY1" => "PROPERTY_PUBLDATE",
		"SORT_BY2" => "SORT",
		"SORT_ORDER1" => "DESC",
		"SORT_ORDER2" => "ASC"
	)
);?>
<?
CModule::IncludeModule("iblock");
$arFilter = Array(
	"IBLOCK_ID"=>IntVal(16),
	//">DATE_ACTIVE_FROM"=>date($DB->DateFormatToPHP(CLang::GetDateFormat("SHORT")), time()),
	"ACTIVE"=>"Y",
);
$res = CIBlockElement::GetList(Array("ID"=>"DESC", "PROPERTY_PRIORITY"=>"ASC"), $arFilter, Array("IBLOCK_SECTION_ID","NAME", "DATE_ACTIVE_FROM"));
if($ar_fields = $res->GetNext())
{
	echo GetPublications($ar_fields["ID"]);
}
?>
<?
function GetPublications($id)
{
	$arSelect = Array("ID", "NAME", "DATE_ACTIVE_FROM", "DETAIL_PAGE_URL", "PROPERTY_START_PAGE", "PROPERTY_END_PAGE");
	$arFilter = Array("IBLOCK_ID"=>17, "PROPERTY_JOURNAL" => $id);
	$res = CIBlockElement::GetList(Array(), $arFilter, false, Array("nPageSize"=>10), $arSelect);
	if(getSize($id) > 0) {
		echo "<br><h4>Содержание</h4>";
		$res->NavStart(10);
		echo $res->NavPrint("Публикации"), "<br>";
		while($ob = $res->GetNextElement())
		{
			$arFields = $ob->GetFields();
			$arProp = $ob->GetProperties();
			echo "<a href='",$arFields['DETAIL_PAGE_URL'], "'>", $arFields['NAME'], "</a>";
			echo " ", $arProp['START_PAGE']["VALUE"], " - ", $arProp['END_PAGE']["VALUE"];
			$count = 0;
			foreach($arProp['AUTHORS']["VALUE"] as $value){
				$count++;
			}
			if ($count == 1) {
				echo "<br>Автор: ";
			} else {
				echo "<br>Авторы: ";
			}
			foreach($arProp['AUTHORS']["VALUE"] as $value){
				$arFilterA = Array("IBLOCK_ID"=>21, "ID"=>$value);
				$resA = CIBlockElement::GetList(Array(), $arFilterA, false, Array("nPageSize"=>10));
				while($obA = $resA->GetNextElement())
				{
					$arPropA = $obA->GetProperties();
					$arFieldsA = $obA->GetFields();
					echo "<a href='", $arFieldsA["DETAIL_PAGE_URL"], "'>", $arPropA["FNAME"]["VALUE"], " </a>";
				}
			}
			echo "<br>";
		}
		echo $res->NavPrint("Публикации");
	}
}
?>
<?
function getSize($id)
{
	return CIBlockElement::GetList(array(), array('IBLOCK_ID' => 17, "PROPERTY_JOURNAL" => $id), array(), false, array('ID', 'NAME'));
}
?><?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>