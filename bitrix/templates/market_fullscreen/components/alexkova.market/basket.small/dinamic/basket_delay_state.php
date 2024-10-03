<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

	<i class="fa fa-shopping-cart"></i><br />
		<?
		if(is_countable($arResult["BASKET_ITEMS"]["DELAY"]) && count($arResult["BASKET_ITEMS"]["DELAY"])){
			$count_delay =  count($arResult["BASKET_ITEMS"]["DELAY"]);
		}
		else{
			$count_delay = 0;
		}
		if(is_countable($arResult["BASKET_ITEMS"]["CAN_BUY"]) && count($arResult["BASKET_ITEMS"]["CAN_BUY"])){
			$count_basket = count($arResult["BASKET_ITEMS"]["CAN_BUY"]);
		}
		else{
			$count_basket = 0;
		}
		?>
        <?$basket_delay_cnt = $count_basket + $count_delay;?>
	<?=$basket_delay_cnt?>
<!--<br /><span class="bxr-format-price"><?=$arResult["FORMAT_SUMM"]?></span>-->
