<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");?>

<?/*$APPLICATION->IncludeComponent(
    "alexkova.market:catalog.product.subscribe.list",
    "",
    Array(
            "CACHE_TIME" => "3600",
            "CACHE_TYPE" => "A",
            "LINE_ELEMENT_COUNT" => "3"
    )
);*/?>
<?$APPLICATION->IncludeComponent(
    "bitrix:catalog.product.subscribe.list",
    "",
    Array(
            "CACHE_TIME" => "3600",
            "CACHE_TYPE" => "A",
            "LINE_ELEMENT_COUNT" => "3"
    )
);?>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>