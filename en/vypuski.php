<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Выпуски");
?><h1 style="text-align: right;"><span style="font-size: 20pt; color: #2f4f4f;">Journal Archive</span></h1>
<span style="color: #2f4f4f;"> </span>
<hr>
<?
CModule::IncludeModule("iblock");
$arSelect = Array("ID", "NAME", "DETAIL_PAGE_URL");
$arFilter = Array("IBLOCK_ID"=>15);
$res = CIBlockElement::GetList(Array('ID'=>"DESC"), $arFilter, false, Array("nPageSize"=>10), $arSelect);
while ($ob = $res->GetNextElement()) {
	$arFields = $ob->GetFields();
	echo "<p>", "<a href='", $arFields["DETAIL_PAGE_URL"], "'>", $arFields['NAME'], "</a><br>";
	$arFilterI = Array("IBLOCK_ID"=>14, "PROPERTY_JOURNAL" => $arFields['ID']);
	$resI = CIBlockElement::GetList(Array(), $arFilterI, false, Array("nPageSize"=>10));
	echo "Article Count: ", getSize(14, "PROPERTY_JOURNAL", $arFields['ID']), "<br>";
	$resI = CIBlockElement::GetList(Array('ID' => 'DESC'), $arFilterI, false, Array("nPageSize"=>1), $arSelect);
	if(getSize(14, "PROPERTY_JOURNAL", $arFields['ID']) > 0) {
		while ($obI = $resI->GetNextElement()) {
			$arPropI = $obI->GetProperties();
			echo "Total Pages: ", $arPropI['END_PAGE']["VALUE"];
			echo "<br>";
		}
	}
	echo "</p>";
	//print_r($arFields);
}
?>
<?
function getCurrentID($iblock_id, $code)
{
	if(CModule::IncludeModule("iblock"))
	{
		$arFilter = array("IBLOCK_ID"=>$iblock_id, "CODE" => $code);
		$res = CIBlockElement::GetList(array(), $arFilter, false, array("nPageSize"=>1), array('ID'));
		$element = $res->Fetch();
		if($res->SelectedRowsCount() != 1) return '<p>Элемент не найден</p>';
		else return $element['ID'];
	}
}
?>
<?
function getSize($block, $property, $id)
{
	return CIBlockElement::GetList(array(), array('IBLOCK_ID' => $block, $property => $id), array(), false, array('ID', 'NAME'));
}
?>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>