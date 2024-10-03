<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("ndc");
?>
 
<?
if (CModule::IncludeModule("catalog"))
{
     $db_res = CCatalogProduct::GetList(
            array(),
            array("IBLOCK_ID" => "17"),
            false,
            false
     );
     $i = 0;    
    while ($ar_res = $db_res->Fetch())
    {
        print_r($ar_res);echo '<br />';
        $arFields = array(
            "ID" => $ar_res["ID"],
            "VAT_INCLUDED" => "N", 
        );
        CCatalogProduct::Add($arFields);
    }
}
?>
 
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>