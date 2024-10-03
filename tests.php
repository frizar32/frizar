<?
include($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");

/*CModule::IncludeModule("iblock");
$bs = new CIBlockSection;

$arFilter = Array('IBLOCK_ID'=>"17");
$db_list = CIBlockSection::GetList(Array(), $arFilter, true, Array('ID', 'NAME', 'CODE'));
$tmpArr = [];
while($ar_result = $db_list->GetNext())
{
	$tmpArr[] = $ar_result;
}
$arFilters = Array('IBLOCK_ID'=>"23");
$db_lists = CIBlockSection::GetList(Array(), $arFilters, true, Array('ID', 'NAME', 'CODE'));
while($ar_results = $db_lists->GetNext())
{
	foreach ($tmpArr as $value) {
		if($value['NAME'] == $ar_results['NAME']){
			$bs->Update($ar_results['ID'], Array("CODE"=>$value['CODE']));
		}
	}
}*/



\Bitrix\Main\Loader::includeModule('iblock');
$entity = \Bitrix\Iblock\IblockTable::compileEntity('catalogApi');
$query = new \Bitrix\Iblock\Orm\Query($entity);
$res = $query
    ->setSelect(['ID', 'NAME', 'CODE','DETAIL_PICTURE', 'CML2_ARTICLE'])
    ->setFilter(['ACTIVE' => 'Y'])
    ->whereNotNull('DETAIL_PICTURE')
    ->whereNotNull('CML2_ARTICLE.VALUE')
    ->exec();

while ($obj = $res->fetchObject()) {


    $arFile = CFile::MakeFileArray($obj->get('DETAIL_PICTURE'));
    $path = "/upload/temp_products/".$arFile['name'];
    $ext =  substr(strrchr($arFile['name'], '.'), 1);
    $newName = '/home/f/frizar/shop.frizar/public_html/upload/temp_products/'.$obj->get('CML2_ARTICLE')->getValue().'.'.$ext;

    /*echo "<pre>";
    print_r($newName ." : ".$obj->get('CML2_ARTICLE')->getValue());
    echo "<pre>";*/

    /*if (!file_exists($newName)){
        if(!copy($arFile['tmp_name'], $newName))
        {
            echo 'ERROR!';
        }else{
            echo 'OK!';
        }
    }else{
        echo 'Такой файл уже есть';
    }*/


}

