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
<?$ElementID = $APPLICATION->IncludeComponent(
	"bitrix:news.detail",
	"demiAuth",
	Array(
		"DISPLAY_DATE" => $arParams["DISPLAY_DATE"],
		"DISPLAY_NAME" => $arParams["DISPLAY_NAME"],
		"DISPLAY_PICTURE" => $arParams["DISPLAY_PICTURE"],
		"DISPLAY_PREVIEW_TEXT" => $arParams["DISPLAY_PREVIEW_TEXT"],
		"IBLOCK_TYPE" => $arParams["IBLOCK_TYPE"],
		"IBLOCK_ID" => $arParams["IBLOCK_ID"],
		"FIELD_CODE" => $arParams["DETAIL_FIELD_CODE"],
		"PROPERTY_CODE" => $arParams["DETAIL_PROPERTY_CODE"],
		"DETAIL_URL" => $arResult["FOLDER"].$arResult["URL_TEMPLATES"]["detail"],
		"SECTION_URL" => $arResult["FOLDER"].$arResult["URL_TEMPLATES"]["section"],
		"META_KEYWORDS" => $arParams["META_KEYWORDS"],
		"META_DESCRIPTION" => $arParams["META_DESCRIPTION"],
		"BROWSER_TITLE" => $arParams["BROWSER_TITLE"],
		"SET_CANONICAL_URL" => $arParams["DETAIL_SET_CANONICAL_URL"],
		"DISPLAY_PANEL" => $arParams["DISPLAY_PANEL"],
		"SET_LAST_MODIFIED" => $arParams["SET_LAST_MODIFIED"],
		"SET_TITLE" => $arParams["SET_TITLE"],
		"MESSAGE_404" => $arParams["MESSAGE_404"],
		"SET_STATUS_404" => $arParams["SET_STATUS_404"],
		"SHOW_404" => $arParams["SHOW_404"],
		"FILE_404" => $arParams["FILE_404"],
		"INCLUDE_IBLOCK_INTO_CHAIN" => $arParams["INCLUDE_IBLOCK_INTO_CHAIN"],
		"ADD_SECTIONS_CHAIN" => $arParams["ADD_SECTIONS_CHAIN"],
		"ACTIVE_DATE_FORMAT" => $arParams["DETAIL_ACTIVE_DATE_FORMAT"],
		"CACHE_TYPE" => $arParams["CACHE_TYPE"],
		"CACHE_TIME" => $arParams["CACHE_TIME"],
		"CACHE_GROUPS" => $arParams["CACHE_GROUPS"],
		"USE_PERMISSIONS" => $arParams["USE_PERMISSIONS"],
		"GROUP_PERMISSIONS" => $arParams["GROUP_PERMISSIONS"],
		"DISPLAY_TOP_PAGER" => $arParams["DETAIL_DISPLAY_TOP_PAGER"],
		"DISPLAY_BOTTOM_PAGER" => $arParams["DETAIL_DISPLAY_BOTTOM_PAGER"],
		"PAGER_TITLE" => $arParams["DETAIL_PAGER_TITLE"],
		"PAGER_SHOW_ALWAYS" => "N",
		"PAGER_TEMPLATE" => $arParams["DETAIL_PAGER_TEMPLATE"],
		"PAGER_SHOW_ALL" => $arParams["DETAIL_PAGER_SHOW_ALL"],
		"CHECK_DATES" => $arParams["CHECK_DATES"],
		"ELEMENT_ID" => $arResult["VARIABLES"]["ELEMENT_ID"],
		"ELEMENT_CODE" => $arResult["VARIABLES"]["ELEMENT_CODE"],
		"IBLOCK_URL" => $arResult["FOLDER"].$arResult["URL_TEMPLATES"]["news"],
		"USE_SHARE" => $arParams["USE_SHARE"],
		"SHARE_HIDE" => $arParams["SHARE_HIDE"],
		"SHARE_TEMPLATE" => $arParams["SHARE_TEMPLATE"],
		"SHARE_HANDLERS" => $arParams["SHARE_HANDLERS"],
		"SHARE_SHORTEN_URL_LOGIN" => $arParams["SHARE_SHORTEN_URL_LOGIN"],
		"SHARE_SHORTEN_URL_KEY" => $arParams["SHARE_SHORTEN_URL_KEY"],
		"ADD_ELEMENT_CHAIN" => (isset($arParams["ADD_ELEMENT_CHAIN"]) ? $arParams["ADD_ELEMENT_CHAIN"] : '')
	),
	$component
);?>

