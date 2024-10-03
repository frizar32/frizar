<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?$this->setFrameMode(true);
echo "<pre style='display: none;'>";print_r($arResult['PROPERTIES']['OTHER_ELEMENTS']['VALUE']);echo "</pre>";
$excludeProps = array('PRICE', 'OLD_PRICE', "MORE_URLS", "VIDEO");

$QueryTitle = COption::GetOptionString('alexkova.corporate', 'query_button_title', GetMessage('QUERY_BUTTON_TITLE'));
$SaleTitle = COption::GetOptionString('alexkova.corporate', 'query_button_title', GetMessage('SALE_BUTTON_TITLE'));

?>
<?
if(is_array($arParams["DETAIL_FIELD_CODE"]))
{
if (in_array("DATE_ACTIVE_FROM",$arParams["DETAIL_FIELD_CODE"]) || in_array("DATE_ACTIVE_TO",$arParams["DETAIL_FIELD_CODE"])):?>
        <div class="date-news">
<?if (in_array("DATE_ACTIVE_FROM",$arParams["DETAIL_FIELD_CODE"])):?>

                <?=$arResult["ACTIVE_FROM"]?>

<?endif;?>
<?if (in_array("DATE_ACTIVE_TO",$arParams["DETAIL_FIELD_CODE"])):?>

                / <?=$arResult["DATE_ACTIVE_TO"]?>

<?endif;?>
        </div>
<?endif;?>
<?}?>
<?if (is_array($arResult["DETAIL_PICTURE"])):?>
        <div class="bxr-news-image">
                <img src="<?=$arResult["DETAIL_PICTURE"]["SRC"]?>">
        </div>
<?endif;?>


<?if (count($arResult["FILES"])>0
	|| count($arResult["LINKS"])>0
		|| count($arResult["VIDEO"])>0):?>


<ul class="nav nav-tabs" role="tablist" id="details">

	<li role="presentation" class="active"><a href="#description" aria-controls="description" role="tab" data-toggle="tab"><?=GetMessage("DETAIL_TEXT_DESC")?></a></li>

	<?if (count($arResult["VIDEO"])>0):?>
		<li role="presentation"><a href="#video" aria-controls="video" role="tab" data-toggle="tab"><?=GetMessage("VIDEO_TAB_DESC")?></a></li>
	<?endif;?>
	<?if (count($arResult["FILES"])>0):?>
		<li role="presentation" ><a href="#files" aria-controls="files" role="tab" data-toggle="tab"><?=GetMessage("CATALOG_FILES")?></a></li>
	<?endif;?>
	<?if (count($arResult["LINKS"])>0):?>
		<li role="presentation"><a href="#links" aria-controls="video" role="tab" data-toggle="tab"><?=GetMessage("LINKS_TAB_DESC")?></a></li>
	<?endif;?>
</ul>

<div class="tab-content">
	<div role="tabpanel" class="tab-pane fade in active" id="description">
		<hr /><?echo $arResult["DETAIL_TEXT"];?>
	</div>

	<?if (count($arResult["FILES"])>0):?>
		<div id="files" class="element-files tb20 tab-pane fade" role="tabpanel">
			<hr />
			<?foreach ($arResult["FILES"] as $val):?>

				<?$template = "file_element";
				$arElementDrawParams = array(
					"DISPLAY_VARIANT" => $template,
					"ELEMENT" => array(
						"NAME" => $val["ORIGINAL_NAME"],
						"LINK" => $val["SRC"],
						"CLASS_NAME"=>$val["EXTENTION"]
					)
				);
