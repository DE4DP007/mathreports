<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Current Issue");
?><h1 style="text-align: right;"><span style="font-size: 20pt; color: #2f4f4f;">Current Issue</span></h1>
<hr>
<?
CModule::IncludeModule("iblock");
$arSelect = Array("ID", "NAME", "DETAIL_PAGE_URL");
$arFilter = Array("IBLOCK_ID"=>15);
$res = CIBlockElement::GetList(Array('ID'=>"DESC"), $arFilter, false, Array("nPageSize"=>1), $arSelect);
while ($ob = $res->GetNextElement()) {
	$arFields = $ob->GetFields();
	echo "<p><b>", "<a href='", $arFields["DETAIL_PAGE_URL"], "'>", $arFields['NAME'], "</a></b><br>";
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
CModule::IncludeModule("iblock");
$arFilter = Array(
	"IBLOCK_ID"=>IntVal(15),
	//">DATE_ACTIVE_FROM"=>date($DB->DateFormatToPHP(CLang::GetDateFormat("SHORT")), time()),
	"ACTIVE"=>"Y",
);
$res = CIBlockElement::GetList(Array("ID"=>"DESC", "PROPERTY_PRIORITY"=>"ASC"), $arFilter, Array("IBLOCK_SECTION_ID","NAME", "DATE_ACTIVE_FROM"));
if($ar_fields = $res->GetNext())
{
	echo GetPublications($ar_fields["ID"]);
}
?>
<?
function GetPublications($id)
{
	$arSelect = Array("ID", "NAME", "DATE_ACTIVE_FROM", "DETAIL_PAGE_URL", "PROPERTY_START_PAGE", "PROPERTY_END_PAGE");
	$arFilter = Array("IBLOCK_ID"=>14, "PROPERTY_JOURNAL" => $id);
	$res = CIBlockElement::GetList(Array(), $arFilter, false, Array("nPageSize"=>10), $arSelect);
	if(getSize(14, "PROPERTY_JOURNAL", $id) > 0) {
		echo "<br><h4>Table of contents</h4>";
		$res->NavStart(10);
		echo $res->NavPrint("Публикации"), "<br>";
		while($ob = $res->GetNextElement())
		{
			$arFields = $ob->GetFields();
			$arProp = $ob->GetProperties();
			echo "<a href='",$arFields['DETAIL_PAGE_URL'], "'>", $arFields['NAME'], "</a>";
			echo " ", $arProp['START_PAGE']["VALUE"], " - ", $arProp['END_PAGE']["VALUE"];
			$count = 0;
			foreach($arProp['AUTHORS']["VALUE"] as $value){
				$count++;
			}
			if ($count == 1) {
				echo "<br>Author: ";
			} else {
				echo "<br>Authors: ";
			}
			foreach($arProp['AUTHORS']["VALUE"] as $value){
				$arFilterA = Array("IBLOCK_ID"=>21, "ID"=>$value);
				$resA = CIBlockElement::GetList(Array(), $arFilterA, false, Array("nPageSize"=>10));
				while($obA = $resA->GetNextElement())
				{
					$arPropA = $obA->GetProperties();
					$arFieldsA = $obA->GetFields();
					echo "<a href='", $arFieldsA["DETAIL_PAGE_URL"], "'>", $arPropA["FNAME_EN"]["VALUE"], " </a>";
				}
			}
			echo "<br>";
		}
		echo $res->NavPrint("Публикации");
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