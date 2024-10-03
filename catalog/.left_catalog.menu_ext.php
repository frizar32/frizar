<?
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
use Alexkova\Market\Core;
global $APPLICATION;
$BXReady = \Alexkova\Market\Core::getInstance();
$areaType = $BXReady->getAreaType('left_menu_type');

$aMenuLinksExt = $APPLICATION->IncludeComponent(
	"alexkova.market:menu.sections",
	"",
	Array(
		"IS_SEF" => "Y",
		"ID" => $_REQUEST["ID"],
		"IBLOCK_TYPE" => "catalog",
		"IBLOCK_ID" => "17",
		"SECTION_URL" => "",
		"DEPTH_LEVEL" => "3",
		"CACHE_TYPE" => "N",
		"CACHE_TIME" => "0",
		"SEF_BASE_URL" => "/catalog/",
		"SECTION_PAGE_URL" => "#SECTION_CODE_PATH#/",
		"DETAIL_PAGE_URL" => "#SECTION_CODE#/#ELEMENT_CODE#/"
	),
        false,
        array("HIDE_ICONS" => "N")
);

foreach ($aMenuLinksExt as $k => &$val){
    if($k!="PICTURE")
	$val["DEPTH_LEVEL"]++;
}

if ($areaType == 'v2') {
    $aMenuLinks = $aMenuLinksExt;
} else {
    $aMenuLinks = array_merge($aMenuLinks, $aMenuLinksExt);
}

?>