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

<h1 class="journhead text-right">
    <?echo GetMessage("HEAD");?>
</h1><hr>

<?if($arParams["DISPLAY_TOP_PAGER"]):?>
	<?=$arResult["NAV_STRING"]?><br/>
<?endif;?>


<?foreach($arResult["ITEMS"] as $arItem):?>
	<?$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
	$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));?>


	<div class="col-md-10 leftside" id="<?=$this->GetEditAreaId($arItem['ID']);?>">
        <h3 class="arttitle">
            <a href="<?=$arItem['DETAIL_PAGE_URL']?>"><?=$arItem['PROPERTIES']['TITLE']['VALUE']?></a>
        </h3>

<?//test_dump($arItem)?>
        <h4>
            <?$count = count($arItem['PROPERTIES']['AUTHORS']["VALUE"]);?>
            <?if($count == 1):?>
                <b><?=GetMessage("AUTHOR_STR")?>:</b>
            <?else:?>
                <b><?=GetMessage("AUTHORS_STR")?>:</b>
            <?endif;?>
            <?$ii = 1;?>
            <?foreach($arItem['PROPERTIES']['AUTHORS']["VALUE"] as $value):?>
                <?$arFilterA = Array("IBLOCK_ID"=>21, "ID"=>$value);?>
                <?$resA = CIBlockElement::GetList(Array(), $arFilterA, false, Array("nPageSize"=>10));?>
                <?while($obA = $resA->GetNextElement()):?>
                    <?$arPropA = $obA->GetProperties();?>
                    <?$arFieldsA = $obA->GetFields();?>
                    <a class="greeners" href="<?=$arFieldsA["DETAIL_PAGE_URL"]?>"><?=$arPropA[GetMessage("FNAME")]["VALUE"]?></a><?=($ii < $count ? ", " : "")?>
                    <?$ii++;?>
                <?endwhile;?>
            <?endforeach;?>
        </h4>
        <h4><b><?=GetMessage("JOURNAL_STR")?>:</b>
            <?$arFilterR = Array("IBLOCK_ID"=>GetMessage("JOURNAL_BLOCK"), "ID"=>$arItem["PROPERTIES"]['JOURNAL']['VALUE']);
            $resR = CIBlockElement::GetList(Array(), $arFilterR, false, Array("nPageSize"=>10));?>
            <?if(count($resR) > 0):?>
                <?$obR = $resR->GetNextElement();?>
                <?$arPropR = $obR->GetProperties();?>
                <?$flds = $obR->GetFields();?>
                <a href="<?=$flds['DETAIL_PAGE_URL']?>"><?=$arPropR['TITLE']['VALUE']?></a>
            <?endif;?>
        </h4>
        <h4><b><?=GetMessage("SECTION_STR")?>:</b>
            <?$arFilterT = Array("IBLOCK_ID"=>20, "ID"=>$arItem["PROPERTIES"]['SECTION']["VALUE"]);
            $resT = CIBlockElement::GetList(Array(), $arFilterT, false, Array("nPageSize"=>10));?>
            <?if(count($resT) > 0):?>
                <?$obT = $resT->GetNextElement();
                $arPropT = $obT->GetProperties();?>
                <?=$arPropT[GetMessage("SECTION_TITLE")]["VALUE"]?>
            <?endif;?>
        </h4>
    </div>

    <div class="col-md-2 text-right">
        <h4><b>
            <?=$arItem['PROPERTIES']['START_PAGE']["VALUE"]?>
            &nbsp;-&nbsp;
            <?=$arItem['PROPERTIES']['END_PAGE']["VALUE"]?>
        </b></h4>
    </div>

    <div class="clearfix"></div><hr/>
<?endforeach;?>

<?if($arParams["DISPLAY_BOTTOM_PAGER"]):?>
	<br/><?=$arResult["NAV_STRING"]?>
<?endif;?>

