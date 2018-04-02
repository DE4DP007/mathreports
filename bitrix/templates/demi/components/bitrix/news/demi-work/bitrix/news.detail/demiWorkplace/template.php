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

<div class="col-md-12">
    <h1 class="journhead text-center">
        <?=$arResult['PROPERTIES'][GetMessage("TITLE")]['VALUE']?>
    </h1>
</div>
<div class="clearfix"></div><br>


<div class="col-md-12">
    <?if(isset($arResult["DETAIL_PICTURE"])):?>
        <p class="col-md-4">
            <img src="<?=$arResult["DETAIL_PICTURE"]["SRC"]?>"
                 title="<?=$arResult['PROPERTIES'][GetMessage("TITLE")]['VALUE']?>"
                 alt="<?=$arResult['PROPERTIES'][GetMessage("TITLE")]['VALUE']?>"
                 class="img-responsive img-thumbnail">
        </p>
        <p class="col-md-8">
    <?else:?>
        <p class="col-md-12">
    <?endif;?>
        <?=$arResult[GetMessage("TEXT")]?>
    </p>
</div>
<div class="clearfix"></div>



<?// AUTHORS
$arSelect = Array("ID", "PROPERTY_FNAME", "PROPERTY_FNAME_EN", "DATE_ACTIVE_FROM", "DETAIL_PAGE_URL", "NAME");
$arFilter = Array("IBLOCK_ID"=>21, "PROPERTY_WORK" => $arResult["ID"]);
$res = CIBlockElement::GetList(Array(), $arFilter, false, Array("nPageSize"=>5), $arSelect);?>

<h3 class="col-md-12 text-center">
    <?=GetMessage("AUTHORS_TITLE")?>
</h3>
<div class="clearfix"></div><br/>
<?while($ob = $res->GetNext()):?>
    <p class="col-md-6 text-center">
        <a class="greeners" href="<?=$ob["DETAIL_PAGE_URL"]?>" >
            <?=$ob[GetMessage("FNAME")]?>
        </a>
    </p>
    <?//thats for articles list!
    $authsID[] = $ob["ID"];?>
<?endwhile;?>
<div class="clearfix"></div>
<br/><br/>


<?// ARTICLES?>
<h3 class="col-md-12 text-center">
    <?=GetMessage("ARTICLE_TITLE")?>
</h3><div class="clearfix"></div><br/>
    <?$inputArr = array();?>
    <?foreach($authsID as $value):?>
        <?$arFilter = array("IBLOCK_ID" => GetMessage("ARTICLE_ID"), "PROPERTY_AUTHORS" => $value);?>
        <?$res = CIBlockElement::GetList(array(), $arFilter, false, array("nPageSize" => 5));?>
        <?if(CIBlockElement::GetList(array(), $arFilter, array(), false) > 0):?>
            <?while($ob = $res->GetNextElement()):?>
                <?$arFields = $ob->GetFields();?>
                <?$arProp = $ob->GetProperties();?>
                <?array_push($inputArr, array(
                    "DRUPL" => $arFields["DETAIL_PAGE_URL"],
                    "TITLE" => $arProp["TITLE"]["VALUE"],
                    "JOURNAL" => $arProp["JOURNAL"]["VALUE"],
                    "AUTHORS" => $arProp["AUTHORS"]["VALUE"]));?>
            <?endwhile;?>
        <?endif;?>
    <?endforeach;?>
    <?$tempArray = array();?>
    <?$keyArray = array();?>
    <?foreach($inputArr as $val):?>
        <?if(!in_array($val["DRUPL"], $keyArray)):?>
            <?$keyArray[] = $val["DRUPL"];?>
            <?$tempArray[] = $val;?>
        <?endif;?>
    <?endforeach;?>
    <?foreach($tempArray as $val):?>
        <?$arFilter = array("IBLOCK_ID" => GetMessage("JOURNAL_BLOCK"), "ID" => $val["JOURNAL"]);?>
        <?$rs = CIBlockElement::GetList(array(), $arFilter, false, array("nPageSize" => 5), $arSelect);?>
        <?while($ob = $rs->GetNextElement()):?>
            <?$arFields = $ob->GetFields();?>
            <p class="col-md-12 text-left">
                <a href="<?=$val["DRUPL"]?>"><span class="glyphicon glyphicon-book"></span> <?=$val["TITLE"]?></a> //
                <a href="<?=$arFields["DETAIL_PAGE_URL"]?>"><?=$arFields["NAME"]?></a>
                <br/>
                <?$nk = sizeof($val["AUTHORS"]);?>
                <b><?=($nk == 1 ? GetMessage("AUTHOR_S") : GetMessage("AUTHORS_S"))?>:</b>
                <?$k = 1;?>
                <?foreach($val["AUTHORS"] as $item):?>
                    <?$resA = CIBlockElement::GetList(array(), array("IBLOCK_ID" => 21, "ID" => $item));?>
                    <?$obj = $resA->GetNextElement();?>
                    <?$authProps = $obj->GetProperties();?>
                    <?$authFields = $obj->GetFields();?>
                    <a class="greeners" href="<?=$authFields["DETAIL_PAGE_URL"]?>"><?=$authProps[GetMessage("FNAME_SHORT")]["VALUE"]?> <?=($k == $nk ? "" : ",")?></a>
                    <?$k++;?>
                <?endforeach;?>
                <br/>
            </p>
        <?endwhile;?>
    <?endforeach;?>

<div class="clearfix"></div><br/>


<br/><br/>
<p class="text-left">
    <a href="<?=SITE_DIR?>work/" class="btn btn-lg btn-primary">
        <span class="glyphicon glyphicon-arrow-left"></span>
        <?=GetMessage("BUTTON_TEXT")?>
    </a>
</p>


