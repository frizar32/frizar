<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
if($arResult['CATALOG_SUBSCRIBE'] == 'Y')
    $showSubscribeBtn = true;
else
    $showSubscribeBtn = false;
$usePriceCount = ('Y' == $arParams['USE_PRICE_COUNT']);
global $ratio_settings,$bxr_ratio_prop_code;

if (count($arResult["OFFERS"]) > 0) {
    foreach ($arResult["OFFERS"] as $offer) :?>
        <div class="offers-btn-wrap" style="display: none" data-item="<?=$offer["ID"]?>">
            <?if ($offer["CATALOG_QUANTITY"] <= 0 && $offer["CATALOG_CAN_BUY_ZERO"] == "N" || !$offer["PRICES"]) :
                if($showSubscribeBtn) {?>
                    <div class="bxr-subscribe-wrap">
                        <?$APPLICATION->includeComponent('alexkova.market:catalog.product.subscribe','',
                            array(
                                'PRODUCT_ID' => $offer['ID'],
                                'BUTTON_ID' => 'bxr-'.$offer['ID'].'-subscribe',
                                'BUTTON_CLASS' => 'bxr-color-button bxr-subscribe',
                            ),
                            $component, array('HIDE_ICONS' => 'Y')
                        );?>
                    </div>
                <?} else {?>
                    <button class="bxr-color-button bxr-trade-request" value="<?=$offer["ID"]?>">
                        <?if (strlen($arParams["MESS_BTN_REQUEST"]) > 0):
                            echo $arParams["TO_BASKET"];
                        else:
                            echo GetMessage("TO_BASKET");
                        endif;?>
                    </button>
                <?}
            else:
                $qtyMax = ($offer["CATALOG_CAN_BUY_ZERO"] == "Y") ? 0 : $offer["CATALOG_QUANTITY"];

                $ratio = 1;

                if($ratio_settings == "own_prop" && strlen($bxr_ratio_prop_code)>0
                        && isset($offer["PROPERTIES"][$bxr_ratio_prop_code]["VALUE"]) && is_numeric($offer["PROPERTIES"][$bxr_ratio_prop_code]["VALUE"]))
                    $ratio = $offer["PROPERTIES"][$bxr_ratio_prop_code]["VALUE"];
                elseif($ratio_settings == "base")
                    $ratio = $offer["CATALOG_MEASURE_RATIO"];

                $quantity = ($ratio > $offer["CATALOG_QUANTITY"] && $offer["CATALOG_QUANTITY"]>0) ? $offer["CATALOG_QUANTITY"] : $ratio;
                ?>
                <form class="bxr-basket-action bxr-basket-group bxr-currnet-torg">
                    <input type="button" class="bxr-quantity-button-minus" value="-" data-item="<?=$offer["ID"]?>" data-ratio="<?=$ratio;?>">
                    <input type="text" name="quantity" value="<?=$quantity;?>" class="bxr-quantity-text" data-item="<?=$offer["ID"]?>">
                    <input type="button" class="bxr-quantity-button-plus" value="+" data-item="<?=$offer["ID"]?>" data-ratio="<?=$ratio;?>" data-max="<?=$qtyMax?>">
                    <button class="bxr-color-button bxr-basket-add" onclick="yaCounter49057298.reachGoal('add_to_cart'); return true;">
                            <?/*!--<span class="fa fa-shopping-cart"></span>--*/
		    if (strlen($arParams["MESS_BTN_BUY"]) > 0):
				echo $arParams["MESS_BTN_BUY"];
		    else:
	            echo GetMessage("TO_BASKET");
		    endif;?>
                    </button>
                    <input class="bxr-basket-item-id" type="hidden" name="item" value="<?=$offer["ID"]?>">
                    <input type="hidden" name="action" value="add">
                </form>
		<?if ($useOneClick):
                //--one click buy block--
				?><div class="bxr-basket-action">
                    <button class="bxr-color-button bxr-one-click-buy" data-item="<?=$offer["ID"]?>">
		    <?if (strlen($arParams["USE_ONE_CLICK_TEXT"]) > 0):
				echo $arParams["USE_ONE_CLICK_TEXT"];
		    else:
	            echo GetMessage("ONE_CLICK_BUY");
		    endif;?>
                    </button>
                </div>
		<?endif;?>
                <div class="clearfix"></div>
            <?endif;?>
        </div>
<?  endforeach;
} else {?>
    <script>
        trade_name = "<?=$arResult['NAME']?>";
        trade_id = "<?=$arResult['ID']?>";
        trade_link = "<?=$arResult['~DETAIL_PAGE_URL']?>";
        formRequestMsg = "<?=GetMessage('TRADE_REQUEST_MSG')?>";
        formRequestMsg = formRequestMsg.replace("#TRADE_NAME#",'<?=htmlspecialchars($arResult['NAME'],ENT_QUOTES, SITE_CHARSET)?>');
    </script>

    <?if ($arResult["CATALOG_QUANTITY"] <= 0 && $arResult["CATALOG_CAN_BUY_ZERO"] == "N"
        || (!$arResult["PRICES"] && !$usePriceCount) || ((!$arResult["PRICE_MATRIX"] || !$arResult['PRICE_MATRIX']['ROWS']) && $usePriceCount)) {
        if($showSubscribeBtn) {?>
            <div class="bxr-subscribe-wrap">
                <?$APPLICATION->includeComponent('alexkova.market:catalog.product.subscribe','',
                    array(
                        'PRODUCT_ID' => $arResult['ID'],
                        'BUTTON_ID' => $arItemIDs['SUBSCRIBE_LINK'],
                        'BUTTON_CLASS' => 'bxr-color-button bxr-subscribe',
                    ),
                    $component, array('HIDE_ICONS' => 'Y')
                );?>
            </div>
			<pre style="display: none;">
						<?print_r(array(
                                'PRODUCT_ID' => $arResult['ID'],
                                'BUTTON_ID' => 'bxr-'.$arResult['ID'].'-subscribe',
                                'BUTTON_CLASS' => 'bxr-color-button bxr-subscribe',
                            ));?>
						</pre>
        <?} else {?>
            <button class="bxr-color-button bxr-trade-request" value="<?=$arResult["ID"]?>">
                <?if (strlen($arParams["MESS_BTN_REQUEST"]) > 0):
                    echo $arParams["MESS_BTN_REQUEST"];
                else:
                    echo GetMessage("REQUEST_BTN");
                endif;?>
            </button>
        <?}
    } else {
        $qtyMax = ($arResult["CATALOG_CAN_BUY_ZERO"] == "Y") ? 0 : $arResult["CATALOG_QUANTITY"];

        $ratio = 1;

        if($ratio_settings == "own_prop" && strlen($bxr_ratio_prop_code)>0
                && isset($arResult["PROPERTIES"][$bxr_ratio_prop_code]["VALUE"]) && is_numeric($arResult["PROPERTIES"][$bxr_ratio_prop_code]["VALUE"]))
            $ratio = $arResult["PROPERTIES"][$bxr_ratio_prop_code]["VALUE"];
        elseif($ratio_settings == "base")
            $ratio = $arResult["CATALOG_MEASURE_RATIO"];

        $quantity = ($ratio > $arResult["CATALOG_QUANTITY"] && $arResult["CATALOG_QUANTITY"]>0) ? $arResult["CATALOG_QUANTITY"] : $ratio;
        ?>
        <?if ($arResult["BASKET_PROPS"]["REQUIRED_CHECK"] || $arResult["BASKET_PROPS"]["OPTIONAL_CHECK"]) {?>
            <table id="bxr-bprop-table">
                <?foreach ($arResult["BASKET_PROPS"]["REQUIRED_CHECK"] as $pCode) {?>
                    <tr>
                        <td class="bxr-bprop-name"><?=$pCode["NAME"]?>: </td>
                        <td class="bxr-bprop-value">
                            <div class="bxr-bprop-tooltip"><?=GetMessage('SELECT_BPROP')?> <?=$pCode["NAME"]?><i class="fa fa-caret-down"></i></div>
                            <select class="bxr-bprop-required bxr-bprop-select" id="bxr-bprop-required-<?=$pCode["ID"]?>" data-required="Y" data-code="<?=$pCode["CODE"]?>" data-name="<?=$pCode["NAME"]?>" data-sort="<?=$pCode["SORT"]?>">
                                <option value="false"><?=GetMessage("BPROP_NOT_SELECT")?></option>
                                <?foreach ($pCode["VALUE"] as $val) {?>
                                    <option value="<?=$val?>"><?=$val?></option>
                                <?}?>
                            </select>
                        </td>
                    </tr>
                <?}
                foreach ($arResult["BASKET_PROPS"]["OPTIONAL_CHECK"] as $pCode) {?>
                    <tr>
                        <td class="bxr-bprop-name"><?=$pCode["NAME"]?>: </td>
                        <td class="bxr-bprop-value">
                            <select class="bxr-bprop-optional bxr-bprop-select" data-required="N" data-code="<?=$pCode["CODE"]?>" data-name="<?=$pCode["NAME"]?>" data-sort="<?=$pCode["SORT"]?>">
                                <option value="<?=GetMessage("BPROP_NOT_SELECT")?>"><?=GetMessage("BPROP_NOT_SELECT")?></option>
                                <?foreach ($pCode["VALUE"] as $val) {?>
                                    <option value="<?=$val?>"><?=$val?></option>
                                <?}?>
                            </select>
                        </td>
                <?}?>
            </table>
        <?}?>
        <form class="bxr-basket-action bxr-basket-group bxr-currnet-torg">
            <input type="button" class="bxr-quantity-button-minus" value="-" data-item="<?=$arResult["ID"]?>" data-ratio="<?=$ratio;?>">
            <input type="text" name="quantity" value="<?=$quantity;?>" class="bxr-quantity-text" data-item="<?=$arResult["ID"]?>">
            <input type="button" class="bxr-quantity-button-plus" value="+" data-item="<?=$arResult["ID"]?>" data-ratio="<?=$ratio;?>" data-max="<?=$qtyMax?>">
            <button class="bxr-color-button bxr-basket-add" onclick="yaCounter49057298.reachGoal('add_to_cart'); return true;">
            <?
            /*if ($arResult["CATALOG_QUANTITY"] > 0): */
    		    if (strlen($arParams["MESS_BTN_BUY"]) > 0):
    				echo $arParams["MESS_BTN_BUY"];
    		    else:
    	            echo GetMessage("TO_BASKET");
    		    endif;
            /*else:
                echo GetMessage("ORDER_BTN");
            endif;*/
            ?>
            </button>
            <input class="bxr-basket-item-id" type="hidden" name="item" value="<?=$arResult["ID"]?>">
            <input type="hidden" name="action" value="add">
        </form>
	<?if ($useOneClick):
        //--one click buy block--
        ?><div class="bxr-basket-action">
            <button class="bxr-color-button bxr-one-click-buy" onclick="yaCounter49057298.reachGoal('get_by_1_klick'); return true;" data-item="<?=$arResult["ID"]?>">
	    <?if (strlen($arParams["USE_ONE_CLICK_TEXT"]) > 0):
			echo $arParams["USE_ONE_CLICK_TEXT"];
	    else:
            echo GetMessage("ONE_CLICK_BUY");
	    endif;?>
            </button>
        </div>
	<?endif;?>
        <div class="clearfix"></div>
    <?}
}

    if ($useShare || $useCompare || $useFavorites):?>
    <div class="bxr-detail-torg-btn">
        <?if ($useShare):
        //--share block--
        ?><div class="bxr-share-group">
            <span class="fa fa-share-alt hidden-md"></span>
	    <?if (strlen($arParams["USE_SHARE_TEXT"]) > 0):
			echo $arParams["USE_SHARE_TEXT"];
	    else:
	    	echo GetMessage("SHARE");
	    endif;?>
        </div>
	<?endif;
        if ($useCompare):
        //--compare block--
        ?><div class="bxr-basket-group">
            <button class="bxr-indicator-item white bxr-indicator-item-compare bxr-compare-button" value="" data-item="<?=$arResult["ID"]?>">
                <span class="fa fa-bar-chart hidden-md" aria-hidden="true"></span>
		    <?if (strlen($arParams["MESS_BTN_COMPARE"]) > 0):
				echo $arParams["MESS_BTN_COMPARE"];
		    else:
		    	echo GetMessage("COMPARE");
		    endif;?>
            </button>
        </div>
        <?endif;
        if ($useFavorites):
        //--favor block--?>
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
	<?endif;?>
        <div class="clearfix"></div>
    </div>

    <div class="inform-detail">

        <div class="inform-detail_send">
            <img src="/images/card/icons-truck.png" alt="">
            <a href="/delivery/">Информация о доставке</a>
            <p>При заказе на сумму менее 15 000 рублей доставка осуществляется любой транспортной компанией за счет покупателя</p>
        </div>

        <div class="inform-detail_pay">
                <img src="/images/card/icons-mastercard-credit-card.png" alt="">
                <a href="/payment/">Информация об оплате</a>
                <p>Для онлайн оплаты на нашем сайте мы предлагаем множество вариантов</p>
        </div>

    </div>


    <?endif;
    if ($useShare):?>
	<div class="bxr-share-icon-wrap">
	    <?$APPLICATION->IncludeComponent(
	            "bitrix:main.share",
	            "element_detail",
	            Array(
	                    "COMPONENT_TEMPLATE" => ".default",
	                    "HANDLERS" => $arParams["HANDLERS"],
	                    "HIDE" => "N",
	                    "PAGE_TITLE" => $arResult["NAME"],
	                    "PAGE_URL" => $arResult["DETAIL_PAGE_URL"],
	                    "SHORTEN_URL_KEY" => "",
	                    "SHORTEN_URL_LOGIN" => ""
	            ),
	            false,
	            array("HIDE_ICONS" => "Y")
	    );?>
	</div>
    <?endif;
