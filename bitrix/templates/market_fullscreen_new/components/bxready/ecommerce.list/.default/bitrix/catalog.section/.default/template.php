<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

use Alexkova\Bxready\Draw;
//use Alexkova\Bxready\Library;

$draw = Alexkova\Bxready\Draw::getInstance();

$this->setFrameMode(true);

$elementTemplate = ".default";

global $unicumID;
if ($unicumID<=0) {$unicumID = 1;} else {$unicumID++;}

$arParams["UNICUM_ID"] = $unicumID;
$arParams["SKU_PROPS_LIST"] = $arResult["SKU_PROPS_LIST"];
$arParams["SKU_PROPS"] = $arResult["SKU_PROPS"];

$colToElem = array();
$bootstrapGridCount = $arParams["BXREADY_LIST_BOOTSTRAP_GRID_STYLE"];
if ($bootstrapGridCount>0){
	for($i=1; $i<=$bootstrapGridCount; $i++){
		if (($bootstrapGridCount % $i) == 0){
			$colToElem[$bootstrapGridCount / $i] = $i;
		}
	}
}



if (count($arResult["ITEMS"])>0):
        if (strlen($arParams["PAGE_BLOCK_TITLE"])>0):
                $addClass = '';
                if (strlen($arParams["PAGE_BLOCK_TITLE_GLYPHICON"])>0){
                        $addClass = 'glyphicon glyphicon-pad '.$arParams["PAGE_BLOCK_TITLE_GLYPHICON"];
                }
                ?>                <div class="<?=$addClass?> h2 bold" style="font-size: 19px;"><?=$arParams["PAGE_BLOCK_TITLE"]?></div>
        <?endif;
        if (strlen($arParams["PROP_NAME_FOR_BLOCK_TITLE"])>0):?>
                <h3><?=$arParams["PROP_NAME_FOR_BLOCK_TITLE"]?></h3>
        <?endif;?>
	<div class="row bxr-list"><?

		

		if ($arParams["BXREADY_LIST_SLIDER"] == "Y") {?>
		<div id="sl_<?=$unicumID?>">
			<?}else{
				if ($arParams["DISPLAY_TOP_PAGER"])
				{
					?><? echo $arResult["NAV_STRING"]; ?><?
				}
			}
			
			$prodIDs = array();
			foreach ($arResult["ITEMS"] as $cell => $arItem):
				
				$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
				$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
				$strMainID = $this->GetEditAreaId($arItem['ID']);
                                $arParams["AREA_ID"] = $strMainID;
                                $arParams["~ADD_URL_TEMPLATE"] = $arResult["~ADD_URL_TEMPLATE"];
                                $arParams["~BUY_URL_TEMPLATE"] = $arResult["~BUY_URL_TEMPLATE"];
                                $arParams["~COMPARE_URL_TEMPLATE"] = $arResult["~COMPARE_URL_TEMPLATE"];
				
				$prodIDs[] = $arItem['ID'];
				
				$arElementDrawParams = array(
					"ELEMENT" => $arItem,
					"PARAMS" => $arParams
				);
				


				?><div id="<?=$strMainID?>" class="t_<?=$unicumID?> col-lg-<?=$arParams["BXREADY_LIST_LG_CNT"]?> col-md-<?=$arParams["BXREADY_LIST_MD_CNT"]?> col-sm-<?=$arParams["BXREADY_LIST_SM_CNT"]?> col-xs-<?=$arParams["BXREADY_LIST_XS_CNT"]?>"><?

					
					$draw->setCurrentTemplate($this);
						$draw->showElement($arParams["BXREADY_ELEMENT_DRAW"], $arItem, $arParams);
					?>
				</div>
			<? endforeach; ?>
		</div>
		<?
$cnt_page = $arResult["NAV_RESULT"]->NavPageCount; // получаем кол-во страниц
$num_page = $_REQUEST["PAGEN_".$arResult['NAV_RESULT']->NavNum];

if($num_page==1)
    LocalRedirect($APPLICATION->GetCurPage());
 
