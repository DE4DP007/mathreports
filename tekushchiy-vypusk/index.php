<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Текущий выпуск ДЭМИ");?>


<?CModule::IncludeModule("iblock");
$arSelect = Array("ID", "NAME", "DETAIL_PAGE_URL");
$arFilter = Array("IBLOCK_ID"=>16, "ACTIVE"=>"Y");
$res = CIBlockElement::GetList(Array('ID'=>"DESC"), $arFilter, false, Array("nPageSize"=>1), $arSelect);?>
<?  $ob = $res->GetNextElement(); $arFields = $ob->GetFields();?>

<h1 class="journhead text-right">
     Текущий выпуск: <?=$arFields['NAME']?>
</h1><hr>


<h3 class="col-md-6 journhead text-left text-xs-center">
    <?$arFilterI = Array("IBLOCK_ID"=>17, "PROPERTY_JOURNAL" => $arFields['ID'], "ACTIVE"=>"Y");
    $resI = CIBlockElement::GetList(Array(), $arFilterI, false, Array("nPageSize"=>10));?>
    Количество статей: <?=getSize(17, "PROPERTY_JOURNAL", $arFields['ID'])?>
</h3>
<h3 class="col-md-6 journhead text-right text-xs-center">
    <?$resI = CIBlockElement::GetList(Array('ID' => 'DESC'), $arFilterI, false, Array("nPageSize"=>1), $arSelect);
    if(getSize(17, "PROPERTY_JOURNAL", $arFields['ID']) > 0) {
        $obI = $resI->GetNextElement();
        $arPropI = $obI->GetProperties();?>
        Всего страниц: <?=$arPropI['END_PAGE']["VALUE"]?>
        <br>
    <?}?>
</h3>



<div class="col-md-12 lefttexter">
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
            <h2 class="text-center">Содержание</h2>
            <?$res->NavStart(10);
            echo $res->NavPrint("Публикации"), "<br>";
            while($ob = $res->GetNextElement()) {
                $arFields = $ob->GetFields();
                $arProp = $ob->GetProperties();?>

                <div class="col-md-10 leftside">
                    <h3 class="arttitle">
                        <a href="<?=$arFields['DETAIL_PAGE_URL']?>"><?=$arFields['NAME']?></a>
                    </h3>
                    <?$kount = count($arProp['AUTHORS']["VALUE"]);

                    if ($kount == 1) {
                        echo "<b>Автор:</b> ";
                    } else {
                        echo "<b>Авторы:</b> ";
                    }
                    $ji = 1;
                    foreach($arProp['AUTHORS']['VALUE'] as $value){
                        $arFilterA = Array("IBLOCK_ID"=>21, "ID"=>$value);
                        $resA = CIBlockElement::GetList(Array(), $arFilterA, false, Array("nPageSize"=>10));

                        $obA = $resA->GetNextElement();
                        $arPropA = $obA->GetProperties();
                        $arFieldsA = $obA->GetFields();
                        echo '<a class="greeners" href="'.$arFieldsA['DETAIL_PAGE_URL'].'">'.$arPropA["FNAME"]["VALUE"].'</a>'.($ji == $kount ? "" : ", ");
                        $ji++;
                    }?>
                </div>
                <div class="col-md-2 text-right text-xs-left xs-no-left-pads">
                    <b class="visible-xs-inline">Страницы:</b>&nbsp;
                    <b><?=$arProp['START_PAGE']["VALUE"]?>&nbsp;-&nbsp;
                        <?=$arProp['END_PAGE']["VALUE"]?></b>
                </div>
                <div class="clearfix"></div><hr>
            <?}
            echo $res->NavPrint("Публикации");
        }
    }?>
</div>


<div class="clearfix"></div>
<br><br><br>

<p class="text-left text-xs-center">
    <a href="<?=SITE_DIR?>vypuski/" class="btn btn-lg btn-primary">
        <span class="glyphicon glyphicon-arrow-left"></span> В список выпусков
    </a>
</p>


<?function getSize($block, $property, $id){
	return CIBlockElement::GetList(array(), array('IBLOCK_ID' => $block, $property => $id), array(), false, array('ID', 'NAME'));
}?>

<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>