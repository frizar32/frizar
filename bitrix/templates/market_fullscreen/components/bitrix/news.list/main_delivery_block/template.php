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
?>
<div class="main_delivery_block">
<?foreach($arResult["ITEMS"] as $arItem):?>
	<?
	$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
	$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
	?>


		<?if($arItem["PROPERTIES"]["ITEM_LINK"]["VALUE"]):?>
			<a href="<?=$arItem["PROPERTIES"]["ITEM_LINK"]["VALUE"]?>" id="<?=$this->GetEditAreaId($arItem['ID']);?>" class="main_delivery_block_item" style="background-image: url('<?=$arItem['DISPLAY_PROPERTIES']['ITEM_BG']['FILE_VALUE']['SRC']?>');">
		<?else:?>
			<div id="<?=$this->GetEditAreaId($arItem['ID']);?>" class="main_delivery_block_item" style="background-image: url('<?=$arItem['DISPLAY_PROPERTIES']['ITEM_BG']['FILE_VALUE']['SRC']?>');">
		<?endif;?>
		<div class="main_delivery_block_title"><?=$arItem['NAME']?></div>
		<div class="main_delivery_block_list">
			<ul>
			<?foreach($arItem['DISPLAY_PROPERTIES']['ITEM_LIST']['VALUE'] as $k => $list):?>
				<?if($arItem['DISPLAY_PROPERTIES']['ITEM_LIST']['DESCRIPTION'][$k]):?>
					<li><a href="<?=$arItem['DISPLAY_PROPERTIES']['ITEM_LIST']['DESCRIPTION'][$k]?>"><?=$list?></a></li>
				<?else:?>
					<li><?=$list?></li>
				<?endif?>
	
			<?endforeach?>
			</ul>
		</div>
		<?if($arItem['DISPLAY_PROPERTIES']['ITEM_ICON']['FILE_VALUE']):?>
		<div class="main_delivery_block_icon">
			<img src="<?=$arItem['DISPLAY_PROPERTIES']['ITEM_ICON']['FILE_VALUE']['SRC']?>" alt="">
		</div>
		<?endif;?>
		<?if($arItem["PROPERTIES"]["ITEM_LINK"]["VALUE"]):?></a><?else:?> </div><?endif;?>

<?endforeach;?>
</div>