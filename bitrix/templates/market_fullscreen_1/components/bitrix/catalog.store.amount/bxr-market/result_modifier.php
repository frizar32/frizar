<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

if ($arParams["SHOW_EMPTY_STORE"] == "N") {
	foreach ($arResult["STORES"] as $key => $store) {
		if ($store["REAL_AMOUNT"] <= 0) {
			unset($arResult["STORES"][$key]);
		}
	}
	sort($arResult["STORES"]);
}