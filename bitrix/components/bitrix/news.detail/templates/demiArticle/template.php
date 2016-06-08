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

<div class="col-md-6">
    <h3 class="journhead text-left">
        <?$arFilterT = Array("IBLOCK_ID"=>20, "ID"=>$arResult["PROPERTIES"]['SECTION']["VALUE"]);
        $resT = CIBlockElement::GetList(Array(), $arFilterT, false, Array("nPageSize"=>10));
        if(count($resT) > 0){
            $obT = $resT->GetNextElement();
            $arPropT = $obT->GetProperties();
            echo $arPropT[GetMessage("TITLE")]["VALUE"];
        }?>
    </h3>
</div>

<div class="col-md-6">
    <h3 class="journhead text-right">
        <?$arFilterR = Array("IBLOCK_ID"=>GetMessage("ID"), "ID"=>$arResult["PROPERTIES"]['JOURNAL']['VALUE']);
        $resR = CIBlockElement::GetList(Array(), $arFilterR, false, Array("nPageSize"=>10));
        if(count($resR) > 0){
            $obR = $resR->GetNextElement();
            $arPropR = $obR->GetProperties();
            echo $arPropR['TITLE']['VALUE'];
        }?>
    </h3>
</div>
<div class="clearfix"></div><hr>

<div class="col-md-12">
    <h1 class="journhead text-center">
        <?=$arResult['NAME']?>
    </h1>
</div>

<div class="col-md-2 hidden-sm spacer"></div>
<div class="col-md-8 col-sm-12 text-center authholder">
    <? $iii = 1;
    $ccount = count($arResult['PROPERTIES']['AUTHORS']['VALUE']);
    foreach($arResult['PROPERTIES']['AUTHORS']['VALUE'] as $value) {
        $arFilterA = Array("IBLOCK_ID"=>21, "ID"=>$value);
        $resA = CIBlockElement::GetList(Array(), $arFilterA, false, Array("nPageSize"=>10));
        $obA = $resA->GetNextElement();
        $arPropA = $obA->GetProperties();
        $arFieldsA = $obA->GetFields();
        echo '<a class="greeners" href="'.$arFieldsA["DETAIL_PAGE_URL"].'">'.$arPropA[GetMessage("FNAME")]["VALUE"].'</a>'.($iii < $ccount ? ", " : "");
        $iii++;
    }?>
</div>
<div class="col-md-2 hidden-sm spacer"></div>
<div class="clearfix"></div>


<div class="col-md-6">
    <h3 class="journhead text-left">
        <?if (isset($arResult["PROPERTIES"]["UDK"]) && ($arResult["PROPERTIES"]["UDK"]["VALUE"] != "")) {
            echo GetMessage("UDK"), ": ".$arResult["PROPERTIES"]["UDK"]["VALUE"];
        }?>
    </h3>
</div>

<div class="col-md-6">
    <h3 class="journhead text-right">
        <?echo GetMessage("PAGES_STR");?> <?=$arResult["PROPERTIES"]["START_PAGE"]["VALUE"]?> -<?=$arResult["PROPERTIES"]["END_PAGE"]["VALUE"]?>
    </h3>
</div>
<div class="clearfix"></div><br/>

<div class="col-md-12 annot text-justify">
    <?= latexTohtml($arResult["PROPERTIES"]["ANNOTATION"]["VALUE"]);?>
</div>
<div class="clearfix"></div><br><br>

<?if (isset($arResult["PROPERTIES"]["KEYWORDS"]["VALUE"]) && ($arResult["PROPERTIES"]["KEYWORDS"]["VALUE"] != "")) {?>
    <div class="col-md-12 keywords">
        <p class="text-justify">
            <b><?echo (SITE_ID == "s1" ? "Ключевые слова: " : "Keywords: ");?></b>
            <?=$arResult["PROPERTIES"]["KEYWORDS"]["VALUE"]?>.
        </p>
    </div>
    <div class="clearfix"></div><br><br>
<?}?>
<br>



<p class="col-md-6 col-xs-12 text-right">
    <?$issuesBlock = (SITE_ID == "s1" ? 16 : 15)?>
    <?$arFiltJ = Array("IBLOCK_ID"=>$issuesBlock, "ID"=>$arResult['PROPERTIES']['JOURNAL']['VALUE']);
    $rsJ = CIBlockElement::GetList(Array(), $arFiltJ, false, Array("nPageSize"=>10));
    $aJ = $rsJ->GetNext();?>
    <a href="<?= $aJ["DETAIL_PAGE_URL"];?>"
       class="btn btn-lg btn-primary">
            <span class="glyphicon glyphicon-arrow-left"></span>
            <?echo (SITE_ID == "s1" ? "В содержание выпуска" : "To issue content")?>
    </a>
</p>


<p class="col-md-6 col-xs-12 text-left">
    <?if (isset($arResult["PROPERTIES"]["FULL_TEXT"]) && ($arResult["PROPERTIES"]["FULL_TEXT"]["VALUE"] != "")) {?>
        <a href="<?=$arResult["PROPERTIES"]["FULL_TEXT"]["VALUE"]?>" class="btn btn-success btn-lg">
            <?echo GetMessage("DOWNLOAD")?>
            <span class="glyphicon glyphicon-book"></span>
        </a>
    <?} else {?>
        <a href="#" class="btn btn-warning btn-lg">
            <?echo GetMessage("NO_FILE")?>
            <span class="glyphicon glyphicon-remove"></span>
        </a>
    <?}?>
</p>

<br><br>


