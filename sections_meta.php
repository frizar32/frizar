<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");?>
<?
CModule::IncludeModule("iblock");
CModule::IncludeModule("catalog");


$arFilter = Array("IBLOCK_ID" => IntVal(17));
$items = GetIBlockSectionList(IntVal(17));
while($arItem = $items->GetNext())
{
	$title = "{=this.Name}";
	$mydesc = "Предлагаем вам ознакомиться с продукцией, представленной в каталоге " . "{=this.Name}" . ".";

	$arFields = Array(
		"SECTION_META_TITLE" => $title,
		"SECTION_META_DESCRIPTION" => $mydesc,
	);
	echo $arItem . '<br><br>';
	$ipropTemplates = new \Bitrix\Iblock\InheritedProperty\SectionTemplates($arItem["IBLOCK_ID"], $arItem["ID"]);
	$ipropTemplates->set($arFields);
}
?>