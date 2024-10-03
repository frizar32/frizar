<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
/** @var array $arParams */
/** @var array $arResult */

foreach($arResult["ITEMS"] as &$arItem)
{
    if(is_array($arItem["PREVIEW_PICTURE"]))
    {
        $file = CFile::ResizeImageGet($arItem["PREVIEW_PICTURE"], array('width'=>182, 'height'=>257), BX_RESIZE_IMAGE_EXACT, true);
        $arItem["PREVIEW_PICTURE"]["THUMB"] =  $file['src'];
    }
}