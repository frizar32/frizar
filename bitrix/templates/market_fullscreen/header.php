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
$BXReady->setAreaType('top_line_type', 'v31');
$BXReady->setAreaType('header_type', 'version_1');
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
//echo $_SERVER['DOCUMENT_ROOT'];
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

	<title>
		<? $APPLICATION->ShowTitle(); ?><?= $title_part ?></title>

	<link href="https://fonts.googleapis.com/css2?family=Nunito+Sans:ital,opsz,wght@0,6..12,200..1000;1,6..12,200..1000&display=swap" rel="stylesheet">

	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
	<? if ($_GET["PAGEN_1"] > 1) { ?>
		<meta name="robots" content="index, follow">
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
	<meta name="yandex-verification" content="a65214afc7affdff" />
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


	<? if ($APPLICATION->GetCurPage(true) == SITE_DIR . 'index.php' /*&& $mainPageType != "two_col"*/): ?>

		<div class="container">
			<div class="row">
				<div class="main-area">

					<div class="main-aside-area">
						<? $APPLICATION->IncludeComponent(
							"bitrix:catalog.section.list",
							"menu-icons",
							array(
								"ADD_SECTIONS_CHAIN" => "N",	// Включать раздел в цепочку навигации
								"CACHE_GROUPS" => "Y",	// Учитывать права доступа
								"CACHE_TIME" => "36000000",	// Время кеширования (сек.)
								"CACHE_TYPE" => "A",	// Тип кеширования
								"COUNT_ELEMENTS" => "Y",	// Показывать количество элементов в разделе
								"FILTER_NAME" => "arrFilter",	// Имя массива со значениями фильтра разделов
								"IBLOCK_ID" => "17",	// Инфоблок
								"IBLOCK_TYPE" => "catalog",	// Тип инфоблока
								"SECTION_CODE" => "",	// Код раздела
								"SECTION_FIELDS" => array(	// Поля разделов
									0 => "",
									1 => "",
								),
								"SECTION_ID" => "",	// ID раздела
								"SECTION_URL" => "",	// URL, ведущий на страницу с содержимым раздела
								"SECTION_USER_FIELDS" => array(	// Свойства разделов
									0 => "UF_SVG",
									1 => "",
								),
								"SHOW_PARENT_NAME" => "Y",	// Показывать название раздела
								"TOP_DEPTH" => "2",	// Максимальная отображаемая глубина разделов
								"VIEW_MODE" => "LINE",	// Вид списка подразделов
								"COMPONENT_TEMPLATE" => ".default",
								"COUNT_ELEMENTS_FILTER" => "CNT_ACTIVE",	// Показывать количество
								"ADDITIONAL_COUNT_ELEMENTS_FILTER" => "additionalCountFilter",	// Дополнительный фильтр для подсчета количества элементов в разделе
								"HIDE_SECTIONS_WITH_ZERO_COUNT_ELEMENTS" => "N",	// Скрывать разделы с нулевым количеством элементов
								"CACHE_FILTER" => "N",	// Кешировать при установленном фильтре
								"COMPOSITE_FRAME_MODE" => "A",	// Голосование шаблона компонента по умолчанию
								"COMPOSITE_FRAME_TYPE" => "AUTO",	// Содержимое компонента
							),
							false
						); ?>
					</div>
					<div class="main-main-area">
						<?
						$BXReady->setAreaType('top_menu_type', 'v1');
						if ($BXReady->getArea('top_menu_type')) {
							include($BXReady->getAreaPath('top_menu_type'));
						};
						?>
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
					</div>
				</div>
			</div>
		</div>

		<div class="container">
			<div class="row">
				<? $APPLICATION->IncludeComponent(
					"bitrix:news.list",
					"main_delivery_block",
					array(
						"ACTIVE_DATE_FORMAT" => "d.m.Y",
						"ADD_SECTIONS_CHAIN" => "N",
						"AJAX_MODE" => "N",
						"AJAX_OPTION_ADDITIONAL" => "",
						"AJAX_OPTION_HISTORY" => "N",
						"AJAX_OPTION_JUMP" => "N",
						"AJAX_OPTION_STYLE" => "N",
						"CACHE_FILTER" => "N",
						"CACHE_GROUPS" => "N",
						"CACHE_TIME" => "36000000",
						"CACHE_TYPE" => "A",
						"CHECK_DATES" => "Y",
						"COMPOSITE_FRAME_MODE" => "A",
						"COMPOSITE_FRAME_TYPE" => "AUTO",
						"DETAIL_URL" => "",
						"DISPLAY_BOTTOM_PAGER" => "N",
						"DISPLAY_DATE" => "N",
						"DISPLAY_NAME" => "Y",
						"DISPLAY_PICTURE" => "N",
						"DISPLAY_PREVIEW_TEXT" => "N",
						"DISPLAY_TOP_PAGER" => "N",
						"FIELD_CODE" => array(
							0 => "",
							1 => "",
						),
						"FILTER_NAME" => "",
						"HIDE_LINK_WHEN_NO_DETAIL" => "N",
						"IBLOCK_ID" => "26",
						"IBLOCK_TYPE" => "content",
						"INCLUDE_IBLOCK_INTO_CHAIN" => "N",
						"INCLUDE_SUBSECTIONS" => "N",
						"MESSAGE_404" => "",
						"NEWS_COUNT" => "4",
						"PAGER_BASE_LINK_ENABLE" => "N",
						"PAGER_DESC_NUMBERING" => "N",
						"PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
						"PAGER_SHOW_ALL" => "N",
						"PAGER_SHOW_ALWAYS" => "N",
						"PAGER_TEMPLATE" => ".default",
						"PAGER_TITLE" => "Новости",
						"PARENT_SECTION" => "",
						"PARENT_SECTION_CODE" => "",
						"PREVIEW_TRUNCATE_LEN" => "",
						"PROPERTY_CODE" => array(
							0 => "ITEM_LIST",
							1 => "ITEM_BG",
							2 => "ITEM_ICON",
							3 => "",
						),
						"SET_BROWSER_TITLE" => "N",
						"SET_LAST_MODIFIED" => "N",
						"SET_META_DESCRIPTION" => "N",
						"SET_META_KEYWORDS" => "N",
						"SET_STATUS_404" => "N",
						"SET_TITLE" => "N",
						"SHOW_404" => "N",
						"SORT_BY1" => "ID",
						"SORT_BY2" => "ID",
						"SORT_ORDER1" => "ASC",
						"SORT_ORDER2" => "ASC",
						"STRICT_SECTION_CHECK" => "N"
					),
					false,
					array(
						"ACTIVE_COMPONENT" => "N"
					)
				); ?>
			</div>
		</div>

	<? else: ?>

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

						<? if ($templateType == "one_col" || substr($APPLICATION->GetCurDir(), 0, (8 + strlen(SITE_DIR))) == SITE_DIR . 'catalog/' || CSite::InDir('/dokumentatsiya/') || CSite::InDir('/prod_selections/')): ?>
							<div>
								<? if (CSite::InDir('/prod_selections/')): ?>
									<div class="row">
										<div class="col-lg-3 col-md-3 hidden-sm hidden-xs">
											<? $APPLICATION->IncludeComponent(
												"alexkova.market:menu",
												isset($arParams["LEFT_MENU_TEMPLATE"]) ? $arParams["LEFT_MENU_TEMPLATE"] : "left",
												array(
													"ROOT_MENU_TYPE" => isset($arParams["ROOT_MENU_TYPE"]) ? $arParams["ROOT_MENU_TYPE"] : "left",
													"MAX_LEVEL" => "1",
													"CHILD_MENU_TYPE" => isset($arParams["CHILD_MENU_TYPE"]) ? $arParams["CHILD_MENU_TYPE"] : "left",
													"USE_EXT" => isset($arParams["USE_EXT"]) ? $arParams["USE_EXT"] : "Y",
													"DELAY" => isset($arParams["DELAY"]) ? $arParams["DELAY"] : "N",
													"TITLE_MENU" => isset($arParams["TITLE_MENU"]) ? $arParams["TITLE_MENU"] : "",
													"STYLE_MENU" => isset($arParams["STYLE_MENU"]) ? $arParams["STYLE_MENU"] : "colored_light",
													"PICTURE_SECTION" => isset($arParams["PICTURE_SECTION"]) ? $arParams["PICTURE_SECTION"] : "N",
													"STYLE_MENU_HOVER" => isset($arParams["STYLE_MENU_HOVER"]) ? $arParams["STYLE_MENU_HOVER"] : "colored_light",
													"PICTURE_SECTION_HOVER" => isset($arParams["PICTURE_SECTION_HOVER"]) ? $arParams["PICTURE_SECTION_HOVER"] : "N",
													"PICTURE_CATEGARIES" => isset($arParams["PICTURE_CATEGARIES"]) ? $arParams["PICTURE_CATEGARIES"] : "N",
													"HOVER_MENU_COL_LG" => isset($arParams["HOVER_MENU_COL_LG"]) ? $arParams["HOVER_MENU_COL_LG"] : "2",
													"HOVER_MENU_COL_MD" => isset($arParams["HOVER_MENU_COL_MD"]) ? $arParams["HOVER_MENU_COL_MD"] : "2",
													"HOVER_MENU_COL_SM" => isset($arParams["HOVER_MENU_COL_SM"]) ? $arParams["HOVER_MENU_COL_SM"] : "2",
													"HOVER_MENU_COL_XS" => isset($arParams["HOVER_MENU_COL_XS"]) ? $arParams["HOVER_MENU_COL_XS"] : "2",
													"SUBMENU" => isset($arParams["SUBMENU"]) ? $arParams["SUBMENU"] : "ACTIVE_SHOW",
													"HOVER_TEMPLATE" => isset($arParams["HOVER_TEMPLATE"]) ? $arParams["HOVER_TEMPLATE"] : "classic",
													"MENU_CACHE_TYPE" => $arParams["CACHE_TYPE"],
													"MENU_CACHE_TIME" => $arParams["CACHE_TIME"],
													"MENU_CACHE_USE_GROUPS" => $arParams["CACHE_GROUPS"],
													"MENU_CACHE_GET_VARS" => array(),
													"SHOW_TREE" => "Y",
												),
												false,
												array("HIDE_ICONS" => "N")
											);


											$BXReady->showBannerPlace("LEFT"); ?>
										</div>
										<div class="col-lg-9 col-md-9 col-sm-12 col-xs-12">
											<h1><? $APPLICATION->ShowTitle(false); ?></h1>
										<? endif; ?>
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