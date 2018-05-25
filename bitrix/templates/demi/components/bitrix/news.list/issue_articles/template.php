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
$this->setFrameMode(true);
?>
<div class="news-list">
<?if($arParams["DISPLAY_TOP_PAGER"]):?>
	<?=$arResult["NAV_STRING"]?><br/>
<?endif;?>
<?foreach($arResult["ITEMS"] as $arItem):?>
	<?
	$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
	$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
	?>
	<div class="news-item" id="<?=$this->GetEditAreaId($arItem['ID']);?>">
		<div class="col-md-10 leftside">
            <h3 class="arttitle">
                <a href="<?=$arItem['DETAIL_PAGE_URL']?>"><?=$arItem['NAME']?></a>
            </h3>
            <?$count = count($arItem['PROPERTIES']['AUTHORS']["VALUE"]);?>
            <?if($count == 1):?>
                <b><?=GetMessage("AUTHOR_TEXT")?>:</b>
            <?else:?>
                <b><?=GetMessage("AUTHORS_TEXT")?>:</b>
            <?endif;?>
            <?$ii = 1;?>
            <?foreach($arItem['PROPERTIES']['AUTHORS']["VALUE"] as $value):?>
                <?$arFilterA = Array("IBLOCK_ID"=>21, "ID"=>$value);
                $resA = CIBlockElement::GetList(Array(), $arFilterA, false, Array("nPageSize"=>10));?>
                <?while($obA = $resA->GetNextElement()):?>
                    <?$arPropA = $obA->GetProperties();
                    $arFieldsA = $obA->GetFields();?>
                    <a class="greeners" href="<?=$arFieldsA["DETAIL_PAGE_URL"]?>"><?=$arPropA[GetMessage("AUTHOR_NAME")]["VALUE"]?></a><?=($ii < $count ? ", " : "")?>
                    <?$ii++;?>
                <?endwhile;?>
            <?endforeach;?>
        </div>

        <div class="col-md-2 text-right text-xs-left xs-no-left-pads">
            <b class="visible-xs-inline"><?=GetMessage("PAGES")?>:&nbsp;</b><b><?=$arItem['PROPERTIES']['START_PAGE']["VALUE"]?>&nbsp;-&nbsp;<?=$arItem['PROPERTIES']['END_PAGE']["VALUE"]?></b>
        </div>
        <div class="clearfix"></div><hr>
	</div>
<?endforeach;?>
<?if($arParams["DISPLAY_BOTTOM_PAGER"]):?>
	<br /><?=$arResult["NAV_STRING"]?>
<?endif;?>
</div>
