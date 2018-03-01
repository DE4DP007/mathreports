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
        // echo GetPublications($ar_fields["ID"]);

        $arFilter = Array("IBLOCK_ID"=>17, "PROPERTY_JOURNAL" => $ar_fields["ID"]);?>
        <h2 class="text-center">Содержание</h2><br/>

    <?$APPLICATION->IncludeComponent("bitrix:news.list", "issue_articles", Array(
    "ACTIVE_DATE_FORMAT" => "d.m.Y",    // Формат показа даты
        "ADD_SECTIONS_CHAIN" => "Y",    // Включать раздел в цепочку навигации
        "AJAX_MODE" => "N", // Включить режим AJAX
        "AJAX_OPTION_ADDITIONAL" => "", // Дополнительный идентификатор
        "AJAX_OPTION_HISTORY" => "N",   // Включить эмуляцию навигации браузера
        "AJAX_OPTION_JUMP" => "N",  // Включить прокрутку к началу компонента
        "AJAX_OPTION_STYLE" => "Y", // Включить подгрузку стилей
        "CACHE_FILTER" => "N",  // Кешировать при установленном фильтре
        "CACHE_GROUPS" => "Y",  // Учитывать права доступа
        "CACHE_TIME" => "36000000", // Время кеширования (сек.)
        "CACHE_TYPE" => "A",    // Тип кеширования
        "CHECK_DATES" => "Y",   // Показывать только активные на данный момент элементы
        "COMPONENT_TEMPLATE" => ".default",
        "DETAIL_URL" => "", // URL страницы детального просмотра (по умолчанию - из настроек инфоблока)
        "DISPLAY_BOTTOM_PAGER" => "Y",  // Выводить под списком
        "DISPLAY_DATE" => "Y",  // Выводить дату элемента
        "DISPLAY_NAME" => "Y",  // Выводить название элемента
        "DISPLAY_PICTURE" => "Y",   // Выводить изображение для анонса
        "DISPLAY_PREVIEW_TEXT" => "Y",  // Выводить текст анонса
        "DISPLAY_TOP_PAGER" => "N", // Выводить над списком
        "FIELD_CODE" => array(  // Поля
            0 => "",
            1 => "",
        ),
        "FILTER_NAME" => "arFilter",   // Фильтр
        "HIDE_LINK_WHEN_NO_DETAIL" => "N",  // Скрывать ссылку, если нет детального описания
        "IBLOCK_ID" => "17",    // Код информационного блока
        "IBLOCK_TYPE" => "issues",  // Тип информационного блока (используется только для проверки)
        "INCLUDE_IBLOCK_INTO_CHAIN" => "Y", // Включать инфоблок в цепочку навигации
        "INCLUDE_SUBSECTIONS" => "Y",   // Показывать элементы подразделов раздела
        "MESSAGE_404" => "",    // Сообщение для показа (по умолчанию из компонента)
        "NEWS_COUNT" => "20",   // Количество новостей на странице
        "PAGER_BASE_LINK_ENABLE" => "N",    // Включить обработку ссылок
        "PAGER_DESC_NUMBERING" => "N",  // Использовать обратную навигацию
        "PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",   // Время кеширования страниц для обратной навигации
        "PAGER_SHOW_ALL" => "N",    // Показывать ссылку "Все"
        "PAGER_SHOW_ALWAYS" => "N", // Выводить всегда
        "PAGER_TEMPLATE" => ".default", // Шаблон постраничной навигации
        "PAGER_TITLE" => "Новости", // Название категорий
        "PARENT_SECTION" => "", // ID раздела
        "PARENT_SECTION_CODE" => "",    // Код раздела
        "PREVIEW_TRUNCATE_LEN" => "",   // Максимальная длина анонса для вывода (только для типа текст)
        "PROPERTY_CODE" => array(   // Свойства
            0 => "AUTHORS",
            1 => "START_PAGE",
            2 => "END_PAGE",
        ),
        "SET_BROWSER_TITLE" => "Y", // Устанавливать заголовок окна браузера
        "SET_LAST_MODIFIED" => "N", // Устанавливать в заголовках ответа время модификации страницы
        "SET_META_DESCRIPTION" => "Y",  // Устанавливать описание страницы
        "SET_META_KEYWORDS" => "Y", // Устанавливать ключевые слова страницы
        "SET_STATUS_404" => "N",    // Устанавливать статус 404
        "SET_TITLE" => "Y", // Устанавливать заголовок страницы
        "SHOW_404" => "N",  // Показ специальной страницы
        "SORT_BY1" => "ACTIVE_FROM",    // Поле для первой сортировки новостей
        "SORT_BY2" => "SORT",   // Поле для второй сортировки новостей
        "SORT_ORDER1" => "DESC",    // Направление для первой сортировки новостей
        "SORT_ORDER2" => "ASC", // Направление для второй сортировки новостей
    ),
    false
);?>
    <?}?>
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