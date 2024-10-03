<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?
global $filterProducts;
$filterProducts = ["ID" => count($arResult["FILTER_ITEMS_ID"]) > 0 ? $arResult["FILTER_ITEMS_ID"] : 0];
//echo '<pre>'; print_r($arResult["FILTER_ITEMS_ID"]); echo '</pre>';
?>

<div class='catalog_detail'>
    <div class="similar_products_wrapp">
        <? echo "<!-- noindex -->";?>
        <h3><?=GetMessage("BRAND_PRODUCTS", Array ("#BRAND_NAME#" => $arResult["NAME"]));?></h3>
        <? echo "<!--/ noindex -->";?>
        <?if(is_countable($arResult["TAGS_ITEMS"]) && count($arResult["TAGS_ITEMS"]) > 0):?>
            <div class="tags-menu">
                <a href="<?echo $arResult["DETAIL_PAGE_URL"]?>" class="tags-menu__items<?if(!isset($_REQUEST["SECTION_CODE"])):?> active<?endif;?>">Все товары</a>
                <?foreach ($arResult["TAGS_ITEMS"] as $arTag):?>
                    <a href="<?echo $arResult["DETAIL_PAGE_URL"]?><?echo $arTag["CODE"]?>/" class="tags-menu__items<?if($_REQUEST["SECTION_CODE"] == $arTag["CODE"]):?> active<?endif;?>"><?echo $arTag["NAME"]?></a>
                <?endforeach;?>
            </div>
        <?endif;?>
    </div>
