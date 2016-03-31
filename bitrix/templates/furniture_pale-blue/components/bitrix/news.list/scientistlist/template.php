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


<?if($arParams["DISPLAY_TOP_PAGER"]):?>
	<?=$arResult["NAV_STRING"]?><br />
<?endif;?>


<?foreach($arResult["ITEMS"] as $arItem):?>
	<?$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
	$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));?>


	<div class="col-md-4 text-center" id="<?=$this->GetEditAreaId($arItem['ID']);?>">
        <div class="thumbnail">
            <?if($arParams["DISPLAY_PICTURE"]!="N" && is_array($arItem["PREVIEW_PICTURE"])):?>
                <img class="img-responsive img-rounded scientistphoto" src="<?=$arItem["PREVIEW_PICTURE"]["SRC"]?>" alt="">
            <?endif;?>
            <div class="caption">
                <h3><a href="<?=$arItem["DETAIL_PAGE_URL"]?>">
                    <?=$arItem["NAME"]?>
                    <br>
                    <small>
                        <b><?=$arItem["PROPERTIES"]["RANK_NAME"]?></b>
                    </small>
                    <br>
                    <small>
                        <?=$arItem["PROPERTIES"]["DEGREE_NAME"]?>
                    </small>
                    <br>
                </a></h3>

                <?/*<p>< ?=$arItem["PREVIEW_TEXT"];?></p>*/?>

                <ul class="list-inline">
                    <li><a href="#"><i class="fa fa-2x fa-facebook-square"></i></a>
                    </li>
                    <li><a href="#"><i class="fa fa-2x fa-linkedin-square"></i></a>
                    </li>
                    <li><a href="#"><i class="fa fa-2x fa-twitter-square"></i></a>
                    </li>
                </ul>
            </div>
        </div>
    </div>


<?endforeach;?>


<?if($arParams["DISPLAY_BOTTOM_PAGER"]):?>
	<br /><?=$arResult["NAV_STRING"]?>
<?endif;?>
