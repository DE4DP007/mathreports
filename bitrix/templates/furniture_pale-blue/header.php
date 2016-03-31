<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?IncludeTemplateLangFile(__FILE__);?>

<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <?$APPLICATION->ShowHead();?>

    <meta name="description" content="Отдел математики и информатики Дагестанского научного центра Российской академии наук">
    <meta name="author" content="Интеллектуальные системы">
    <meta name="keywords" content="математика, информатика, прикладная математика, научно-исследовательская работа, Дагестанский научный центр, РАН, ДНЦ РАН">
    <link href="<?=SITE_TEMPLATE_PATH?>/favicon.ico" rel="icon shortcut" type="image/x-icon" />


    <!-- <title>Отдел математики и информатики ДНЦ РАН</title> -->
    <title><?$APPLICATION->ShowTitle()?></title>

    <!-- Bootstrap Core CSS -->
    <link href="<?=SITE_TEMPLATE_PATH?>/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="<?=SITE_TEMPLATE_PATH?>/css/modern-business.css" rel="stylesheet">

    <link href="<?=SITE_TEMPLATE_PATH?>/css/omistyles.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="<?=SITE_TEMPLATE_PATH?>/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->


    <!-- From Bitrix. Do we need it? -->
    <!--[if lte IE 6]>
    <style type="text/css">
        #banner-overlay {
            background-image: none;
            filter: progid:DXImageTransform.Microsoft.AlphaImageLoader(src='<?=SITE_TEMPLATE_PATH?>images/overlay.png', sizingMethod = 'crop');
        }
        div.product-overlay {
            background-image: none;
            filter: progid:DXImageTransform.Microsoft.AlphaImageLoader(src='<?=SITE_TEMPLATE_PATH?>images/product-overlay.png', sizingMethod = 'crop');
        }
    </style>
    <![endif]-->


    <!-- jQuery -->
    <script type="text/javascript" src="<?=SITE_TEMPLATE_PATH?>/js/jquery.js"></script>
    <!-- Bootstrap Core JavaScript -->
    <script type="text/javascript" src="<?=SITE_TEMPLATE_PATH?>/js/bootstrap.min.js"></script>

    <!--Custom OMI Tools -->
    <script type="text/javascript" src="<?=SITE_TEMPLATE_PATH?>/js/omiTools.js"></script>
</head>

<body>
<!-- Navigation -->
<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
    <!-- Bitrix Panel -->
    <div id="panel"><?$APPLICATION->ShowPanel();?></div>

    <div class="container">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header text-center" >
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                <span class="sr-only">Показать меню</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" id="omilogo" href="<?SITE_DIR?>/">
                <img class="img-responsive" id="omi-logo" src="<?=SITE_TEMPLATE_PATH?>/images/omi-logo.png" alt="Отдел Математики и Информатики" />
                Отдел Математики и Информатики
                <br><small>Дагестанского научного центра РАН</small>
            </a>
        </div>
        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <?$APPLICATION->IncludeComponent("bitrix:menu", "omidnc", array(
                "ROOT_MENU_TYPE" => "top",
                "MAX_LEVEL" => "2",
                "CHILD_MENU_TYPE" => "left",
                "USE_EXT" => "Y",
                "MENU_CACHE_TYPE" => "A",
                "MENU_CACHE_TIME" => "36000000",
                "MENU_CACHE_USE_GROUPS" => "Y",
                "MENU_CACHE_GET_VARS" => ""
            ),
                false,
                array(
                    "ACTIVE_COMPONENT" => "Y"
                )
            );?>
        </div>
        <!-- /.navbar-collapse -->
    </div>
    <!-- /.container -->
</nav>

<!-- ========== MAKE IT ON MAIN PAGE ONLY! =========== -->
<?if ($APPLICATION->GetCurPage(false) == "/"):?>
<!-- Header Carousel -->
    <header id="myCarousel" class="carousel slide">
        <!-- Indicators -->
        <ol class="carousel-indicators">
            <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
            <li data-target="#myCarousel" data-slide-to="1"></li>
            <li data-target="#myCarousel" data-slide-to="2"></li>
        </ol>

        <!-- Wrapper for slides -->
        <div class="carousel-inner">
            <div class="item active">
                <div class="fill text-center">
                    <img src="<?=SITE_TEMPLATE_PATH?>/images/OMIBanner.jpg" alt="Отдел Математики и Информатики">
                </div>
            </div>
            <div class="item">
                <div class="fill text-center">
                    <img src="<?=SITE_TEMPLATE_PATH?>/images/seminavr.jpg" alt="Заседание семинара Отдела">
                </div>
                <div class="carousel-caption">
                    <h2>Заседание Отдела Математики и Информатики</h2>
                </div>
            </div>
            <div class="item">
                <div class="fill text-center">
                    <img src="<?=SITE_TEMPLATE_PATH?>/images/70year.jpg" alt="70 лет Дагестанскому научному центру РАН">
                </div>
                <div class="carousel-caption">
                    <h2>70 лет Дагестанскому научному центру РАН</h2>
                </div>
                <!--<div class="fill" style="background-image:url('http://placehold.it/1900x1080&text=Slide Three');"></div>-->
            </div>
        </div>

        <!-- Controls -->
        <a class="left carousel-control" href="#myCarousel" data-slide="prev">
            <span class="icon-prev"></span>
        </a>
        <a class="right carousel-control" href="#myCarousel" data-slide="next">
            <span class="icon-next"></span>
        </a>
    </header>
<?endif;?>



<!-- Page Content -->
<div class="container">