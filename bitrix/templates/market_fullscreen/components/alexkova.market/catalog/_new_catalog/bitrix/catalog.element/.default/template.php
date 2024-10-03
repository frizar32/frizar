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
$this->setFrameMode(true);
global $moreSettings;
$templateData = array(
    'TEMPLATE_THEME' => $this->GetFolder().'/themes/'.$arParams['TEMPLATE_THEME'].'/style.css',
    'TEMPLATE_CLASS' => 'bx_'.$arParams['TEMPLATE_THEME']
);
$strMainID = $this->GetEditAreaId($arResult['ID']);
$arItemIDs = array(
    'ID' => $strMainID,
    'PICT' => $strMainID.'_pict',
    'DISCOUNT_PICT_ID' => $strMainID.'_dsc_pict',
    'STICKER_ID' => $strMainID.'_sticker',
    'BIG_SLIDER_ID' => $strMainID.'_big_slider',
    'BIG_IMG_CONT_ID' => $strMainID.'_bigimg_cont',
    'SLIDER_CONT_ID' => $strMainID.'_slider_cont',
    'SLIDER_LIST' => $strMainID.'_slider_list',
    'SLIDER_LEFT' => $strMainID.'_slider_left',
    'SLIDER_RIGHT' => $strMainID.'_slider_right',
    'OLD_PRICE' => $strMainID.'_old_price',
    'PRICE' => $strMainID.'_price',
    'DISCOUNT_PRICE' => $strMainID.'_price_discount',
    'SLIDER_CONT_OF_ID' => $strMainID.'_slider_cont_',
    'SLIDER_LIST_OF_ID' => $strMainID.'_slider_list_',
    'SLIDER_LEFT_OF_ID' => $strMainID.'_slider_left_',
    'SLIDER_RIGHT_OF_ID' => $strMainID.'_slider_right_',
    'QUANTITY' => $strMainID.'_quantity',
    'QUANTITY_DOWN' => $strMainID.'_quant_down',
    'QUANTITY_UP' => $strMainID.'_quant_up',
    'QUANTITY_MEASURE' => $strMainID.'_quant_measure',
    'QUANTITY_LIMIT' => $strMainID.'_quant_limit',
    'BUY_LINK' => $strMainID.'_buy_link',
    'ADD_BASKET_LINK' => $strMainID.'_add_basket_link',
    'COMPARE_LINK' => $strMainID.'_compare_link',
    'PROP' => $strMainID.'_prop_',
    'PROP_DIV' => $strMainID.'_skudiv',
    'DISPLAY_PROP_DIV' => $strMainID.'_sku_prop',
    'OFFER_GROUP' => $strMainID.'_set_group_',
    'BASKET_PROP_DIV' => $strMainID.'_basket_prop',
        'SUBSCRIBE_LINK' => $strMainID.'_subscribe',
);
$strObName = 'ob'.preg_replace("/[^a-zA-Z0-9_]/", "x", $strMainID);
$templateData['JS_OBJ'] = $strObName;

$strTitle = (
    isset($arResult["IPROPERTY_VALUES"]["ELEMENT_DETAIL_PICTURE_FILE_TITLE"]) && '' != $arResult["IPROPERTY_VALUES"]["ELEMENT_DETAIL_PICTURE_FILE_TITLE"]
    ? $arResult["IPROPERTY_VALUES"]["ELEMENT_DETAIL_PICTURE_FILE_TITLE"]
    : $arResult['NAME']
);
$strAlt = (
    isset($arResult["IPROPERTY_VALUES"]["ELEMENT_DETAIL_PICTURE_FILE_ALT"]) && '' != $arResult["IPROPERTY_VALUES"]["ELEMENT_DETAIL_PICTURE_FILE_ALT"]
    ? $arResult["IPROPERTY_VALUES"]["ELEMENT_DETAIL_PICTURE_FILE_ALT"]
    : $arResult['NAME']
);

$useVoteRating = ('Y' == $arParams['USE_VOTE_RATING']);
$useReview = ('Y' == $arParams['USE_REVIEW']);
$storeAmount = ('Y' == $arParams['USE_STORE']);
$useCompare = ('Y' == $arParams['DISPLAY_COMPARE']);
$useFavorites = ('Y' == $arParams['USE_FAVORITES']);
$useShare = ('Y' == $arParams['USE_SHARE']);
$useOneClick = ('Y' == $arParams['USE_ONE_CLICK']);
$noTabs = ('Y' == $arParams['NO_TABS']);

