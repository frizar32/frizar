<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true)
    die();
/** @var array $templateData */
/** @var @global CMain $APPLICATION */
global $MESS;
include_once(GetLangFileName(dirname(__FILE__) . '/lang/', '/template.php'));

global $APPLICATION;
global $moreSettings;

$APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH . '/js/fancybox/jquery.fancybox.pack.js');
$APPLICATION->SetAdditionalCSS(SITE_TEMPLATE_PATH . '/js/fancybox/jquery.fancybox.css');