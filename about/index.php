<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Об Отделе Математики и Информатики");?>



    <!-- Page Heading/Breadcrumbs -->
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">
                <?$APPLICATION->IncludeFile(
                    SITE_DIR."include/about/header.php",
                    Array(),
                    Array("MODE"=>"html")
                );?>
            </h1>

            <ol class="breadcrumb">
                <li><a href="index.html">Главная</a>
                </li>
                <li class="active">Об Отделе</li>
            </ol>

        </div>
    </div>
    <!-- /.row -->

    <!-- Intro Content -->
    <div class="row">
        <div class="col-md-6">
            <?$APPLICATION->IncludeFile(
                SITE_DIR."include/about/largeimage.php",
                Array(),
                Array("MODE"=>"html")
            );?>
        </div>
        <div class="col-md-6">
            <h2>
                <?$APPLICATION->IncludeFile(
                    SITE_DIR."include/about/headtext.php",
                    Array(),
                    Array("MODE"=>"text")
                );?>
            </h2>
                <?$APPLICATION->IncludeFile(
                    SITE_DIR."include/about/maintext.php",
                    Array(),
                    Array("MODE"=>"html")
                );?>
        </div>
    </div>
    <!-- /.row -->


    <hr>

    <!-- Intro Content -->
    <div class="row">
        <div class="col-md-12">
            <h2 class="page-header">
                <?$APPLICATION->IncludeFile(
                    SITE_DIR."include/about/infohead.php",
                    Array(),
                    Array("MODE"=>"text")
                );?>
            </h2>
        </div>
        <div class="col-md-12">
            <?$APPLICATION->IncludeFile(
                SITE_DIR."include/about/infotext.php",
                Array(),
                Array("MODE"=>"html")
            );?>
        </div>
    </div>
    <!-- /.row -->

    <hr>


    <!-- Team Members -->
    <div class="row">
        <div class="col-lg-12">
            <h2 class="page-header">
                <?$APPLICATION->IncludeFile(
                    SITE_DIR."include/mainhead3.php",
                    Array(),
                    Array("MODE"=>"text")
                );?>
            </h2>
        </div>

        <?$APPLICATION->IncludeComponent(
            "bitrix:news.list",
            "scientistlist",
            array(
                "ACTIVE_DATE_FORMAT" => "d.m.Y",
                "ADD_SECTIONS_CHAIN" => "Y",
                "AJAX_MODE" => "N",
                "AJAX_OPTION_ADDITIONAL" => "",
                "AJAX_OPTION_HISTORY" => "N",
                "AJAX_OPTION_JUMP" => "N",
                "AJAX_OPTION_STYLE" => "Y",
                "CACHE_FILTER" => "N",
                "CACHE_GROUPS" => "Y",
                "CACHE_TIME" => "36000000",
                "CACHE_TYPE" => "A",
                "CHECK_DATES" => "Y",
                "COMPONENT_TEMPLATE" => "scientistlist",
                "DETAIL_URL" => "",
                "DISPLAY_BOTTOM_PAGER" => "Y",
                "DISPLAY_DATE" => "Y",
                "DISPLAY_NAME" => "Y",
                "DISPLAY_PICTURE" => "Y",
                "DISPLAY_PREVIEW_TEXT" => "Y",
                "DISPLAY_TOP_PAGER" => "N",
                "FIELD_CODE" => array(
                    0 => "",
                    1 => "",
                ),
                "FILTER_NAME" => "",
                "HIDE_LINK_WHEN_NO_DETAIL" => "N",
                "IBLOCK_ID" => "5",
                "IBLOCK_TYPE" => "news",
                "INCLUDE_IBLOCK_INTO_CHAIN" => "Y",
                "INCLUDE_SUBSECTIONS" => "Y",
                "MESSAGE_404" => "",
                "NEWS_COUNT" => "20",
                "PAGER_BASE_LINK_ENABLE" => "N",
                "PAGER_DESC_NUMBERING" => "N",
                "PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
                "PAGER_SHOW_ALL" => "N",
                "PAGER_SHOW_ALWAYS" => "N",
                "PAGER_TEMPLATE" => ".default",
                "PAGER_TITLE" => "Новости",
                "PARENT_SECTION" => "",
                "PARENT_SECTION_CODE" => "",
                "PREVIEW_TRUNCATE_LEN" => "",
                "PROPERTY_CODE" => array(
                    0 => "",
                    1 => "RANK",
                    2 => "NAME",
                    3 => "PATRONIM",
                    4 => "DEGREE",
                    5 => "SURNAME",
                    6 => "",
                ),
                "SET_BROWSER_TITLE" => "Y",
                "SET_LAST_MODIFIED" => "N",
                "SET_META_DESCRIPTION" => "Y",
                "SET_META_KEYWORDS" => "Y",
                "SET_STATUS_404" => "N",
                "SET_TITLE" => "Y",
                "SHOW_404" => "N",
                "SORT_BY1" => "ACTIVE_FROM",
                "SORT_BY2" => "SORT",
                "SORT_ORDER1" => "DESC",
                "SORT_ORDER2" => "ASC"
            ),
            false
        );?>
    </div>




    <!-- Our Customers -->
    <div class="row">
        <div class="col-lg-12">
            <h2 class="page-header">
                <?$APPLICATION->IncludeFile(
                    SITE_DIR."include/about/botthead.php",
                    Array(),
                    Array("MODE"=>"text")
                );?>
            </h2>
        </div>

        <?$APPLICATION->IncludeComponent(
            "bitrix:news.list",
            "orglist",
            Array(
                "ACTIVE_DATE_FORMAT" => "d.m.Y",
                "ADD_SECTIONS_CHAIN" => "Y",
                "AJAX_MODE" => "N",
                "AJAX_OPTION_ADDITIONAL" => "",
                "AJAX_OPTION_HISTORY" => "N",
                "AJAX_OPTION_JUMP" => "N",
                "AJAX_OPTION_STYLE" => "Y",
                "CACHE_FILTER" => "N",
                "CACHE_GROUPS" => "Y",
                "CACHE_TIME" => "36000000",
                "CACHE_TYPE" => "A",
                "CHECK_DATES" => "Y",
                "COMPONENT_TEMPLATE" => ".default",
                "DETAIL_URL" => "",
                "DISPLAY_BOTTOM_PAGER" => "Y",
                "DISPLAY_DATE" => "Y",
                "DISPLAY_NAME" => "Y",
                "DISPLAY_PICTURE" => "Y",
                "DISPLAY_PREVIEW_TEXT" => "Y",
                "DISPLAY_TOP_PAGER" => "N",
                "FIELD_CODE" => array("NAME", "SORT", "PREVIEW_TEXT", "PREVIEW_PICTURE", ""),
                "FILTER_NAME" => "",
                "HIDE_LINK_WHEN_NO_DETAIL" => "N",
                "IBLOCK_ID" => "8",
                "IBLOCK_TYPE" => "organization",
                "INCLUDE_IBLOCK_INTO_CHAIN" => "Y",
                "INCLUDE_SUBSECTIONS" => "Y",
                "MESSAGE_404" => "",
                "NEWS_COUNT" => "20",
                "PAGER_BASE_LINK_ENABLE" => "N",
                "PAGER_DESC_NUMBERING" => "N",
                "PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
                "PAGER_SHOW_ALL" => "N",
                "PAGER_SHOW_ALWAYS" => "N",
                "PAGER_TEMPLATE" => ".default",
                "PAGER_TITLE" => "Научные организации",
                "PARENT_SECTION" => "",
                "PARENT_SECTION_CODE" => "",
                "PREVIEW_TRUNCATE_LEN" => "",
                "PROPERTY_CODE" => array("LINK", ""),
                "SET_BROWSER_TITLE" => "Y",
                "SET_LAST_MODIFIED" => "N",
                "SET_META_DESCRIPTION" => "Y",
                "SET_META_KEYWORDS" => "Y",
                "SET_STATUS_404" => "Y",
                "SET_TITLE" => "Y",
                "SHOW_404" => "N",
                "SORT_BY1" => "ACTIVE_FROM",
                "SORT_BY2" => "SORT",
                "SORT_ORDER1" => "DESC",
                "SORT_ORDER2" => "ASC"
            )
        );?>

    </div>
    <!-- /.row -->



<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>