?>
				<?
				$APPLICATION->IncludeComponent(
					"alexkova.corporate:element.draw",
					".default",
					$arElementDrawParams,
					false
				)
				?>

			<?endforeach;?>

		</div><div class="clearfix"></div>
	<?endif;?>

	<?if (count($arResult["LINKS"])>0):?>
		<div id="links" class="element-files tb20 tab-pane fade" role="tabpanel">
			<hr />
			<?foreach ($arResult["LINKS"] as $val):?>

				<?$template = "glyph_links";
				$arElementDrawParams = array(
					"DISPLAY_VARIANT" => $template,
					"ELEMENT" => array(
						"NAME" => $val["TITLE"],
						"LINK" => $val["LINK"],
						"GLYPH"=>array("GLYPH_CLASS" => "glyphicon-chevron-right"),
						"TARGET"=>"_blank"
					)
				);
				?>
				<?
				$APPLICATION->IncludeComponent(
					"alexkova.corporate:element.draw",
					".default",
					$arElementDrawParams,
					false
				)
				?>

			<?endforeach;?>

		</div><div class="clearfix"></div>
	<?endif;?>

	<?if (count($arResult["VIDEO"])>0):?>
		<div id="video" class="element-files tb20 tab-pane fade" role="tabpanel">
			<hr />
			<?foreach ($arResult["VIDEO"] as $val):?>

				<?$template = "video_card";
				$arElementDrawParams = array(
					"DISPLAY_VARIANT" => $template,
					"ELEMENT" => array(
						"VIDEO" => $val["LINK"],                  //������ �� �����
						"VIDEO_IMG" => '',               //������ �� ��������
						"VIDEO_IMG_WIDTH" => '150',         //������ �������� ��� �����
						"NAME" => $val["TITLE"]
					)
				);




				?>
				<div class="col-lg-3">
				<?
				$APPLICATION->IncludeComponent(
					"alexkova.corporate:element.draw",
					".default",
					$arElementDrawParams,
					false
				)
				?>
				</div>

			<?endforeach;?>

		</div><div class="clearfix"></div>
	<?endif;?>



</div>

<script>
	$(function () {
		$('#details a').click(function (e) {
			e.preventDefault();
			$(this).tab('show')
		})
	})
</script>
<?else:?>
	<?echo $arResult["DETAIL_TEXT"];?>
