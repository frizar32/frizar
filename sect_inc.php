<?use Alexkova\Market\Core;

$BXReady = \Alexkova\Market\Core::getInstance();
?>

<?
// LeftMenu
global $arLeftMenu;
if (strlen($arLeftMenu["TYPE"])) {
	switch ($arLeftMenu["TYPE"]) {
		case "with_catalog": $BXReady->setAreaType('left_menu_type', 'v3'); break;
		case "only_catalog": $BXReady->setAreaType('left_menu_type', 'v2'); break;
		case "without_catalog": $BXReady->setAreaType('left_menu_type', 'v1'); break;
	}
}
if ($BXReady->getArea('left_menu_type')){
	include($BXReady->getAreaPath('left_menu_type'));
};


// end LeftMenu



?>

<?if (CModule::IncludeModule('sender')):?>
<?/*$APPLICATION->IncludeComponent(
	"alexkova.market:sender.subscribe", 
	"market_column", 
	array(
		"AJAX_MODE" => "N",
		"AJAX_OPTION_ADDITIONAL" => "",
		"AJAX_OPTION_HISTORY" => "N",
		"AJAX_OPTION_JUMP" => "N",
		"AJAX_OPTION_STYLE" => "Y",
		"CACHE_TIME" => "3600",
		"CACHE_TYPE" => "A",
		"COMPONENT_TEMPLATE" => "market_column",
		"CONFIRMATION" => "Y",
		"PAGE" => "/personal/subscribe/subscr_edit.php",
		"SET_TITLE" => "N",
		"SHOW_HIDDEN" => "N",
		"SHOW_RUBRICS" => "Y",
		"USE_PERSONALIZATION" => "Y",
		"HIDE_MAILINGS" => "N",
		"USER_CONSENT" => "N",
		"USER_CONSENT_ID" => "0",
		"USER_CONSENT_IS_CHECKED" => "Y",
		"USER_CONSENT_IS_LOADED" => "N",
		"COMPOSITE_FRAME_MODE" => "A",
		"COMPOSITE_FRAME_TYPE" => "AUTO"
	),
	false,
	array(
		"ACTIVE_COMPONENT" => "Y"
	)
);
*/
?>
<?$APPLICATION->IncludeComponent(
	"bitrix:subscribe.form", 
	"market_column", 
	array(
		"USE_PERSONALIZATION" => "Y",
		"PAGE" => "#SITE_DIR#personal/subscribe/subscr_edit.php",
		"SHOW_HIDDEN" => "N",
		"CACHE_TYPE" => "A",
		"CACHE_TIME" => "3600",
		"COMPONENT_TEMPLATE" => "market_column",
		"ALLOW_ANONYMOUS" => "Y",
		"COMPOSITE_FRAME_MODE" => "A",
		"COMPOSITE_FRAME_TYPE" => "AUTO",
		"SHOW_RUBRICS" => "N"
	),
	false
);?>
<?endif;?>
<?Alexkova\Market\Core::getInstance()->showBannerPlace("LEFT");?>