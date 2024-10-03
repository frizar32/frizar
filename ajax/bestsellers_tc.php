<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");

$arParams = array();
//If component params are stored in SESSION
if (isset($_SESSION["BXR_BESTSELLER_SETTINGS"]) && is_array($_SESSION["BXR_BESTSELLER_SETTINGS"])) {
    $arParams = $_SESSION["BXR_BESTSELLER_SETTINGS"];
} else {
    //if session is empty, trying to get params from DB (D7 only)
    $paramsTable = Bitrix\Main\Component\ParametersTable::getTableName();

    if ($paramsTable) {
        global $DB;

        $sqlString = "
            SELECT PARAMETERS FROM `" . $paramsTable . "`
                WHERE 
                    SITE_ID = '" . SITE_ID . "'
                    AND COMPONENT_NAME = 'alexkova.market:catalog.bestsellers'
                    AND PARAMETERS LIKE 'a%'
                    ORDER BY ID DESC
                    LIMIT 1
        ";

        $result = $DB->Query($sqlString);
        $componentParams = $result->Fetch();
        if ($componentParams) {
            $componentParams = unserialize($componentParams['PARAMETERS']);
            $arParams = $componentParams;
        }
    }
}

if ($arParams) {
    $APPLICATION->IncludeComponent(
        'alexkova.market:catalog.bestsellers',
        ".default",
        $arParams,
        false
    );
}

require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/epilog_after.php");
