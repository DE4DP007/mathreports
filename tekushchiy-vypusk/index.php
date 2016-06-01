<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Текущий выпуск ДЭМИ");?>


<h1 class="journhead text-right">Текущий выпуск</h1><hr>



<div class="col-md-10 col-sm-12 lefttexter">
    <?CModule::IncludeModule("iblock");
    $arFilter = Array(
        "IBLOCK_ID"=>IntVal(16),
        //">DATE_ACTIVE_FROM"=>date($DB->DateFormatToPHP(CLang::GetDateFormat("SHORT")), time()),
        "ACTIVE"=>"Y",
    );
    $res = CIBlockElement::GetList(Array("ID"=>"DESC", "PROPERTY_PRIORITY"=>"ASC"), $arFilter, Array("IBLOCK_SECTION_ID","NAME", "DATE_ACTIVE_FROM"));
    if($ar_fields = $res->GetNext())
    {
        echo GetPublications($ar_fields["ID"]);
    }?>

    <?function GetPublications($id)
    {
        $arSelect = Array("ID", "NAME", "DATE_ACTIVE_FROM", "DETAIL_PAGE_URL", "PROPERTY_START_PAGE", "PROPERTY_END_PAGE");
        $arFilter = Array("IBLOCK_ID"=>17, "PROPERTY_JOURNAL" => $id);
        $res = CIBlockElement::GetList(Array(), $arFilter, false, Array("nPageSize"=>10), $arSelect);
        if(getSize(17, "PROPERTY_JOURNAL", $id) > 0) {?>
            <h2>Содержание</h2>
            <?$res->NavStart(10);
            echo $res->NavPrint("Публикации"), "<br>";
            while($ob = $res->GetNextElement()) {
                $arFields = $ob->GetFields();
                $arProp = $ob->GetProperties();?>

                <div class="col-md-10 leftside">
                    <h3 class="arttitle">
                        <a href="<?=$arFields['DETAIL_PAGE_URL']?>"><?=$arFields['NAME']?></a>
                    </h3>
                    <?$count = 0;
                    foreach($arProp['AUTHORS']["VALUE"] as $value){
                       $count++;
                    }
                    if ($count == 1) {
                        echo "Автор: ";
                    } else {
                        echo "Авторы: ";
                    }
                    foreach($arProp['AUTHORS']["VALUE"] as $value){
                        $arFilterA = Array("IBLOCK_ID"=>21, "ID"=>$value);
                        $resA = CIBlockElement::GetList(Array(), $arFilterA, false, Array("nPageSize"=>10));
                        while($obA = $resA->GetNextElement())
                        {
                            $arPropA = $obA->GetProperties();
                            $arFieldsA = $obA->GetFields();?>
                            <a class="greeners" href="<?=$arFieldsA["DETAIL_PAGE_URL"]?>"><?=$arPropA["FNAME"]["VALUE"]?></a>,
                        <?}
                    }?>
                </div>
                <div class="col-md-2 text-center">
                    <b><?=$arProp['START_PAGE']["VALUE"]?>&nbsp;-&nbsp;<?=$arProp['END_PAGE']["VALUE"]?></b>
                </div>
                <div class="clearfix"></div><hr>
            <?}
            echo $res->NavPrint("Публикации");
        }
    }?>
</div>


<div class="col-md-2 col-sm-12 righttexter">
    <?CModule::IncludeModule("iblock");
    $arSelect = Array("ID", "NAME", "DETAIL_PAGE_URL");
    $arFilter = Array("IBLOCK_ID"=>16);
    $res = CIBlockElement::GetList(Array('ID'=>"DESC"), $arFilter, false, Array("nPageSize"=>1), $arSelect);?>
    <?while ($ob = $res->GetNextElement()) {
        $arFields = $ob->GetFields();?>
        <p><b><a href="<?=$arFields["DETAIL_PAGE_URL"]?>"><?=$arFields['NAME']?></a></b><br>
            <?$arFilterI = Array("IBLOCK_ID"=>17, "PROPERTY_JOURNAL" => $arFields['ID']);
            $resI = CIBlockElement::GetList(Array(), $arFilterI, false, Array("nPageSize"=>10));?>
            Количество статей: <?=getSize(17, "PROPERTY_JOURNAL", $arFields['ID'])?><br>
            <?$resI = CIBlockElement::GetList(Array('ID' => 'DESC'), $arFilterI, false, Array("nPageSize"=>1), $arSelect);
            if(getSize(17, "PROPERTY_JOURNAL", $arFields['ID']) > 0) {
                $obI = $resI->GetNextElement();
                $arPropI = $obI->GetProperties();?>
                Всего страниц: <?=$arPropI['END_PAGE']["VALUE"]?>
                <br>
            <?}?>
        </p>
    <?}?>
</div>



<?function getSize($block, $property, $id){
	return CIBlockElement::GetList(array(), array('IBLOCK_ID' => $block, $property => $id), array(), false, array('ID', 'NAME'));
}
?>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>