<div style="display: block;">
    <div class="row bxr-list" style="height: auto;">
    <?
    CModule::IncludeModule("catalog");
    $arSelect = Array("ID", "NAME", "DETAIL_PAGE_URL", "CATALOG_GROUP_1","CATALOG_GROUP_3", "DETAIL_PICTURE");
    $arFilter = Array("IBLOCK_ID"=>17, "ID"=>$arResult['PROPERTIES']['OTHER_ELEMENTS']['VALUE'], "ACTIVE"=>"Y");
    $res = CIBlockElement::GetList(Array(), $arFilter, false, Array("nPageSize"=>50), $arSelect);
    while($ob = $res->GetNextElement())
    {
        $arFields = $ob->GetFields();
        $img = CFile::GetPath($arFields["DETAIL_PICTURE"]);
        $ar_price = CPrice::GetBasePrice($arFields['ID']); //самая базовая цена
        if(isset($ar_price['PRICE']))
        {
            $price = $ar_price['PRICE'];
        }
        else if($arFields['CATALOG_PRICE_3'])
        {
            $price = $arFields['CATALOG_PRICE_3'];

        } else {
            $price = round(CCurrencyRates::ConvertCurrency($arFields['CATALOG_PRICE_1'], "EUR", "RUB"),2);
        }

        //echo '<pre>'; print_r($arFields); echo '</pre>';
        ?>
        <div class="<?/*id="bx_1970176138_6450"*/?> t_1 col-lg-3 col-md-3 col-sm-6 col-xs-6">
            <div class="bxr-ecommerce-v2-lite" data-uid="0" data-resize="1" <?/*id="bx_1970176138_6450"*/?> style="height: 434px;">
                <div class="bxr-element-container" style="height: 400px;">
                    <div class="bxr-element-image">
                        <a href="<?=$arFields['DETAIL_PAGE_URL']?>">
                            <img src="<?=$img?>" width="160" height="160" <?/*id="bx_1970176138_6450_pict"*/?>"
                                 alt="<?=$arFields['NAME']?>" title="<?=$arFields['NAME']?>">
                        </a>
                        <!--<button class="bxr-element-detail-button bxr-bg-hover-light hidden-sm hidden-xs">
                            <i class="fa fa-search-plus"></i>
                        </button>-->
                    </div>
                    <div class="bxr-ribbon-marker-vertical">

                    </div>

                    <div class="bxr-cart-basket-indicator">
                        <div class="bxr-indicator-item bxr-indicator-item-basket" data-item="<?=$arFields['ID']?>">
                            <span class="fa fa-shopping-cart"></span>
                            <span class="bxr-counter-item bxr-counter-item-basket" data-item="<?=$arFields['ID']?>">0</span>
                        </div>
                    </div>

                    <div class="bxr-sale-indicator ">
                        <div class="bxr-basket-group">
                            <form class="bxr-basket-action bxr-basket-group" action="">
                                <button class="bxr-indicator-item bxr-indicator-item-favor bxr-basket-favor" data-item="<?=$arFields['ID']?>" tabindex="0">
                                    <span class="fa fa-heart-o"></span>
                                </button>
                                <input type="hidden" name="item" value="<?=$arFields['ID']?>" tabindex="0">
                                <input type="hidden" name="action" value="favor" tabindex="0">
                                <input type="hidden" name="favor" value="yes">
                            </form>
                        </div>
                    </div>
                    <div class="bxr-element-name" id="bxr-element-name-6450" style="height: 60px;">
                        <a href="<?=$arFields['DETAIL_PAGE_URL']?>" <?/*id="bx_1970176138_6450"*/?> title="<?=$arFields['NAME']?>">
                            <?=$arFields['NAME']?>       </a>
                    </div>

<!--                    <div class="bxr-element-rating">-->
<!--                        <div class="bxr-stars-container">-->
<!--                            <div class="bxr-stars-bg"></div>-->
<!--                            <div class="bxr-stars-progres" style="width: 0%;"></div>-->
<!--                        </div>-->
<!--                    </div><div class="clearfix"></div>-->


                    <div class="bxr-element-price">
                        <div class="bxr-product-price-wrap">
                            <div class="bxr-market-item-price">
                                <!--old price-->
                                <!--current price with all discounts-->
                                <span class="bxr-market-current-price"><?=$price/100*20+$price?> руб.</span>
                                <div class="clearfix"></div>
                            </div>
                            <div class="clearfix"></div>
                        </div>
                    </div>

                    <div class="bxr-element-action" <?/*id="bx_1970176138_6450_basket_actions"*/?> ">
                        <!--basket-btns block-->
                        <form class="bxr-basket-action bxr-basket-group bxr-currnet-torg" action="">
                            <input type="button" class="bxr-quantity-button-minus" value="-" data-item="<?=$arFields['ID']?>" data-ratio="1">
                            <input type="text" name="quantity" value="1" class="bxr-quantity-text" data-item="<?=$arFields['ID']?>">
                            <input type="button" class="bxr-quantity-button-plus" value="+" data-item="<?=$arFields['ID']?>" data-ratio="1" data-max="0">
                            <button class="bxr-color-button bxr-color-button-small-only-icon bxr-basket-add" onclick="yaCounter49057298.reachGoal('get_by_1_klick'); return true;">
                                <span class="fa fa-shopping-cart"></span>
                            </button>
                            <input class="bxr-basket-item-id" type="hidden" name="item" value="<?=$arFields['ID']?>">
                            <input type="hidden" name="action" value="add">
                        </form>
                        <div class="clearfix"></div>
                    </div>
                </div>
            </div>

        </div>
        <?
        //echo $price.'<br />';
        //print_r($arFields);
       // print_r($ar_price);
    }

    ?>
    <?global $USER;
    if($USER->isAdmin()){

 }
    ?>
        <div style="clear: both;"></div>
    </div>
</div>


<?endif;?>