$show_files = false;
if( isset($arParams["DETAIL_DISPLAY_SHOW_FILES"]) && $arParams["DETAIL_DISPLAY_SHOW_FILES"] == "Y" &&
 (!empty($arResult["PROPERTIES"]["FILES"]["VALUE"]) || !empty($arResult["PROPERTIES"]["UF_FILES"]))) {
    $show_files = true;
}

$show_video = false;
if(isset($arParams["DETAIL_DISPLAY_SHOW_VIDEO"]) && $arParams["DETAIL_DISPLAY_SHOW_VIDEO"] == "Y") {
    if(!empty($arResult["PROPERTIES"]["UF_VIDEO"]))
        $show_video = true;

    if(!empty($arResult["PROPERTIES"]["VIDEO"]["VALUE"]) && !empty($arResult["PROPERTIES"]["VIDEO"]["VALUE"][0]))
        $show_video = true;
    else
        unset($arResult["PROPERTIES"]["VIDEO"]["VALUE"][0]);
}

foreach($arParams["PREVIEW_DETAIL_PROPERTY_CODE"] as $propertyCode)
{
    $arResult["DISPLAY_PREVIEW_PROPERTIES"][$propertyCode] = $arResult["DISPLAY_PROPERTIES"][$propertyCode];

    if ($arParams["HIDE_PREVIEW_PROPS_INLIST"] == 'Y'):
        unset($arResult["DISPLAY_PROPERTIES"][$propertyCode]);
    endif;
}

if ($arParams["ARTICLE_POSITION"] && $arParams["ARTICLE_POSITION"] != "none")
{
    $articlePropCode = ($arParams["ARTICLE_PROP_CODE"] && strlen($arParams["ARTICLE_PROP_CODE"])>0) ? $arParams["ARTICLE_PROP_CODE"] : 'CML2_ARTICLE';
    $articlePropName = $arResult["PROPERTIES"][$articlePropCode]["NAME"];
    $articleValue = $arResult["PROPERTIES"][$articlePropCode]["VALUE"];
    $articleBlock = '<div class="bxr-article-block '.$arParams["ARTICLE_POSITION"].'"><span class="bxr-article-name">'.$articlePropName.': '.'</span>';
    $articleBlock .= '<span class="bxr-article-value">'.$articleValue.'</span></div>';
}
?>

<?if ($arParams["ARTICLE_POSITION"] && $arParams["ARTICLE_POSITION"] == "after_name" && strlen($articleValue)>0):?>
    <?=$articleBlock?>
<?endif;?>

<?//include_once 'top_tabs.php';?>


<?//echo '<pre>';print_r($arResult['PROPERTIES']['CML2_TRAITS']['VALUE'][2]);echo '</pre>';?>


