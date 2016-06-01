<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Выпуски журнала ДЭМИ");?>

<? global $arrFilter;
$arrFilter = Array('PROPERTY_JOURNAL' => 74);?>


<h1 class="journhead text-right">Архив журнала</h1>
<hr>

<?CModule::IncludeModule("iblock");
$arSelect = Array("ID", "NAME", "DETAIL_PAGE_URL");
$arFilter = Array("IBLOCK_ID"=>16);
$res = CIBlockElement::GetList(Array('ID'=>"DESC"), $arFilter, false, Array("nPageSize"=>10), $arSelect);?>

<div class="col-md-6 col-sm-12 lefttexter">
    <h2 class="text-left ">Выпуски</h2><br>

    <?while ($ob = $res->GetNextElement()) {?>
        <?$arFields = $ob->GetFields();?>
        <p>
            <b><a href="<?=$arFields["DETAIL_PAGE_URL"]?>"><?=$arFields['NAME']?></a></b><br>
            <?$arFilterI = Array("IBLOCK_ID"=>17, "PROPERTY_JOURNAL" => $arFields['ID']);
            $resI = CIBlockElement::GetList(Array(), $arFilterI, false, Array("nPageSize"=>10));?>
            Количество статей: <?=getSize(17, "PROPERTY_JOURNAL", $arFields['ID'])?><br>
            <?$resI = CIBlockElement::GetList(Array('ID' => 'DESC'), $arFilterI, false, Array("nPageSize"=>1), $arSelect);?>
            <?if(getSize(17, "PROPERTY_JOURNAL", $arFields['ID']) > 0) {
                $obI = $resI->GetNextElement();
                $arPropI = $obI->GetProperties();?>
                Всего страниц: <?=$arPropI['END_PAGE']["VALUE"]?>
                <br><hr>
            <?}?>
        </p>
    <?}?>
</div>

<div class="col-md-6 col-sm-12">
    <h2 class="text-right">Наши авторы</h2><br>
</div>
<div class="clearfix"></div>

<?function getSize($block, $property, $id) {
	return CIBlockElement::GetList(array(), array('IBLOCK_ID' => $block, $property => $id), array(), false, array('ID', 'NAME'));
}?>


<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>