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
        <?=(SITE_ID == "s1" ? $arResult['PROPERTIES']['TITLE']['VALUE'] : $arResult['PROPERTIES']['TITLE_EN']['VALUE'])?>
    </h1>
</div>
<div class="clearfix"></div><br>


<div class="col-md-12">
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



<?// AUTHORS
$arSelect = Array("ID", "PROPERTY_FNAME", "PROPERTY_FNAME_EN", "DATE_ACTIVE_FROM", "DETAIL_PAGE_URL");
$arFilter = Array("IBLOCK_ID"=>21, "PROPERTY_WORK" => getCurrentID(22, $_REQUEST["ELEMENT_CODE"]));
$res = CIBlockElement::GetList(Array(), $arFilter, false, Array("nPageSize"=>5), $arSelect);?>

<h3 class="col-md-12 text-center">
    <?echo (SITE_ID == "s1" ? "Авторы организации" : "Authors of Organization")?>
</h3><div class="clearfix"></div><br>
<?while ($ob = $res->GetNext()) {?>
    <p class="col-md-6 text-center">
        <a class="greeners" href="<?=$ob["DETAIL_PAGE_URL"]?>" >
            <?echo (SITE_ID == "s1" ? $ob["PROPERTY_FNAME_VALUE"] : $ob["PROPERTY_FNAME_EN_VALUE"])?>
        </a>
    </p>
    <?//thats for articles list!
    $authsID[] = $ob["ID"];
}?>
<div class="clearfix"></div>
<br><br>


<?// ARTICLES?>
<h3 class="col-md-12 text-center">
    <?echo (SITE_ID == "s1" ? "Статьи организации" : "Articles of Organization")?>
</h3><div class="clearfix"></div><br>
<?(SITE_ID == "s1" ? getArticles($authsID, 17) : getArticles($authsID, 14));?>

<div class="clearfix"></div><br>


<br><br>
<p class="text-left">
    <a href="/work/" class="btn btn-lg btn-primary">
        <span class="glyphicon glyphicon-arrow-left"></span>
        <?=(SITE_ID == "s1" ? "В список организаций" : "To organizations list")?>
    </a>
</p>





<?function getArticles($authsID, $block_id) {
    $inputArr = array();
    foreach($authsID as $value){
        $arFilter = Array("IBLOCK_ID"=>$block_id, "PROPERTY_AUTHORS" => $value);
        $res = CIBlockElement::GetList(Array(), $arFilter, false, Array("nPageSize"=>5));
        if(getSize($block_id, $value, "PROPERTY_AUTHORS") > 0) {
            while ($ob = $res->GetNextElement()) {
                $arFields = $ob->GetFields();
                $arProp = $ob->GetProperties();
                array_push($inputArr, array("DPURL" => $arFields['DETAIL_PAGE_URL'], "TITLE" => $arProp["TITLE"]["VALUE"]));
            }
        }
    }
    $resultArr = unique_multidim_array($inputArr, "DPURL");
    foreach($resultArr as $value) {
        echo "<p class='col-md-12 text-left'><a href='", $value["DPURL"], "'>", $value["TITLE"], "</a></p>";
    }
}?>




<?function unique_multidim_array($array, $key) {
    $temp_array = array();
    $i = 0;
    $key_array = array();

    foreach($array as $val) {
        if (!in_array($val[$key], $key_array)) {
            $key_array[$i] = $val[$key];
            $temp_array[$i] = $val;
        }
        $i++;
    }
    return $temp_array;
}?>


<?//=================================?>
<?//============= STUFF =============?>
<?//=================================?>


<?function getSize($block_id, $id, $value) {
    return CIBlockElement::GetList(array(), array('IBLOCK_ID' => $block_id, $value => $id), array(), false, array('ID', 'NAME'));
} ?>




<?function getAuthorsAndArticles($string, $value, $arblock, $arString, $title){
    $arSelect = Array("ID", "NAME", "DATE_ACTIVE_FROM", "DETAIL_PAGE_URL");
    $arFilter = Array("IBLOCK_ID"=>21, "PROPERTY_WORK" => getCurrentID(22, $_REQUEST["ELEMENT_CODE"]));
    $res = CIBlockElement::GetList(Array(), $arFilter, false, Array("nPageSize"=>5), $arSelect);
    if(getSize(21, getCurrentID(22, $_REQUEST["ELEMENT_CODE"]), "PROPERTY_WORK") > 0){
        echo "<br><p>", $string, ": </p>";
        while($ob = $res->GetNextElement())
        {
            $arFields = $ob->GetFields();
            $arProp = $ob->GetProperties();
            echo "<a href='", $arFields['DETAIL_PAGE_URL'], "'>", $arProp[$value]["VALUE"], "</a><br>";
            $authsID[] = $arFields['ID'];
        }
        echo "<br><p>", $arString, ": </p>";
        getArticles($authsID, $arblock);
    }
}?>

<?function getCurrentID($iblock_id, $code)
{
    if(CModule::IncludeModule("iblock"))
    {
        $arFilter = array("IBLOCK_ID"=>$iblock_id, "CODE" => $code);
        $res = CIBlockElement::GetList(array(), $arFilter, false, array("nPageSize"=>1), array('ID'));
        $element = $res->Fetch();
        if($res->SelectedRowsCount() != 1) return '<p>Элемент не найден</p>';
        else return $element['ID'];
    }
}?>