<div class="row">
 <!--//////////////////////////////////новая версия детальной страницы////////////////////////////////////-->
		<div class="new-catalog-detail-page">
			<div class="top-bar-element">
				<div class="top-bar-element-right">
					<!--Код товара-->
					<div class="top-bar-element-right-code">Код товара: <?=$arResult['PROPERTIES']['CML2_TRAITS']['VALUE'][2]?></div>
					<!--Код товара-->
					<!--Рейтинг -->
						<?
						if ($useVoteRating)
						{?>
							<div class="bxr-rating-wrap"<?=($arResult["PROPERTIES"]["rating"]["VALUE"] > 0)?' itemprop="aggregateRating" itemscope itemtype="https://schema.org/AggregateRating"':''?>>
						<?if($arResult["PROPERTIES"]["rating"]["VALUE"] > 0) :?>
						<meta itemprop="ratingValue" content="<?=$arResult["PROPERTIES"]["rating"]["VALUE"]?>">
						<meta itemprop="ratingCount" content="<?=$arResult["PROPERTIES"]["vote_count"]["VALUE"]?>">
							<?  endif;

						$APPLICATION->IncludeComponent(
								"bitrix:iblock.vote",
								"stars",
								array(
										"IBLOCK_TYPE" => $arParams['IBLOCK_TYPE'],
										"IBLOCK_ID" => $arParams['IBLOCK_ID'],
										"ELEMENT_ID" => $arResult['ID'],
										"ELEMENT_CODE" => "",
										"MAX_VOTE" => "5",
										"VOTE_NAMES" => array("1", "2", "3", "4", "5"),
										"SET_STATUS_404" => "N",
										"DISPLAY_AS_RATING" => $arParams['VOTE_DISPLAY_AS_RATING'],
										"CACHE_TYPE" => $arParams['CACHE_TYPE'],
										"CACHE_TIME" => $arParams['CACHE_TIME']
								),
								$component,
								array("HIDE_ICONS" => "Y")
							);?>
							</div>
						<?}
						include_once 'quantity.php';?>
					<!--Рейтинг -->
				</div>
				<div class="top-bar-element-left">
				<!--Избранное-->
				<?if ($useFavorites):?>
					<form class="bxr-basket-action bxr-basket-group">
						<button class="bxr-indicator-item white bxr-indicator-item-favor bxr-basket-favor" data-item="<?=$arResult["ID"]?>" tabindex="0">
							<span class="fa fa-heart-o hidden-md"></span>
						<?if (strlen($arParams["USE_FAVORITES_TEXT"]) > 0):
							echo $arParams["USE_FAVORITES_TEXT"];
						else:
							echo GetMessage("FAVORITES");
						endif;?>
						</button>
						<input type="hidden" name="item" value="<?=$arResult["ID"]?>" tabindex="0">
						<input type="hidden" name="action" value="favor" tabindex="0">
						<input type="hidden" name="favor" value="yes">
					</form>
				<?endif?>
				<!--Избранное-->
				<!--Сравнение-->
				<?if ($useCompare):?>
				<div class="bxr-basket-group">
					<button class="bxr-indicator-item white bxr-indicator-item-compare bxr-compare-button" value="" data-item="<?=$arResult["ID"]?>">
						<span class="fa fa-bar-chart hidden-md" aria-hidden="true"></span>
					<?if (strlen($arParams["MESS_BTN_COMPARE"]) > 0):
						echo $arParams["MESS_BTN_COMPARE"];
					else:
						echo GetMessage("COMPARE");
					endif;?>
					</button>
				</div>
				<?endif?>
				<!--Сравнение-->
				</div>
			</div>
			<div class="base-info-element"></div>
		</div>
<!--//////////////////////////новая версия детальной страницы//////////////////////////////////-->
</div>
<div class="row">
	<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
        <?//--slider block, also includes manufacturer logo, sale icons and value--
        if (count($arResult["MORE_PHOTO"]) > 0):
            include_once 'slider.php';
        endif;?>
    </div>
    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 bxr-detail-right bxr-detail-right_flex">

	<div class="bxr-detail-right first">
