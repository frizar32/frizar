<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
/** @var array $arParams */
/** @var array $arResult */
/** @global CMain $APPLICATION */
/** @global CUser $USER */
/** @global CDatabase $DB */
/** @var CBitrixComponentTemplate $this */
/** @var string $templateName */
/** @var string $templateFile */
/** @var string $templateFolder */
/** @var string $componentPath */
/** @var CBitrixComponent $component */
if(!isset($arParams["USE_PRODUCT_QUANTITY"])) $arParams["USE_PRODUCT_QUANTITY"] = "Y";
if(!isset($arParams["SHOW_MAX_QUANTITY"])) $arParams["SHOW_MAX_QUANTITY"] = "Y";
if(!isset($arParams["SIDEBAR_DETAIL_SHOW"])) $arParams["SIDEBAR_DETAIL_SHOW"] = "Y";
global $moreSettings;
use Alexkova\Market\Core;

$offerMask = 'offer';
$cache_id = SITE_ID."|".$APPLICATION->GetCurPage()."|".intval($arResult["VARIABLES"]["OFFER_ID"])."|".$USER->GetGroups();
$obCache = new CPHPCache;
if ($obCache->InitCache($arParams['CACHE_TIME'], $cache_id, '/'))
{
    $vars = $obCache->GetVars();
    $offerId = $vars['offerId'];

} elseif ($obCache->StartDataCache()) {
    $offerId = false;
    if ($arResult["VARIABLES"]["OFFER_ID"]) {
        $offers = CCatalogSKU::GetInfoByProductIBlock($arParams["IBLOCK_ID"]);
        if (!$arResult["VARIABLES"]["ELEMENT_ID"] && $arResult["VARIABLES"]["ELEMENT_CODE"]) {
            $filter = array("IBLOCK_ID" => $arParams["IBLOCK_ID"], "CODE" => $arResult["VARIABLES"]["ELEMENT_CODE"]);
            $select = array("ID");
            $res = CIBlockElement::GetList(Array("SORT"=>"ASC"), $filter, false, false, $select);
            if ($arElem = $res->GetNext())
                $arResult["VARIABLES"]["ELEMENT_ID"] = $arElem["ID"];
        }
        $filter = array("IBLOCK_ID" => $offers["IBLOCK_ID"], "ID" => $arResult["VARIABLES"]["OFFER_ID"], "PROPERTY_CML2_LINK" => $arResult["VARIABLES"]["ELEMENT_ID"]);
        $select = array("ID");
        $res = CIBlockElement::GetList(Array("SORT"=>"ASC"), $filter, false, false, $select);
        if ($arOffer = $res->GetNext())
            $offerId = $arOffer["ID"];
    }

    $obCache->EndDataCache(array(
      'offerId' => $offerId,
    ));
}

$bxr_use_links_sku = COption::GetOptionString("alexkova.market", "bxr_use_links_sku", "N");
if (!$offerId && $arResult["VARIABLES"]["OFFER_ID"] || $bxr_use_links_sku != "Y" && isset($arResult["VARIABLES"]["OFFER_ID"])) {
    $GLOBALS["APPLICATION"]->RestartBuffer();
    include   $_SERVER['DOCUMENT_ROOT'].'/bitrix/templates/'.SITE_TEMPLATE_ID.'/header.php';
    require   ($_SERVER['DOCUMENT_ROOT'].'/404.php');
    die();
}


$BXReady = \Alexkova\Market\Core::getInstance();
$module_id = "alexkova.market";
global $bxreadyMarkers;

if (strlen(COption::GetOptionString('alexkova.market', 'list_marker_type'))>0){
        $bxreadyMarkers = COption::GetOptionString('alexkova.market', 'list_marker_type');
}else{
        $bxreadyMarkers = $arParams["BXREADY_LIST_MARKER_TYPE"];
}



// central manage mode
$managment_element_mode = COption::GetOptionString($module_id, "managment_element_mode", "N");
if ($managment_element_mode == "Y") {
    $ownOptElementLib = COption::GetOptionString($module_id, "own_catalog_list_element_type_".SITE_TEMPLATE_ID, "ecommerce.v2.lite");
    if (strlen($ownOptElementLib) > 0) {
        $elementLibrary = trim($ownOptElementLib);
    } else {
        $optElementLib = COption::GetOptionString($module_id, "catalog_list_element_type_".SITE_TEMPLATE_ID, "ecommerce.v2.lite");
        if (strlen($optElementLib) > 0) {
            $elementLibrary = $optElementLib;
        } else {
            $elementLibrary = "ecommerce.v2.lite";
        }
    }
} else {
    $elementLibrary = "ecommerce.v2.lite";
}

if ($managment_element_mode == "Y") {
    if ($elementLibrary == $elementBlock) {
        $ownOptElementLib = COption::GetOptionString($module_id, "own_catalog_list_element_type_".SITE_TEMPLATE_ID, $elementBlock);
        if (strlen($ownOptElementLib) > 0) {
            $optElementLib = trim($ownOptElementLib);
        } else {
            $optElementLib = COption::GetOptionString($module_id, "catalog_list_element_type_".SITE_TEMPLATE_ID, $elementBlock);
        }
        $arResponsiveParams["LG"] = COption::GetOptionString($module_id, "catalog_list_element_count_lg_".SITE_TEMPLATE_ID, 4);
        $arResponsiveParams["MD"] = COption::GetOptionString($module_id, "catalog_list_element_count_md_".SITE_TEMPLATE_ID, 3);
        $arResponsiveParams["SM"] = COption::GetOptionString($module_id, "catalog_list_element_count_sm_".SITE_TEMPLATE_ID, 2);
        $arResponsiveParams["XS"] = COption::GetOptionString($module_id, "catalog_list_element_count_xs_".SITE_TEMPLATE_ID, 1);
    } elseif ($elementLibrary == $elementList) {
        $nameListOption = substr("own_catalog_list_element_type_list_".SITE_TEMPLATE_ID, 0,50);
        $ownOptElementLib = COption::GetOptionString($module_id, $nameListOption, $elementList);
        if (strlen($ownOptElementLib) > 0) {
            $optElementLib = trim($ownOptElementLib);
        } else {
            $optElementLib = COption::GetOptionString($module_id, "catalog_list_element_type_list_".SITE_TEMPLATE_ID, $elementList);
        }
    } elseif ($elementLibrary == $elementTable) {
        $nameTableOption = substr("own_catalog_list_element_type_table_".SITE_TEMPLATE_ID, 0,50);
        $ownOptElementLib = COption::GetOptionString($module_id, $nameTableOption, $elementTable);
        if (strlen($ownOptElementLib) > 0) {
            $optElementLib = trim($ownOptElementLib);
        } else {
            $optElementLib = COption::GetOptionString($module_id, "catalog_list_element_type_table_".SITE_TEMPLATE_ID, $elementTable);
        }
    };
    if (strlen($optElementLib) > 0)
            $elementLibrary = $optElementLib;
}


$this->setFrameMode(true);
$isSidebar = $arParams["SIDEBAR_DETAIL_SHOW"] == "N"; //вывод бокового меню выключен
$isAdditionalSideBar = (isset($arParams["SIDEBAR_PATH"]) && !empty($arParams["SIDEBAR_PATH"]));
$isMenu = ($arParams['SHOW_LEFT_MENU'] == 'Y');

if ($isSidebar):?>
<div class="col-lg-3 col-md-3 hidden-sm hidden-xs">
	<?if ($isMenu):
		$APPLICATION->IncludeComponent(
			"alexkova.market:menu",
			isset($arParams["LEFT_MENU_TEMPLATE"]) ? $arParams["LEFT_MENU_TEMPLATE"] : "left",
			array(
                            "ROOT_MENU_TYPE" => isset($arParams["ROOT_MENU_TYPE"]) ? $arParams["ROOT_MENU_TYPE"] : "left",
                            "MAX_LEVEL" => isset($arParams["MAX_LEVEL"]) ? $arParams["MAX_LEVEL"] : "2",
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
                            "MENU_CACHE_GET_VARS" => array(
                            ),
                            "SHOW_TREE" => "Y",
                        ),
			false,
			array("HIDE_ICONS" => "Y")
		);
	endif;
	$BXReady->showBannerPlace("LEFT");
	if ($isAdditionalSideBar):
		$APPLICATION->IncludeComponent(
			"bitrix:main.include",
			"",
			Array(
				"AREA_FILE_SHOW" => "file",
				"PATH" => $arParams["SIDEBAR_PATH"],
				"AREA_FILE_RECURSIVE" => "N",
				"EDIT_MODE" => "html",
			),
			false,
			Array('HIDE_ICONS' => 'N')
		);
	endif?>
