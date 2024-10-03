<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Заказы");
?>

<?
$arMinOrderPrice = $APPLICATION->IncludeComponent(
    "alexkova.market:order.min.price", 
    ".default", 
    array(),
    false 
);
?>
<?if ($arMinOrderPrice["ADD_PRICE"] <= 0 || $_REQUEST["ORDER_ID"]) {?>
    <?$APPLICATION->IncludeComponent("bitrix:sale.order.ajax", ".default", Array(
	"PAY_FROM_ACCOUNT" => "Y",	// Разрешить оплату с внутреннего счета
		"COUNT_DELIVERY_TAX" => "N",
		"COUNT_DISCOUNT_4_ALL_QUANTITY" => "N",
		"ONLY_FULL_PAY_FROM_ACCOUNT" => "N",	// Разрешить оплату с внутреннего счета только в полном объеме
		"ALLOW_AUTO_REGISTER" => "Y",	// Оформлять заказ с автоматической регистрацией пользователя
		"SEND_NEW_USER_NOTIFY" => "Y",	// Отправлять пользователю письмо, что он зарегистрирован на сайте
		"DELIVERY_NO_AJAX" => "N",	// Когда рассчитывать доставки с внешними системами расчета
		"TEMPLATE_LOCATION" => "popup",	// Визуальный вид контрола выбора местоположений
		"PROP_1" => "",
		"PATH_TO_BASKET" => SITE_DIR."personal/basket/",	// Путь к странице корзины
		"PATH_TO_PERSONAL" => SITE_DIR."personal/order/",	// Путь к странице персонального раздела
		"PATH_TO_PAYMENT" => SITE_DIR."personal/order/payment/",	// Страница подключения платежной системы
		"PATH_TO_ORDER" => SITE_DIR."personal/order/make/",
		"SET_TITLE" => "Y",	// Устанавливать заголовок страницы
		"DELIVERY2PAY_SYSTEM" => "",
		"SHOW_ACCOUNT_NUMBER" => "Y",
		"DELIVERY_NO_SESSION" => "Y",	// Проверять сессию при оформлении заказа
		"COMPONENT_TEMPLATE" => ".default",
		"DELIVERY_TO_PAYSYSTEM" => "d2p",	// Последовательность оформления
		"USE_PREPAYMENT" => "N",	// Использовать предавторизацию для оформления заказа (PayPal Express Checkout)
		"ALLOW_NEW_PROFILE" => "Y",	// Разрешить множество профилей покупателей
		"SHOW_PAYMENT_SERVICES_NAMES" => "Y",
		"SHOW_STORES_IMAGES" => "N",	// Показывать изображения складов в окне выбора пункта выдачи
		"PATH_TO_AUTH" => SITE_DIR."auth/",	// Путь к странице авторизации
		"DISABLE_BASKET_REDIRECT" => "N",	// Оставаться на странице оформления заказа, если список товаров пуст
		"PRODUCT_COLUMNS" => "",
			"USE_YM_GOALS" => "Y",
			"YM_GOALS_COUNTER" => "49057298",
			"YM_GOALS_SAVE_ORDER" => "order_done"
	),
	false
);?>
<?}?>    
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>