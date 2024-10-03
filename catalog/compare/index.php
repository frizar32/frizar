<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Таблица сравнения товаров");
?><?$APPLICATION->IncludeComponent(
	"bitrix:catalog.compare.result", 
	".default", 
	array(
		"ACTION_VARIABLE" => "action",
		"AJAX_MODE" => "N",
		"AJAX_OPTION_ADDITIONAL" => "",
		"AJAX_OPTION_HISTORY" => "N",
		"AJAX_OPTION_JUMP" => "N",
		"AJAX_OPTION_STYLE" => "Y",
		"BASKET_URL" => "/personal/basket.php",
		"COMPONENT_TEMPLATE" => ".default",
		"CONVERT_CURRENCY" => "Y",
		"DETAIL_URL" => "/catalog/#SECTION_CODE#/#ELEMENT_CODE#/",
		"DISPLAY_ELEMENT_SELECT_BOX" => "N",
		"ELEMENT_SORT_FIELD" => "sort",
		"ELEMENT_SORT_FIELD_BOX" => "name",
		"ELEMENT_SORT_FIELD_BOX2" => "id",
		"ELEMENT_SORT_ORDER" => "asc",
		"ELEMENT_SORT_ORDER_BOX" => "asc",
		"ELEMENT_SORT_ORDER_BOX2" => "desc",
		"FIELD_CODE" => array(
			0 => "NAME",
			1 => "DETAIL_PICTURE",
		),
		"HIDE_NOT_AVAILABLE" => "N",
		"IBLOCK_ID" => "17",
		"IBLOCK_TYPE" => "catalog",
		"NAME" => "CATALOG_COMPARE_LIST",
		"PRICE_CODE" => array(
			0 => "Продажи через сайт",
			1 => "Продажи через сайт РУБ",
			2 => "roznitsa",
		),
		"PRICE_VAT_INCLUDE" => "Y",
		"PRODUCT_ID_VARIABLE" => "id",
		"PROPERTY_CODE" => array(
			0 => "DIAMETR",
			1 => "CML2_ARTICLE",
			2 => "CML2_BASE_UNIT",
			3 => "CML2_MANUFACTURER",
			4 => "CML2_ATTRIBUTES",
			5 => "CML2_BAR_CODE",
			6 => "",
		),
		"SECTION_ID_VARIABLE" => "SECTION_ID",
		"SHOW_PRICE_COUNT" => "1",
		"TEMPLATE_THEME" => "site",
		"USE_PRICE_COUNT" => "N",
		"COMPOSITE_FRAME_MODE" => "A",
		"COMPOSITE_FRAME_TYPE" => "AUTO",
		"CURRENCY_ID" => "RUB"
	),
	false
);?><br><?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>