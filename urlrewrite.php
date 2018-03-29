<?
$arUrlRewrite = array(
	array(
		"CONDITION" => "#^/en/articles/([a-zA-Z0-9\\.\\-_]+)/?.*#",
		"RULE" => "ELEMENT_CODE=\$1",
		"ID" => "bitrix:news.detail",
		"PATH" => "/en/articles/detail.php",
	),
	array(
		"CONDITION" => "#^/en/authors/([a-zA-Z0-9\\.\\-_]+)/?.*#",
		"RULE" => "ELEMENT_CODE=\$1",
		"ID" => "bitrix:news.detail",
		"PATH" => "/en/authors/detail.php",
	),
	array(
		"CONDITION" => "#^/en/issues/([a-zA-Z0-9\\.\\-_]+)/?.*#",
		"RULE" => "ELEMENT_CODE=\$1",
		"ID" => "bitrix:news.detail",
		"PATH" => "/en/issues/detail.php",
	),
	array(
		"CONDITION" => "#^/articles/([a-zA-Z0-9\\.\\-_]+)/?.*#",
		"RULE" => "ELEMENT_CODE=\$1",
		"ID" => "bitrix:news.detail",
		"PATH" => "/articles/detail.php",
	),
	array(
		"CONDITION" => "#^/authors/([a-zA-Z0-9\\.\\-_]+)/?.*#",
		"RULE" => "ELEMENT_CODE=\$1",
		"ID" => "bitrix:news.detail",
		"PATH" => "/authors/detail.php",
	),
	array(
		"CONDITION" => "#^/en/work/([a-zA-Z0-9\\.\\-_]+)/?.*#",
		"RULE" => "ELEMENT_CODE=\$1",
		"ID" => "bitrix:news.detail",
		"PATH" => "/work/detail.php",
	),
	array(
		"CONDITION" => "#^/issues/([a-zA-Z0-9\\.\\-_]+)/?.*#",
		"RULE" => "ELEMENT_CODE=\$1",
		"ID" => "bitrix:news.detail",
		"PATH" => "/issues/detail.php",
	),
	array(
		"CONDITION" => "#^/work/([a-zA-Z0-9\\.\\-_]+)/?.*#",
		"RULE" => "ELEMENT_CODE=\$1",
		"ID" => "bitrix:news.detail",
		"PATH" => "/work/detail.php",
	),
	array(
		"CONDITION" => "#^/en/tekushchiy-vypusk/#",
		"PATH" => "/en/tekushchiy-vypusk.php",
	),
	array(
		"CONDITION" => "#^/en/work/index.php?.*#",
		"PATH" => "/work/index.php",
	),
	array(
		"CONDITION" => "#^/en/dlya-avtorov/#",
		"PATH" => "/en/dlya-avtorov.php",
	),
	array(
		"CONDITION" => "#^/en/redkollegiya/#",
		"PATH" => "/en/redkollegiya.php",
	),
	array(
		"CONDITION" => "#^/en/articles/#",
		"RULE" => "",
		"ID" => "bitrix:news",
		"PATH" => "/en/articles/index.php",
	),
	array(
		"CONDITION" => "#^/en/authors/#",
		"PATH" => "/en/authors/index.php",
	),
	array(
		"CONDITION" => "#^\\en/authors/#",
		"RULE" => "",
		"ID" => "bitrix:news",
		"PATH" => "/en/authors/index.php",
	),
	array(
		"CONDITION" => "#^/en/vypuski/#",
		"PATH" => "/en/vypuski.php",
	),
	array(
		"CONDITION" => "#^/en/issues/#",
		"RULE" => "",
		"ID" => "bitrix:news",
		"PATH" => "/en/issues/index.php",
	),
	array(
		"CONDITION" => "#^/articles/#",
		"RULE" => "",
		"ID" => "bitrix:news",
		"PATH" => "/articles/index.php",
	),
	array(
		"CONDITION" => "#^/en/work/#",
		"RULE" => "",
		"ID" => "bitrix:news",
		"PATH" => "/en/work/index.php",
	),
	array(
		"CONDITION" => "#^/authors/#",
		"RULE" => "",
		"ID" => "bitrix:news",
		"PATH" => "/authors/index.php",
	),
	array(
		"CONDITION" => "#^/vypuski/#",
		"PATH" => "/vypuski.php",
	),
	array(
		"CONDITION" => "#^/en/work/#",
		"PATH" => "/work/index.php",
	),
	array(
		"CONDITION" => "#^/issues/#",
		"RULE" => "",
		"ID" => "bitrix:news",
		"PATH" => "/issues/index.php",
	),
	array(
		"CONDITION" => "#^/work/#",
		"RULE" => "",
		"ID" => "bitrix:news",
		"PATH" => "/work/index.php",
	),
);

?>