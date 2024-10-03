<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<? $this->setFrameMode( true ); ?>
<div class="header-row">
	<h2 class="color_style"><?=$arResult["NAME"]?></h2>
	<a href="/company/brands/">Смотреть все</a>
</div>
<div class="brands_list">
	<?foreach( $arResult["ITEMS"] as $arItem ){
		$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
		$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
		?>
		<div class="brands_item" id="<?=$this->GetEditAreaId($arItem['ID']);?>">
			<a href="<?=$arItem["DETAIL_PAGE_URL"]?>" title="<?=$arItem["NAME"]?>">
				<?if( is_array($arItem["PREVIEW_PICTURE"]) ){?>
					<img border="0" src="<?=$arItem["PREVIEW_PICTURE"]["SRC"]?>" alt="<?=($arItem["PREVIEW_PICTURE"]["ALT"]?$arItem["PREVIEW_PICTURE"]["ALT"]:$arItem["NAME"]);?>" title="<?=($arItem["PREVIEW_PICTURE"]["TITLE"]?$arItem["PREVIEW_PICTURE"]["TITLE"]:$arItem["NAME"]);?>" />
				<?}elseif( is_array($arItem["DETAIL_PICTURE"]) ){?>
					<img border="0" src="<?=$arItem["DETAIL_PICTURE"]["SRC"]?>" alt="<?=($arItem["DETAIL_PICTURE"]["ALT"]?$arItem["DETAIL_PICTURE"]["ALT"]:$arItem["NAME"]);?>" title="<?=($arItem["DETAIL_PICTURE"]["TITLE"]?$arItem["DETAIL_PICTURE"]["TITLE"]:$arItem["NAME"]);?>" />
				<?}?>
			</a>
		</div>
	<?}?>
</div>

<?=$arResult["NAV_STRING"]?>
