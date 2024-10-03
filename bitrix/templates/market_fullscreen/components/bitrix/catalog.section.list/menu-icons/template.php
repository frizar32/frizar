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

<div class="aside-catalog-menu">
	<div class="aside-catalog-menu__button">
			<div class="acmb__btn">
				<span class="acmb__btn__icon">
						<svg xmlns="http://www.w3.org/2000/svg" width="25" height="15" viewBox="0 0 25 15" fill="none">
						<path d="M0 1.61191H25" stroke="white" stroke-width="2"/>
						<path d="M0 7.61191H25" stroke="white" stroke-width="2"/>
						<path d="M0 13.6119H25" stroke="white" stroke-width="2"/>
					</svg>
				</span>
				<span class="acmb__btn__text">Каталог</span>
			</div>
	</div>
	<div class="aside-catalog-menu__list">
		<?php foreach ($arResult['PARENTS'] as &$arSection)
		{
				$this->AddEditAction($arSection['ID'], $arSection['EDIT_LINK'], $strSectionEdit);
				$this->AddDeleteAction($arSection['ID'], $arSection['DELETE_LINK'], $strSectionDelete, $arSectionDeleteParams);
		?>

			<a href="<?php echo $arSection['SECTION_PAGE_URL']; ?>"
			   data-trigger-section="<?=$arSection['ID'];?>"
			   class="acml-item"
			   id="<?php echo $this->GetEditAreaId($arSection['ID']); ?>"
			>
				<span class="acml__icon"><?php echo $arSection['~UF_SVG'];?></span>
				<span class="acml__text"><?php echo $arSection['NAME'];?></span>
				<?php if(isset($arResult['CHILDS'][$arSection['ID']])):?><i class="fa fa-angle-right"></i><?php endif;?>
			</a>
			<?php if(isset($arResult['CHILDS'][$arSection['ID']])):?>
				<div class="aside-catalog-menu_child__list" data-target-section="<?=$arSection['ID'];?>">
					<?php foreach ($arResult['CHILDS'][$arSection['ID']] as &$arChildSection):?>
							<a class="child-section" href="<?= $arChildSection['SECTION_PAGE_URL']?>"><?= $arChildSection['NAME']?></a>
					<?php endforeach;?>
				</div>
			<?endif;?>
		<?}?>

	</div>
</div>


