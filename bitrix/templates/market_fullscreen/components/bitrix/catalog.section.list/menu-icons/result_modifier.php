<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

$arResult['PARENTS'] = [];
$arResult['CHILDS'] = [];

foreach ($arResult['SECTIONS'] as &$arSection)
{
    if($arSection['DEPTH_LEVEL'] == 1)
    {
        $arResult['PARENTS'][] = $arSection;
    }
    else{
        $arResult['CHILDS'][$arSection['IBLOCK_SECTION_ID']][] = $arSection;
    }
}
unset($arResult['SECTIONS']);
