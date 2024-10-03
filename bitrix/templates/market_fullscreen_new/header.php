<? IncludeTemplateLangFile(__FILE__); ?>
<?
if (!CModule::IncludeModule('alexkova.market')) return;
if (!CModule::IncludeModule('alexkova.bxready')) return;

use Alexkova\Market\Core;
use Alexkova\Bxready\Core as BXRCore;
use Alexkova\Bxready\Bxready;

global $templateType, $catalogType, $mainPageType, $arTopMenu, $arLeftMenu;

$arTopMenu = array(
	"TYPE" => "with_catalog",
	"TEMPLATE" => "version_v1",
	"FIXED_MENU" => "Y",
	"FULL_WIDTH" => "",
	"STYLE_MENU" => "colored_light",
	"TEMPLATE_MENU_HOVER" => "classic",
	"STYLE_MENU_HOVER" => "colored_light",
	"PICTURE_SECTION" => "N",
	"PICTURE_CATEGARIES" => "N",
	"HOVER_MENU_COL_LG" => "3",
	"HOVER_MENU_COL_MD" => "3",
	"SEARCH_FORM" => "N"
);

$arLeftMenu = array(
	"TYPE" => "with_catalog",
	"LEFT_MENU_TEMPLATE" => "left_hover",
	"STYLE_MENU" => "colored_light",
	"PICTURE_SECTION" => "N",
	"SUBMENU" => "ACTIVE_SHOW",
	"HOVER_TEMPLATE" => "classic",
	"STYLE_MENU_HOVER" => "colored_light",
	"PICTURE_SECTION_HOVER" => "N",
	"PICTURE_CATEGARIES" => "N",
	"HOVER_MENU_COL_LG" => "2",
	"HOVER_MENU_COL_MD" => "2"

);

$BXReady = \Alexkova\Market\Core::getInstance();
/******************default settings************************/
$BXReady->setAreaType('top_line_type', 'v21');
$BXReady->setAreaType('header_type', 'version_6');
$BXReady->setAreaType('top_menu_type', 'v1');
$BXReady->setAreaType('left_menu_type', 'v2');

$BXReady->setBannerSettings(array(
	"TOP" => "FIXED",
	"BOTTOM" => "FIXED",
	"CATALOG_TOP" => "RESPONSIVE",
	"CATALOG_BOTTOM" => "RESPONSIVE",
	"LEFT" => "RESPONSIVE",
));

if ($USER->IsAdmin()) $BXReady->getBitrixTopPanelMenu();

$mainPageType = "one_col";
//$mainPageType = "two_col";
$templateType = "two_col";
//$templateType = "one_col";
$catalogType = "two_col";

$CUR_PAGE = $APPLICATION->GetCurPage(false);
?>
<!DOCTYPE html>
<html>

<head>
	<?
	$title_part = "";
	if ($_GET["PAGEN_1"]) {
		$title_part = " | Страница № " . $_GET["PAGEN_1"] . " - Frizar";
	} else if ($CUR_PAGE !== '/') {
		$title_part = " - Frizar";
	}
	?>

	<title><? $APPLICATION->ShowTitle(); ?><?= $title_part ?></title>
	<noscript>
		<link href='https://fonts.googleapis.com/css?family=Open+Sans:300,300italic,400,400italic,700,700italic&subset=latin,cyrillic,cyrillic-ext' rel='stylesheet' type='text/css'>
	</noscript>
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
	<? if ($_GET["PAGEN_1"] > 1) { ?>
		<meta name="robots" content="noindex, follow">
	<?	} ?>
	<? $APPLICATION->ShowHead(); ?>

	<? $APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH . '/js/jquery-1.11.3.js'); ?>
	<? $APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH . '/js/script.js'); ?>

	<?
	$APPLICATION->SetAdditionalCSS("/bitrix/css/main/bootstrap.css");
	$APPLICATION->SetAdditionalCSS("/bitrix/css/main/font-awesome.css");
	$APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH . '/library/bootstrap/js/bootstrap.min.js');
	$APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH . '/js/jquery.inputmask.js');
	?>

	<?
	$APPLICATION->SetAdditionalCSS(SITE_TEMPLATE_PATH . '/library/bootstrap/css/grid10_column.css', true);
	$APPLICATION->SetAdditionalCSS(SITE_TEMPLATE_PATH . "/library/less/less.css", true);
	?>

	<? $APPLICATION->IncludeComponent(
		"bitrix:main.include",
		"named_area",
		array(
			"AREA_FILE_SHOW" => "file",
			"AREA_FILE_SUFFIX" => "inc",
			"EDIT_TEMPLATE" => "",
			"PATH" => SITE_DIR . "include/schema_og.php"
		),
		false
	); ?>

	<? if ($_GET["PAGEN_1"]): ?>
		<link rel="canonical" href="<?= $APPLICATION->GetCurPage(false); ?>"><? endif; ?>
	<!-- <meta name="yandex-verification" content="f79c3ced5b217cbb" /> -->
	<!-- <meta name="yandex-verification" content="14dc7b74ea7cc598" /> -->
	<meta name="google-site-verification" content="bELQc7IttulswFEktAFtvQTWpWp2_K_T1Wh8MJ7r8TY" />

