
<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
/*
$filter = Array("EMAIL" => "golovatovl@mail.ru"); //$arFields["EMAIL"]
$rsUser = CUser::GetList(($by="id"), ($order="desc"), $filter);
$arUser = $rsUser->Fetch();
if(isset($arUser['ID']))
{
	echo '<pre>';
	print_r($arUser);
	echo '</pre>';
}
		
$ID = 7616;
$res = CIBlockElement::GetByID(7616);
if($ar_res = $res->GetNext())
{
echo "<br>Товар с кодом ".$ID." имеет следующие параметры:<pre>";
print_r($ar_res);
echo "</pre>";	
}
$message = '
						Пользователь с данными: '.$arUser['NAME'].' '.$arUser['LAST_NAME'].'
						email: '.$arUser['EMAIL'].'
						телефон: '.$arUser['PERSONAL_PHONE'].'
						Подписался на уведомление о поступлении товара '.$tovar_link;
						echo $message;
						mail("dimas4@inbox.ru", "My Subject", $message, "From: shop.frizar.ru\r\n");*/?>

<?$APPLICATION->IncludeComponent(
	"alexkova.market:form.iblock", 
	".default", 
	array(
		"COMPOSITE_FRAME_MODE" => "A",
		"COMPOSITE_FRAME_TYPE" => "AUTO",
		"GROUPS" => array(
		),
		"IBLOCK_ID" => "20",
		"IBLOCK_TYPE" => "forms",
		"MAX_FILE_SIZE" => "0",
		"MODE" => "link",
		"NAME_FROM_PROPERTY" => "220",
		"PERSONAL_DATA" => "Y",
		"PERSONAL_DATA_CAPTION" => "",
		"PERSONAL_DATA_ERROR" => "Обработка вашей заявки без согласия на обработку персональных данных невозможна.",
		"PERSONAL_DATA_TEXT" => "Cогласен на обработку персональных данных в соответсвии с положением",
		"PERSONAL_DATA_URL" => "/privacy-policy/",
		"PROPERTY_CODES" => array(
			0 => "218",
			1 => "219",
			2 => "220",
			3 => "221",
		),
		"RESIZE_IMAGES" => "N",
		"STATUS_NEW" => "N",
		"USER_MESSAGE_ADD" => "Спасибо, в ближайшее время с Вами свяжутся",
		"USE_CAPTCHA" => "N",
		"COMPONENT_TEMPLATE" => ".default",
		"EVENT_CLASS" => "open-form-help",
		"BUTTON_TEXT" => "Помощь в выборе",
		"POPUP_TITLE" => "Заполните поля",
		"SEND_EVENT" => "KZNC_NEW_FORM_RESULT_HELP"
	),
	false
);?>

<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");
?>