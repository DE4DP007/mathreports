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
//test_dump($arResult["PROPERTIES"]);
?>

<h1 class="text-center">
    <?=$arResult["PROPERTIES"][GetMessage("FNAME")]["VALUE"]?>

    <?if (isset($arResult["PROPERTIES"][GetMessage("ADD_INFO")]) && ($arResult["PROPERTIES"][GetMessage("ADD_INFO")]["VALUE"] != "")):?>
        <h3 class="text-center greeners"><?=$arResult["PROPERTIES"][GetMessage("ADD_INFO")]["VALUE"]?></h3>
    <?endif;?>
<div class="col-md-12">
    <h4>
        <p>
            <b><?=GetMessage("TITLE_S")?>: </b>
            <?$arSelect = Array("ID", "NAME", "DATE_ACTIVE_FROM", "DETAIL_PAGE_URL");
            $arFilterA = Array("IBLOCK_ID"=>21, "ID" => $arResult["ID"]);
            $resA = CIBlockElement::GetList(Array(), $arFilterA, false, Array("nPageSize"=>10), $arSelect);?>
            <?while($obA = $resA->GetNextElement()):?>
                <?$arPropA = $obA->GetProperties();
                $arFilter = Array("IBLOCK_ID"=>22, "ID" =>  $arPropA["WORK"]["VALUE"]);?>
                <?if($arPropA["WORK"]["VALUE"] != null && CIBlockElement::GetList(array(), array('IBLOCK_ID' => 22, "ID" => $arPropA["WORK"]["VALUE"]), array(), false, array('ID', 'NAME')) > 0):?>
                    <?$res = CIBlockElement::GetList(Array(), $arFilter, false, Array("nPageSize"=>10), $arSelect);?>
                    <?while($ob = $res->GetNextElement()):?>
                        <?$arFields = $ob->GetFields();
                        $arProp = $ob->GetProperties();?>
                        <a href="<?=$arFields['DETAIL_PAGE_URL']?>"><?=$arProp[GetMessage("TITLE")]['VALUE']?></a><br/>
                    <?endwhile;?>
                <?endif;?>
            <?endwhile;?>
        </p>
    </h4>
</div><div class="clearfix"></div>
<div class="row">
    <?if (isset($arResult["DETAIL_PICTURE"])):?>
        <p class="col-md-4">
            <img src="<?=$arResult["DETAIL_PICTURE"]["SRC"]?>"
                 title="<?=$arResult["PROPERTIES"][GetMessage("TITLE")]["VALUE"]?>"
                 alt="<?=$arResult["PROPERTIES"][GetMessage("TITLE")]["VALUE"]?>"
                 class="img-responsive img-thumbnail">
        </p>
        <p class="col-md-8">
    <?else:?>
        <p class="col-md-12">
    <?endif;?>
    <?if (isset($arResult["PREVIEW_TEXT"]) && ($arResult["PREVIEW_TEXT"] != "")):?>
        <?=$arResult[GetMessage("PREV")]?>
    <?endif;?>
    </p>
</div>

<div class="clearfix"></div>
