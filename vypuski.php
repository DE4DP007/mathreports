<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Выпуски");
?><? global $arrFilter;
$arrFilter = Array('PROPERTY_JOURNAL' => 74);
?>
<h1 style="text-align: right;"><span style="font-size: 20pt;">Архив журнала</span></h1>
<hr>
<?
CModule::IncludeModule("iblock");
$arSelect = Array("ID", "NAME", "DETAIL_PAGE_URL");
$arFilter = Array("IBLOCK_ID"=>16);
$res = CIBlockElement::GetList(Array('ID'=>"DESC"), $arFilter, false, Array("nPageSize"=>10), $arSelect);
while ($ob = $res->GetNextElement()) {
	$arFields = $ob->GetFields();
	echo "<p>", "<a href='", $arFields["DETAIL_PAGE_URL"], "'>", $arFields['NAME'], "</a><br>";
	$arFilterI = Array("IBLOCK_ID"=>17, "PROPERTY_JOURNAL" => $arFields['ID']);
	$resI = CIBlockElement::GetList(Array(), $arFilterI, false, Array("nPageSize"=>10));
	echo "Количество статей: ", getSize(17, "PROPERTY_JOURNAL", $arFields['ID']), "<br>";
	$resI = CIBlockElement::GetList(Array('ID' => 'DESC'), $arFilterI, false, Array("nPageSize"=>1), $arSelect);
	if(getSize(17, "PROPERTY_JOURNAL", $arFields['ID']) > 0) {
		while ($obI = $resI->GetNextElement()) {
			$arPropI = $obI->GetProperties();
			echo "Всего страниц: ", $arPropI['END_PAGE']["VALUE"];
			echo "<br>";
		}
	}
	echo "</p>";
}
?>
<?
function getSize($block, $property, $id)
{
	return CIBlockElement::GetList(array(), array('IBLOCK_ID' => $block, $property => $id), array(), false, array('ID', 'NAME'));
}
?>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>