<?$APPLICATION->IncludeComponent(
	"alexkova.market:form.iblock",
	"request_trade",
	array(
		"COMPOSITE_FRAME_MODE" => "A",
		"COMPOSITE_FRAME_TYPE" => "AUTO",
		"GROUPS" => array(
			0 => "2",
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
		"COMPONENT_TEMPLATE" => "request_trade",
		"EVENT_CLASS" => "open-form-help",
		"BUTTON_TEXT" => "Помощь в выборе",
		"POPUP_TITLE" => "Заполните поля",
		"SEND_EVENT" => "KZNC_NEW_FORM_RESULT_HELP"
	),
	false
);?>
</div>

<?endif;?>
<div class="<?=($isSidebar)?'col-lg-9 col-md-9 ':'col-lg-12 col-md-12 '?>col-sm-12 col-xs-12" itemscope itemtype="https://schema.org/Product">
    <?
    if(!empty($_SERVER['QUERY_STRING'])):
        $query = '?'.$_SERVER['QUERY_STRING'];
    endif;
    ?>

    <?/*<a class="button_next">НАЗАД</a>
    <br/>*/?>
    <h1 itemprop="name"><?=$APPLICATION->ShowTitle('h1')?></h1>
    <?$arParams["OFFERS_VIEW"] = ($arParams["OFFERS_VIEW"]) ? $arParams["OFFERS_VIEW"] : "SELECT";
    $ElementID = $APPLICATION->IncludeComponent(
            "bitrix:catalog.element",
            "",
            array(
					"COMPATIBLE_MODE" => "Y",
                    "IBLOCK_TYPE" => $arParams["IBLOCK_TYPE"],
                    "IBLOCK_ID" => $arParams["IBLOCK_ID"],
                    "PROPERTY_CODE" => array_merge($arParams["DETAIL_PROPERTY_CODE"], $arParams["PREVIEW_DETAIL_PROPERTY_CODE"]),
                    //"META_KEYWORDS" => $arParams["DETAIL_META_KEYWORDS"],
                    //"META_DESCRIPTION" => $arParams["DETAIL_META_DESCRIPTION"],
                    //"BROWSER_TITLE" => $arParams["DETAIL_BROWSER_TITLE"],
                    "SET_CANONICAL_URL" => $arParams["DETAIL_SET_CANONICAL_URL"],
                    "BASKET_URL" => $arParams["BASKET_URL"],
                    "ACTION_VARIABLE" => $arParams["ACTION_VARIABLE"],
                    "PRODUCT_ID_VARIABLE" => $arParams["PRODUCT_ID_VARIABLE"],
                    "SECTION_ID_VARIABLE" => $arParams["SECTION_ID_VARIABLE"],
                    "CHECK_SECTION_ID_VARIABLE" => (isset($arParams["DETAIL_CHECK_SECTION_ID_VARIABLE"]) ? $arParams["DETAIL_CHECK_SECTION_ID_VARIABLE"] : ''),
                    "PRODUCT_QUANTITY_VARIABLE" => $arParams["PRODUCT_QUANTITY_VARIABLE"],
                    "PRODUCT_PROPS_VARIABLE" => $arParams["PRODUCT_PROPS_VARIABLE"],
                    "CACHE_TYPE" => $arParams["CACHE_TYPE"],
                    "CACHE_TIME" => $arParams["CACHE_TIME"],
                    "CACHE_GROUPS" => $arParams["CACHE_GROUPS"],
                    "SET_TITLE" => $arParams["SET_TITLE"],
                    "SET_LAST_MODIFIED" => $arParams["SET_LAST_MODIFIED"],
                    "MESSAGE_404" => $arParams["MESSAGE_404"],
                    "SET_STATUS_404" => $arParams["SET_STATUS_404"],
                    "SHOW_404" => $arParams["SHOW_404"],
                    "FILE_404" => $arParams["FILE_404"],
                    "PRICE_CODE" => $arParams["PRICE_CODE"],
                    "SHOW_PRICE_NAME" => $arParams["SHOW_PRICE_NAME"],
                    "USE_PRICE_COUNT" => $arParams["USE_PRICE_COUNT"],
                    "SHOW_ANALOG_BTN" => $arParams["SHOW_ANALOG_BTN"],
                    "SHOW_PRICE_COUNT" => $arParams["SHOW_PRICE_COUNT"],
                    "PRICE_VAT_INCLUDE" => $arParams["PRICE_VAT_INCLUDE"],
                    "PRICE_VAT_SHOW_VALUE" => $arParams["PRICE_VAT_SHOW_VALUE"],
                    "USE_PRODUCT_QUANTITY" => $arParams['USE_PRODUCT_QUANTITY'],
                    "PRODUCT_PROPERTIES" => $arParams["PRODUCT_PROPERTIES"],
                    "ADD_PROPERTIES_TO_BASKET" => (isset($arParams["ADD_PROPERTIES_TO_BASKET"]) ? $arParams["ADD_PROPERTIES_TO_BASKET"] : ''),
                    "PARTIAL_PRODUCT_PROPERTIES" => (isset($arParams["PARTIAL_PRODUCT_PROPERTIES"]) ? $arParams["PARTIAL_PRODUCT_PROPERTIES"] : ''),
                    "LINK_IBLOCK_TYPE" => $arParams["LINK_IBLOCK_TYPE"],
                    "LINK_IBLOCK_ID" => $arParams["LINK_IBLOCK_ID"],
                    "LINK_PROPERTY_SID" => $arParams["LINK_PROPERTY_SID"],
                    "LINK_ELEMENTS_URL" => $arParams["LINK_ELEMENTS_URL"],
                    'PRODUCT_DISPLAY_MODE' => $arParams['PRODUCT_DISPLAY_MODE'],
                    "OFFERS_CART_PROPERTIES" => $arParams["OFFERS_CART_PROPERTIES"],
                    "OFFERS_FIELD_CODE" => $arParams["DETAIL_OFFERS_FIELD_CODE"],
                    "OFFERS_PROPERTY_CODE" => $arParams["DETAIL_OFFERS_PROPERTY_CODE"],
                    "OFFERS_SORT_FIELD" => $arParams["OFFERS_SORT_FIELD"],
                    "OFFERS_SORT_ORDER" => $arParams["OFFERS_SORT_ORDER"],
                    "OFFERS_SORT_FIELD2" => $arParams["OFFERS_SORT_FIELD2"],
                    "OFFERS_SORT_ORDER2" => $arParams["OFFERS_SORT_ORDER2"],

                    "ELEMENT_ID" => $arResult["VARIABLES"]["ELEMENT_ID"],
                    "ELEMENT_CODE" => $arResult["VARIABLES"]["ELEMENT_CODE"],
                    "OFFER_ID" => $arResult["VARIABLES"]["OFFER_ID"],
                    "SECTION_ID" => $arResult["VARIABLES"]["SECTION_ID"],
                    "SECTION_CODE" => $arResult["VARIABLES"]["SECTION_CODE"],
                    "SECTION_URL" => $arResult["FOLDER"].$arResult["URL_TEMPLATES"]["section"],
                    "DETAIL_URL" => $arResult["FOLDER"].$arResult["URL_TEMPLATES"]["element"],
                    'CONVERT_CURRENCY' => $arParams['CONVERT_CURRENCY'],
                    'CURRENCY_ID' => $arParams['CURRENCY_ID'],
                    'HIDE_NOT_AVAILABLE' => $arParams["HIDE_NOT_AVAILABLE"],
                    'USE_ELEMENT_COUNTER' => $arParams['USE_ELEMENT_COUNTER'],
                    'SHOW_DEACTIVATED' => $arParams['SHOW_DEACTIVATED'],
                    "USE_MAIN_ELEMENT_SECTION" => $arParams["USE_MAIN_ELEMENT_SECTION"],
                    'STRICT_SECTION_CHECK' => (isset($arParams['DETAIL_STRICT_SECTION_CHECK']) ? $arParams['DETAIL_STRICT_SECTION_CHECK'] : ''),

                    'ADD_PICT_PROP' => $arParams['ADD_PICT_PROP'],
                    'LABEL_PROP' => $arParams['LABEL_PROP'],
                    'OFFER_ADD_PICT_PROP' => $arParams['OFFER_ADD_PICT_PROP'],
                    'OFFER_TREE_PROPS' => $arParams['OFFER_TREE_PROPS'],
                    'PRODUCT_SUBSCRIPTION' => $arParams['PRODUCT_SUBSCRIPTION'],
                    'SHOW_DISCOUNT_PERCENT' => $arParams['SHOW_DISCOUNT_PERCENT'],
                    'SHOW_OLD_PRICE' => $arParams['SHOW_OLD_PRICE'],
                    'SHOW_MAX_QUANTITY' => $arParams['DETAIL_SHOW_MAX_QUANTITY'],
                    'USE_SHARE' => (isset($arParams['USE_SHARE']) ? $arParams['USE_SHARE'] : 'Y'),
                    'USE_FAVORITES' => (isset($arParams['USE_FAVORITES']) ? $arParams['USE_FAVORITES'] : 'Y'),
                    'USE_SHARE_TEXT' => $arParams['USE_SHARE_TEXT'],
                    'USE_FAVORITES_TEXT' => $arParams['USE_FAVORITES_TEXT'],
                    'USE_ONE_CLICK' => (isset($arParams['USE_ONE_CLICK']) ? $arParams['USE_ONE_CLICK'] : 'Y'),
                    'USE_ONE_CLICK_TEXT' => $arParams['USE_ONE_CLICK_TEXT'],
                    'MESS_BTN_BUY' => $arParams['MESS_BTN_BUY'],
                    'MESS_BTN_ADD_TO_BASKET' => $arParams['MESS_BTN_ADD_TO_BASKET'],
                    'MESS_BTN_REQUEST' => $arParams['MESS_BTN_REQUEST'],
                    'MESS_BTN_COMPARE' => $arParams['MESS_BTN_COMPARE'],
                    'MESS_NOT_AVAILABLE' => $arParams['MESS_NOT_AVAILABLE'],
                    'USE_VOTE_RATING' => $arParams['DETAIL_USE_VOTE_RATING'],
                    'VOTE_DISPLAY_AS_RATING' => (isset($arParams['DETAIL_VOTE_DISPLAY_AS_RATING']) ? $arParams['DETAIL_VOTE_DISPLAY_AS_RATING'] : ''),
                    'USE_COMMENTS' => $arParams['DETAIL_USE_COMMENTS'],
                    'BLOG_USE' => (isset($arParams['DETAIL_BLOG_USE']) ? $arParams['DETAIL_BLOG_USE'] : ''),
                    'BLOG_URL' => (isset($arParams['DETAIL_BLOG_URL']) ? $arParams['DETAIL_BLOG_URL'] : ''),
                    'BLOG_EMAIL_NOTIFY' => (isset($arParams['DETAIL_BLOG_EMAIL_NOTIFY']) ? $arParams['DETAIL_BLOG_EMAIL_NOTIFY'] : ''),
                    'VK_USE' => (isset($arParams['DETAIL_VK_USE']) ? $arParams['DETAIL_VK_USE'] : ''),
                    'VK_API_ID' => (isset($arParams['DETAIL_VK_API_ID']) ? $arParams['DETAIL_VK_API_ID'] : 'API_ID'),
                    'FB_USE' => (isset($arParams['DETAIL_FB_USE']) ? $arParams['DETAIL_FB_USE'] : ''),
                    'FB_APP_ID' => (isset($arParams['DETAIL_FB_APP_ID']) ? $arParams['DETAIL_FB_APP_ID'] : ''),
                    'BRAND_USE' => (isset($arParams['DETAIL_BRAND_USE']) ? $arParams['DETAIL_BRAND_USE'] : 'N'),
                    'BRAND_PROP_CODE' => (isset($arParams['DETAIL_BRAND_PROP_CODE']) ? $arParams['DETAIL_BRAND_PROP_CODE'] : ''),
                    'DISPLAY_NAME' => (isset($arParams['DETAIL_DISPLAY_NAME']) ? $arParams['DETAIL_DISPLAY_NAME'] : ''),
                    'ADD_DETAIL_TO_SLIDER' => (isset($arParams['DETAIL_ADD_DETAIL_TO_SLIDER']) ? $arParams['DETAIL_ADD_DETAIL_TO_SLIDER'] : ''),
                    'ADD_DETAIL_TO_SLIDER_SKU' => (isset($arParams['DETAIL_ADD_DETAIL_TO_SLIDER_SKU']) ? $arParams['DETAIL_ADD_DETAIL_TO_SLIDER_SKU'] : 'Y'),
                    'ADDITIONAL_SKU_PIC_2_SLIDER' => (isset($arParams['ADDITIONAL_SKU_PIC_2_SLIDER']) ? $arParams['ADDITIONAL_SKU_PIC_2_SLIDER'] : 'N'),
                    'FILTER_SKU_PHOTO' => (isset($arParams['FILTER_SKU_PHOTO']) ? $arParams['FILTER_SKU_PHOTO'] : 'Y'),
                    'SHOW_MAIN_INSTEAD_NF_SKU' => (isset($arParams['SHOW_MAIN_INSTEAD_NF_SKU']) ? $arParams['SHOW_MAIN_INSTEAD_NF_SKU'] : 'Y'),
                    'TEMPLATE_THEME' => (isset($arParams['TEMPLATE_THEME']) ? $arParams['TEMPLATE_THEME'] : ''),
                    "ADD_SECTIONS_CHAIN" => (isset($arParams["ADD_SECTIONS_CHAIN"]) ? $arParams["ADD_SECTIONS_CHAIN"] : ''),
                    "ADD_ELEMENT_CHAIN" => (isset($arParams["ADD_ELEMENT_CHAIN"]) ? $arParams["ADD_ELEMENT_CHAIN"] : ''),
                    "DISPLAY_PREVIEW_TEXT_MODE" => (isset($arParams['DETAIL_DISPLAY_PREVIEW_TEXT_MODE']) ? $arParams['DETAIL_DISPLAY_PREVIEW_TEXT_MODE'] : ''),
		    "HIDE_PREVIEW_PROPS_INLIST" => (isset($arParams['HIDE_PREVIEW_PROPS_INLIST']) ? $arParams['HIDE_PREVIEW_PROPS_INLIST'] : ''),
                    "PROPS_TAB_VIEW" => (isset($arParams['PROPS_TAB_VIEW']) ? $arParams['PROPS_TAB_VIEW'] : ''),
                    "DETAIL_PICTURE_MODE" => (isset($arParams['DETAIL_DETAIL_PICTURE_MODE']) ? $arParams['DETAIL_DETAIL_PICTURE_MODE'] : ''),
                    'ADD_TO_BASKET_ACTION' => $basketAction,
                    'SHOW_CLOSE_POPUP' => isset($arParams['COMMON_SHOW_CLOSE_POPUP']) ? $arParams['COMMON_SHOW_CLOSE_POPUP'] : '',
                    'DISPLAY_COMPARE' => (isset($arParams['USE_COMPARE']) ? $arParams['USE_COMPARE'] : ''),
                    'COMPARE_PATH' => $arResult['FOLDER'].$arResult['URL_TEMPLATES']['compare'],
                    'SHOW_BASIS_PRICE' => (isset($arParams['DETAIL_SHOW_BASIS_PRICE']) ? $arParams['DETAIL_SHOW_BASIS_PRICE'] : 'Y'),
                    'BACKGROUND_IMAGE' => (isset($arParams['DETAIL_BACKGROUND_IMAGE']) ? $arParams['DETAIL_BACKGROUND_IMAGE'] : ''),
                    "ZOOM_ON" => $arParams["ZOOM_ON"],
                    "OFFERS_VIEW" => $arParams["OFFERS_VIEW"],
                    "FILTER_SKU_PHOTO_FLEX" => $arParams["FILTER_SKU_PHOTO_FLEX"],
                    "SKU_SORT_PARAMS" => (isset($arParams['SKU_SORT_PARAMS']) ? $arParams['SKU_SORT_PARAMS'] : 'N'),
//                    "USE_LINKS_SKU" => (isset($arParams['USE_LINKS_SKU']) ? $arParams['USE_LINKS_SKU'] : 'Y'),
                    "HIDE_OFFERS_LIST" => $arParams["HIDE_OFFERS_LIST"],
                    "GROUP_PRICE_COUNT" => $arParams["GROUP_PRICE_COUNT"],
                    "OFFER_PRICE_SHOW_FROM" => $arParams["OFFER_PRICE_SHOW_FROM"],
                    "MIN_AMOUNT" => $arParams["MIN_AMOUNT"],
                    "USE_MIN_AMOUNT" => $arParams["USE_MIN_AMOUNT"],
                    "SHOW_CATALOG_QUANTITY_CNT" => $arParams["SHOW_CATALOG_QUANTITY_CNT"],
                    "SHOW_CATALOG_QUANTITY" => $arParams["SHOW_CATALOG_QUANTITY"],
                    "QTY_SHOW_TYPE" => $arParams["QTY_SHOW_TYPE"],
                    "IN_STOCK" => $arParams["IN_STOCK"],
                    "NOT_IN_STOCK" => $arParams["NOT_IN_STOCK"],
                    "QTY_MANY_GOODS_INT" => $arParams["QTY_MANY_GOODS_INT"],
                    "QTY_MANY_GOODS_TEXT" => $arParams["QTY_MANY_GOODS_TEXT"],
                    "QTY_LESS_GOODS_TEXT" => $arParams["QTY_LESS_GOODS_TEXT"],
                    "PREVIEW_DETAIL_PROPERTY_CODE" => $arParams["PREVIEW_DETAIL_PROPERTY_CODE"],
                    "USE_REVIEW" => $arParams["USE_REVIEW"],
                    "USE_STORE" => $arParams["USE_STORE"],
                    "SKU_PROPS_SHOW_TYPE" => $arParams["SKU_PROPS_SHOW_TYPE"],
                    "DETAIL_DISPLAY_SHOW_FILES" => $arParams["DETAIL_DISPLAY_SHOW_FILES"],
                    "DETAIL_DISPLAY_SHOW_VIDEO" => $arParams["DETAIL_DISPLAY_SHOW_VIDEO"],
                    "VIDEO_TYPE" => $arParams["VIDEO_TYPE"],
                    "VIDEO_PLAYER" => $arParams["VIDEO_PLAYER"],
                    "VIDEO_PLAYER_FULLSCREEN" => $arParams["VIDEO_PLAYER_FULLSCREEN"],
		    "STORES" => $arParams["STORES"],
		    "SHOW_EMPTY_STORE" => $arParams["SHOW_EMPTY_STORE"],
		    "SHOW_GENERAL_STORE_INFORMATION" => $arParams["SHOW_GENERAL_STORE_INFORMATION"],
		    "FIELDS" => $arParams["FIELDS"],
		    "USER_FIELDS" => $arParams["USER_FIELDS"],
		    "MAIN_TITLE" => $arParams["MAIN_TITLE"],
		    "SHOW_MEASURE" => $arParams["SHOW_MEASURE"],
		    "ADDITIONAL_TAB_SHOW" => (isset($arParams["ADDITIONAL_TAB_SHOW"]) ? $arParams["ADDITIONAL_TAB_SHOW"] : 'N'),
		    "ADDITIONAL_TAB_PATH" => $arParams["ADDITIONAL_TAB_PATH"],
		    "ADDITIONAL_TAB_NAME" => $arParams["ADDITIONAL_TAB_NAME"],
		    "SHOW_OFFER_PIC_BYCLICK" => $arParams["SHOW_OFFER_PIC_BYCLICK"],
            "CATALOG_SUBSCRIBE" => "N"
            ),
            $component
    );
  $price = $arResult['MIN_PRICE'];
 $res = CIBlockElement::GetByID($ElementID);
    if($ar_res = $res->GetNext()) {


		//мета для карточек товара
$array_A = array(
'Предлагаем вам купить товар:',
'У нас на сайте вы можете купить:',
'В нашем каталоге вы можете купить:',
'В компании Фризар вы можете купить:',
'В каталоге интернет-магазины вы можете заказать:',
'На нашем сайте вы можете оформить заказ на:',
'У нас на заказ доступен товар:',

);
$array_B = array(
'Действуют акции и скидки',
'Быстрая доставка по всей России',
'Подробная информация на сайте',
'Быстрая доставка в любой регион России',
'Характеристики описаны на сайте',
'За подробной информацией обращайтесь по телефону +7 (4832) 58-66-33',
'За подробной информацией обращайтесь по телефону +7 (4832) 58-66-38',
'Наши консультанты помогут вам определиться с выбором.',

);


$seocrc=crc32($_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']);
$copy_A = rtrim($array_A[abs($seocrc%count($array_A))]);
$copy_B = rtrim($array_B[abs($seocrc%count($array_B))]);

$APPLICATION->SetPageProperty("title", $ar_res['NAME'].'');
$APPLICATION->SetPageProperty("description", $copy_A.' '.$ar_res['NAME'].' по цене '.$price.'. '.$copy_B );
    }

    if (0 < $ElementID)
    {
            $arRecomData = array();
            $recomCacheID = array('IBLOCK_ID' => $arParams['IBLOCK_ID']);
            $obCache = new CPHPCache();
            if ($obCache->InitCache(36000, serialize($recomCacheID), "/catalog/recommended"))
            {
                    $arRecomData = $obCache->GetVars();
            }
            elseif ($obCache->StartDataCache())
            {
                    if (\Bitrix\Main\Loader::includeModule("catalog"))
                    {
                            $arSKU = CCatalogSKU::GetInfoByProductIBlock($arParams['IBLOCK_ID']);
                            $arRecomData['OFFER_IBLOCK_ID'] = (!empty($arSKU) ? $arSKU['IBLOCK_ID'] : 0);
                            $arRecomData['IBLOCK_LINK'] = '';
                            $arRecomData['ALL_LINK'] = '';
                            $rsProps = CIBlockProperty::GetList(
                                    array('SORT' => 'ASC', 'ID' => 'ASC'),
                                    array('IBLOCK_ID' => $arParams['IBLOCK_ID'], 'PROPERTY_TYPE' => 'E', 'ACTIVE' => 'Y')
                            );
                            $found = false;
                            while ($arProp = $rsProps->Fetch())
                            {
                                    if ($found)
                                    {
                                            break;
                                    }
                                    if ($arProp['CODE'] == '')
                                    {
                                            $arProp['CODE'] = $arProp['ID'];
                                    }
                                    $arProp['LINK_IBLOCK_ID'] = intval($arProp['LINK_IBLOCK_ID']);
                                    if ($arProp['LINK_IBLOCK_ID'] != 0 && $arProp['LINK_IBLOCK_ID'] != $arParams['IBLOCK_ID'])
                                    {
                                            continue;
                                    }
                                    if ($arProp['LINK_IBLOCK_ID'] > 0)
                                    {
                                            if ($arRecomData['IBLOCK_LINK'] == '')
                                            {
                                                    $arRecomData['IBLOCK_LINK'] = $arProp['CODE'];
                                                    $found = true;
                                            }
                                    }
                                    else
                                    {
                                            if ($arRecomData['ALL_LINK'] == '')
                                            {
                                                    $arRecomData['ALL_LINK'] = $arProp['CODE'];
                                            }
                                    }
                            }
                            if ($found)
                            {
                                    if(defined("BX_COMP_MANAGED_CACHE"))
                                    {
                                            global $CACHE_MANAGER;
                                            $CACHE_MANAGER->StartTagCache("/catalog/recommended");
                                            $CACHE_MANAGER->RegisterTag("iblock_id_".$arParams["IBLOCK_ID"]);
                                            $CACHE_MANAGER->EndTagCache();
                                    }
                            }
                    }
                    $obCache->EndDataCache($arRecomData);
            }

            if($arParams["USE_ALSO_BUY"] == "Y" && \Bitrix\Main\ModuleManager::isModuleInstalled("sale") && !empty($arRecomData))
            {
				$APPLICATION->IncludeComponent("bitrix:sale.recommended.products", 'market_recommended' , array(
					"ID" => $ElementID,
					"TEMPLATE_THEME" => (isset($arParams['TEMPLATE_THEME']) ? $arParams['TEMPLATE_THEME'] : ''),
					"MIN_BUYES" => $arParams["ALSO_BUY_MIN_BUYES"],
					"ELEMENT_COUNT" => $arParams["ALSO_BUY_ELEMENT_COUNT"],
					"LINE_ELEMENT_COUNT" => $arParams["ALSO_BUY_ELEMENT_COUNT"],
					"DETAIL_URL" => $arParams["DETAIL_URL"],
					"BASKET_URL" => $arParams["BASKET_URL"],
					"ACTION_VARIABLE" => $arParams["ACTION_VARIABLE"],
					"PRODUCT_ID_VARIABLE" => $arParams["PRODUCT_ID_VARIABLE"],
					"SECTION_ID_VARIABLE" => $arParams["SECTION_ID_VARIABLE"],
					"PAGE_ELEMENT_COUNT" => $arParams["ALSO_BUY_ELEMENT_COUNT"],
					"CACHE_TYPE" => $arParams["CACHE_TYPE"],
					"CACHE_TIME" => $arParams["CACHE_TIME"],
					"PRICE_CODE" => $arParams["PRICE_CODE"],
					"USE_PRICE_COUNT" => $arParams["USE_PRICE_COUNT"],
					"SHOW_PRICE_COUNT" => $arParams["SHOW_PRICE_COUNT"],
					"PRICE_VAT_INCLUDE" => $arParams["PRICE_VAT_INCLUDE"],
					'CONVERT_CURRENCY' => $arParams['CONVERT_CURRENCY'],
					'CURRENCY_ID' => $arParams['CURRENCY_ID'],
					'HIDE_NOT_AVAILABLE' => $arParams["HIDE_NOT_AVAILABLE"],
					"SHOW_PRODUCTS_".$arParams["IBLOCK_ID"] => "Y",
					"PROPERTY_CODE_".$arRecomData['OFFER_IBLOCK_ID'] => array(    ),
					"OFFER_TREE_PROPS_".$arRecomData['OFFER_IBLOCK_ID'] => $arParams["OFFER_TREE_PROPS"],
					"BLOCK_TITLE" => $arParams["ALSO_BUY_TITLE"],
                    "IBLOCK_ID" => $arParams["IBLOCK_ID"]
					),
					$component
				);
            }
    }



if($arParams["SHOWS_BIGDATA_DETAIL"] == "Y"){
        if ($managment_element_mode == "Y") {
            $ownOptElementLib = COption::GetOptionString($module_id, "own_catalog_list_element_type_".SITE_TEMPLATE_ID, "ecommerce.v2.lite");
            if (strlen($ownOptElementLib) > 0) {
                $elementLibrary = trim($ownOptElementLib);
            } else {
                $optElementLib = COption::GetOptionString($module_id, "catalog_list_element_type_".SITE_TEMPLATE_ID, "ecommerce.v2.lite");
                if (strlen($optElementLib) > 0) {
                    $elementLibrary = $optElementLib;
                } else {
                    $elementLibrary = "ecommerce.v2.lite";
                }
            }
            $arResponsiveParams["LG"] = COption::GetOptionString($module_id, "catalog_list_element_count_lg_".SITE_TEMPLATE_ID, 4);
            $arResponsiveParams["MD"] = COption::GetOptionString($module_id, "catalog_list_element_count_md_".SITE_TEMPLATE_ID, 3);
            $arResponsiveParams["SM"] = COption::GetOptionString($module_id, "catalog_list_element_count_sm_".SITE_TEMPLATE_ID, 2);
            $arResponsiveParams["XS"] = COption::GetOptionString($module_id, "catalog_list_element_count_xs_".SITE_TEMPLATE_ID, 1);
        } else {
            $elementLibrary = "ecommerce.v2.lite";
            $arResponsiveParams["LG"] = 3;
            $arResponsiveParams["MD"] = 4;
            $arResponsiveParams["SM"] = 6;
            $arResponsiveParams["XS"] = 6;
        }
?>

<style>
.goods-tabs {
    padding: 0;
    margin: 0;
    margin-bottom: 20px;
    list-style: none;
}
  .goods-tab{
    display: none;
  }
  .goods-tab.active{display: block;}
  .goods-tabs li{
    margin-right: 10px;
    border: 1px solid #dbdbdb;
    border-radius: 2px;
    background: #fff;
    margin-bottom: 10px;
    font-weight: bold;
    cursor: pointer;
    padding: 8px 3.1rem;
    text-transform: uppercase;
    display: inline-block;
  }
  .goods-tabs li.active{
    color: #3c569f;
    border: 1px solid #3c569f;
  }
  [data-good-target] div {
    height: auto !important;
  }
</style>
<div class="clearfix"></div>
<ul class="goods-tabs" id="goodsTabs">
  <li data-good="recomend" class="active">Рекомендованные товары</li>
  <li data-good="similar">Похожие товары</li>
  <li data-good="brand">Товары этого бренда</li>
</ul>


<div class="goods-tabs-content" id="goodsAjaxWrapper">

    <div class="goods-tab active" data-good-target="recomend">

      <?
          $APPLICATION->IncludeComponent("bitrix:catalog.bigdata.products", ".default", array(
              "ID" => $ElementID,
              "LINE_ELEMENT_COUNT" => $arParams["RCM_COUNT_DETAIL"],
              "TEMPLATE_THEME" => (isset($arParams['TEMPLATE_THEME']) ? $arParams['TEMPLATE_THEME'] : ''),
              "DETAIL_URL" => $arResult["FOLDER"].$arResult["URL_TEMPLATES"]["element"],
              "BASKET_URL" => $arParams["BASKET_URL"],
              "ACTION_VARIABLE" => (!empty($arParams["ACTION_VARIABLE"]) ? $arParams["ACTION_VARIABLE"] : "action")."_cbdp",
              "PRODUCT_ID_VARIABLE" => $arParams["PRODUCT_ID_VARIABLE"],
              "PRODUCT_QUANTITY_VARIABLE" => $arParams["PRODUCT_QUANTITY_VARIABLE"],
              "ADD_PROPERTIES_TO_BASKET" => (isset($arParams["ADD_PROPERTIES_TO_BASKET"]) ? $arParams["ADD_PROPERTIES_TO_BASKET"] : ''),
              "PRODUCT_PROPS_VARIABLE" => $arParams["PRODUCT_PROPS_VARIABLE"],
              "PARTIAL_PRODUCT_PROPERTIES" => (isset($arParams["PARTIAL_PRODUCT_PROPERTIES"]) ? $arParams["PARTIAL_PRODUCT_PROPERTIES"] : ''),
              "SHOW_OLD_PRICE" => $arParams['SHOW_OLD_PRICE'],
              "SHOW_DISCOUNT_PERCENT" => $arParams['SHOW_DISCOUNT_PERCENT'],
              "PRICE_CODE" => $arParams["PRICE_CODE"],
              "SHOW_PRICE_COUNT" => $arParams["SHOW_PRICE_COUNT"],
              "PRODUCT_SUBSCRIPTION" => $arParams['PRODUCT_SUBSCRIPTION'],
              "PRICE_VAT_INCLUDE" => $arParams["PRICE_VAT_INCLUDE"],
              "USE_PRODUCT_QUANTITY" => $arParams['USE_PRODUCT_QUANTITY'],
              "SHOW_NAME" => "Y",
              "SHOW_IMAGE" => "Y",
              "MESS_BTN_BUY" => $arParams['MESS_BTN_BUY'],
              "MESS_BTN_DETAIL" => $arParams['MESS_BTN_DETAIL'],
              "MESS_BTN_SUBSCRIBE" => $arParams['MESS_BTN_SUBSCRIBE'],
              "MESS_NOT_AVAILABLE" => $arParams['MESS_NOT_AVAILABLE'],
              "PAGE_ELEMENT_COUNT" => $arParams["RCM_COUNT_DETAIL"],
              "SHOW_FROM_SECTION" => "Y",
              "IBLOCK_TYPE" => $arParams["IBLOCK_TYPE"],
              "IBLOCK_ID" => $arParams["IBLOCK_ID"],
              "DEPTH" => "2",
              "CACHE_TYPE" => $arParams["CACHE_TYPE"],
              "CACHE_TIME" => $arParams["CACHE_TIME"],
              "CACHE_GROUPS" => $arParams["CACHE_GROUPS"],
              "SHOW_PRODUCTS_".$arParams["IBLOCK_ID"] => "Y",
              "HIDE_NOT_AVAILABLE" => $arParams["HIDE_NOT_AVAILABLE"],
              "CONVERT_CURRENCY" => $arParams["CONVERT_CURRENCY"],
              "CURRENCY_ID" => $arParams["CURRENCY_ID"],
              "SECTION_ID" => $intSectionID,
              "SECTION_CODE" => "",
              "SECTION_ELEMENT_ID" => $ElementID,
              "SECTION_ELEMENT_CODE" => "",
              "LABEL_PROP_".$arParams["IBLOCK_ID"] => $arParams['LABEL_PROP'],
              "PROPERTY_CODE_".$arParams["IBLOCK_ID"] => $arParams["LIST_PROPERTY_CODE"],
              "PROPERTY_CODE_".$arRecomData['OFFER_IBLOCK_ID'] => $arParams["LIST_OFFERS_PROPERTY_CODE"],
              "CART_PROPERTIES_".$arParams["IBLOCK_ID"] => $arParams["PRODUCT_PROPERTIES"],
              "CART_PROPERTIES_".$arRecomData['OFFER_IBLOCK_ID'] => $arParams["OFFERS_CART_PROPERTIES"],
              "ADDITIONAL_PICT_PROP_".$arParams["IBLOCK_ID"] => $arParams['ADD_PICT_PROP'],
              "ADDITIONAL_PICT_PROP_".$arRecomData['OFFER_IBLOCK_ID'] => $arParams['OFFER_ADD_PICT_PROP'],
              "OFFER_TREE_PROPS_".$arRecomData['OFFER_IBLOCK_ID'] => $arParams["OFFER_TREE_PROPS"],
              "RCM_TYPE" => (isset($arParams['BIG_DATA_RCM_TYPE']) ? $arParams['BIG_DATA_RCM_TYPE'] : ''),
              "BLOCK_TITLE" => $arParams["RCM_NAME_DETAIL"],
              "BXREADY_LIST_LG_CNT" => $arResponsiveParams["LG"],
              "BXREADY_LIST_MD_CNT" => $arResponsiveParams["MD"],
              "BXREADY_LIST_SM_CNT" => $arResponsiveParams["SM"],
              "BXREADY_LIST_XS_CNT" => 12,
              "BXREADY_ELEMENT_DRAW" => $elementLibrary,
              "USE_VOTE_RATING" => $arParams["DETAIL_USE_VOTE_RATING"],
              "VOTE_DISPLAY_AS_RATING" => "N",
              "SHOW_CATALOG_QUANTITY_CNT" => $arParams["SHOW_CATALOG_QUANTITY_CNT"],
              "SHOW_CATALOG_QUANTITY" => $arParams["SHOW_CATALOG_QUANTITY"],
              "QTY_SHOW_TYPE" => $arParams["QTY_SHOW_TYPE"],
              "IN_STOCK" => $arParams["IN_STOCK"],
              "NOT_IN_STOCK" => $arParams["NOT_IN_STOCK"],
              "QTY_MANY_GOODS_INT" => $arParams["QTY_MANY_GOODS_INT"],
              "QTY_MANY_GOODS_TEXT" => $arParams["QTY_MANY_GOODS_TEXT"],
              "QTY_LESS_GOODS_TEXT" => $arParams["QTY_LESS_GOODS_TEXT"],
              "OFFERS_VIEW" => $arParams["OFFERS_VIEW"],
          ),
          $component);
      }
      ?>
    </div>
    <div class="goods-tab" data-good-target="similar">
      <?
      $APPLICATION->IncludeComponent(
          "bxready:ecommerce.list",
          ".default",
          array(
        "COMPATIBLE_MODE" => "Y",
              "IBLOCK_TYPE" => $arParams["IBLOCK_TYPE"],
              "IBLOCK_ID" => $arParams["IBLOCK_ID"],
              "ELEMENT_SORT_FIELD" => $sort,
              "ELEMENT_SORT_ORDER" => $sort_order,
              "ELEMENT_SORT_FIELD2" => $arParams["ELEMENT_SORT_FIELD2"],
              "ELEMENT_SORT_ORDER2" => $arParams["ELEMENT_SORT_ORDER2"],
              "PROPERTY_CODE" => $arParams["LIST_PROPERTY_CODE"],
              //"META_KEYWORDS" => $arParams["LIST_META_KEYWORDS"],
              //"META_DESCRIPTION" => $arParams["LIST_META_DESCRIPTION"],
              //"BROWSER_TITLE" => $arParams["LIST_BROWSER_TITLE"],
              "SET_LAST_MODIFIED" => $arParams["SET_LAST_MODIFIED"],
              "INCLUDE_SUBSECTIONS" => $arParams["INCLUDE_SUBSECTIONS"],
              "BASKET_URL" => $arParams["BASKET_URL"],
              "ACTION_VARIABLE" => $arParams["ACTION_VARIABLE"],
              "PRODUCT_ID_VARIABLE" => $arParams["PRODUCT_ID_VARIABLE"],
              "SECTION_ID_VARIABLE" => $arParams["SECTION_ID_VARIABLE"],
              "PRODUCT_QUANTITY_VARIABLE" => $arParams["PRODUCT_QUANTITY_VARIABLE"],
              "PRODUCT_PROPS_VARIABLE" => $arParams["PRODUCT_PROPS_VARIABLE"],
              "FILTER_NAME" => $arParams["FILTER_NAME"],
              "CACHE_TYPE" => $arParams["CACHE_TYPE"],
              "CACHE_TIME" => $arParams["CACHE_TIME"],
              "CACHE_FILTER" => $arParams["CACHE_FILTER"],
              "CACHE_GROUPS" => $arParams["CACHE_GROUPS"],
              "SET_TITLE" => 'N',
              "MESSAGE_404" => $arParams["MESSAGE_404"],
              "SET_STATUS_404" => $arParams["SET_STATUS_404"],
              "SHOW_404" => $arParams["SHOW_404"],
              "FILE_404" => $arParams["FILE_404"],
              "DISPLAY_COMPARE" => $arParams["USE_COMPARE"],
              "PAGE_ELEMENT_COUNT" => '4',
              "LINE_ELEMENT_COUNT" => '4',
              "PRICE_CODE" => $arParams["PRICE_CODE"],
              "USE_PRICE_COUNT" => $arParams["USE_PRICE_COUNT"],
              "SHOW_PRICE_COUNT" => $arParams["SHOW_PRICE_COUNT"],

              "PRICE_VAT_INCLUDE" => $arParams["PRICE_VAT_INCLUDE"],
              "USE_PRODUCT_QUANTITY" => $arParams['USE_PRODUCT_QUANTITY'],
              "ADD_PROPERTIES_TO_BASKET" => (isset($arParams["ADD_PROPERTIES_TO_BASKET"]) ? $arParams["ADD_PROPERTIES_TO_BASKET"] : ''),
              "PARTIAL_PRODUCT_PROPERTIES" => (isset($arParams["PARTIAL_PRODUCT_PROPERTIES"]) ? $arParams["PARTIAL_PRODUCT_PROPERTIES"] : ''),
              "PRODUCT_PROPERTIES" => $arParams["PRODUCT_PROPERTIES"],

              "DISPLAY_TOP_PAGER" => 'N',
              "DISPLAY_BOTTOM_PAGER" => 'N',
              "PAGER_TITLE" => $arParams["PAGER_TITLE"],
              "PAGER_SHOW_ALWAYS" => $arParams["PAGER_SHOW_ALWAYS"],
              "PAGER_TEMPLATE" => $arParams["PAGER_TEMPLATE"],
              "PAGER_DESC_NUMBERING" => $arParams["PAGER_DESC_NUMBERING"],
              "PAGER_DESC_NUMBERING_CACHE_TIME" => $arParams["PAGER_DESC_NUMBERING_CACHE_TIME"],
              "PAGER_SHOW_ALL" => $arParams["PAGER_SHOW_ALL"],
              "PAGER_BASE_LINK_ENABLE" => $arParams["PAGER_BASE_LINK_ENABLE"],
              "PAGER_BASE_LINK" => $arParams["PAGER_BASE_LINK"],
              "PAGER_PARAMS_NAME" => $arParams["PAGER_PARAMS_NAME"],

              "OFFERS_CART_PROPERTIES" => $arParams["OFFERS_CART_PROPERTIES"],
              "OFFERS_FIELD_CODE" => $arParams["LIST_OFFERS_FIELD_CODE"],
              "OFFERS_PROPERTY_CODE" => $arParams["LIST_OFFERS_PROPERTY_CODE"],
              "OFFERS_SORT_FIELD" => $arParams["OFFERS_SORT_FIELD"],
              "OFFERS_SORT_ORDER" => $arParams["OFFERS_SORT_ORDER"],
              "OFFERS_SORT_FIELD2" => $arParams["OFFERS_SORT_FIELD2"],
              "OFFERS_SORT_ORDER2" => $arParams["OFFERS_SORT_ORDER2"],
  //          "OFFERS_LIMIT" => $arParams["LIST_OFFERS_LIMIT"],
                          "OFFERS_LIMIT" => 0,
              "SECTION_ID" => $arResult["VARIABLES"]["SECTION_ID"],
              "SECTION_CODE" => $arResult["VARIABLES"]["SECTION_CODE"],
              "SECTION_URL" => $arResult["FOLDER"].$arResult["URL_TEMPLATES"]["section"],
              "DETAIL_URL" => $arResult["FOLDER"].$arResult["URL_TEMPLATES"]["element"],
              "USE_MAIN_ELEMENT_SECTION" => $arParams["USE_MAIN_ELEMENT_SECTION"],
              'CONVERT_CURRENCY' => $arParams['CONVERT_CURRENCY'],
              'CURRENCY_ID' => $arParams['CURRENCY_ID'],
              'HIDE_NOT_AVAILABLE' => $arParams["HIDE_NOT_AVAILABLE"],

              'LABEL_PROP' => $arParams['LABEL_PROP'],
              'ADD_PICT_PROP' => $arParams['ADD_PICT_PROP'],
              'PRODUCT_DISPLAY_MODE' => $arParams['PRODUCT_DISPLAY_MODE'],

              'OFFER_ADD_PICT_PROP' => $arParams['OFFER_ADD_PICT_PROP'],
              'OFFER_TREE_PROPS' => $arParams['OFFER_TREE_PROPS'],
              'PRODUCT_SUBSCRIPTION' => $arParams['PRODUCT_SUBSCRIPTION'],
              'SHOW_DISCOUNT_PERCENT' => $arParams['SHOW_DISCOUNT_PERCENT'],
              'SHOW_OLD_PRICE' => $arParams['SHOW_OLD_PRICE'],
              'MESS_BTN_BUY' => $arParams['MESS_BTN_BUY'],
              'MESS_BTN_ADD_TO_BASKET' => $arParams['MESS_BTN_ADD_TO_BASKET'],
              'MESS_BTN_SUBSCRIBE' => $arParams['MESS_BTN_SUBSCRIBE'],
              'MESS_BTN_DETAIL' => $arParams['MESS_BTN_DETAIL'],
              'MESS_NOT_AVAILABLE' => $arParams['MESS_NOT_AVAILABLE'],

              'TEMPLATE_THEME' => (isset($arParams['TEMPLATE_THEME']) ? $arParams['TEMPLATE_THEME'] : ''),
              "ADD_SECTIONS_CHAIN" => "N",
              'ADD_TO_BASKET_ACTION' => $basketAction,
              'SHOW_CLOSE_POPUP' => isset($arParams['COMMON_SHOW_CLOSE_POPUP']) ? $arParams['COMMON_SHOW_CLOSE_POPUP'] : '',
              'COMPARE_PATH' => $arResult['FOLDER'].$arResult['URL_TEMPLATES']['compare'],
              'BACKGROUND_IMAGE' => (isset($arParams['SECTION_BACKGROUND_IMAGE']) ? $arParams['SECTION_BACKGROUND_IMAGE'] : ''),
              "BXREADY_LIST_BOOTSTRAP_GRID_STYLE" => "12",
              "BXREADY_LIST_PAGE_BLOCK_TITLE" => "",
              "BXREADY_LIST_PAGE_BLOCK_TITLE_GLYPHICON" => "",
              "BXREADY_LIST_LG_CNT" => $arResponsiveParams["LG"],
              "BXREADY_LIST_MD_CNT" => $arResponsiveParams["MD"],
              "BXREADY_LIST_SM_CNT" => $arResponsiveParams["SM"],
              "BXREADY_LIST_XS_CNT" => 12,
              "BXREADY_LIST_SLIDER" => "N",
              "BXREADY_ELEMENT_DRAW" => $elementLibrary,
              "BXREADY_LIST_VERTICAL_SLIDER_MODE" => "N",
              "BXREADY_LIST_HIDE_SLIDER_ARROWS" => "Y",
              "BXREADY_LIST_HIDE_MOBILE_SLIDER_ARROWS" => "N",
              "BXREADY_LIST_MARKER_TYPE" => $bxreadyMarkers,
              "USE_VOTE_RATING" => $arParams["DETAIL_USE_VOTE_RATING"],
              "VOTE_DISPLAY_AS_RATING" => $arParams["DETAIL_VOTE_DISPLAY_AS_RATING"],
              "SHOW_CATALOG_QUANTITY_CNT" => $arParams["SHOW_CATALOG_QUANTITY_CNT"],
              "SHOW_CATALOG_QUANTITY" => $arParams["SHOW_CATALOG_QUANTITY"],
              "QTY_SHOW_TYPE" => $arParams["QTY_SHOW_TYPE"],
              "IN_STOCK" => $arParams["IN_STOCK"],
              "NOT_IN_STOCK" => $arParams["NOT_IN_STOCK"],
              "QTY_MANY_GOODS_INT" => $arParams["QTY_MANY_GOODS_INT"],
              "QTY_MANY_GOODS_TEXT" => $arParams["QTY_MANY_GOODS_TEXT"],
              "QTY_LESS_GOODS_TEXT" => $arParams["QTY_LESS_GOODS_TEXT"],
              "OFFERS_VIEW" => $arParams["OFFERS_VIEW"],
              "SKU_PROPS_SHOW_TYPE" => $arParams["SKU_PROPS_SHOW_TYPE"],
              "PREVIEW_TRUNCATE_LEN" => $arParams["PREVIEW_TRUNCATE_LEN"],
              "ANOUNCE_TRUNCATE_LEN" => $arParams["ANOUNCE_TRUNCATE_LEN"],
              "TILE_SHOW_PROPERTIES" => $arParams["TILE_SHOW_PROPERTIES"]
          ),
          false,
          array("HIDE_ICONS" => "Y")
      );?>

    </div>

    <div class="goods-tab" data-good-target="brand">
      <?
      $db_props = CIBlockElement::GetProperty($arParams["IBLOCK_ID"], $ElementID, array("sort" => "asc"), Array("CODE"=>"CML2_MANUFACTURER"));
      if($ar_props = $db_props->Fetch())
      {
        $brand = $ar_props["VALUE"];
      }

      global $brandFilter;
      $brandFilter = ['PROPERTY_CML2_MANUFACTURER' => $brand, '!ID' => $ElementID, '>QUANTITY' => 0];
      ?>

      <?
      $APPLICATION->IncludeComponent(
          "bxready:ecommerce.list",
          ".default",
          array(
              "COMPATIBLE_MODE" => "Y",
              "IBLOCK_TYPE" => $arParams["IBLOCK_TYPE"],
              "IBLOCK_ID" => $arParams["IBLOCK_ID"],
              "ELEMENT_SORT_FIELD" => $sort,
              "ELEMENT_SORT_ORDER" => $sort_order,
              "ELEMENT_SORT_FIELD2" => $arParams["ELEMENT_SORT_FIELD2"],
              "ELEMENT_SORT_ORDER2" => $arParams["ELEMENT_SORT_ORDER2"],
              "PROPERTY_CODE" => $arParams["LIST_PROPERTY_CODE"],
              //"META_KEYWORDS" => $arParams["LIST_META_KEYWORDS"],
              //"META_DESCRIPTION" => $arParams["LIST_META_DESCRIPTION"],
              //"BROWSER_TITLE" => $arParams["LIST_BROWSER_TITLE"],
              "SET_LAST_MODIFIED" => $arParams["SET_LAST_MODIFIED"],
              "INCLUDE_SUBSECTIONS" => $arParams["INCLUDE_SUBSECTIONS"],
              "BASKET_URL" => $arParams["BASKET_URL"],
              "ACTION_VARIABLE" => $arParams["ACTION_VARIABLE"],
              "PRODUCT_ID_VARIABLE" => $arParams["PRODUCT_ID_VARIABLE"],
              "SECTION_ID_VARIABLE" => $arParams["SECTION_ID_VARIABLE"],
              "PRODUCT_QUANTITY_VARIABLE" => $arParams["PRODUCT_QUANTITY_VARIABLE"],
              "PRODUCT_PROPS_VARIABLE" => $arParams["PRODUCT_PROPS_VARIABLE"],
              "FILTER_NAME" => "brandFilter",
              "CACHE_TYPE" => $arParams["CACHE_TYPE"],
              "CACHE_TIME" => $arParams["CACHE_TIME"],
              "CACHE_FILTER" => $arParams["CACHE_FILTER"],
              "CACHE_GROUPS" => $arParams["CACHE_GROUPS"],
              "SET_TITLE" => "N",
              "MESSAGE_404" => $arParams["MESSAGE_404"],
              "SET_STATUS_404" => $arParams["SET_STATUS_404"],
              "SHOW_404" => $arParams["SHOW_404"],
              "FILE_404" => $arParams["FILE_404"],
              "DISPLAY_COMPARE" => "N",
              "PAGE_ELEMENT_COUNT" => '4',
              "LINE_ELEMENT_COUNT" => '4',
              "PRICE_CODE" => $arParams["PRICE_CODE"],
              "USE_PRICE_COUNT" => $arParams["USE_PRICE_COUNT"],
              "SHOW_PRICE_COUNT" => $arParams["SHOW_PRICE_COUNT"],

              "PRICE_VAT_INCLUDE" => $arParams["PRICE_VAT_INCLUDE"],
              "USE_PRODUCT_QUANTITY" => $arParams['USE_PRODUCT_QUANTITY'],
              "ADD_PROPERTIES_TO_BASKET" => (isset($arParams["ADD_PROPERTIES_TO_BASKET"]) ? $arParams["ADD_PROPERTIES_TO_BASKET"] : ''),
              "PARTIAL_PRODUCT_PROPERTIES" => (isset($arParams["PARTIAL_PRODUCT_PROPERTIES"]) ? $arParams["PARTIAL_PRODUCT_PROPERTIES"] : ''),
              "PRODUCT_PROPERTIES" => $arParams["PRODUCT_PROPERTIES"],

              "DISPLAY_TOP_PAGER" => 'N',
              "DISPLAY_BOTTOM_PAGER" => 'N',
              "PAGER_TITLE" => $arParams["PAGER_TITLE"],
              "PAGER_SHOW_ALWAYS" => $arParams["PAGER_SHOW_ALWAYS"],
              "PAGER_TEMPLATE" => $arParams["PAGER_TEMPLATE"],
              "PAGER_DESC_NUMBERING" => $arParams["PAGER_DESC_NUMBERING"],
              "PAGER_DESC_NUMBERING_CACHE_TIME" => $arParams["PAGER_DESC_NUMBERING_CACHE_TIME"],
              "PAGER_SHOW_ALL" => $arParams["PAGER_SHOW_ALL"],
              "PAGER_BASE_LINK_ENABLE" => $arParams["PAGER_BASE_LINK_ENABLE"],
              "PAGER_BASE_LINK" => $arParams["PAGER_BASE_LINK"],
              "PAGER_PARAMS_NAME" => $arParams["PAGER_PARAMS_NAME"],

              "OFFERS_CART_PROPERTIES" => $arParams["OFFERS_CART_PROPERTIES"],
              "OFFERS_FIELD_CODE" => $arParams["LIST_OFFERS_FIELD_CODE"],
              "OFFERS_PROPERTY_CODE" => $arParams["LIST_OFFERS_PROPERTY_CODE"],
              "OFFERS_SORT_FIELD" => $arParams["OFFERS_SORT_FIELD"],
              "OFFERS_SORT_ORDER" => $arParams["OFFERS_SORT_ORDER"],
              "OFFERS_SORT_FIELD2" => $arParams["OFFERS_SORT_FIELD2"],
              "OFFERS_SORT_ORDER2" => $arParams["OFFERS_SORT_ORDER2"],
              //          "OFFERS_LIMIT" => $arParams["LIST_OFFERS_LIMIT"],
              "OFFERS_LIMIT" => 0,
              "SECTION_ID" => $arResult["VARIABLES"]["SECTION_ID"],
              "SECTION_CODE" => $arResult["VARIABLES"]["SECTION_CODE"],
              "SECTION_URL" => $arResult["FOLDER"].$arResult["URL_TEMPLATES"]["section"],
              "DETAIL_URL" => $arResult["FOLDER"].$arResult["URL_TEMPLATES"]["element"],
              "USE_MAIN_ELEMENT_SECTION" => $arParams["USE_MAIN_ELEMENT_SECTION"],
              'CONVERT_CURRENCY' => $arParams['CONVERT_CURRENCY'],
              'CURRENCY_ID' => $arParams['CURRENCY_ID'],
              'HIDE_NOT_AVAILABLE' => $arParams["HIDE_NOT_AVAILABLE"],

              'LABEL_PROP' => $arParams['LABEL_PROP'],
              'ADD_PICT_PROP' => $arParams['ADD_PICT_PROP'],
              'PRODUCT_DISPLAY_MODE' => $arParams['PRODUCT_DISPLAY_MODE'],

              'OFFER_ADD_PICT_PROP' => $arParams['OFFER_ADD_PICT_PROP'],
              'OFFER_TREE_PROPS' => $arParams['OFFER_TREE_PROPS'],
              'PRODUCT_SUBSCRIPTION' => $arParams['PRODUCT_SUBSCRIPTION'],
              'SHOW_DISCOUNT_PERCENT' => $arParams['SHOW_DISCOUNT_PERCENT'],
              'SHOW_OLD_PRICE' => $arParams['SHOW_OLD_PRICE'],
              'MESS_BTN_BUY' => $arParams['MESS_BTN_BUY'],
              'MESS_BTN_ADD_TO_BASKET' => $arParams['MESS_BTN_ADD_TO_BASKET'],
              'MESS_BTN_SUBSCRIBE' => $arParams['MESS_BTN_SUBSCRIBE'],
              'MESS_BTN_DETAIL' => $arParams['MESS_BTN_DETAIL'],
              'MESS_NOT_AVAILABLE' => $arParams['MESS_NOT_AVAILABLE'],

              'TEMPLATE_THEME' => (isset($arParams['TEMPLATE_THEME']) ? $arParams['TEMPLATE_THEME'] : ''),
              "ADD_SECTIONS_CHAIN" => "N",
              'ADD_TO_BASKET_ACTION' => $basketAction,
              'SHOW_CLOSE_POPUP' => isset($arParams['COMMON_SHOW_CLOSE_POPUP']) ? $arParams['COMMON_SHOW_CLOSE_POPUP'] : '',
              'COMPARE_PATH' => $arResult['FOLDER'].$arResult['URL_TEMPLATES']['compare'],
              'BACKGROUND_IMAGE' => (isset($arParams['SECTION_BACKGROUND_IMAGE']) ? $arParams['SECTION_BACKGROUND_IMAGE'] : ''),
              "BXREADY_LIST_BOOTSTRAP_GRID_STYLE" => "12",
              "BXREADY_LIST_PAGE_BLOCK_TITLE" => "",
              "BXREADY_LIST_PAGE_BLOCK_TITLE_GLYPHICON" => "",
              "BXREADY_LIST_LG_CNT" => $arResponsiveParams["LG"],
              "BXREADY_LIST_MD_CNT" => $arResponsiveParams["MD"],
              "BXREADY_LIST_SM_CNT" => $arResponsiveParams["SM"],
              "BXREADY_LIST_XS_CNT" => 12,
              "BXREADY_LIST_SLIDER" => "N",
              "BXREADY_ELEMENT_DRAW" => $elementLibrary,
              "BXREADY_LIST_VERTICAL_SLIDER_MODE" => "N",
              "BXREADY_LIST_HIDE_SLIDER_ARROWS" => "Y",
              "BXREADY_LIST_HIDE_MOBILE_SLIDER_ARROWS" => "N",
              "BXREADY_LIST_MARKER_TYPE" => $bxreadyMarkers,
              "USE_VOTE_RATING" => $arParams["DETAIL_USE_VOTE_RATING"],
              "VOTE_DISPLAY_AS_RATING" => $arParams["DETAIL_VOTE_DISPLAY_AS_RATING"],
              "SHOW_CATALOG_QUANTITY_CNT" => $arParams["SHOW_CATALOG_QUANTITY_CNT"],
              "SHOW_CATALOG_QUANTITY" => $arParams["SHOW_CATALOG_QUANTITY"],
              "QTY_SHOW_TYPE" => $arParams["QTY_SHOW_TYPE"],
              "IN_STOCK" => $arParams["IN_STOCK"],
              "NOT_IN_STOCK" => $arParams["NOT_IN_STOCK"],
              "QTY_MANY_GOODS_INT" => $arParams["QTY_MANY_GOODS_INT"],
              "QTY_MANY_GOODS_TEXT" => $arParams["QTY_MANY_GOODS_TEXT"],
              "QTY_LESS_GOODS_TEXT" => $arParams["QTY_LESS_GOODS_TEXT"],
              "OFFERS_VIEW" => $arParams["OFFERS_VIEW"],
              "SKU_PROPS_SHOW_TYPE" => $arParams["SKU_PROPS_SHOW_TYPE"],
              "PREVIEW_TRUNCATE_LEN" => $arParams["PREVIEW_TRUNCATE_LEN"],
              "ANOUNCE_TRUNCATE_LEN" => $arParams["ANOUNCE_TRUNCATE_LEN"],
              "TILE_SHOW_PROPERTIES" => $arParams["TILE_SHOW_PROPERTIES"]
          ),
          false,
          array("HIDE_ICONS" => "Y")
      );?>

    </div>
</div>

<?
    $BXReady->showBannerPlace("CATALOG_BOTTOM");?>
</div>
<div class="clearfix"></div>
<script>

    document.addEventListener("DOMContentLoaded", function() {

        $('[data-good]').on('click', function () {
          $(this).addClass('active').siblings().removeClass('active');
          $('[data-good-target="'+$(this).data('good')+'"]').addClass('active').siblings().removeClass('active');
        })

        /*let gettingHeight = document.querySelector(".detail_char").offsetHeight;
        if(gettingHeight<300){
            document.querySelector(".block_reviews").style.minHeight = "300px";
        } else {
            document.querySelector(".block_reviews").style.minHeight = `${gettingHeight}` + 'px';
        }*/

  });
</script>
<script>
    //работа кнопки назад
	/*document.addEventListener("DOMContentLoaded", function(){
        let last_elem = $("#last-elem-breadcrumb").attr('href');
        let but = document.querySelector(".button_next")
        but.setAttribute("href", last_elem);
	})*/

</script>
