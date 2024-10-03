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
<div class="main_help_block">
<div class="main_help_block_content">
<div class="main_help_title"><?=GetMessage("TITLE")?></div>
<div class="main_help_about"><a href="/company/"><?=GetMessage("ABOUT")?></a></div>
</div>
<div class="main_help_block_icons">
<?foreach($arResult["ITEMS"] as $arItem):?>
	<div class="main_help_block_item" >
		<div class="main_help_block_icon"><img src="<?=$arItem['DISPLAY_PROPERTIES']['ITEM_ICON']['FILE_VALUE']['SRC']?>" alt=""></div>
		<div class="main_help_block_title"><?=$arItem['NAME']?></div>
	</div>
<?endforeach;?>
</div>
</div>
