<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?IncludeTemplateLangFile(__FILE__);
$APPLICATION->SetAdditionalCSS("/bitrix/templates/demi/css/bootstrap.css");
$APPLICATION->SetAdditionalCSS("/bitrix/templates/demi/css/bootstrap.min.css");
$APPLICATION->SetAdditionalCSS("/bitrix/templates/demi/css/bootstrap-theme.css");
$APPLICATION->SetAdditionalCSS("/bitrix/templates/demi/css/bootstrap-theme.min.css");
$APPLICATION->SetAdditionalCSS("/bitrix/templates/demi/css/mathrep.css");
/**
 * Created by PhpStorm.
 * User: Salikh
 * Date: 05.05.2016
 * Time: 12:05
 */
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <link href='https://fonts.googleapis.com/css?family=PT+Sans+Narrow:400,700&subset=latin,cyrillic' rel='stylesheet' type='text/css'>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <?$APPLICATION->ShowHead();?>
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title><?$APPLICATION->ShowTitle()?></title>

    <!-- Bootstrap -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

    <!-- My Styles -->
    <link href="css/mathrep.css" rel="stylesheet">
</head>
<body>
<?$APPLICATION->ShowPanel();?>
<div class="container" id="bighat">
    <div id="leftlogo" class="col-lg-6 col-md-6 hidden-sm visible-md visible-lg">
        <img src="/bitrix/templates/demi/images/demilogo.jpg" alt="Дагестанские электронные математические известия">
    </div>
    <div id="rightlogo" class="col-lg-6 col-md-6 col-sm-12 col-xs-12  text-center">
        <!--<img src="/bitrix/templates/demi/images/demilogo2.png" alt="Дагестанские электронные математические известия">-->
		<?echo GetMessage("HEADER_TITLE")?>
    </div>
</div>

<div class="container" id="mmenu">
    <?$APPLICATION->IncludeComponent(
        "bitrix:menu",
        "demi",
        array(
            "ALLOW_MULTI_SELECT" => "N",
            "CHILD_MENU_TYPE" => "left",
            "COMPONENT_TEMPLATE" => "demi",
            "DELAY" => "N",
            "MAX_LEVEL" => "1",
            "MENU_CACHE_GET_VARS" => array(
            ),
            "MENU_CACHE_TIME" => "3600",
            "MENU_CACHE_TYPE" => "N",
            "MENU_CACHE_USE_GROUPS" => "Y",
            "MENU_THEME" => "site",
            "ROOT_MENU_TYPE" => "left",
            "USE_EXT" => "N"
        ),
        false
    );?>

    <!--

    <nav class="navbar navbar-inverse">
        <div class="container-fluid">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand visible-xs" href="#">Навигация по сайту</a>
            </div>
            <div class="collapse navbar-collapse" id="myNavbar">
                <ul class="nav navbar-nav nav-justified">
                    <li class="active"><a href="#">Home</a></li>
                    <li><a href="#">Page 1</a></li>
                    <li><a href="#">Page 2</a></li>
                    <li><a href="#">Page 3</a></li>
                </ul>
            </div>
        </div>
    </nav>

    -->
</div>



<div class="container" id="mainblock">
