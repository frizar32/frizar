<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?$this->setFrameMode(true);
echo "<pre style='display: none;'>";print_r($arResult['PROPERTIES']['OTHER_ELEMENTS']['VALUE']);echo "</pre>";
$excludeProps = array('PRICE', 'OLD_PRICE', "MORE_URLS", "VIDEO");

$QueryTitle = COption::GetOptionString('alexkova.corporate', 'query_button_title', GetMessage('QUERY_BUTTON_TITLE'));
$SaleTitle = COption::GetOptionString('alexkova.corporate', 'query_button_title', GetMessage('SALE_BUTTON_TITLE'));

?>
<?if (in_array("DATE_ACTIVE_FROM",$arParams["DETAIL_FIELD_CODE"]) || in_array("DATE_ACTIVE_TO",$arParams["DETAIL_FIELD_CODE"])):?>
        <div class="date-news">
<?if (in_array("DATE_ACTIVE_FROM",$arParams["DETAIL_FIELD_CODE"])):?>

                <?=$arResult["ACTIVE_FROM"]?>

<?endif;?>
<?if (in_array("DATE_ACTIVE_TO",$arParams["DETAIL_FIELD_CODE"])):?>

                / <?=$arResult["DATE_ACTIVE_TO"]?>

<?endif;?>
        </div>
<?endif;?>

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
    $arSelect = Array("ID", "NAME", "DETAIL_PAGE_URL", "CATALOG_GROUP_3", "DETAIL_PICTURE");
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
        else
        {
            $price = $arFields['CATALOG_PRICE_3'];

        }
        ?>
        <div class="<?/*id="bx_1970176138_6450"*/?> t_1 col-lg-3 col-md-3 col-sm-6 col-xs-6">
            <div class="bxr-ecommerce-v2-lite" data-uid="0" data-resize="1" <?/*id="bx_1970176138_6450"*/?> style="height: 434px;">
                <div class="bxr-element-container" style="height: 446px;">
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

                    <div class="bxr-sale-indicator ololo">
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

                    <div class="bxr-element-rating">
                        <div class="bxr-stars-container">
                            <div class="bxr-stars-bg"></div>
                            <div class="bxr-stars-progres" style="width: 0%;"></div>
                        </div>
                    </div><div class="clearfix"></div>


                    <div class="bxr-element-price" <?/*id="bx_1970176138_6450_price"*/?>">
                        <div class="bxr-product-price-wrap">
                            <div class="bxr-market-item-price">
                                <!--old price-->
                                <!--current price with all discounts olololo-->
                                <span class="bxr-market-current-price"><?=$price/100*20+$price?></span>
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
        <div style="clear: both;"></div>
    </div>
</div>

<?endif;?>
