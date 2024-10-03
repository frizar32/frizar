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
<div class="certificates">
<?foreach($arResult["ITEMS"] as $arItem):?>
	<?
	$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
	$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
	?>
	<a data-fancybox="images" data-rel="gallery" data-fancybox-group="bx-gallery" href="<?=$arItem["PREVIEW_PICTURE"]["SRC"]?>" class="fancybox certificates__item" id="<?=$this->GetEditAreaId($arItem['ID']);?>">
		<img class="certificates__item__image" alt="<?=$arItem['NAME']?>" title="<?=$arItem['NAME']?>" src="<?=$arItem["PREVIEW_PICTURE"]["THUMB"]?>">
	</a>
<?endforeach;?>
</div>

<script>
    var img = document.querySelectorAll('.certificates__item__image');

    for(var i in img) {
        img[i].oncontextmenu = function() {
            return false;
        }
    }
</script>

<script type="text/javascript">
$(document).ready(function() {
    $("a.fancybox").fancybox();
});
</script>

<style>
	.fancybox-image {
		-webkit-user-select: none;
		-moz-user-select: none;
		user-select: none;
		pointer-events: none;
	}
	.certificates__item,
	.certificates__item__image {
		-webkit-user-select: none;
		-moz-user-select: none;
		user-select: none;
	}

</style>