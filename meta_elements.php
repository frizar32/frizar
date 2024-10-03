<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");?>
<?
CModule::IncludeModule("iblock");
CModule::IncludeModule("catalog");

$seoA = Array(
	'Действуют акции и скидки',
	'Быстрая доставка по всей России',
	'Подробная информация на сайте',
	'Быстрая доставка в любой регион России',
	'Характеристики описаны на сайте',
	'За подробной информацией обращайтесь по телефону +7 (4832) 58-66-33',
	'За подробной информацией обращайтесь по телефону +7 (4832) 58-66-38'
);

$IB_ID = "17";
$arFilter = Array("IBLOCK_SECTION_ID"=>"374",
    "INCLUDE_SUBSECTIONS" => "Y",);
$res = CIBlockElement::GetList(Array("SORT"=>"ASC"), $arFilter, false, false, array('NAME','ID','IBLOCK_SECTION_ID'));
while($ar = $res->GetNext()) {

	$ipropValues = new \Bitrix\Iblock\InheritedProperty\ElementValues($IB_ID,$ar["ID"]);
	$IPROPERTY  = $ipropValues->getValues();
	//if(!$IPROPERTY["ELEMENT_META_TITLE"]){
		//$title = $ar["NAME"];
		$descr = 'Предлагаем вам купить товар: ' . $ar["NAME"] . '. ' .$seoA[array_rand($seoA, 1)].'.';
		?><pre><?//print_r($title);?><br><?print_r($descr);?></pre><?
		$arFields = Array(
			//"ELEMENT_META_TITLE" => $title,
		   	"ELEMENT_META_DESCRIPTION" => $descr,
		);
		$ipropTemplates = new \Bitrix\Iblock\InheritedProperty\ElementTemplates($ar["IBLOCK_SECTION_ID"], $ar["ID"]);
		$ipropTemplates->set($arFields);
	//}


/*echo $mydesc = $seoA[array_rand($seoA, 1)].' '.$seoB[array_rand($seoB, 1)].' '.$ar["NAME"].' '.$seoC[array_rand($seoC, 1)].' '.CurrencyFormat($ar["PRICE"], 'RUB').' '.$seoD[array_rand($seoD, 1)];

*/
}

?>