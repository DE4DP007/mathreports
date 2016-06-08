<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Current Issue");?>


<?CModule::IncludeModule("iblock");
$arSelect = Array("ID", "NAME", "DETAIL_PAGE_URL");
$arFilter = Array("IBLOCK_ID"=>15);
$res = CIBlockElement::GetList(Array('ID'=>"DESC"), $arFilter, false, Array("nPageSize"=>1), $arSelect);?>
<?  $ob = $res->GetNextElement(); $arFields = $ob->GetFields();?>

<h1 class="journhead text-right">
     Current Issue: <?=$arFields['NAME']?>
</h1><hr>


<h4 class="col-md-6 text-left arttitle">
    <?$arFilterI = Array("IBLOCK_ID"=>14, "PROPERTY_JOURNAL" => $arFields['ID']);
    $resI = CIBlockElement::GetList(Array(), $arFilterI, false, Array("nPageSize"=>10));?>
    Articles count: <?=getSize(14, "PROPERTY_JOURNAL", $arFields['ID'])?>
</h4>
<h4 class="col-md-6 text-right">
    <?$resI = CIBlockElement::GetList(Array('ID' => 'DESC'), $arFilterI, false, Array("nPageSize"=>1), $arSelect);
    if(getSize(14, "PROPERTY_JOURNAL", $arFields['ID']) > 0) {
        $obI = $resI->GetNextElement();
        $arPropI = $obI->GetProperties();?>
        Total pages: <?=$arPropI['END_PAGE']["VALUE"]?>
        <br>
    <?}?>
</h4>



<div class="col-md-12 lefttexter">
    <?CModule::IncludeModule("iblock");
    $arFilter = Array(
        "IBLOCK_ID"=>IntVal(15),
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
        $arFilter = Array("IBLOCK_ID"=>14, "PROPERTY_JOURNAL" => $id);
        $res = CIBlockElement::GetList(Array(), $arFilter, false, Array("nPageSize"=>10), $arSelect);
        if(getSize(14, "PROPERTY_JOURNAL", $id) > 0) {?>
            <h2 class="text-center">Table of contents</h2>
            <?$res->NavStart(10);
            echo $res->NavPrint("Publications"), "<br>";
            while($ob = $res->GetNextElement()) {
                $arFields = $ob->GetFields();
                $arProp = $ob->GetProperties();?>

                <div class="col-md-10 leftside">
                    <h3 class="arttitle">
                        <a href="<?=$arFields['DETAIL_PAGE_URL']?>"><?=$arFields['NAME']?></a>
                    </h3>
                    <?$kount = count($arProp['AUTHORS']["VALUE"]);

                    if ($kount == 1) {
                        echo "<b>Author:</b> ";
                    } else {
                        echo "<b>Authors:</b> ";
                    }
                    foreach($arProp['AUTHORS']['VALUE'] as $value){
                        $arFilterA = Array("IBLOCK_ID"=>21, "ID"=>$value);
                        $resA = CIBlockElement::GetList(Array(), $arFilterA, false, Array("nPageSize"=>10));
                        $ji = 0;
                        while($obA = $resA->GetNextElement()) {
                            $arPropA = $obA->GetProperties();
                            $arFieldsA = $obA->GetFields();
                            $ji++;
                            echo '<a class="greeners" href="'.$arFieldsA['DETAIL_PAGE_URL'].'">'.$arPropA["FNAME_EN"]["VALUE"].'</a>'.($ji < $kount ? ", " : "");
                        }
                    }?>
                </div>
                <div class="col-md-2 text-right">
                    <b><?=$arProp['START_PAGE']["VALUE"]?>&nbsp;-&nbsp;
                        <?=$arProp['END_PAGE']["VALUE"]?></b>
                </div>
                <div class="clearfix"></div><hr>
            <?}
            echo $res->NavPrint("Publications");
        }
    }?>
</div>


<div class="clearfix"></div>
<br><br><br>

<p class="text-left">
    <a href="<?=SITE_DIR?>vypuski/" class="btn btn-lg btn-primary">
        <span class="glyphicon glyphicon-arrow-left"></span> To issues
    </a>
</p>


<?function getSize($block, $property, $id){
	return CIBlockElement::GetList(array(), array('IBLOCK_ID' => $block, $property => $id), array(), false, array('ID', 'NAME'));
}?>

<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>