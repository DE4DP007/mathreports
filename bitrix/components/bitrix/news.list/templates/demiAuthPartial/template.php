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


<?foreach($arResult["ITEMS"] as $arItem):?>
	<?$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
	$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));?>

    <div class='col-md-12 no-right-pads'><p class='thumbnail text-center' id="<?=$this->GetEditAreaId($arItem['ID']);?>">
		<?if (SITE_ID == "s1") {?>
            <b><a href="<?=$arItem["DETAIL_PAGE_URL"]?>"><?=$arItem["PROPERTIES"]["FNAME"]["VALUE"]?></b></a><br />

            <?if (isset($arItem["PROPERTIES"]["WORK"]["VALUE"])) {
                $arSelect = Array("ID", "NAME", "PROPERTY_TITLE", "DETAIL_PAGE_URL");
                $arFilter = Array("IBLOCK_ID" => 22, "ID" => $arItem["PROPERTIES"]["WORK"]["VALUE"]);
                $res = CIBlockElement::GetList(Array(), $arFilter, false, Array("nPageSize" => 5), $arSelect);
                $ob = $res->GetNext();
                echo "<small><a class='greeners' href='",$ob["DETAIL_PAGE_URL"],"'>",$ob["PROPERTY_TITLE_VALUE"],"</a></small><br>";
            }?>

            <?if(isset($arItem["PROPERTIES"]["ADD_INFO"]) && ($arItem["PROPERTIES"]["ADD_INFO"]["VALUE"]!="")) {
                echo "<small><i>",$arItem["PROPERTIES"]["ADD_INFO"]["VALUE"],"</i></small><br>";
            }?>
        <?} else {?>
            <b><a href="<?=$arItem["DETAIL_PAGE_URL"]?>"><?=$arItem["PROPERTIES"]["FNAME_EN"]["VALUE"]?></b></a><br />

            <?if (isset($arItem["PROPERTIES"]["WORK"]["VALUE"])) {
                $arSelect = Array("ID", "NAME", "PROPERTY_TITLE_EN", "DETAIL_PAGE_URL");
                $arFilter = Array("IBLOCK_ID" => 22, "ID" => $arItem["PROPERTIES"]["WORK"]["VALUE"]);
                $res = CIBlockElement::GetList(Array(), $arFilter, false, Array("nPageSize" => 5), $arSelect);
                $ob = $res->GetNext();
                echo "<small><a class='greeners' href='",$ob["DETAIL_PAGE_URL"],"'>",$ob["PROPERTY_TITLE_EN_VALUE"],"</a></small><br>";
            }?>

            <?if(isset($arItem["PROPERTIES"]["ADD_INFO_EN"]) && ($arItem["PROPERTIES"]["ADD_INFO_EN"]["VALUE"]!="")) {
                echo $arItem["PROPERTIES"]["ADD_INFO_EN"]["VALUE"];
            }?>
        <?}?>

        <?$arSel = Array("ID", "NAME", "DATE_ACTIVE_FROM", "DETAIL_PAGE_URL");
        $arFilt = Array("IBLOCK_ID"=>17, "PROPERTY_AUTHORS" => $arItem["ID"]);
        $rs = CIBlockElement::GetList(Array(), $arFilt, false, Array("nPageSize"=>5), $arSel);?>
        <small>
            <?echo (SITE_ID == "s1" ? "Количество статей в журнале: " : "Article count in Jounal: ")?>
            <b><?=count($rs->arResult)?></b>
        </small><br>

	</p></div>
<?endforeach;?>
<div class="clearfix"></div><br><br>
