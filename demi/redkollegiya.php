<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Редколлегия");
?><br>
 <br>
 <br>
 <br>
 <?$APPLICATION->IncludeComponent(
	"bitrix:menu",
	"blue_tabs",
	Array(
		"ALLOW_MULTI_SELECT" => "N",
		"CHILD_MENU_TYPE" => "left",
		"COMPONENT_TEMPLATE" => "blue_tabs",
		"DELAY" => "N",
		"MAX_LEVEL" => "1",
		"MENU_CACHE_GET_VARS" => array(),
		"MENU_CACHE_TIME" => "3600",
		"MENU_CACHE_TYPE" => "N",
		"MENU_CACHE_USE_GROUPS" => "Y",
		"MENU_THEME" => "site",
		"ROOT_MENU_TYPE" => "left",
		"USE_EXT" => "N"
	)
);?>
<h1 style="text-align: right;">Состав редколлегии</h1>
<hr>
<p>
</p>
<p>
</p>
<p>
 <b>Главный редактор:</b>&nbsp;&nbsp;Шарапудинов Идрис Идрисович, д.ф.-м.н., профессор, Заведующий Отделом математики и информатики (ОМИ) ДНЦ РАН, зав. кафедрой математического анализа Дагестанского государственного педагогического университета (ДГПУ).
</p>
<p>
</p>
<p>
 <b>Заместитель главного редактора:</b>&nbsp; Рамазанов Абдул-Рашид Кехриманович, д.ф.-м.н., профессор, декан факультета математики и компьютерных наук Дагестанского государственного университета (ДГУ), зав. кафедрой математического анализа ДГУ.
</p>
<p>
</p>
<p>
 <b>Члены редколлегии:</b>
</p>
<ul>
	<li>Алишаев Мухтар Гусейнович, д.ф.-м.н., профессор, ОМИ ДНЦ РАН.</li>
	<li>Вагабов Абдулвагаб Исмаилович, д.ф.-м.н., профессор, ЮМИ ВНЦ РАН и РСО-А.</li>
	<li>Кадиев Рамазан Исмаилович, д.ф.-м.н., профессор, ОМИ ДНЦ РАН.</li>
	<li>Меджидов Зияудин Гаджиевич, к.ф.-м.н., ОМИ ДНЦ РАН.</li>
	<li>Сиражудинов Магомед Магомедалиевич, д.ф.-м.н., профессор, ОМИ ДНЦ РАН.</li>
</ul>
<p>
</p>
<p>
 <b>Ответственный секретарь:</b> &nbsp; Султанахмедов Мурад Салихович, ОМИ ДНЦ РАН.
</p><?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>