<?$GLOBALS["arFilter"] = Array("PROPERTY_AUTHORS" => $ElementID);?> 
        <h2 class="text-center"><?=GetMessage("ARTICLES")?></h2><br/> 
 
    <?$APPLICATION->IncludeComponent("bitrix:news.list", "authors_articles", Array( 
  "ACTIVE_DATE_FORMAT" => "d.m.Y",  // Формат показа даты 
    "ADD_SECTIONS_CHAIN" => "Y",  // Включать раздел в цепочку навигации 
    "AJAX_MODE" => "N",  // Включить режим AJAX 
    "AJAX_OPTION_ADDITIONAL" => "",  // Дополнительный идентификатор 
    "AJAX_OPTION_HISTORY" => "N",  // Включить эмуляцию навигации браузера 
    "AJAX_OPTION_JUMP" => "N",  // Включить прокрутку к началу компонента 
    "AJAX_OPTION_STYLE" => "Y",  // Включить подгрузку стилей 
    "CACHE_FILTER" => "N",  // Кешировать при установленном фильтре 
    "CACHE_GROUPS" => "Y",  // Учитывать права доступа 
    "CACHE_TIME" => "36000000",  // Время кеширования (сек.) 
    "CACHE_TYPE" => "A",  // Тип кеширования 
    "CHECK_DATES" => "Y",  // Показывать только активные на данный момент элементы 
    "DETAIL_URL" => "",  // URL страницы детального просмотра (по умолчанию - из настроек инфоблока) 
    "DISPLAY_BOTTOM_PAGER" => "Y",  // Выводить под списком 
    "DISPLAY_DATE" => "Y",  // Выводить дату элемента 
    "DISPLAY_NAME" => "Y",  // Выводить название элемента 
    "DISPLAY_PICTURE" => "Y",  // Выводить изображение для анонса 
    "DISPLAY_PREVIEW_TEXT" => "Y",  // Выводить текст анонса 
    "DISPLAY_TOP_PAGER" => "N",  // Выводить над списком 
    "FIELD_CODE" => array(  // Поля 
      0 => "", 
      1 => "", 
    ), 
    "FILTER_NAME" => "arFilter",  // Фильтр 
    "HIDE_LINK_WHEN_NO_DETAIL" => "N",  // Скрывать ссылку, если нет детального описания 
    "IBLOCK_ID" => GetMessage("ARTICLES_BID"),  // Код информационного блока 
    "IBLOCK_TYPE" => "issues",  // Тип информационного блока (используется только для проверки) 
    "INCLUDE_IBLOCK_INTO_CHAIN" => "N",  // Включать инфоблок в цепочку навигации 
    "INCLUDE_SUBSECTIONS" => "N",  // Показывать элементы подразделов раздела 
    "MESSAGE_404" => "",  // Сообщение для показа (по умолчанию из компонента) 
    "NEWS_COUNT" => "20",  // Количество новостей на странице 
    "PAGER_BASE_LINK_ENABLE" => "N",  // Включить обработку ссылок 
    "PAGER_DESC_NUMBERING" => "N",  // Использовать обратную навигацию 
    "PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",  // Время кеширования страниц для обратной навигации 
    "PAGER_SHOW_ALL" => "N",  // Показывать ссылку "Все" 
    "PAGER_SHOW_ALWAYS" => "N",  // Выводить всегда 
    "PAGER_TEMPLATE" => ".default",  // Шаблон постраничной навигации 
    "PAGER_TITLE" => GetMessage("AUTHORS_S"),  // Название категорий 
    "PARENT_SECTION" => "",  // ID раздела 
    "PARENT_SECTION_CODE" => "",  // Код раздела 
    "PREVIEW_TRUNCATE_LEN" => "",  // Максимальная длина анонса для вывода (только для типа текст) 
    "PROPERTY_CODE" => array(  // Свойства 
      0 => "START_PAGE", 
      1 => "END_PAGE", 
      2 => "AUTHORS", 
      3 => "", 
    ), 
    "SET_BROWSER_TITLE" => "N",  // Устанавливать заголовок окна браузера 
    "SET_LAST_MODIFIED" => "N",  // Устанавливать в заголовках ответа время модификации страницы 
    "SET_META_DESCRIPTION" => "N",  // Устанавливать описание страницы 
    "SET_META_KEYWORDS" => "Y",  // Устанавливать ключевые слова страницы 
    "SET_STATUS_404" => "N",  // Устанавливать статус 404 
    "SET_TITLE" => "N",  // Устанавливать заголовок страницы 
    "SHOW_404" => "N",  // Показ специальной страницы 
    "SORT_BY1" => "SORT",  // Поле для первой сортировки новостей 
    "SORT_BY2" => "ACTIVE_FORM",  // Поле для второй сортировки новостей 
    "SORT_ORDER1" => "DESC",  // Направление для первой сортировки новостей 
    "SORT_ORDER2" => "DESC",  // Направление для второй сортировки новостей 
  ), 
  $component 
);?> 
 
<p class="col-md-12 text-left"> 
    <a href="<?=$arResult["FOLDER"].$arResult["URL_TEMPLATES"]["news"]?>" class="btn btn-lg btn-primary"> 
        <span class="glyphicon glyphicon-arrow-left"></span> 
        <?=GetMessage("T_NEWS_DETAIL_BACK")?>
    </a> 
</p>