</div>
<div id='brandProducts'>
<?$APPLICATION->IncludeComponent(
	"bxready:ecommerce.list",
	".default",
	array(
		"ACTION_VARIABLE" => "action",
		"ADD_PICT_PROP" => "-",
		"ADD_PROPERTIES_TO_BASKET" => "Y",
		"ADD_SECTIONS_CHAIN" => "N",
		"ADD_TO_BASKET_ACTION" => "ADD",
		"AJAX_MODE" => "N",
		"AJAX_OPTION_ADDITIONAL" => "",
		"AJAX_OPTION_HISTORY" => "N",
		"AJAX_OPTION_JUMP" => "N",
		"AJAX_OPTION_STYLE" => "Y",
		"BACKGROUND_IMAGE" => "-",
		"BASKET_URL" => "/personal/basket.php",
		"BROWSER_TITLE" => "-",
		"BXREADY_ELEMENT_DRAW" => "system#ecommerce_v1",
		"BXREADY_LIST_BOOTSTRAP_GRID_STYLE" => "12",
		"BXREADY_LIST_LG_CNT" => "4",
		"BXREADY_LIST_MD_CNT" => "4",
		"BXREADY_LIST_PAGE_BLOCK_TITLE" => "",
		"BXREADY_LIST_PAGE_BLOCK_TITLE_GLYPHICON" => "",
		"BXREADY_LIST_SLIDER" => "N",
		"BXREADY_LIST_SM_CNT" => "4",
		"BXREADY_LIST_XS_CNT" => "3",
		"CACHE_FILTER" => "N",
		"CACHE_GROUPS" => "Y",
		"CACHE_TIME" => "36000000",
		"CACHE_TYPE" => "A",
		"COMPOSITE_FRAME_MODE" => "A",
		"COMPOSITE_FRAME_TYPE" => "AUTO",
		"CONVERT_CURRENCY" => "Y",
		"DETAIL_URL" => "/catalog/#SECTION_CODE#/#ELEMENT_CODE#/",
		"DISPLAY_BOTTOM_PAGER" => "Y",
		"DISPLAY_TOP_PAGER" => "N",
		"ELEMENT_SORT_FIELD" => "sort",
		"ELEMENT_SORT_FIELD2" => "id",
		"ELEMENT_SORT_ORDER" => "asc",
		"ELEMENT_SORT_ORDER2" => "desc",
		"FILTER_NAME" => "filterProducts",
		"HIDE_NOT_AVAILABLE" => "N",
		"IBLOCK_ID" => "17",
		"IBLOCK_TYPE" => "catalog",
		"INCLUDE_SUBSECTIONS" => "A",
		"LABEL_PROP" => "-",
		"LINE_ELEMENT_COUNT" => "3",
		"MESSAGE_404" => "",
		"MESS_BTN_ADD_TO_BASKET" => "В корзину",
		"MESS_BTN_BUY" => "Купить",
		"MESS_BTN_DETAIL" => "Подробнее",
		"MESS_BTN_SUBSCRIBE" => "Подписаться",
		"MESS_NOT_AVAILABLE" => "Нет в наличии",
		"META_DESCRIPTION" => "-",
		"META_KEYWORDS" => "-",
		"OFFERS_LIMIT" => "5",
		"PAGER_BASE_LINK_ENABLE" => "N",
		"PAGER_DESC_NUMBERING" => "N",
		"PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
		"PAGER_SHOW_ALL" => "N",
		"PAGER_SHOW_ALWAYS" => "N",
		"PAGER_TEMPLATE" => ".default",
		"PAGER_TITLE" => "Товары",
		"PAGE_ELEMENT_COUNT" => "21",
		"PARTIAL_PRODUCT_PROPERTIES" => "N",
		"PRICE_CODE" => array(
			0 => "Продажи через сайт РУБ",
			1 => "Продажи через сайт EUR",
			2 => "Продажи через сайт CNY",
		),
		"PRICE_VAT_INCLUDE" => "Y",
		"PRODUCT_ID_VARIABLE" => "id",
		"PRODUCT_PROPERTIES" => array(
			0 => "NEWPRODUCT",
			1 => "RECOMMENDED",
			2 => "SALELEADER",
			3 => "CML2_MANUFACTURER",
			4 => "CML2_TRAITS",
			5 => "CML2_TAXES",
			6 => "CML2_ATTRIBUTES",
			7 => "BREND",
		),
		"PRODUCT_PROPS_VARIABLE" => "prop",
		"PRODUCT_QUANTITY_VARIABLE" => "quantity",
		"PRODUCT_SUBSCRIPTION" => "N",
		"PROPERTY_CODE" => array(
			0 => "DIAMETR",
			1 => "NAIMENOVANIE_DLYA_POISKA",
			2 => "NEWPRODUCT",
			3 => "RECOMMENDED",
			4 => "DIAPAZON_IZMERENIY",
			5 => "SALELEADER",
			6 => "SHAG_REZBY",
			7 => "GRUPPA_OBRABATYVAEMYKH_MATERIALOV",
			8 => "STANDART",
			9 => "TIP_SHTANGENTSIRKULYA",
			10 => "BLOG_POST_ID",
			11 => "CML2_ARTICLE",
			12 => "CML2_BASE_UNIT",
			13 => "DLINA_REZHUSHCHEY_CHASTI",
			14 => "WR_COATING",
			15 => "BLOG_COMMENTS_CNT",
			16 => "vote_count",
			17 => "THREAD_PER_INCH",
			18 => "POKRYTIE",
			19 => "HAS_PREVIEW_PICTURE",
			20 => "CML2_MANUFACTURER",
			21 => "THREAD_SIZE",
			22 => "MATERIAL",
			23 => "rating",
			24 => "CML2_TRAITS",
			25 => "CML2_TAXES",
			26 => "STANDARD",
			27 => "vote_sum",
			28 => "HOLE_TYPE",
			29 => "THREAD_TYPE",
			30 => "ACCURACY",
			31 => "CML2_ATTRIBUTES",
			32 => "TSENA_DELENIYA",
			33 => "THREAD_STEP",
			34 => "CML2_BAR_CODE",
			35 => "MATERIAL_1",
			36 => "NAPRAVLENIE_REZANIYA",
			37 => "OKHLAZHDENIE",
			38 => "RAZMER_SW",
			39 => "OBSHCHAYA_DLINA",
			40 => "DOPUSK",
			41 => "BREND",
			42 => "",
		),
		"SECTION_CODE" => $_REQUEST["SECTION_CODE"],
		"SECTION_ID" => $_REQUEST["SECTION_ID"],
		"SECTION_ID_VARIABLE" => "SECTION_ID ",
		"SECTION_URL" => "/catalog/#SECTION_CODE#/",
		"SECTION_USER_FIELDS" => array(
			0 => "",
			1 => "",
		),
		"SEF_MODE" => "Y",
		"SET_BROWSER_TITLE" => "Y",
		"SET_LAST_MODIFIED" => "N",
		"SET_META_DESCRIPTION" => "Y",
		"SET_META_KEYWORDS" => "Y",
		"SET_STATUS_404" => "N",
		"SET_TITLE" => "Y",
		"SHOW_404" => "N",
		"SHOW_ALL_WO_SECTION" => "N",
		"SHOW_CLOSE_POPUP" => "N",
		"SHOW_DISCOUNT_PERCENT" => "N",
		"SHOW_OLD_PRICE" => "N",
		"SHOW_PRICE_COUNT" => "1",
		"USE_MAIN_ELEMENT_SECTION" => "N",
		"USE_PRICE_COUNT" => "N",
		"USE_PRODUCT_QUANTITY" => "N",
		"USE_VOTE_RATING" => "Y",
		"VOTE_DISPLAY_AS_RATING" => "vote_avg",
		"COMPONENT_TEMPLATE" => ".default",
		"SEF_RULE" => "",
		"SECTION_CODE_PATH" => $_REQUEST["SECTION_CODE_PATH"],
		"CURRENCY_ID" => "RUB"
	),
	false
);?><br>
</div>
<?php if(!$_REQUEST["SECTION_CODE"]):?>
	<script>
		$(document).ready(function (){
			$('#brandProducts [data-alt-url]').each(function (i, el){
				if($(el).data('alt-url') != ''){
					$(el).attr('href', $(el).data('alt-url'));
				}
			});
		});
	</script>
<?php endif;?>
