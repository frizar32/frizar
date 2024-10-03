<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Бренды");
?><?$APPLICATION->IncludeComponent(
	"alexkova.market:catalog", 
	"brands_new", 
	array(
		"ACTION_VARIABLE" => "action",
		"ADD_ELEMENT_CHAIN" => "N",
		"ADD_PICT_PROP" => "MORE_PHOTO",
		"ADD_PROPERTIES_TO_BASKET" => "Y",
		"ADD_SECTIONS_CHAIN" => "Y",
		"AJAX_MODE" => "N",
		"AJAX_OPTION_ADDITIONAL" => "",
		"AJAX_OPTION_HISTORY" => "N",
		"AJAX_OPTION_JUMP" => "N",
		"AJAX_OPTION_STYLE" => "Y",
		"ALSO_BUY_ELEMENT_COUNT" => "4",
		"ALSO_BUY_MIN_BUYES" => "1",
		"BASKET_URL" => "/personal/basket.php",
		"CACHE_FILTER" => "N",
		"CACHE_GROUPS" => "Y",
		"CACHE_TIME" => "3600",
		"CACHE_TYPE" => "A",
		"COMPARE_ELEMENT_SORT_FIELD" => "shows",
		"COMPARE_ELEMENT_SORT_ORDER" => "asc",
		"SHOW_LEFT_MENU" => "Y",
		"COMPARE_FIELD_CODE" => array(
			0 => "NAME",
			1 => "DETAIL_PICTURE",
			2 => "",
		),
		"COMPARE_NAME" => "CATALOG_COMPARE_LIST",
		"COMPARE_OFFERS_FIELD_CODE" => array(
			0 => "",
			1 => "",
		),
		"COMPARE_OFFERS_PROPERTY_CODE" => array(
			0 => "",
			1 => "",
		),
		"COMPARE_PROPERTY_CODE" => array(
			0 => "MATERIAL",
			1 => "COLOR",
			2 => "MECH_KOL",
			3 => "SUVENIR_NAZNACH",
			4 => "GLASS_OS",
			5 => "VELO_NAGRUZKA",
			6 => "PAL_TYPE",
			7 => "VELO_TYPE",
			8 => "PLATFORM",
			9 => "COMPLECT",
			10 => "ARB_TIME",
			11 => "CAMERA_TYPE",
			12 => "GLASS_TYPE",
			13 => "MANUFACTURER",
			14 => "DISPLAY_TYPE",
			15 => "ENERGY_TYPE",
			16 => "MATRIX_TYPE",
			17 => "CAMERA_POSITION",
			18 => "GLASS_CPU",
			19 => "DIAGONAL",
			20 => "ARB_CHANNEL",
			21 => "VOLUME",
			22 => "PX_SUMM",
			23 => "MATRIX",
			24 => "GLASS_ALL",
			25 => "MINIMUM_PRICE",
			26 => "OBJOM_VSTROENNOY_PAMYATI",
			27 => "SIZE_ACCUMUL",
			28 => "FORM_FACTOR",
			29 => "DYSPLAY_CAM",
			30 => "VIDEO_RESIZED",
			31 => "SUMM_SIM",
			32 => "MAXIMUM_PRICE",
			33 => "CHASTOTA",
			34 => "PERSONAL_SIZE",
			35 => "FORMAT_SIM",
			36 => "IMPEDANS",
			37 => "",
		),
		"COMPARE_SCROLL_UP" => "Y",
		"COMPONENT_TEMPLATE" => "brands",
		"CONVERT_CURRENCY" => "N",
		"DETAIL_ADD_DETAIL_TO_SLIDER" => "Y",
		"DETAIL_BLOG_URL" => "catalog_comments",
		"DETAIL_BLOG_USE" => "Y",
		"DETAIL_BRAND_PROP_CODE" => array(
			0 => "MANUFACTURER",
			1 => "",
		),
		"DETAIL_BRAND_USE" => "Y",
		"DETAIL_BROWSER_TITLE" => "-",
		"DETAIL_CHECK_SECTION_ID_VARIABLE" => "N",
		"DETAIL_DETAIL_PICTURE_MODE" => "IMG",
		"DETAIL_DISPLAY_NAME" => "Y",
		"DETAIL_DISPLAY_PREVIEW_TEXT_MODE" => "H",
		"DETAIL_FB_USE" => "N",
		"DETAIL_META_DESCRIPTION" => "-",
		"DETAIL_META_KEYWORDS" => "-",
		"DETAIL_OFFERS_FIELD_CODE" => array(
			0 => "NAME",
			1 => "",
		),
		"DETAIL_OFFERS_PROPERTY_CODE" => array(
			0 => "SILENT",
			1 => "SIZE",
			2 => "COLOR",
			3 => "",
		),
		"DETAIL_PROPERTY_CODE" => array(
			0 => "METAL_DETECTOR",
			1 => "INSULATION",
			2 => "MATERIAL",
			3 => "COLOR",
			4 => "MECH_KOL",
			5 => "SUVENIR_NAZNACH",
			6 => "GLASS_OS",
			7 => "VELO_NAGRUZKA",
			8 => "PAL_TYPE",
			9 => "VELO_TYPE",
			10 => "PLATFORM",
			11 => "COMPLECT",
			12 => "ARB_TIME",
			13 => "CAMERA_TYPE",
			14 => "GLASS_TYPE",
			15 => "MANUFACTURER",
			16 => "DISPLAY_TYPE",
			17 => "ENERGY_TYPE",
			18 => "MATRIX_TYPE",
			19 => "CAMERA_POSITION",
			20 => "GLASS_CPU",
			21 => "DIAGONAL",
			22 => "ARB_CHANNEL",
			23 => "VOLUME",
			24 => "PX_SUMM",
			25 => "MATRIX",
			26 => "GLASS_ALL",
			27 => "OBJOM_VSTROENNOY_PAMYATI",
			28 => "SIZE_ACCUMUL",
			29 => "FORM_FACTOR",
			30 => "DYSPLAY_CAM",
			31 => "VIDEO_RESIZED",
			32 => "SUMM_SIM",
			33 => "CHASTOTA",
			34 => "PERSONAL_SIZE",
			35 => "FORMAT_SIM",
			36 => "IMPEDANS",
			37 => "CML2_ATTRIBUTES",
			38 => "",
		),
		"DETAIL_SHOW_MAX_QUANTITY" => "Y",
		"DETAIL_USE_COMMENTS" => "Y",
		"DETAIL_USE_VOTE_RATING" => "Y",
		"DETAIL_VK_API_ID" => "API_ID",
		"DETAIL_VK_USE" => "N",
		"DETAIL_VOTE_DISPLAY_AS_RATING" => "rating",
		"DISPLAY_BOTTOM_PAGER" => "Y",
		"DISPLAY_ELEMENT_SELECT_BOX" => "N",
		"DISPLAY_TOP_PAGER" => "N",
		"ELEMENT_SORT_FIELD" => "shows",
		"ELEMENT_SORT_FIELD2" => "shows",
		"ELEMENT_SORT_ORDER" => "asc",
		"ELEMENT_SORT_ORDER2" => "asc",
		"FILTER_FIELD_CODE" => array(
			0 => "",
			1 => "",
		),
		"FILTER_NAME" => "",
		"FILTER_OFFERS_FIELD_CODE" => array(
			0 => "",
			1 => "",
		),
		"FILTER_OFFERS_PROPERTY_CODE" => array(
			0 => "",
			1 => "",
		),
		"FILTER_PRICE_CODE" => array(
		),
		"FILTER_PROPERTY_CODE" => array(
			0 => "",
			1 => "WIDTH",
			2 => "LENGHT",
			3 => "HEIGHT",
			4 => "",
		),
		"FILTER_VIEW_MODE" => "VERTICAL",
		"FORUM_ID" => "",
		"GROUP_PRICE_COUNT" => "count",
		"HIDE_NOT_AVAILABLE" => "Y",
		"HIDE_OFFERS_LIST" => "N",
		"IBLOCK_ID" => "12",
		"IBLOCK_TYPE" => "catalog",
		"INCLUDE_SUBSECTIONS" => "Y",
		"LABEL_PROP" => "-",
		"LINE_ELEMENT_COUNT" => "3",
		"LINK_ELEMENTS_URL" => "link.php?PARENT_ELEMENT_ID=#ELEMENT_ID#",
		"LINK_IBLOCK_ID" => "13",
		"LINK_IBLOCK_TYPE" => "content",
		"LINK_PROPERTY_SID" => "ACCESSORIES",
		"LIST_BROWSER_TITLE" => "-",
		"LIST_META_DESCRIPTION" => "-",
		"LIST_META_KEYWORDS" => "-",
		"LIST_OFFERS_FIELD_CODE" => array(
			0 => "NAME",
			1 => "",
		),
		"LIST_OFFERS_LIMIT" => "5",
		"LIST_OFFERS_PROPERTY_CODE" => array(
			0 => "SILENT",
			1 => "SIZE",
			2 => "COLOR",
			3 => "",
		),
		"LIST_PROPERTY_CODE" => array(
			0 => "METAL_DETECTOR",
			1 => "INSULATION",
			2 => "SUVENIR_NAZNACH",
			3 => "WIDTH",
			4 => "LENGHT",
			5 => "SIZE",
			6 => "HEIGHT",
			7 => "RECOMMEND",
			8 => "",
		),
		"MAIN_TITLE" => "Наличие на складах",
		"MESSAGES_PER_PAGE" => "10",
		"MESS_BTN_ADD_TO_BASKET" => "В корзину",
		"MESS_BTN_BUY" => "Купить",
		"MESS_BTN_COMPARE" => "Сравнение",
		"MESS_BTN_DETAIL" => "Подробнее",
		"MESS_NOT_AVAILABLE" => "Нет в наличии",
		"MIN_AMOUNT" => "10",
		"OFFERS_CART_PROPERTIES" => array(
			0 => "SIZE",
			1 => "COLOR",
		),
		"OFFERS_SORT_FIELD" => "shows",
		"OFFERS_SORT_FIELD2" => "shows",
		"OFFERS_SORT_ORDER" => "asc",
		"OFFERS_SORT_ORDER2" => "asc",
		"OFFERS_VIEW" => "CHOISE",
		"OFFER_ADD_PICT_PROP" => "-",
		"OFFER_PRICE_SHOW_FROM" => "Y",
		"OFFER_TREE_PROPS" => array(
			0 => "COLOR",
			1 => "SIZE",
		),
		"PAGER_DESC_NUMBERING" => "N",
		"PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
		"PAGER_SHOW_ALL" => "N",
		"PAGER_SHOW_ALWAYS" => "N",
		"PAGER_TEMPLATE" => ".default",
		"PAGER_TITLE" => "Товары",
		"PAGE_ELEMENT_COUNT" => "12",
		"PARTIAL_PRODUCT_PROPERTIES" => "N",
		"PATH_TO_SMILE" => "/bitrix/images/forum/smile/",
		"PRICE_CODE" => array(
			0 => "BASE",
		),
		"PRICE_VAT_INCLUDE" => "Y",
		"PRICE_VAT_SHOW_VALUE" => "N",
		"PRODUCT_DISPLAY_MODE" => "Y",
		"PRODUCT_ID_VARIABLE" => "id",
		"PRODUCT_PROPERTIES" => array(
		),
		"PRODUCT_PROPS_VARIABLE" => "prop",
		"PRODUCT_QUANTITY_VARIABLE" => "quantity",
		"REVIEW_AJAX_POST" => "N",
		"SECTIONS_SHOW_PARENT_NAME" => "Y",
		"SECTIONS_VIEW_MODE" => "LIST",
		"SECTION_COUNT_ELEMENTS" => "Y",
		"SECTION_ID_VARIABLE" => "SECTION_CODE",
		"SECTION_TOP_DEPTH" => "2",
		"SEF_FOLDER" => "/brands/",
		"SEF_MODE" => "Y",
		"SET_STATUS_404" => "N",
		"SET_TITLE" => "Y",
		"SHOW_CATALOG_QUANTITY" => "Y",
		"SHOW_CATALOG_QUANTITY_CNT" => "Y",
		"SHOW_DESCRIPTION_AFTER_SECTION" => "Y",
		"SHOW_DISCOUNT_PERCENT" => "Y",
		"SHOW_LEFT_CATALOG_MENU" => "Y",
		"SHOW_LINK_TO_FORUM" => "N",
		"SHOW_OLD_PRICE" => "Y",
		"SHOW_PRICE_COUNT" => "0",
		"SHOW_PRICE_NAME" => "Y",
		"SHOW_TOP_ELEMENTS" => "Y",
		"STORE_PATH" => "/company/#store_id#/",
		"TEMPLATE_THEME" => "site",
		"TOP_ELEMENT_COUNT" => "2",
		"TOP_ELEMENT_SORT_FIELD" => "shows",
		"TOP_ELEMENT_SORT_FIELD2" => "shows",
		"TOP_ELEMENT_SORT_ORDER" => "asc",
		"TOP_ELEMENT_SORT_ORDER2" => "asc",
		"TOP_LINE_ELEMENT_COUNT" => "3",
		"TOP_OFFERS_FIELD_CODE" => array(
			0 => "",
			1 => "",
		),
		"TOP_OFFERS_LIMIT" => "5",
		"TOP_OFFERS_PROPERTY_CODE" => array(
			0 => "",
			1 => "",
		),
		"TOP_PROPERTY_CODE" => array(
			0 => "",
			1 => "",
		),
		"TOP_ROTATE_TIMER" => "30",
		"TOP_VIEW_MODE" => "BANNER",
		"URL_TEMPLATES_READ" => "",
		"USE_ALSO_BUY" => "Y",
		"USE_CAPTCHA" => "Y",
		"USE_COMPARE" => "Y",
		"USE_ELEMENT_COUNTER" => "Y",
		"USE_FILTER" => "Y",
		"USE_MIN_AMOUNT" => "N",
		"USE_PRICE_COUNT" => "N",
		"USE_PRODUCT_QUANTITY" => "Y",
		"USE_REVIEW" => "Y",
		"USE_STORE" => "Y",
		"USE_STORE_PHONE" => "Y",
		"USE_STORE_SCHEDULE" => "Y",
		"ZOOM_ON" => "Y",
		"QTY_SHOW_TYPE" => "NUM",
		"IN_STOCK" => "В наличии",
		"NOT_IN_STOCK" => "Нет в наличии",
		"QTY_MANY_GOODS_INT" => "3",
		"QTY_MANY_GOODS_TEXT" => "много",
		"QTY_LESS_GOODS_TEXT" => "мало",
		"COMMON_SHOW_CLOSE_POPUP" => "N",
		"DETAIL_BLOG_EMAIL_NOTIFY" => "N",
		"SIDEBAR_SECTION_SHOW" => "Y",
		"SIDEBAR_DETAIL_SHOW" => "Y",
		"SIDEBAR_PATH" => "",
		"USE_MAIN_ELEMENT_SECTION" => "N",
		"SET_LAST_MODIFIED" => "N",
		"USE_SALE_BESTSELLERS" => "Y",
		"COMPARE_POSITION_FIXED" => "Y",
		"COMPARE_POSITION" => "top left",
		"USE_COMMON_SETTINGS_BASKET_POPUP" => "N",
		"COMMON_ADD_TO_BASKET_ACTION" => "",
		"TOP_ADD_TO_BASKET_ACTION" => "BUY",
		"SECTION_ADD_TO_BASKET_ACTION" => "BUY",
		"DETAIL_ADD_TO_BASKET_ACTION" => array(
		),
		"DETAIL_SHOW_BASIS_PRICE" => "Y",
		"SECTION_BACKGROUND_IMAGE" => "-",
		"DETAIL_SET_CANONICAL_URL" => "N",
		"DETAIL_BACKGROUND_IMAGE" => "-",
		"SHOW_DEACTIVATED" => "N",
		"USE_BIG_DATA" => "Y",
		"BIG_DATA_RCM_TYPE" => "bestsell",
		"PAGER_BASE_LINK_ENABLE" => "N",
		"SHOW_404" => "N",
		"MESSAGE_404" => "",
		"PREVIEW_DETAIL_PROPERTY_CODE" => array(
			0 => "COLOR",
			1 => "CML2_ATTRIBUTES",
			2 => "",
		),
		"SHOW_LEFT_MENU_SETTINGS" => "Y",
		"STORES" => array(
			0 => "1",
			1 => "2",
		),
		"USER_FIELDS" => array(
			0 => "",
			1 => "",
		),
		"FIELDS" => array(
			0 => "",
			1 => "",
		),
		"SHOW_EMPTY_STORE" => "Y",
		"SHOW_GENERAL_STORE_INFORMATION" => "Y",
		"ROOT_MENU_TYPE" => "left",
		"MAX_LEVEL" => "1",
		"CHILD_MENU_TYPE" => "left",
		"USE_EXT" => "Y",
		"DELAY" => "N",
		"LEFT_MENU_TEMPLATE" => "left",
		"TITLE_MENU" => "Каталог",
		"STYLE_MENU" => "colored_light",
		"PICTURE_SECTION" => "N",
		"SUBMENU" => "ACTIVE_SHOW",
		"STYLE_MENU_HOVER" => "colored_light",
		"HANDLERS" => array(
			0 => "lj",
			1 => "twitter",
			2 => "vk",
			3 => "facebook",
			4 => "mailru",
			5 => "delicious",
		),
		"SHORTEN_URL_LOGIN" => "",
		"SHORTEN_URL_KEY" => "",
		"ALSO_BUY_TITLE" => "С этим товаром покупают",
		"TOP_TITLE" => "Лидеры продаж",
		"BESTSALLERS_TITLE" => "Лидеры продаж",
		"BESTSALLERS_CNT" => "4",
		"BIG_DATA_TITLE" => "Персональные рекомендации",
		"BIG_DATA_CNT" => "4",
		"VIEWED_PRODUCTS_BLOCK_TITLE" => "Просмотренные товары",
		"VIEWED_PRODUCTS_CNT" => "3",
		"BESTSALLERS_WERE_SHOW" => "bottom",
		"VIEWED_PRODUCTS_SHOW" => "Y",
		"VIEWED_PRODUCTS_WERE_SHOW" => "left",
		"BESTSALLERS_SORT" => "200",
		"VIEWED_PRODUCTS_SORT" => "100",
		"SHOW_SECTION_DESC" => "top",
		"SKU_PROPS_SHOW_TYPE" => "rounded",
		"SEF_URL_TEMPLATES" => array(
			"sections" => "",
			"section" => "#SECTION_CODE#/",
			"element" => "/catalog/#SECTION_CODE#/#ELEMENT_CODE#/",
			"compare" => "compare.php?action=#ACTION_CODE#",
			"smart_filter" => "#BRAND_CODE#/",
		),
		"VARIABLE_ALIASES" => array(
			"compare" => array(
				"ACTION_CODE" => "action",
			),
		)
	),
	false
);?><?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>