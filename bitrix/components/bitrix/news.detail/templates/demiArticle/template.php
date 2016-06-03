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


<div class="col-md-6 no-left-pads">
    <h3 class="journhead text-left">
        <?$arFilterT = Array("IBLOCK_ID"=>20, "ID"=>$arResult["PROPERTIES"]['SECTION']["VALUE"]);
        $resT = CIBlockElement::GetList(Array(), $arFilterT, false, Array("nPageSize"=>10));
        if(count($resT) > 0){
            $obT = $resT->GetNextElement();
            $arPropT = $obT->GetProperties();
            echo $arPropT["TITLE"]["VALUE"];
        }?>
    </h3>
</div>

<div class="col-md-6 no-right-pads">
    <h3 class="journhead text-right">
        <?$arFilterR = Array("IBLOCK_ID"=>16, "ID"=>$arResult["PROPERTIES"]['JOURNAL']['VALUE']);
        $resR = CIBlockElement::GetList(Array(), $arFilterR, false, Array("nPageSize"=>10));
        if(count($resT) > 0){
            $obR = $resR->GetNextElement();
            $arPropR = $obR->GetProperties();
            echo $arPropR['TITLE']['VALUE'];
        }?>
    </h3>
</div>
<div class="clearfix"></div><hr>

<h1 class="journhead text-center">
    <?=$arResult['NAME']?>
</h1>

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
        echo '<a class="greeners" href="'.$arFieldsA["DETAIL_PAGE_URL"].'">'.$arPropA["FNAME"]["VALUE"].'</a>'.($iii < $ccount ? "," : "");
        $iii++;
    }?>
</div>
<div class="col-md-2 hidden-sm spacer"></div>
<div class="clearfix"></div>


<div class="col-md-6 no-left-pads">
    <h3 class="journhead text-left">
        <?if (isset($arResult["PROPERTIES"]["UDK"]) && ($arResult["PROPERTIES"]["UDK"]["VALUE"] != "")) {
            echo "УДК: ".$arResult["PROPERTIES"]["UDK"]["VALUE"];
        }?>
    </h3>
</div>

<div class="col-md-6 no-right-pads">
    <h3 class="journhead text-right">
        Страницы: <?=$arResult["PROPERTIES"]["START_PAGE"]["VALUE"]?> -<?=$arResult["PROPERTIES"]["END_PAGE"]["VALUE"]?>
    </h3>
</div>
<div class="clearfix"></div><br/>

<div class="col-md-12 annot">
    <?=$arResult["PROPERTIES"]["ANNOTATION"]["VALUE"]?>
</div>
<div class="clearfix"></div><br><br><br>




<p class="col-md-6 col-xs-12 text-right">
    <a href="
        <?$arFilterJ = Array("IBLOCK_ID"=>16, "ID"=>$arProp['JOURNAL']['VALUE']);
    $resJ = CIBlockElement::GetList(Array(), $arFilterJ, false, Array("nPageSize"=>10));
    $obJ = $resJ->GetNextElement();
    $arFieldsJ = $obJ->GetFields();
    echo $arFieldsJ["DETAIL_PAGE_URL"];?>
    "
       class="btn btn-lg btn-primary">
        <span class="glyphicon glyphicon-arrow-left"></span> В список выпусков
    </a>
</p>


<p class="col-md-6 col-xs-12 text-left">
    <?if (isset($arResult["PROPERTIES"]["FULL_TEXT"]) && ($arResult["PROPERTIES"]["FULL_TEXT"]["VALUE"] != "")) {?>
        <a href="<?=$arResult["PROPERTIES"]["FULL_TEXT"]["VALUE"]?>" class="btn btn-success btn-lg">
            Скачать полный текст
            <span class="glyphicon glyphicon-book"></span>
        </a>
    <?} else {?>
        <a href="#" class="btn btn-warning btn-lg">
            Полный текст недоступен
            <span class="glyphicon glyphicon-remove"></span>
        </a>
    <?}?>
</p>

<br><br>