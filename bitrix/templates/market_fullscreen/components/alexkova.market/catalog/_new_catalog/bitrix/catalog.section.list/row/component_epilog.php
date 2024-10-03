<?$fSections = CIBlockSection::GetList(
    false,
    Array("IBLOCK_ID" => 23, "ID" => $arResult ['ID'], "ACTIVE"=>"Y", "GLOBAL_ACTIVE"=>"Y", "SECTION_ACTIVE" => "Y"),
    false,
    Array("UF_TITLE", "UF_DESCRIPTION"),
    false
);
$flSections = $fSections->Fetch();
if ($flSections['UF_TITLE']) {
    $APPLICATION->SetPageProperty("title", $flSections['UF_TITLE']);
	//echo $flSections['UF_TITLE'];
}?>