<?if ($arParams["PROPS_TAB_VIEW"] == "LIST") {?>
    <div class="bxr-props-block">
        <?foreach($arResult["DISPLAY_PROPERTIES"] as $key => $arProperty):
            if (!in_array($key, $arParams["PREVIEW_DETAIL_PROPERTY_CODE"]) || $arParams["HIDE_PREVIEW_PROPS_INLIST"] == 'N'):
                if (!is_array($arProperty["DISPLAY_VALUE"]) && $arProperty["DISPLAY_VALUE"]){?>
                        <div itemprop="additionalProperty" itemscope itemtype="https://schema.org/PropertyValue">
                                <h5 class="bxr-props-name">
                                    <b><span itemprop="name"><?=(!empty($arProperty["DESCRIPTION"][0])) ? $arProperty["DESCRIPTION"][0] : $arProperty["NAME"];?></span></b>
                                    <?if ($arProperty["HINT"]):?>
                                        <div class="item_title_hint_chint">
                                            <i id="item_title_hint_<?echo $arProperty["ID"]?>" class="fa fa-question-circle"></i>
                                            <div><?=$arProperty["HINT"]?></div>
                                        </div>
                                    <?endif;?>
                                </h5>
                                <div class="bxr-props-data"><span itemprop="value"><?=$arProperty["DISPLAY_VALUE"]?></span></div>
                        </div>
                <?}elseif (is_array($arProperty["DISPLAY_VALUE"]) && count($arProperty["DISPLAY_VALUE"]>0)){

                        $withDesc = false;
                        foreach($arProperty["DESCRIPTION"] as $cell=>$val){
                            if ($val) {
                                $withDesc = true;
                                break;
                            }
                        }
                        if ($withDesc) {?>
                            <div>
                                <h5 class="bxr-props-data bxr-props-data-group">
                                    <b><?=$arProperty["NAME"]?></b>
                                    <?if ($arProperty["HINT"]):?>
                                        <div class="item_title_hint_chint">
                                            <i id="item_title_hint_<?echo $arProperty["ID"]?>" class="fa fa-question-circle"></i>
                                            <div><?=$arProperty["HINT"]?></div>
                                        </div>
                                    <?endif;?>
                                </h5>
                            <?foreach($arProperty["DISPLAY_VALUE"] as $cell=>$val){?>
                                <div itemprop="additionalProperty" itemscope itemtype="https://schema.org/PropertyValue">
                                    <b><span class="bxr-props-name no-bold" itemprop="name"><?=$arProperty["DESCRIPTION"][$cell]?>: </span></b>
                                    <span class="bxr-props-data" itemprop="value"><?=$val?></span>
                                </div>
                            <?}?>
                            </div>
                        <?} else {?>
                            <div itemprop="additionalProperty" itemscope itemtype="https://schema.org/PropertyValue">
                                <h5 class="bxr-props-name">
                                    <span itemprop="name"><?=$arProperty["NAME"]?>:</span>
                                    <?if ($arProperty["HINT"]):?>
                                        <div class="item_title_hint_chint">
                                            <i id="item_title_hint_<?echo $arProperty["ID"]?>" class="fa fa-question-circle"></i>
                                            <div><?=$arProperty["HINT"]?></div>
                                        </div>
                                    <?endif;?>
                                </h5>
                                <div class="bxr-props-data"><span itemprop="value"><?=  implode(', ', $arProperty["DISPLAY_VALUE"])?></span></div>
                            </div>
                        <?}
                }
            endif;
        endforeach;?>

	</div>
<?} else {?>
    <div class="bxr-props-table">
        <?foreach($arResult["DISPLAY_PROPERTIES"] as $key => $arProperty):
		        if ($arProperty['ID'] == 151) continue;
            if (!in_array($key, $arParams["PREVIEW_DETAIL_PROPERTY_CODE"]) || $arParams["HIDE_PREVIEW_PROPS_INLIST"] == 'N'):
                if (!is_array($arProperty["DISPLAY_VALUE"]) && $arProperty["DISPLAY_VALUE"]){?>
                        <div class="bxr-props-row" itemprop="additionalProperty" itemscope itemtype="https://schema.org/PropertyValue">
                                <div class="bxr-props-name">
                                    <span itemprop="name"><?=(!empty($arProperty["DESCRIPTION"][0])) ? $arProperty["DESCRIPTION"][0] : $arProperty["NAME"];?>:</span>
                                    <?if ($arProperty["HINT"]):?>
                                        <div class="item_title_hint_chint">
                                            <i id="item_title_hint_<?echo $arProperty["ID"]?>" class="fa fa-question-circle"></i>
                                            <div><?=$arProperty["HINT"]?></div>
                                        </div>
                                    <?endif;?>
                                </div>
                                <div class="bxr-props-data"><span itemprop="value"><?=$arProperty["DISPLAY_VALUE"]?></span></div>
                        </div>
                <?}elseif (is_array($arProperty["DISPLAY_VALUE"]) && count($arProperty["DISPLAY_VALUE"]) > 0){

                        $withDesc = false;
                        foreach($arProperty["DESCRIPTION"] as $cell=>$val){
                            if ($val) {
                                $withDesc = true;
                                break;
                            }
                        }
                        if ($withDesc) {?>
                            <div class="bxr-props-row">
                                    <div colspan="2" class="bxr-props-data bxr-props-data-group">
                                            <b><?=$arProperty["NAME"]?></b>
                                            <?if ($arProperty["HINT"]):?>
                                                <div class="item_title_hint_chint">
                                                    <i id="item_title_hint_<?echo $arProperty["ID"]?>" class="fa fa-question-circle"></i>
                                                    <div><?=$arProperty["HINT"]?></div>
                                                </div>
                                            <?endif;?>
                                    </div>
                            </div>
                            <?foreach($arProperty["DISPLAY_VALUE"] as $cell=>$val){?>
                                <?if($val !== "0"):?> <?/* custom */?>
                                    <div class="bxr-props-row" itemprop="additionalProperty" itemscope itemtype="https://schema.org/PropertyValue">
                                            <div class="bxr-props-name no-bold"><span itemprop="name"><?=$arProperty["DESCRIPTION"][$cell]?></span></div>
                                            <div class="bxr-props-data"><span itemprop="value"><?=$val?></span></div>
                                    </div>
                                <?endif;?>
                            <?}
                        } else {?>
                            <div class="bxr-props-row" itemprop="additionalProperty" itemscope itemtype="https://schema.org/PropertyValue">
                                <div class="bxr-props-name">
                                    <span itemprop="name"><?=$arProperty["NAME"]?>:</span>
                                    <?if ($arProperty["HINT"]):?>
                                        <div class="item_title_hint_chint">
                                            <i id="item_title_hint_<?echo $arProperty["ID"]?>" class="fa fa-question-circle"></i>
                                            <div><?=$arProperty["HINT"]?></div>
                                        </div>
                                    <?endif;?>
                                </div>
                                <div class="bxr-props-data"><span itemprop="value"><?=  implode(', ', $arProperty["DISPLAY_VALUE"])?></span></div>
                            </div>
                        <?}
                }
            endif;
        endforeach;?>
    </div>
<? } ?>
	<div class="button_more_prop" onclick='toSimilar("#bxr-detail-block-wrap");'>Все характеристики</div>
	<div class="button_more_prop brdr" onclick='toSimilar("#goodsTabs", "[data-good=similar]");'>Похожие товары</div>

