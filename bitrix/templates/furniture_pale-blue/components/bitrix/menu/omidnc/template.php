<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
if (empty($arResult)) return;?>

<ul class="nav navbar-nav navbar-right">
<?$previousLevel = 0;
foreach($arResult as $arItem):?>

    <?if ($previousLevel && $arItem["DEPTH_LEVEL"] < $previousLevel):?>
        <?=str_repeat("</ul></li>", ($previousLevel - $arItem["DEPTH_LEVEL"]));?>
    <?endif?>

    <?if ($arItem["IS_PARENT"]):?>

    <?if ($arItem["DEPTH_LEVEL"] == 1):?>
    <li class="dropdown"><a href="<?=$arItem["LINK"]?>" data-toggle="dropdown" class="dropdown-toggle"><?=$arItem["TEXT"]?><b class="caret"></b></a>
    <ul class="dropdown-menu">
    <?else:?>
    <li<?if ($arItem["SELECTED"]):?> class="item-selected"<?endif?>><a href="<?=$arItem["LINK"]?>" class="parent"><?=$arItem["TEXT"]?></a>
    <ul>
    <?endif?>

    <?else:?>

        <?if ($arItem["PERMISSION"] > "D"):?>

            <?if ($arItem["DEPTH_LEVEL"] == 1):?>
                <li><a href="<?=$arItem["LINK"]?>" class="<?if ($arItem["SELECTED"]):?>root-item-selected<?else:?>root-item<?endif?>"><?=$arItem["TEXT"]?></a></li>
            <?else:?>
                <li<?if ($arItem["SELECTED"]):?> class="item-selected"<?endif?>><a href="<?=$arItem["LINK"]?>"><?=$arItem["TEXT"]?></a></li>
            <?endif?>

        <?else:?>

            <?if ($arItem["DEPTH_LEVEL"] == 1):?>
                <li><a href="" class="<?if ($arItem["SELECTED"]):?>root-item-selected<?else:?>root-item<?endif?>" title="<?=GetMessage("MENU_ITEM_ACCESS_DENIED")?>"><?=$arItem["TEXT"]?></a></li>
            <?else:?>
                <li><a href="" class="denied" title="<?=GetMessage("MENU_ITEM_ACCESS_DENIED")?>"><?=$arItem["TEXT"]?></a></li>
            <?endif?>

        <?endif?>

    <?endif?>

    <?$previousLevel = $arItem["DEPTH_LEVEL"];?>

<?endforeach?>

<?if ($previousLevel > 1)://close last item tags?>
    <?=str_repeat("</ul></li>", ($previousLevel-1) );?>
<?endif?>
</ul>

<? /*
<ul class="nav navbar-nav navbar-right">
        <li>
            <a href="about.html">Об Отделе</a>
        </li>
        <li>
            <a href="services.html">Сотрудники</a>
        </li>
        <li>
            <a href="services.html">НИР</a>
        </li>
        <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">Публикации<b class="caret"></b></a>
            <ul class="dropdown-menu">
                <li>
                    <a href="full-width.html">По авторам</a>
                </li>
                <li>
                    <a href="sidebar.html">По темам</a>
                </li>
                <li>
                    <a href="faq.html">По типу публикации</a>
                </li>
                <li>
                    <a href="404.html">По годам</a>
                </li>
            </ul>
        </li>
        <li>
            <a href="contact.html">Контакты</a>
        </li>
    </ul>
*/?>
