<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Сотрудники");
?>

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
    <div class="col-md-4 col-sm-6">
        <a href="portfolio-item.html">
            <img class="img-responsive img-portfolio img-hover" src="http://placehold.it/700x450" alt="">
        </a>
    </div>
    <div class="col-md-4 col-sm-6">
        <a href="portfolio-item.html">
            <img class="img-responsive img-portfolio img-hover" src="http://placehold.it/700x450" alt="">
        </a>
    </div>
    <div class="col-md-4 col-sm-6">
        <a href="portfolio-item.html">
            <img class="img-responsive img-portfolio img-hover" src="http://placehold.it/700x450" alt="">
        </a>
    </div>
    <div class="col-md-4 col-sm-6">
        <a href="portfolio-item.html">
            <img class="img-responsive img-portfolio img-hover" src="http://placehold.it/700x450" alt="">
        </a>
    </div>
    <div class="col-md-4 col-sm-6">
        <a href="portfolio-item.html">
            <img class="img-responsive img-portfolio img-hover" src="http://placehold.it/700x450" alt="">
        </a>
    </div>
    <div class="col-md-4 col-sm-6">
        <a href="portfolio-item.html">
            <img class="img-responsive img-portfolio img-hover" src="http://placehold.it/700x450" alt="">
        </a>
    </div>
    </div>

<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>