</head>

<body>
	<div id="panel">
		<? $APPLICATION->ShowPanel(); ?>
	</div>

	<? $APPLICATION->IncludeComponent(
		"bitrix:main.include",
		"named_area",
		array(
			"AREA_FILE_SHOW" => "file",
			"AREA_FILE_SUFFIX" => "inc",
			"EDIT_TEMPLATE" => "",
			"PATH" => SITE_DIR . "include/schema.php"
		),
		false
	); ?>

	<?
	//    if ($GLOBALS["USER"]->GetId() == 2 || $GLOBALS["USER"]->GetId() == 6) {
	if ($GLOBALS["USER"]->isAdmin() && false) { ?>
		<? $APPLICATION->IncludeComponent(
			"bxr.demo:customize.panel",
			".default",
			array(),
			false
		); ?>
	<? } ?>

	<?

	$BXReady->showBannerPlace("TOP");
	?>

	<?
	// Headline and Small Basket Interface
	if ($BXReady->getArea('top_line_type')) {
		include($BXReady->getAreaPath('top_line_type'));
	};
	// end Headline
	?>

	<?
	// Header Basket Interface
	if ($BXReady->getArea('header_type')) {
		include($BXReady->getAreaPath('header_type'));
	};
	// end Headline
	?>

	<? $APPLICATION->IncludeComponent(
		"alexkova.market:buttonUp",
		".default",
		array(
			"COMPONENT_TEMPLATE" => ".default",
			"LOCATION_HORIZONTALLY" => "rigth",
			"BUTTON_UP_HORIZONTALLY_INDENT" => "15",
			"BUTTON_UP_VERTICAL_INDENT" => "15",
			"BUTTON_UP_TOP_SHOW" => "300",
			"BUTTON_UP_SPEED" => "5000"
		),
		false
	); ?>


	<?
	// TopMenu
	if (strlen($arTopMenu["TYPE"])) {
		switch ($arTopMenu["TYPE"]) {
			case "with_catalog":
				$BXReady->setAreaType('top_menu_type', 'v1');
				break;
			case "only_catalog":
				$BXReady->setAreaType('top_menu_type', 'v2');
				break;
		}
	}
	if ($BXReady->getArea('top_menu_type')) {
		include($BXReady->getAreaPath('top_menu_type'));
	};
	// end TopMenu
	?>

	<? if ($APPLICATION->GetCurPage(true) != SITE_DIR . 'index.php'): ?>
		<div class="container">
			<div class="row">
				<div class="col-lg-12">
					<? $APPLICATION->IncludeComponent(
						"bitrix:breadcrumb",
						"template1",
						array(
							"COMPONENT_TEMPLATE" => ".default",
							"PATH" => "",	// Путь, для которого будет построена навигационная цепочка (по умолчанию, текущий путь)
							"SITE_ID" => "-",	// Cайт (устанавливается в случае многосайтовой версии, когда DOCUMENT_ROOT у сайтов разный)
							"START_FROM" => "0",	// Номер пункта, начиная с которого будет построена навигационная цепочка
						),
						false
					); ?>


				</div>
			</div>
		</div>
	<? endif; ?>

	<? if ($APPLICATION->GetCurPage(true) == SITE_DIR . 'index.php' && $mainPageType != "two_col"): ?>
		<? $APPLICATION->IncludeComponent(
			"bitrix:main.include",
			"named_area",
			array(
				"AREA_FILE_SHOW" => "file",
				"AREA_FILE_SUFFIX" => "inc",
				"EDIT_TEMPLATE" => "",
				"PATH" => SITE_DIR . "include/main_page_promo_slider.php",
				"INCLUDE_PTITLE" => GetMessage("GHANGE_MAIN_PAGE_PROMO_SLIDER")
			),
			false
		); ?>
	<? endif; ?>

	<div class="container <? if ($mainPageType == "two_col" || $APPLICATION->GetCurPage(true) != SITE_DIR . 'index.php') echo "tb20"; ?>" id="content">
		<div class="row">
			<? if ($APPLICATION->GetCurPage(true) == SITE_DIR . 'index.php'): ?>
				<? if ($mainPageType == "two_col"): ?>
					<div class="col-lg-3 col-md-3 hidden-sm hidden-xs">
						<? $APPLICATION->IncludeComponent(
							"bitrix:main.include",
							"named_area",
							array(
								"AREA_FILE_SHOW" => "file",
								"AREA_FILE_SUFFIX" => "inc",
								"EDIT_TEMPLATE" => "",
								"PATH" => SITE_DIR . "include/main_page_left_column.php",
								"INCLUDE_PTITLE" => GetMessage("GHANGE_MAIN_PAGE_LEFT")
							),
							false
						); ?>
					</div>
					<div class="col-lg-9 col-md-9 col-sm-12 col-xs-12 pull-right">
						<? $APPLICATION->IncludeComponent(
							"bitrix:main.include",
							"named_area",
							array(
								"AREA_FILE_SHOW" => "file",
								"AREA_FILE_SUFFIX" => "inc",
								"EDIT_TEMPLATE" => "",
								"PATH" => SITE_DIR . "include/main_page_promo_column.php",
								"INCLUDE_PTITLE" => GetMessage("GHANGE_MAIN_PAGE_PROMO")
							),
							false
						); ?>
					<? else: ?>
						<div class="col-xs-12">
							<? $APPLICATION->IncludeComponent(
								"bitrix:main.include",
								"named_area",
								array(
									"AREA_FILE_SHOW" => "file",
									"AREA_FILE_SUFFIX" => "inc",
									"EDIT_TEMPLATE" => "",
									"PATH" => SITE_DIR . "include/main_page_promo.php",
									"INCLUDE_PTITLE" => GetMessage("GHANGE_MAIN_PAGE_PROMO")
								),
								false
							); ?>
						<? endif; ?>
					<? endif; ?>

					<? if ($APPLICATION->GetCurPage(false) !== "/" && $APPLICATION->GetCurDir(false) !== "/search/"): ?>

						<? if ($templateType == "one_col" || substr($APPLICATION->GetCurDir(), 0, (8 + strlen(SITE_DIR))) == SITE_DIR . 'catalog/' || CSite::InDir('/dokumentatsiya/')): ?>
							<div>
							<? else: ?>
								<div class="col-lg-3 col-md-3 hidden-sm hidden-xs">
									<? $APPLICATION->IncludeComponent(
										"bitrix:main.include",
										"named_area",
										array(
											"AREA_FILE_SHOW" => "sect",
											"AREA_FILE_SUFFIX" => "inc",
											"EDIT_TEMPLATE" => "",
											"PATH" => SITE_DIR . "include/page_left_column.php",
											"INCLUDE_PTITLE" => GetMessage("GHANGE_PAGE_LEFT")
										),
										false
									); ?>
								</div>
								<div class="col-lg-9 col-md-9 col-sm-12 col-xs-12 pull-right">
									<h1><? $APPLICATION->ShowTitle(false); ?></h1>
								<? endif; ?>
							<? endif; ?>