<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
IncludeTemplateLangFile(__FILE__);?>


    <hr/>



    <?if ($APPLICATION->GetCurPage(false) != "/contacts/"):?>
        <!-- Call to Action Section -->
        <div class="well">
            <div class="row">
                <div class="col-md-8">
                    <p>
                        <?$APPLICATION->IncludeFile(
                            SITE_DIR."include/welcomenote.php",
                            Array(),
                            Array("MODE"=>"text")
                        );?>
                    </p>
                </div>
                <div class="col-md-4">
                    <a class="btn btn-lg btn-default btn-block" href="<?SITE_DIR?>/contacts#contactform">Связаться с нами</a>
                </div>
            </div>
        </div>

        <hr/>
    <?endif;?>

    <!-- Footer -->
    <footer>
        <div class="row">
            <div class="col-lg-12">
                <p>
                    <?$APPLICATION->IncludeFile(
                        SITE_DIR."include/footnoter.php",
                        Array(),
                        Array("MODE"=>"html")
                    );?>
                </p>
            </div>
        </div>
    </footer>

</div>
<!-- /.container -->


<!-- Script to Activate the Carousel -->
<script type="text/javascript">
    $('.carousel').carousel({
        interval: 15000 //changes the speed
    })
</script>

</body>

</html>