if ($cnt_page > 1 ) {
  
    if(empty($num_page)){ // если первая страница
        $APPLICATION->AddHeadString('<link rel="next" href="'.$APPLICATION->GetCurPage(false).'?PAGEN_'.$arResult['NAV_RESULT']->NavNum.'=2">',true);
    } else {
        if($num_page == 2) { // если это вторая страница
            $APPLICATION->AddHeadString('<link rel="prev" href="'.$APPLICATION->GetCurPage(false).'">',true); // предыдущая страница
            $APPLICATION->AddHeadString('<link rel="next" href="'.$APPLICATION->GetCurPage(false).'?PAGEN_'.$arResult['NAV_RESULT']->NavNum.'='. ($num_page+1) .'">',true); // следующая страница
        } elseif ($num_page > 2 && $num_page < $cnt_page) { // если страница от 2 до макс. страницы
            $APPLICATION->AddHeadString('<link rel="prev" href="'.$APPLICATION->GetCurPage(false).'?PAGEN_'.$arResult['NAV_RESULT']->NavNum.'='. ($num_page-1) .'">',true); // предыдущая страница
            $APPLICATION->AddHeadString('<link rel="next" href="'.$APPLICATION->GetCurPage(false).'?PAGEN_'.$arResult['NAV_RESULT']->NavNum.'='. ($num_page+1) .'">',true); // следующая страница
         
        } elseif ($num_page == $cnt_page) { // если последняя страница
            $APPLICATION->AddHeadString('<link rel="prev" href="'.$APPLICATION->GetCurPage(false).'?PAGEN_'.$arResult['NAV_RESULT']->NavNum.'='. ($num_page-1) .'">',true); 
        }
    }
}
?>
		<?if ($arParams["BXREADY_LIST_SLIDER"] == "Y") {?>
	</div>



	<script>
		function isTouchDevice() {
			try {
				document.createEvent('TouchEvent');
				return true;
			}
			catch(e) {
				return false;
			}
		}
		<?if ($arParams["HIDE_SLIDER_ARROWS"] == "Y" || !isset($arParams["HIDE_SLIDER_ARROWS"])) {?>
		if (!isTouchDevice()) {
			prevBtn = '<button type="button" class="bxr-color-button slick-prev hidden-arrow"></button>';
			nextBtn = '<button type="button" class="bxr-color-button slick-next hidden-arrow"></button>';
		}
		<?} else {?>
		if (!isTouchDevice()) {
			prevBtn = '<button type="button" class="bxr-color-button slick-prev"></button>';
			nextBtn = '<button type="button" class="bxr-color-button slick-next"></button>';
		}
		<?}?>
		<?if ($arParams["HIDE_MOBILE_SLIDER_ARROWS"] == "Y") {?>
		if (isTouchDevice()) {
			prevBtn = '<button type="button" class="bxr-color-button slick-prev hidden-arrow"></button>';
			nextBtn = '<button type="button" class="bxr-color-button slick-next hidden-arrow"></button>';
		}
		<?} else {?>
		if (isTouchDevice()) {
			prevBtn = '<button type="button" class="bxr-color-button slick-prev"></button>';
			nextBtn = '<button type="button" class="bxr-color-button slick-next"></button>';
		}
		<?}?>
		$('#sl_'+<?=$unicumID?>).slick({
			<?if ($arParams["BXREADY_LIST_SLIDER_MARKERS"] == "Y") {?>
			dots: true,
			<?}?>
			infinite: true,
			speed: 300,
			<?if ($arParams["BXREADY_LIST_HIDE_MOBILE_SLIDER_AUTOSCROLL"] == "Y") {?>
			autoplay: true,
			autoplaySpeed: <?=intval($arParams["BXREADY_LIST_HIDE_MOBILE_SLIDER_SCROLLSPEED"])>0 ? intval($arParams["BXREADY_LIST_HIDE_MOBILE_SLIDER_SCROLLSPEED"]) :  2000?>,
			<?}?>
			<?if ($arParams["VERTICAL_SLIDER_MODE"] == "Y") {?>
			vertical: true,
			<?}?>
			slidesToShow: <?=$colToElem[$arParams["BXREADY_LIST_LG_CNT"]]?>,
			slidesToScroll: 1,
			prevArrow: prevBtn,
			nextArrow: nextBtn,
			responsive: [
				{
					breakpoint: 1199,
					settings: {
						slidesToShow: <?=$colToElem[$arParams["BXREADY_LIST_MD_CNT"]]?>,
						slidesToScroll: 1
					}
				},
				{
					breakpoint: 991,
					settings: {
						slidesToShow: <?=$colToElem[$arParams["BXREADY_LIST_SM_CNT"]]?>,
						slidesToScroll: 1
					}
				},
				{
					breakpoint: 767,
					settings: {
						slidesToShow: <?=$colToElem[$arParams["BXREADY_LIST_XS_CNT"]]?>,
						slidesToScroll: 1
					}
				},
			]
		});
	</script>
<?}
	else{
		if ($arParams["DISPLAY_BOTTOM_PAGER"])
		{
			echo $arResult["NAV_STRING"];
		}
	}
	

endif;?><script>
var google_tag_params = {
	ecomm_prodid: [<?=implode(",", $prodIDs)?>],
<?if (isset($_GET['q'])):?>
	ecomm_pagetype: "searchresults",
<?else:?>
	ecomm_pagetype: "category",
	ecomm_category: "<?=$arResult['NAME']?>"
<?endif;?>
};
</script>
