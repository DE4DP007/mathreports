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
	<?=$arResult["NAV_STRING"]?><br />
<?endif;?>
<?foreach($arResult["ITEMS"] as $arItem):?>
	<?
	$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
	$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
	?>
	<div class="news-item" id="<?=$this->GetEditAreaId($arItem['ID']);?>">
		<h4 class="artlist"><a href="<?=$arItem["DETAIL_PAGE_URL"]?>">
            <span class="glyphicon glyphicon-book"></span>
            
            <?$n = sizeof($arItem['PROPERTIES']['AUTHORS']["VALUE"]);
            $k = 1;?>

            <?foreach ($arItem['PROPERTIES']['AUTHORS']["VALUE"] as $key => $value):?>
                <?$arFilter = array("BLOCK_ID"=>21, "ID"=>$value);
                $res = CIBlockElement::GetList(array(), $arFilter, false, array("nPageSize"=>10));
                $ob = $res->GetNextElement();
                $arProp = $ob->GetProperties();?>
                <?=$arProp[GetMessage("AUTHOR_NAME")]["VALUE"]?>
                <?=($k == $n ? ". " : ", ")?>
                <?$k++;?>
            <?endforeach;?>

            <?$arFilter = array("ID"=>$arItem["PROPERTIES"]["JOURNAL"]["VALUE"]);
            $res = CIBlockElement::GetList(array(), $arFilter, false, array("nPageSize"=>10));
            $ob = $res->GetNextElement();
            $arProp = $ob->GetProperties();?>

            <?=$arItem["NAME"]?> // 
            <?=$arProp["TITLE"]["VALUE"]?>, <?=GetMessage("PAGES")?> <?=$arItem["PROPERTIES"]["START_PAGE"]["VALUE"]?> - <?=$arItem["PROPERTIES"]["END_PAGE"]["VALUE"]?>
        </a></h4>
	</div>
<?endforeach;?>
<?if($arParams["DISPLAY_BOTTOM_PAGER"]):?>
	<br /><?=$arResult["NAV_STRING"]?>
<?endif;?>
</div>
