<?
$arUrlRewrite = array(
	array(
		"CONDITION" => "#^/publtype/([a-zA-Z0-9\\.\\-_]+)/?.*#",
		"RULE" => "ELEMENT_CODE=$1",
		"ID" => "bitrix:news.detail",
		"PATH" => "/publtype/detail.php",
	),
	array(
		"CONDITION" => "#^/journals/([a-zA-Z0-9\\.\\-_]+)/?.*#",
		"RULE" => "ELEMENT_CODE=$1",
		"ID" => "bitrix:news.detail",
		"PATH" => "/journals/detail.php",
	),
	array(
		"CONDITION" => "#^/position/([a-zA-Z0-9\\.\\-_]+)/?.*#",
		"RULE" => "ELEMENT_CODE=$1",
		"ID" => "bitrix:news.detail",
		"PATH" => "/position/detail.php",
	),
	array(
		"CONDITION" => "#^/degree/([a-zA-Z0-9\\.\\-_]+)/?.*#",
		"RULE" => "ELEMENT_CODE=$1",
		"ID" => "bitrix:news.detail",
		"PATH" => "/degree/detail.php",
	),
	array(
		"CONDITION" => "#^/publications/#",
		"RULE" => "",
		"ID" => "bitrix:news",
		"PATH" => "/publikatsii.php",
	),
	array(
		"CONDITION" => "#^/scientist/#",
		"RULE" => "",
		"ID" => "bitrix:news",
		"PATH" => "/kandidat-fiziko-matematicheskikh-nauk.php",
	),
	array(
		"CONDITION" => "#^/scientist/#",
		"RULE" => "",
		"ID" => "bitrix:news",
		"PATH" => "/scientist/index.php",
	),
	array(
		"CONDITION" => "#^/POSITION/#",
		"RULE" => "",
		"ID" => "bitrix:news",
		"PATH" => "/dolzhnost.php",
	),
	array(
		"CONDITION" => "#^/products/#",
		"RULE" => "",
		"ID" => "bitrix:catalog",
		"PATH" => "/products/index.php",
	),
	array(
		"CONDITION" => "#^/services/#",
		"RULE" => "",
		"ID" => "bitrix:catalog",
		"PATH" => "/services/index.php",
	),
	array(
		"CONDITION" => "#^/DEGREE/#",
		"RULE" => "",
		"ID" => "bitrix:news",
		"PATH" => "/uchenaya-stepen.php",
	),
	array(
		"CONDITION" => "#^/news/#",
		"RULE" => "",
		"ID" => "bitrix:news",
		"PATH" => "/news/index.php",
	),
);

?>