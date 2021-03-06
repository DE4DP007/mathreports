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
$arFilter = array("IBLOCK_ID" => GetMessage("ID"), "PROPERTY_JOURNAL" => $arResult["ID"]);
$count = CIBlockElement::GetList(Array(), $arFilter, array(), false, array());
$hasActiveFrom = $arParams["DISPLAY_DATE"]!="N" && $arResult["ACTIVE_FROM"];
$colWidth = $hasActiveFrom ? 'col-md-4' : 'col-md-6';?>
<h3 class="journhead text-left <?=$colWidth?> text-xs-center"><?=GetMessage("ARTICLES_STR")?>: <?=$count?></h3>

<?if($hasActiveFrom):?>
	<h3 class="journhead text-center <?=$colWidth?> text-xs-center"><?=GetMessage('DATE')?>: <?=$arResult["ACTIVE_FROM"]?></h3>
<?endif;?>

<?$res = CIBlockElement::GetList(Array('ID' => 'DESC'), $arFilter, false, Array("nPageSize"=>1), $arSelect);?>
<?if($count > 0):?>
    <?$ob = $res->GetNextElement();
    $arProp = $ob->GetProperties();?>
    <h3 class="journhead text-right <?=$colWidth?> text-xs-center"><?echo GetMessage("PAGES_STR")?>: <?=$arProp['END_PAGE']["VALUE"]?></h3>
<?endif;?>
<div class="clearfix"></div>
