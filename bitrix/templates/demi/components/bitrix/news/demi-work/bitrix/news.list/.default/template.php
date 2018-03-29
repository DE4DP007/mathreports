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
?>
<div class="news-list">
<?if($arParams["DISPLAY_TOP_PAGER"]):?>
	<?=$arResult["NAV_STRING"]?><br />
<?endif;?>

<div class="container-fluid">
<?foreach($arResult["ITEMS"] as $arItem):?>
	<?
	$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
	$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
	?>

	<div class="col-md-6">
		<p class="thumbnail text-center">
			<b><a href="<?=$arItem["DETAIL_PAGE_URL"]?>"><?=$arItem["DISPLAY_PROPERTIES"][GetMessage("TITLE")]["VALUE"]?></a></b>
			<br/>
			<?=GetMessage("AUTHORS_S")?>: <?=CIBlockElement::GetList(array(), array("BLOCK_ID" => 21, "PROPERTY_WORK" => $arItem["ID"], "ACTIVE" => "Y"), array(), false, array("ID", "NAME"));?>
			<br/>
			<?$res = CIBlockElement::GetList(array(), array("BLOCK_ID" => 21, "PROPERTY_WORK" => $arItem["ID"], "ACTIVE" => "Y"), false, Array("nPageSize"=>10), array("ID", "NAME"));?>
			<?$arIDs = array();?>
			<?while($ob = $res->GetNextElement()):?>
				<?$arFields = $ob->GetFields();?>
				<?array_push($arIDs, $arFields["ID"]);?>
			<?endwhile;?>
			<?$inputArr = array();?>
			<?foreach($arIDs as $value):?>
				<?$res1 = CIBlockElement::GetList(array(), array("ACTIVE"=>"Y", "BLOCK_ID"=>GetMessage("ARTICLES_BID"), "PROPERTY_AUTHORS"=>$value), false, Array("nPageSize"=>5));?>
				<?if(CIBlockElement::GetList(array(), array("ACTIVE"=>"Y", "BLOCK_ID"=>GetMessage("ARTICLES_BID"), "PROPERTY_AUTHORS"=>$value), array(), false, array("ID", "NAME")) > 0):?>
					<?while($ob1 = $res1->GetNextElement()):?>
						<?$arFields1 = $ob1->GetFields();?>
						<?$arProp1 = $ob1->GetProperties();?>
						<?array_push($inputArr, array("DRUPL"=>$arFields1["DETAIL_PAGE_URL"], "TITLE" => $arProp1["TITLE"]["VALUE"]));?>
					<?endwhile;?>
				<?endif;?>
			<?endforeach;?>

			<?$temp_array = array();?>
			<?$i = 0;?>
			<?$key_array = array();?>
			<?foreach($inputArr as $value):?>
				<?if(!in_array($value["DRUPL"], $key_array)):?>
					<?$key_array[$i] = $value["DRUPL"];?>
					<?$temp_array[$i] = $value;?>
				<?endif;?>
				<?$i++;?>
			<?endforeach;?>

			<?=GetMessage("ARTICLES_S")?>: <?=count($temp_array)?>
		</p>
	</div>

<?endforeach;?>
</div>
<?if($arParams["DISPLAY_BOTTOM_PAGER"]):?>
	<br /><?=$arResult["NAV_STRING"]?>
<?endif;?>
</div>
