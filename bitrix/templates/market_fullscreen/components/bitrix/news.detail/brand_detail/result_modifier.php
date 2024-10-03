<? if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();
//Выбираем все товары этого бренда

$arElems = [];
$arResult["FILTER_ITEMS_ID"] = [];
$arSelect = Array("ID", "IBLOCK_ID", "IBLOCK_SECTION_ID");
$arFilter = Array("IBLOCK_ID"=> 17, "ACTIVE"=>"Y", "!IBLOCK_SECTION_ID" => false, "=PROPERTY_BREND_VALUE" => $arResult['PROPERTIES']['NAME_TO_CATALOG']['VALUE'], "INCLUDE_SUBSECTIONS" => "Y");
$res = CIBlockElement::GetList(Array(), $arFilter, false, false, $arSelect);
while($ob = $res->GetNextElement())
{
    $arProps = $ob->GetProperties();
    $arFields = $ob->GetFields();
    //echo '<pre>'; print_r($arFields); echo '</pre>';
    if($arProps["BREND"]["VALUE"]){
        $arSectionsId[] = $arFields["IBLOCK_SECTION_ID"]; //разделы с этим брендом
        $arResult["FILTER_ITEMS_ID"][] = $arFields['ID']; // айдишники для фильтра товаров

    }
}
if(is_array($arSectionsId))
{
	$arSectionsId = array_unique($arSectionsId);

	$arFilter = array('IBLOCK_ID' => 17, 'ID' => count($arSectionsId) > 0 ? $arSectionsId : 0);
	$rsSections = CIBlockSection::GetList(array(), $arFilter, array("CNT_ACTIVE" => "Y"), array("NAME", "CODE"));
	$arResult["TAGS_ITEMS"] = [];

	while ($arSection = $rsSections->Fetch())
	{
		$arResult["TAGS_ITEMS"][] = [
			"NAME" => $arSection['NAME'],
			"CODE" => $arSection['CODE']
		];
	}
}
$this->__component->SetResultCacheKeys(['FILTER_ITEMS_ID', 'TAGS_ITEMS', 'DETAIL_PAGE_URL']);


