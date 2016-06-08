<?
$arUrlRewrite = array(
	array(
		"CONDITION" => "#^/en/authors/([a-zA-Z0-9\\.\\-_]+)/?.*#",
		"RULE" => "ELEMENT_CODE=\$1",
		"ID" => "bitrix:news.detail",
		"PATH" => "/authors/detail.php",
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
		"CONDITION" => "#^/en/articles/([a-zA-Z0-9\\.\\-_]+)/?.*#",
		"RULE" => "ELEMENT_CODE=\$1",
		"ID" => "bitrix:news.detail",
		"PATH" => "/en/articles/detail.php",
	),
	array(
		"CONDITION" => "#^/authors/([a-zA-Z0-9\\.\\-_]+)/?.*#",
		"RULE" => "ELEMENT_CODE=\$1",
		"ID" => "bitrix:news.detail",
		"PATH" => "/authors/detail.php",
	),
	array(
		"CONDITION" => "#^/en/authors/([a-zA-Z0-9\\.\\-_]+)/?.*#",
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
		"CONDITION" => "#^/en/redkollegiya/#",
		"PATH" => "/en/redkollegiya.php",
	),
	array(
		"CONDITION" => "#^/en/dlya-avtorov/#",
		"PATH" => "/en/dlya-avtorov.php",
	),
	array(
		"CONDITION" => "#^/en/vypuski/#",
		"PATH" => "/en/vypuski.php",
	),
	array(
		"CONDITION" => "#^/en/work/#",
		"PATH" => "/work/index.php",
	),
	array(
		"CONDITION" => "#^/en/authors/#",
		"PATH" => "/authors/index.php",
	),
);

?>