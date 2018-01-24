<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?IncludeTemplateLangFile(__FILE__);
$APPLICATION->SetAdditionalCSS("/bitrix/templates/demi/css/bootstrap.css");
$APPLICATION->SetAdditionalCSS("/bitrix/templates/demi/css/bootstrap.min.css");
$APPLICATION->SetAdditionalCSS("/bitrix/templates/demi/css/bootstrap-theme.css");
$APPLICATION->SetAdditionalCSS("/bitrix/templates/demi/css/bootstrap-theme.min.css");
$APPLICATION->SetAdditionalCSS("/bitrix/templates/demi/css/mathrep.css");?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <link href='https://fonts.googleapis.com/css?family=PT+Sans+Narrow:400,700&subset=latin,cyrillic' rel='stylesheet' type='text/css'>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<link href="<?=SITE_TEMPLATE_PATH?>/favicon.ico" rel="icon shortcut" type="image/x-icon" />

    <?$APPLICATION->ShowHead();?>
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title><?$APPLICATION->ShowTitle()?></title>

    <!-- Bootstrap -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <!-- Bootstrap Core JavaScript -->
    <script type="text/javascript" src="<?=SITE_TEMPLATE_PATH?>/js/bootstrap.min.js"></script>

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

    <!-- My Styles -->
    <link href="css/mathrep.css" rel="stylesheet">
	
	<script>
	  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
	  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
	  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
	  })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

	  ga('create', 'UA-81114331-1', 'auto');
	  ga('send', 'pageview');

	</script>
</head>

<body>
<?$APPLICATION->ShowPanel();?>

<div class="pageholder container">

<div class="container" id="bighat">
    <div id="leftlogo" class="col-lg-6 col-md-6 hidden-sm visible-md visible-lg">
        <img src="/bitrix/templates/demi/images/demilogo.jpg" alt="Дагестанские электронные математические известия">
    </div>
    <div id="rightlogo" class="col-lg-6 col-md-6 col-sm-12 col-xs-12  text-center">
        <h4 class="langswitch pull-right">
            <?if(SITE_ID == "s1") {
                echo "RU";
                echo " | ";
                echo "<a href='/en/", substr($APPLICATION->GetCurPage(false), 1), "' class=\"switcher\">EN</a>";
            } else {
                echo "<a href='", substr($APPLICATION->GetCurPage(false), 3), "' class=\"switcher\">RU</a>";
                echo " | ";
                echo "EN";
            }?>
        </h4><div class="clearfix"></div>
        <!--<img src="/bitrix/templates/demi/images/demilogo2.png" alt="Дагестанские электронные математические известия">-->
		<?echo GetMessage("HEADER_TITLE")?>
		<p class="text-center logotext-3">ISSN: 2500-3240</p>
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