<style>
    .bxr-ecommerce-v2-lite{
        position: relative;
        padding: 0;
        margin-bottom: 20px;
    }
    .bxr-ecommerce-v2-lite .bxr-element-container{
        position: relative;
        border: 1px solid #f6f6f6;
        background: #FFF;
        padding: 0;
        padding-bottom: 10px;
        text-align: center;

    }
    .bxr-ecommerce-v2-lite:hover .bxr-element-container{
        position: absolute;
        width: 100%;
        border: 1px solid #f6f6f6;
        -webkit-box-shadow: 0px 0px 20px -3px rgba(0,0,0,0.1);
        -moz-box-shadow: 0px 0px 20px -3px rgba(0,0,0,0.1);
        box-shadow: 0px 0px 20px -3px rgba(0,0,0,0.1);
        z-index: 930;

    }
    .bxr-ecommerce-v2-lite .bxr-element-container .bxr-element-image{
        line-height: 160px;
        width: 180px;
        height: 160px;
        max-width: 100%;
        margin: 0 auto;
        text-align: center;
        margin-top: 10px;
        margin-bottom: 10px;
        position: relative;
    }
    .bxr-ecommerce-v2-lite .bxr-element-container .bxr-element-image img{
        display: inline !important;
        max-width: 100%;
        max-height: 100%;
        border: 0;
    }
    .bxr-ecommerce-v2-lite .bxr-element-container .bxr-element-detail-button{
        text-align: center;
        width: 64px;
        height: 64px;
        line-height: 32px;
        position: absolute;
        left: 50%;
        top: 50%;
        margin-left: -32px;
        margin-top: -32px;
        font-size: 27px;
        cursor: pointer;
        -webkit-appearance: button;
        border: none;
        border-collapse: collapse;
        background-color: #FFF;
        display: none;
    }
    .bxr-ecommerce-v2-lite:hover .bxr-element-container .bxr-element-detail-button{
        display: block;
    }

    .bxr-ecommerce-v2-lite:hover .bxr-element-container .bxr-element-image img{
        opacity: 0.5;
    }
    .bxr-ecommerce-v2-lite .bxr-element-container .bxr-element-name
    ,.bxr-ecommerce-v2-lite .bxr-element-container .bxr-element-rating
    ,.bxr-ecommerce-v2-lite .bxr-element-container .bxr-element-avail
    ,.bxr-ecommerce-v2-lite .bxr-element-container .bxr-element-price{
        padding: 0 10px;
        margin: 30px 0;
    }

    .bxr-ecommerce-v2-lite .bxr-element-container .bxr-element-name a{
        font-size: 13px;
        /*font-weight: bold;*/
        text-decoration: none;
    }

    .bxr-ecommerce-v2-lite .bxr-element-container .bxr-sale-indicator{
        position: absolute;
        width: 30px;
        top: 15px;
        left: auto;
        right: 10px;
    }

    .bxr-ecommerce-v2-lite .bxr-element-container .bxr-cart-basket-indicator{
        position: absolute;
        width: 60px;
        top: 130px;
        left: auto;
        right: 10px;
        text-align: right;
    }

    .bxr-ecommerce-v2-lite .bxr-element-container .bxr-cart-basket-indicator .bxr-indicator-item-basket{
        display: none;
    }
    .bxr-ecommerce-v2-lite .bxr-element-container .bxr-cart-basket-indicator .bxr-indicator-item-basket.bxr-indicator-item-active{
        display: inline-block;
    }

    .bxr-ecommerce-v2-lite .bxr-element-container .bxr-sale-indicator .bxr-basket-group{
        margin-bottom: 5px;
    }

    .bxr-ecommerce-v2-lite .bxr-element-container .bxr-color-button-small.bxr-basket-add{
        padding: 6px 10px 7px;
        font-size: 12px;
        font-weight: bold;
    }

    .bxr-ecommerce-v2-lite .bxr-element-container input.bxr-quantity-text
    ,.bxr-ecommerce-v2-lite .bxr-element-container input.bxr-quantity-button-minus
    ,.bxr-ecommerce-v2-lite .bxr-element-container input.bxr-quantity-button-plus
    {
        padding-top: 4px;
        padding-bottom: 4px;
    }

    .bxr-ecommerce-v2-lite .bxr-element-container .bxr-stars-container {
        position: relative;
        width: 70px;
        height: 11px;
        background: #dadada;
        background-size: 100% 100%;
    }

    .bxr-ecommerce-v2-lite .bxr-element-container .bxr-stars-container .bxr-stars-bg {
        position: absolute;
        top: 0;
        right: 0;
        bottom: 0;
        left: 0;
        z-index: 101;
        background: url(../images/stars.jpg) no-repeat center;
    }

    .bxr-ecommerce-v2-lite .bxr-element-container .bxr-stars-container .bxr-stars-progres {
        position: absolute;
        top: 0;
        bottom: 0;
        left: 0;
        background: #f18e00;
    }

    .bxr-ecommerce-v2-lite .bxr-element-container .bxr-indicator-item{
        display: none;
    }
    .bxr-ecommerce-v2-lite .bxr-element-container .bxr-indicator-item.bxr-indicator-item-active
    ,.bxr-ecommerce-v2-lite .bxr-element-container .bxr-indicator-item.bxr-counter-compare-active
    ,.bxr-ecommerce-v2-lite:hover .bxr-element-container .bxr-basket-favor
    ,.bxr-ecommerce-v2-lite:hover .bxr-element-container .bxr-compare-button
    {
        display: block;
    }

    .bxr-ecommerce-v2-lite .bxr-element-container .bxr-element-action{
        display: inline-block;
    }

    .bxr-market-current-price.bxr-market-format-price {
        font-weight: bold;
        font-size: 18px;
    }

    .bxr-market-old-price {
        text-decoration: line-through;
    }

    .bxr-instock-wrap .fa-check {
        margin-right: 6px;
        background: green;
        color: #fff;
        padding: 3px;
        border-radius: 2px;
        font-size: 9px;
    }

    .bxr-instock-wrap .fa-times {
        margin-right: 10px;
        background: red;
        color: #fff;
        padding: 2px 3px;
        border-radius: 2px;
        font-size: 11px;
        line-height: 11px;
    }

    .bxr-ecommerce-v2-lite .bxr-element-container .bxr-element-rating {
        margin: 10px auto 0;
        display: inline-block;
    }

    .bxr-ecommerce-v2-lite .bxr-element-container .bxr-element-action{
        padding-top: 10px;
        padding-bottom: 10px;
    }
    /*****************************************************/
    .bxr-ecommerce-v2-lite .bxr-element-container .bxr-element-offers{
        display: none;
    }

    .bxr-ecommerce-v2-lite .bxr-element-container .bxr-instock-wrap {
        width: 100%;
        margin-bottom: 10px;
    }

    .bxr-ecommerce-v2-lite .bxr-color-button-small-only-icon {
        height: 34px;
        width: 34px;
        border-radius: 2px;
    }

    .bxr-ecommerce-v2-lite .bxr-color-button {
        border-radius: 2px;
        text-transform: uppercase;
        font-weight: bold;
        font-size: 12px;
        display: inline-block;
    }

    .bxr-ecommerce-v2-lite .bxr-element-name table.bxr-element-props-table {
        width: 100%;
        font-size: 11px;
        margin-top: 5px;
        word-break: break-all;
    }
    .bxr-ecommerce-v2-lite .bxr-element-name table.bxr-element-props-table td.bxr-props-table-name,
    .bxr-ecommerce-v2-lite .bxr-element-name table.bxr-element-props-table td.bxr-props-table-value {
        padding: 5px;
    }
    .bxr-ecommerce-v2-lite .bxr-element-name table.bxr-element-props-table td.bxr-props-table-name{
        text-align: left;
        padding-left: 0;
    }
    .bxr-ecommerce-v2-lite .bxr-element-name table.bxr-element-props-table td.bxr-props-table-value{
        text-align: right;
        padding-right: 0;
    }

    .bxr-ecommerce-v2-lite .bxr-subscribe {
        cursor: pointer;
    }
</style>
