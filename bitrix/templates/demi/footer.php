<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
IncludeTemplateLangFile(__FILE__);
/**
 * Created by PhpStorm.
 * User: Salikh
 * Date: 05.05.2016
 * Time: 12:03
 */
?>
</div>



<div class="container" id="footer">
    <div class="col-sm-6 col-xs-12" id="booker">
        <img src="/bitrix/templates/demi/images/b00k.png" alt="Дагестанские электронные математические известия" class="img-responsive pull-left" id="book">
        <p>
            <?echo GetMessage("FOOTER_DESCRIPTION")?>
        </p>
    </div>
    <div class="col-sm-6 col-xs-12">
		<h4 style="font-weight: bold; color: whitesmoke; text-align: right">
            <?
            if(SITE_ID == "s1") {
                echo "<a href='", $APPLICATION->GetCurUri(), "' style=\"color: whitesmoke\">RU</a>";
                echo " | ";
                echo "<a href='/en/", substr($APPLICATION->GetCurUri(), 1), "' style=\"color: whitesmoke\">EN</a>";
            } else {
                echo "<a href='", substr($APPLICATION->GetCurUri(), 3), "' style=\"color: whitesmoke\">RU</a>";
                echo " | ";
                echo "<a href='", $APPLICATION->GetCurUri(), "' style=\"color: whitesmoke\">EN</a>";
            }
            ?>
        </h4>
    </div>
</div>




<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<!-- Include all compiled plugins (below), or include individual files as needed -->
<script src="js/bootstrap.min.js"></script>
</body>
</html>