</div>
	<div class="bxr-detail-right second">
			<?if ($arParams["ARTICLE_POSITION"] && $arParams["ARTICLE_POSITION"] == "right" && strlen($articleValue)>0):?>
            <?=$articleBlock?>
        <?endif;?>

        <div class="clearfix"></div>
        <?if ($arResult["PROPERTIES"]["CML2_ARTICLE"]["VALUE"] && false) {?>
            <div class="bxr-good-article">
                <?=GetMessage("BXR_ARTICLE_TITLE_DETAIL").": ".$arResult["PROPERTIES"]["CML2_ARTICLE"]["VALUE"]?>
            </div>
        <?}?>
        <div class="clearfix"></div>
    <?
        //--sku-select block -->
        if (count($arResult["OFFERS"]) > 0) {?>
            <div id="bxr-market-sku-select-wrap" class="tb20">
                <?  include_once 'sku_select.php';?>
            </div>
        <?}

        //--basket-btns block--
    ?>
        <!--<p class="bold"><?=GetMessage("SWITCH_REGION");?></p>
        <?$APPLICATION->IncludeComponent(
            "bitrix:sale.location.selector.search",
            "",
            Array(
                "COMPONENT_TEMPLATE" => ".default",
                "ID" => "",
                "CODE" => "",
                "INPUT_NAME" => "LOCATION",
                "PROVIDE_LINK_BY" => "id",
                "JSCONTROL_GLOBAL_ID" => "",
                "JS_CALLBACK" => "",
                "FILTER_BY_SITE" => "Y",
                "SHOW_DEFAULT_LOCATIONS" => "Y",
                "CACHE_TYPE" => "A",
                "CACHE_TIME" => "36000000",
                "FILTER_SITE_ID" => "s1",
                "INITIALIZE_BY_GLOBAL_EVENT" => "",
                "SUPPRESS_ERRORS" => "N"
            )
        );?>-->

        <div id="bxr-market-detail-basket-btn-wrap">
            <?  include_once 'basket_btn_new.php';?>
        </div>

        <?
        //--gift notice block--
        if ($arParams['USE_GIFTS_DETAIL'] == 'Y' && $arParams['SHOW_GIFTS_DETAIL_NOTICE'] == 'Y' && \Bitrix\Main\ModuleManager::isModuleInstalled("sale")){?>
        <div class="bxr-gift-notice bxr-border-color">
            <div class="bxr-gift-notice-icon bxr-color-button">
                <span class="fa fa-gift"></span>
            </div>
            <div class="bxr-gift-notice-text">
                <a href="javascript:void(0);" class="bxr-gift-notice-main"><?=GetMessage("BXR_GIFT_NOTICE_TITLE")?></a>
                <span class="bxr-gift-notice-add"><?=(strlen($arParams["BXR_GIFT_NOTICE_TEXT"])>0) ? $arParams["BXR_GIFT_NOTICE_TEXT"] : GetMessage("BXR_GIFT_NOTICE_TEXT")?></span>
            </div>
            <div class="clearfix"></div>
        </div>
        <?}

        if ($arResult["PreviewBlockShow"]) {?>
            <div class="bxr-detail-preview-wrap">
                <?if ($arResult["PreviewTextShow"]) {
                    include_once 'anounce.php';
                }
                if (count($arParams["PREVIEW_DETAIL_PROPERTY_CODE"]) > 0) {
                    include_once 'preview_props.php';
                }?>
            </div>
        <?}?>

	</div>



    </div>
    <div class="clearfix"></div>
