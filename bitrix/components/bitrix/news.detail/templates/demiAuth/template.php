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
    <?=(SITE_ID == "s1" ? $arResult["PROPERTIES"]["FNAME"]["VALUE"] : $arResult["PROPERTIES"]["FNAME_EN"]["VALUE"])?>
</h1>

<?if (SITE_ID == "s1") {
    if (isset($arResult["PROPERTIES"]["ADD_INFO"]) && ($arResult["PROPERTIES"]["ADD_INFO"]["VALUE"] != "")) {
        echo "<h3 class='text-center greeners'>".$arResult["PROPERTIES"]["ADD_INFO"]["VALUE"]."</h3>";
    }
} else {
    if (isset($arResult["PROPERTIES"]["ADD_INFO_EN"]) && ($arResult["PROPERTIES"]["ADD_INFO_EN"]["VALUE"] != "")) {
        echo "<h3 class='text-center greeners'>".$arResult["PROPERTIES"]["ADD_INFO_EN"]["VALUE"]."</h3>";
    }
}?>
<div class="col-md-12">
    <h4>
        <?(SITE_ID == "s1" ? getWork("Место работы", "TITLE") : getWork("Workplace", "TITLE_EN"));?>
    </h4>
</div><div class="clearfix"></div>
<div class="row">
    <?if (isset($arResult["DETAIL_PICTURE"])) {?>
    <p class="col-md-4">
        <img src="<?=$arResult["DETAIL_PICTURE"]["SRC"]?>"
             title="<?=(SITE_ID == "s1" ? $arResult['PROPERTIES']['TITLE']['VALUE'] : $arResult['PROPERTIES']['TITLE_EN']['VALUE'])?>"
             alt="<?=(SITE_ID == "s1" ? $arResult['PROPERTIES']['TITLE']['VALUE'] : $arResult['PROPERTIES']['TITLE_EN']['VALUE'])?>"
             class="img-responsive img-thumbnail">
    </p>
    <p class="col-md-8">
        <?} else {?>
    <p class="col-md-12">
        <?}?>
        <?if (SITE_ID == "s1") {
            if (isset($arResult["PREVIEW_TEXT"]) && ($arResult["PREVIEW_TEXT"] != "")) {
                echo $arResult["PREVIEW_TEXT"];
            } else
            { }
        } else {
            if (isset($arResult["DETAIL_TEXT"]) && ($arResult["DETAIL_TEXT"] != "")) {
                echo $arResult["DETAIL_TEXT"];
            }
        }?>
    </p>
</div>

<div class="clearfix"></div>


<?function getWork($valueSt, $value) {
    $arSelect = Array("ID", "NAME", "DATE_ACTIVE_FROM", "DETAIL_PAGE_URL");
    $arFilterA = Array("IBLOCK_ID"=>21, "ID" => getCurrentID(21, $_REQUEST["ELEMENT_CODE"]));
    $resA = CIBlockElement::GetList(Array(), $arFilterA, false, Array("nPageSize"=>10), $arSelect);
    while ($obA = $resA->GetNextElement()) {
        $arPropA = $obA->GetProperties();
        $arFilter = Array("IBLOCK_ID"=>22, "ID" =>  $arPropA["WORK"]["VALUE"]);
        if($arPropA["WORK"]["VALUE"] != null && getSize(22,  $arPropA["WORK"]["VALUE"], "ID") > 0) {
            $res = CIBlockElement::GetList(Array(), $arFilter, false, Array("nPageSize"=>10), $arSelect);
            while ($ob = $res->GetNextElement()) {
                $arFields = $ob->GetFields();
                $arProp = $ob->GetProperties();
                echo "<p><b>", $valueSt, "</b>: <a href='", $arFields['DETAIL_PAGE_URL'], "'>", $arProp[$value]['VALUE'], "</a></p>";
            }
        }
    }
}?>

<?function getSize($block_id, $id, $property){
    return CIBlockElement::GetList(array(), array('IBLOCK_ID' => $block_id, $property => $id), array(), false, array('ID', 'NAME'));
}?>
