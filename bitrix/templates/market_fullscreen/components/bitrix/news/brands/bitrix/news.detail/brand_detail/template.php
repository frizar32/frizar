<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?$this->setFrameMode( true ); ?>

<div class="news_detail_wrapp ">
	<?if ($arResult["PREVIEW_TEXT"]):?>
		<div class="<?if ($left_side):?>right_side<?endif;?> preview_text"><?=$arResult["PREVIEW_TEXT"];?></div>
	<?endif;?>
	<?if( !empty($arResult["DETAIL_PICTURE"])):?>
		<div class="detail_picture_block">
			<?$img = CFile::ResizeImageGet($arResult["DETAIL_PICTURE"], array( "width" => 300, "height" => 225 ), BX_RESIZE_IMAGE_PROPORTIONAL, true, array() );?>
			<a href="<?=$arResult["DETAIL_PICTURE"]["SRC"]?>" class="fancy">
				<div class="fancy_hover" style="height:<?=$img["height"]?>px; width:<?=$img["width"]?>px;"></div>
				<img src="<?=$img["src"]?>" alt="<?=($arResult["DETAIL_PICTURE"]["ALT"] ? $arResult["DETAIL_PICTURE"]["ALT"] : $arResult["NAME"])?>" title="<?=($arResult["DETAIL_PICTURE"]["TITLE"] ? $arResult["DETAIL_PICTURE"]["TITLE"] : $arResult["NAME"])?>" height="<?=$img["height"]?>" width="<?=$img["width"]?>" />
			</a>
			<?if ($arResult["DETAIL_PICTURE"]["DESCRIPTION"]):?><div class="picture_description"><?=$arResult["DETAIL_PICTURE"]["DESCRIPTION"];?></div><?endif;?>
		</div>
	<?endif;?>
	<?if ($arResult["DETAIL_TEXT"]):?>
		<div class="detail_text is_cuted"><?=$arResult["DETAIL_TEXT"]?></div>
        <br>
        <div class="toggleText">
            <span class="js-show">Подробнее</span>
            <span class="js-hide" style="display: none;">Скрыть</span>
        </div>
	<?endif;?>
	<div class="clear"></div>

	<?if($arParams["SHOW_GALLERY"]=="Y" && $arResult["PROPERTIES"][$arParams["GALLERY_PROPERTY"]]["VALUE"]){?>
		<div>
			<ul class="module-gallery-list">
				<?
					$files = $arResult["PROPERTIES"][$arParams["GALLERY_PROPERTY"]]["VALUE"];		
					if(array_key_exists('SRC', $files)) 
					{
					   $files['SRC'] = '/' . substr($files['SRC'], 1);
					   $files['ID'] = $arResult["PROPERTIES"][$arParams["GALLERY_PROPERTY"]]["VALUE"][0];
					   $files = array($files);
					}
				?>
				<?	foreach($files as $arFile):?>
					<?
						$img = CFile::ResizeImageGet($arFile, array('width'=>175, 'height'=>125), BX_RESIZE_IMAGE_EXACT, true);
						
						$img_big = CFile::ResizeImageGet($arFile, array('width'=>800, 'height'=>600), BX_RESIZE_IMAGE_PROPORTIONAL, true);
						$img_big = $img_big['src'];
					?>
					<li>
						<a href="<?=$img_big;?>" class="fancy" data-fancybox-group="gallery">
							<div class="fancy_hover" style="height:<?=($img["height"]-6)?>px; width:<?=($img["width"]-6)?>px;"></div><?=CFile::ShowImage($img["src"]); ?>
						</a>				  
					</li>
				<?endforeach;?>
			</ul>
		</div>
	<?}?>
		
	<?//if ($arParams["SHOW_LINKED_PRODUCTS"] == "Y" && strlen($arParams["LINKED_PRODUCTS_PROPERTY"])):?>

	<?//endif;?>
	
	<?/*if ($arParams["SHOW_BACK_LINK"]=="Y"):?>
		<div class="back"><a class="button30" href="<?=$arResult["LIST_PAGE_URL"]?>"><span><?=GetMessage("BACK");?></span></a></div>
	<?endif;*/?>
</div>

<script>
    $('.toggleText span').on('click', function () {
        $(this).toggle().siblings().toggle();
        $(this).parent().siblings('.detail_text').toggleClass('is_cuted');
    });
</script>