</div>
<div class="row tb20 <?if($noTabs) echo "bxr-detail-block-no-tabs";?>" id="bxr-detail-block-wrap">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 detail_char">
        <?
            if ($arResult['OFFER_GROUP'])
                include_once 'set.php';

            if(!$noTabs)
                include_once 'tabs.php';

            if(is_array($arResult["TABS"]) && count($arResult["TABS"]) > 0):
                foreach ($arResult["TABS"] as $k => $tab):
                        if(isset($tab["epilog"]) && $tab["epilog"])
                                continue;

                        if(is_array($tab["echo"]) && count($tab["echo"]) > 0)
                                foreach($tab["echo"] as $v) {
                                    echo $v;
                                }

                        if(is_array($tab["include_top"]) && count($tab["include_top"]) > 0)
                                foreach($tab["include_top"] as $v) {
                                    include_once $v;
                                }

                        if(empty($tab["name"]))
                                continue;

                        if($k == "props" && count($arResult["DISPLAY_PROPERTIES"])===0)
                                continue;
                    ?>
                    <div class="bxr-detail-tab-mobile-title  hidden-lg hidden-md hidden-sm h3 bold" data-tab="<?=$k?>"><?=$tab["name"]?></div><hr class="section">
                    <div class="bxr-detail-tab <?=$tab["class"]?>"<?=(strlen($tab["id"]) > 0)?'id="'.$tab["id"].'"':''?> data-tab="<?=$k?>">
                        <?
                            if(is_array($tab["include"]) && count($tab["include"])>0)
                                    foreach($tab["include"] as $v) {
										include_once $v;
                                    }
                        ?>
                    </div>
            <?  endforeach;
            endif;?>
    </div>
    <?/*

    */?>
    <!-- <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
        <div class="row">
            <div class="block_reviews">
                <div class="block_reviews_title">Отзывы</div> -->

                <?/*<div class="block_reviews_descr_add"><a href="javascript: void(0)">Добавить комментарий</a></div>*/?>

                <?/*$APPLICATION->IncludeComponent("bitrix:catalog.comments",
                        "comments_reviews",
                        Array(
                                "ELEMENT_ID" => $arResult["ID"],
                                "ELEMENT_CODE" => "",
                                "IBLOCK_ID" => $arParams["IBLOCK_ID"],
                                "URL_TO_COMMENT" => "",
                                "WIDTH" => "",
                                "COMMENTS_COUNT" => "10",
                                "BLOG_USE" => "Y",
                                "FB_USE" => "N",
                                "FB_APP_ID" => "",
                                "VK_USE" => "N",
                                "VK_API_ID" => "",
                                "CACHE_TYPE" => $arParams["CACHE_TYPE"],
                                "CACHE_TIME" => $arParams["CACHE_TIME"],
                                "BLOG_TITLE" => "",
                                "BLOG_URL" => "catalog_comments"."_".SITE_ID,
                                "PATH_TO_SMILE" => "",
                                "EMAIL_NOTIFY" => "N",
                                "AJAX_POST" => "Y",
                                "SHOW_SPAM" => "Y",
                                "SHOW_RATING" => "N",
                                "FB_TITLE" => "",
                                "FB_USER_ADMIN_ID" => "",
                                "FB_COLORSCHEME" => "light",
                                "FB_ORDER_BY" => "reverse_time",
                                "VK_TITLE" => "",
                                "TEMPLATE_THEME" => $arParams["~TEMPLATE_THEME"],
                        ),
                        false,
                        array("HIDE_ICONS" => "Y")
                );*/?>
            <!-- </div>
        </div>
    </div> -->
</div>
<script>
  function toSimilar(anckor, clickToTab = false) {
    if(clickToTab)
      $(clickToTab).trigger('click');
    $('html,body').animate({scrollTop: $(anckor).offset().top}, 1000);
  }
</script>