<?if($arParams["USE_RATING"]=="Y" && $ElementID):?>
<?$APPLICATION->IncludeComponent(
	"bitrix:iblock.vote",
	"",
	Array(
		"IBLOCK_TYPE" => $arParams["IBLOCK_TYPE"],
		"IBLOCK_ID" => $arParams["IBLOCK_ID"],
		"ELEMENT_ID" => $ElementID,
		"MAX_VOTE" => $arParams["MAX_VOTE"],
		"VOTE_NAMES" => $arParams["VOTE_NAMES"],
		"CACHE_TYPE" => $arParams["CACHE_TYPE"],
		"CACHE_TIME" => $arParams["CACHE_TIME"],
	),
	$component
);?>
<?endif?>
<?if($arParams["USE_CATEGORIES"]=="Y" && $ElementID):
	global $arCategoryFilter;
	$obCache = new CPHPCache;
	$strCacheID = $componentPath.LANG.$arParams["IBLOCK_ID"].$ElementID.$arParams["CATEGORY_CODE"];
	if(($tzOffset = CTimeZone::GetOffset()) <> 0)
		$strCacheID .= "_".$tzOffset;
	if($arParams["CACHE_TYPE"] == "N" || $arParams["CACHE_TYPE"] == "A" && COption::GetOptionString("main", "component_cache_on", "Y") == "N")
		$CACHE_TIME = 0;
	else
		$CACHE_TIME = $arParams["CACHE_TIME"];
	if($obCache->StartDataCache($CACHE_TIME, $strCacheID, $componentPath))
	{
		$rsProperties = CIBlockElement::GetProperty($arParams["IBLOCK_ID"], $ElementID, "sort", "asc", array("ACTIVE"=>"Y","CODE"=>$arParams["CATEGORY_CODE"]));
		$arCategoryFilter = array();
		while($arProperty = $rsProperties->Fetch())
		{
			if(is_array($arProperty["VALUE"]) && count($arProperty["VALUE"])>0)
			{
				foreach($arProperty["VALUE"] as $value)
					$arCategoryFilter[$value]=true;
			}
			elseif(!is_array($arProperty["VALUE"]) && strlen($arProperty["VALUE"])>0)
				$arCategoryFilter[$arProperty["VALUE"]]=true;
		}
		$obCache->EndDataCache($arCategoryFilter);
	}
	else
	{
		$arCategoryFilter = $obCache->GetVars();
	}
	if(count($arCategoryFilter)>0):
		$arCategoryFilter = array(
			"PROPERTY_".$arParams["CATEGORY_CODE"] => array_keys($arCategoryFilter),
			"!"."ID" => $ElementID,
		);
		?>
		<hr /><h3><?=GetMessage("CATEGORIES")?></h3>
		<?foreach($arParams["CATEGORY_IBLOCK"] as $iblock_id):?>
			<?$APPLICATION->IncludeComponent(
				"bitrix:news.list",
				$arParams["CATEGORY_THEME_".$iblock_id],
				Array(
					"IBLOCK_ID" => $iblock_id,
					"NEWS_COUNT" => $arParams["CATEGORY_ITEMS_COUNT"],
					"SET_TITLE" => "N",
					"INCLUDE_IBLOCK_INTO_CHAIN" => "N",
					"CACHE_TYPE" => $arParams["CACHE_TYPE"],
					"CACHE_TIME" => $arParams["CACHE_TIME"],
					"CACHE_GROUPS" => $arParams["CACHE_GROUPS"],
					"FILTER_NAME" => "arCategoryFilter",
					"CACHE_FILTER" => "Y",
					"DISPLAY_TOP_PAGER" => "N",
					"DISPLAY_BOTTOM_PAGER" => "N",
				),
				$component
			);?>
		<?endforeach?>
	<?endif?>
<?endif?>
<?if($arParams["USE_REVIEW"]=="Y" && IsModuleInstalled("forum") && $ElementID):?>
<hr />
<?$APPLICATION->IncludeComponent(
	"bitrix:forum.topic.reviews",
	"",
	Array(
		"CACHE_TYPE" => $arParams["CACHE_TYPE"],
		"CACHE_TIME" => $arParams["CACHE_TIME"],
		"MESSAGES_PER_PAGE" => $arParams["MESSAGES_PER_PAGE"],
		"USE_CAPTCHA" => $arParams["USE_CAPTCHA"],
		"PATH_TO_SMILE" => $arParams["PATH_TO_SMILE"],
		"FORUM_ID" => $arParams["FORUM_ID"],
		"URL_TEMPLATES_READ" => $arParams["URL_TEMPLATES_READ"],
		"SHOW_LINK_TO_FORUM" => $arParams["SHOW_LINK_TO_FORUM"],
		"DATE_TIME_FORMAT" => $arParams["DETAIL_ACTIVE_DATE_FORMAT"],
		"ELEMENT_ID" => $ElementID,
		"AJAX_POST" => $arParams["REVIEW_AJAX_POST"],
		"IBLOCK_ID" => $arParams["IBLOCK_ID"],
		"URL_TEMPLATES_DETAIL" => $arResult["FOLDER"].$arResult["URL_TEMPLATES"]["detail"],
	),
	$component
);?>
<?endif?>
