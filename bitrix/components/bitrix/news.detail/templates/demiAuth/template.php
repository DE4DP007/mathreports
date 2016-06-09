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

<br><br>
<hr>
<div class="col-md-12">
    <h3 class="text-left">
        <?=(SITE_ID == "s1" ? "Статьи автора в Журнале" : "Articles of author in Journal");?>
    </h3><br>


    <?if (SITE_ID == "s1") {
        getArticles(17, "C.");
    } else {
        getArticles(14, "P.");
    }?>
</div>
<div class="clearfix"></div><br><br>



<p class="col-md-12 text-left">
    <a href="<?=SITE_DIR?>authors/" class="btn btn-lg btn-primary">
        <span class="glyphicon glyphicon-arrow-left"></span>
        <?echo (SITE_ID == "s1" ? "В список авторов" : "To authors list")?>
    </a>
</p>



<?function getArticles($block_id, $pages_string) {
    $arSelect = Array("ID", "NAME", "DATE_ACTIVE_FROM", "DETAIL_PAGE_URL", "PROPERTY_START_PAGE", "PROPERTY_END_PAGE", "PROPERTY_JOURNAL");
    $arFilter = Array("IBLOCK_ID"=>$block_id, "PROPERTY_AUTHORS" => getCurrentID(21, $_REQUEST["ELEMENT_CODE"]));
    if(getSize($block_id, getCurrentID(21, $_REQUEST["ELEMENT_CODE"]), "PROPERTY_AUTHORS") > 0) {
        $res = CIBlockElement::GetList(Array(), $arFilter, false, Array("nPageSize"=>10), $arSelect);
        while ($ob = $res->GetNextElement()) {
            $arFields = $ob->GetFields();
            $arProp = $ob->GetProperties();
            $arFilterI = Array("ID" => $arProp['JOURNAL']["VALUE"]);
            $resI = CIBlockElement::GetList(Array(), $arFilterI, false, Array("nPageSize" => 10));
            while ($obI = $resI->GetNextElement()) {
                $arPropI = $obI->GetProperties();
                echo "<h4 class='artlist'><a href='", $arFields['DETAIL_PAGE_URL'], "'>","<span class='glyphicon glyphicon-book'></span> ";

                $n = sizeof($arProp["AUTHORS"]["VALUE"]);
                $k = 1;
                foreach($arProp["AUTHORS"]["VALUE"] as $value) {
					$arFilterA = Array("BLOCK_ID" => 21, "ID" => $value);
					$resA = CIBlockElement::GetList(Array(), $arFilterA, false, Array("nPageSize" => 10));
					$obA = $resA -> GetNextElement();
                    $arPropA = $obA -> GetProperties();
                    echo $arPropA[GetMessage("FNAME")]["VALUE"];
                    echo ($k == $n ? ". " : ", ");
                    $k++;
				}
                echo $arFields['NAME'], " // ",
                $arPropI["TITLE"]["VALUE"], ", ", $pages_string," ", $arProp['START_PAGE']["VALUE"], " - ", $arProp['END_PAGE']["VALUE"], "</a></h4>";

            }
        }
    }
}?>

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

<?function getCurrentID($iblock_id, $code) {
    if(CModule::IncludeModule("iblock")) {
        $arFilter = array("IBLOCK_ID"=>$iblock_id, "CODE" => $code);
        $res = CIBlockElement::GetList(array(), $arFilter, false, array("nPageSize"=>1), array('ID'));
        $element = $res->Fetch();
        if($res->SelectedRowsCount() != 1) return '<p>Элемент не найден</p>';
        else return $element['ID'];
    }
}?>

<?function getSize($block_id, $id, $property){
    return CIBlockElement::GetList(array(), array('IBLOCK_ID' => $block_id, $property => $id), array(), false, array('ID', 'NAME'));
}?>
