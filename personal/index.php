<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Личный кабинет");
?><?$APPLICATION->IncludeComponent(
	"bitrix:sale.personal.section",
	"bxr-market",
	Array(
		"ACCOUNT_PAYMENT_ELIMINATED_PAY_SYSTEMS" => array("0"),
		"ACCOUNT_PAYMENT_PERSON_TYPE" => "1",
		"ACCOUNT_PAYMENT_SELL_SHOW_FIXED_VALUES" => "Y",
		"ACCOUNT_PAYMENT_SELL_TOTAL" => array("100","200","500","1000","5000",""),
		"ACCOUNT_PAYMENT_SELL_USER_INPUT" => "Y",
		"ACTIVE_DATE_FORMAT" => "d.m.Y",
		"CACHE_GROUPS" => "Y",
		"CACHE_TIME" => "3600",
		"CACHE_TYPE" => "A",
		"CHECK_RIGHTS_PRIVATE" => "N",
		"COMPATIBLE_LOCATION_MODE_PROFILE" => "N",
		"CUSTOM_PAGES" => "",
		"CUSTOM_SELECT_PROPS" => array(""),
		"NAV_TEMPLATE" => "",
		"ORDER_HISTORIC_STATUSES" => array("F"),
		"PATH_TO_BASKET" => "/personal/basket",
		"PATH_TO_CATALOG" => "/catalog/",
		"PATH_TO_CONTACT" => "/company/contacts",
		"PATH_TO_PAYMENT" => "/personal/order/payment",
		"PER_PAGE" => "20",
		"PROP_1" => array(),
		"PROP_2" => array(),
		"SAVE_IN_SESSION" => "Y",
		"SEF_FOLDER" => "/personal/",
		"SEF_MODE" => "Y",
		"SEF_URL_TEMPLATES" => array(
			"account"=>"account/",
			"index"=>"index.php",
			"order_cancel"=>"cancel/#ID#",
			"order_detail"=>"orders/#ID#",
			"orders"=>"orders/",
			"private"=>"profile/",
			"profile"=>"profiles/",
			"profile_detail"=>"profiles/#ID#",
			"subscribe"=>"subscribe/"
		),
		"SEND_INFO_PRIVATE" => "N",
		"SET_TITLE" => "Y",
		"SHOW_ACCOUNT_COMPONENT" => "Y",
		"SHOW_ACCOUNT_PAGE" => "Y",
		"SHOW_ACCOUNT_PAY_COMPONENT" => "Y",
		"SHOW_BASKET_PAGE" => "Y",
		"SHOW_CONTACT_PAGE" => "Y",
		"SHOW_ORDER_PAGE" => "Y",
		"SHOW_PRIVATE_PAGE" => "Y",
		"SHOW_PROFILE_PAGE" => "Y",
		"SHOW_SUBSCRIBE_PAGE" => "Y",
		"USER_PROPERTY_PRIVATE" => array(),
		"USE_AJAX_LOCATIONS_PROFILE" => "N"
	)
);?><br>
	<br><?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>