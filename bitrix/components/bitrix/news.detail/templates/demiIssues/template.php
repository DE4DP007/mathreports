<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
/** @var array $arParams */
/** @var array $arResult */
/** @global CMain $APPLICATION */
/** @global CUser $USER */
/** @global CDatabase $DB */
/** @var CBitrixComponentTemplate $this */
/** @var string $templateName */
/** @var string $templateFile */
/** @var string $templateFolder */
/** @var string $componentPath */
/** @var CBitrixComponent $component */
$this->setFrameMode(true);?>


<?/*if($arParams["DISPLAY_PICTURE"]!="N" && is_array($arResult["DETAIL_PICTURE"])) {?>
	<img
		class="detail_picture"
		border="0"
		src="<?=$arResult["DETAIL_PICTURE"]["SRC"]?>"
		width="<?=$arResult["DETAIL_PICTURE"]["WIDTH"]?>"
		height="<?=$arResult["DETAIL_PICTURE"]["HEIGHT"]?>"
		alt="<?=$arResult["DETAIL_PICTURE"]["ALT"]?>"
		title="<?=$arResult["DETAIL_PICTURE"]["TITLE"]?>"
		/>
<?}?>

<?if($arParams["DISPLAY_DATE"]!="N" && $arResult["DISPLAY_ACTIVE_FROM"]) {?>
	<span class="news-date-time"><?=$arResult["DISPLAY_ACTIVE_FROM"]?></span>
<?}*/?>

<h1 class="journhead text-right">
    <?=$arResult['NAME']?>
</h1><hr>

<div class="clearfix"></div>

<?//Определение количества статей и страниц в тестовом режиме
$arSelect = Array("ID", "NAME", "DATE_ACTIVE_FROM", "DETAIL_PAGE_URL", "PROPERTY_START_PAGE", "PROPERTY_END_PAGE");
$arFilter = Array("IBLOCK_ID"=>17, "PROPERTY_JOURNAL" => getCurrentID(16, $_REQUEST["ELEMENT_CODE"]));
$res = CIBlockElement::GetList(Array(), $arFilter, false, Array("nPageSize"=>10), $arSelect);?>
    <h4 class="text-left col-md-6">Количество статей: <?=getSize(17, "PROPERTY_JOURNAL", getCurrentID(16, $_REQUEST["ELEMENT_CODE"]))?></h4>

<?$res = CIBlockElement::GetList(Array('ID' => 'DESC'), $arFilter, false, Array("nPageSize"=>1), $arSelect);
if(getSize(17, "PROPERTY_JOURNAL", getCurrentID(16, $_REQUEST["ELEMENT_CODE"])) > 0) {
    $ob = $res->GetNextElement();
    $arProp = $ob->GetProperties();?>
    <h4 class="text-right col-md-6">Всего страниц: <?=$arProp['END_PAGE']["VALUE"]?></h4>
<?}?>
<div class="clearfix"></div>
