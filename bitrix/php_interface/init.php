<?
define("RE_SITE_KEY","6LdQHtAZAAAAABl1QASl7oxofQ5Jbz8lG3lHNM2I");
define("RE_SEC_KEY","6LdQHtAZAAAAADHIy4ehAQhXm4mr8_kZBNP8l0yv");

use Bitrix\Catalog\Model\Event;
use Bitrix\Catalog\Model\Price;
use Bitrix\Catalog\PriceTable;
use Bitrix\Main\EventManager;
use Bitrix\Main\ORM\Query\Query;

function setRubSymbol($str)
{
  return str_replace('руб.', '₽', $str);
}
//Если цена приходит 0,01 то удаляем её.
$eventManager = \Bitrix\Main\EventManager::getInstance();
$eventManager->addEventHandler('catalog', 'Bitrix\Catalog\Model\Price::OnAfterAdd',
    ['ToDeletePrice', 'onPriceEvent']
);
$eventManager->addEventHandler('catalog', 'Bitrix\Catalog\Model\Price::OnAfterUpdate',
    ['ToDeletePrice', 'onPriceEvent']
);

class ToDeletePrice
{
    protected static $eventDeployed = false;
    protected static $eventOrder = [];

    public static function onPriceEvent(Event $event): void
    {
         $arFields  =  $event->getParameter('fields');

         /*if($arFields['PRICE'] == 0.01 || $arFields['PRICE'] == 0.02){
             self::pushToEvent($arFields['PRODUCT_ID'], $arFields['CATALOG_GROUP_ID'], 0);
         }*/

		 //формируем параметр сортировки по цене на лету
		 $minimum_price = $arFields["PRICE_SCALE"] + $arFields["PRICE_SCALE"]*0.2;
		 CIBlockElement::SetPropertyValuesEx($arFields['PRODUCT_ID'], false, array('MINIMUM_PRICE' => $minimum_price));
		 //AddMessage2Log(print_r($minimum_price, true), "arFields");

    }
/*
    protected static function pushToEvent($productId, $PriceGroupId, $zeroPrice)
    {
        $pushEvent = false;

        \Bitrix\Main\Loader::includeModule('iblock');
        $entity = \Bitrix\Iblock\IblockTable::compileEntity('catalogApi');

        $priceEntity = PriceTable::getEntity();
        $res = (new Query($priceEntity))
            ->where('PRODUCT_ID', $productId)
            ->where('CATALOG_GROUP_ID', $PriceGroupId)
            ->setSelect(['ID', 'PRICE'])
            ->setLimit(1)
            ->exec();

        if ($elArr = $res->fetch()) {
            // Если цена уже есть в таблице b_catalog_price
            $priceValue = $elArr['PRICE'];
            AddMessage2Log(print_r($priceValue. " - " .$productId, true), "my_module_id");
            if ($priceValue != $zeroPrice) {
                self::$eventOrder['DELETE'] = self::$eventOrder['DELETE'] ?? [];
                self::$eventOrder['DELETE'][] = [
                    'ID' => $elArr['ID']
                ];

                if($priceValue == 0.02)
                {
                    $query = new \Bitrix\Iblock\Orm\Query($entity);
                    $res = $query
                        ->setSelect(['ID', 'NOT_PROD.ITEM'])
                        ->where('ID', $productId)
                        ->exec();

                    while ($obj = $res->fetchObject()) {
                        $obj->set('NOT_PROD', '263'); //Галочка «Снято с производства»
                        $updateResult = $obj->save();

                        if (!$updateResult->isSuccess()) {
                            AddMessage2Log(print_r($updateResult->getErrorMessages(), true), "my_module_id");
                        }
                    }
                }
                $pushEvent = true;
            }
        }

        if ($pushEvent && !self::$eventDeployed) {
            self::$eventDeployed = true;

            // Прямо по ходу дела подписываемся на событие,
            // когда БД будет разлочена от текущей операции с ценой
            $eventManager = EventManager::getInstance();
            $eventManager->addEventHandler(
                'main',
                'OnBeforeEndBufferContent',
                [__CLASS__, 'processPricesOrders']
            );
        }
    }

    public static function processPricesOrders()
    {
        foreach (self::$eventOrder as $type => $orderList) {
            foreach ($orderList as $orderFields) {
                if ($type === 'DELETE') {
                    $recordId = $orderFields['ID'];
                    unset($orderFields['ID']);

                    $updateResult = Price::delete($recordId);
                    if (!$updateResult->isSuccess()) {
                        AddMessage2Log(print_r('Ошибка при изменении цены', true), "my_module_id");
                    }

                }
            }
        }
    }
*/
}



AddEventHandler("iblock", "OnBeforeIBlockElementUpdate ", "OnBeforeIBlockElementUpdateHandler");
function OnBeforeIBlockElementUpdateHandler(&$arFields)
{
    /*

  if (isset($_GET['type'], $_GET['mode']) && $_GET['type'] === 'catalog' && $_GET['mode'] === 'import') {
   // if(($arFields['ID'] === 17) || ($arFields['IBLOCK_ID'] == 17)){
    //get листом получаем все элементы каталога
      $arSelect = Array("ID", "IBLOCK_ID", "NAME","PROPERTY_NAIMENOVANIE_DLYA_POISKA");
      $arFilter = Array("IBLOCK_ID"=> "17");
      $res = CIBlockElement::GetList(Array(), $arFilter, false, Array(), $arSelect);

      while($ob = $res->GetNextElement()){
      $arFields = $ob->GetFields();
      $arProps = $ob->GetProperties();
    // задаем функцию для замены символов
      $find = array('x');
      $replace = array('х');
      $string = $arFields['NAME'];
      $newProp = str_replace($find, $replace, $string);
    //и заменяем все английские буквы "х" на русские в названии элементов
      $el = new CIBlockElement;
      $arLoadProductArray = Array(
          "NAME" => $newProp,
          );
      $res_new = $el->Update($arFields['ID'], $arLoadProductArray);
    //теперь меняем еще раз, но с русских букв "х" на английские
      $find_new = array('х');
      $replace_new = array('x');
      $string_new = $string;
      $newProp_new = str_replace($find_new, $replace_new, $string_new);
    //записываем в доп.свойства для фильтра
      CIBlockElement::SetPropertyValuesEx($arFields['ID'], false, array('NAIMENOVANIE_DLYA_POISKA' => $newProp_new));
      //}
    }
  }*/
}

/*AddEventHandler("subscribe", "OnBeforeSubscriptionUpdate", Array("MyClass", "OnBeforeSubscriptionUpdate"));
class MyClass
{

    function OnBeforeSubscriptionUpdate($arFields)
    {
        AddMessage2Log(print_r($arFields, true), "my_module_id");
    }
}*/




AddEventHandler("sale", "OnOrderNewSendEmail", "bxModifySaleMails");
//-- Собственно обработчик события
function bxModifySaleMails($orderID, &$eventName, &$arFields)
{
  $arOrder = CSaleOrder::GetByID($orderID);

  //-- получаем телефоны и адрес
  $order_props = CSaleOrderPropsValue::GetOrderProps($orderID);
  $phone="";
  $index = "";
  $country_name = "";
  $city_name = "";
  $address = "";
  while ($arProps = $order_props->Fetch())
  {

    if ($arProps["CODE"] == "PHONE")
    {
       $phone = htmlspecialchars($arProps["VALUE"]);
    }
    if ($arProps["CODE"] == "LOCATION")
    {
        $arLocs = CSaleLocation::GetByID($arProps["VALUE"]);
        $country_name =  $arLocs["COUNTRY_NAME_ORIG"];
		$disctict_name =  $arLocs["REGION_NAME_ORIG"];
		$city_name = $arLocs["CITY_NAME_ORIG"];


    }

    if ($arProps["CODE"] == "INDEX")
    {
      $index = $arProps["VALUE"];
    }

    if ($arProps["CODE"] == "ADDRESS")
    {
      $address = $arProps["VALUE"];
    }

  }

  $full_address = $country_name.", ".$city_name.", ".$address;

  //-- получаем название службы доставки
  $arDeliv = CSaleDelivery::GetByID($arOrder["DELIVERY_ID"]);
  $delivery_name = "";
  if ($arDeliv)
  {
    $delivery_name = $arDeliv["NAME"];
  }

  //-- получаем название платежной системы
  $arPaySystem = CSalePaySystem::GetByID($arOrder["PAY_SYSTEM_ID"]);
  $pay_system_name = "";
  if ($arPaySystem)
  {
    $pay_system_name = $arPaySystem["NAME"];
  }

  //-- добавляем новые поля в массив результатов
  $arFields["ORDER_DESCRIPTION"] = $arOrder["USER_DESCRIPTION"];
  $arFields["PHONE"] =  $phone;
  $arFields["DELIVERY_NAME"] =  $delivery_name;
  $arFields["PAY_SYSTEM_NAME"] =  $pay_system_name;
  $arFields["FULL_ADDRESS"] = $full_address;
}

// убираем галочку ндс при загрузке товаров
AddEventHandler("sale", "OnProductAdd", "Nds");
AddEventHandler("catalog", "OnProductUpdate", "Nds");
function Nds($ID,$Fields)
{
  $res=Array("VAT_INCLUDED"=>'N');
  CCatalogProduct::Update($ID,$res);
}

AddEventHandler("main", "OnEndBufferContent", "OnEndBufferContentHandler");
function OnEndBufferContentHandler($content)
{
   global $APPLICATION, $USER;
   $url = $APPLICATION->GetCurUri();
   if(!substr_count($url,"/bitrix/") && substr_count($content,"</body>") && !$USER->IsAdmin()){
       $hashUrl = hash('md5',$url);
       $sliCont = substr($content,0,strpos($content,"</body>")+7);
       $sliCont = substr($sliCont,strpos($sliCont,"<body>"));
       $hashContent = hash('md5',$sliCont);
       $hashArr = ["time" => time(), "hash" => $hashContent];
       if(file_exists($_SERVER["DOCUMENT_ROOT"]."/upload/page_hash/".$hashUrl.".txt")){
           $lastArr = json_decode(file_get_contents($_SERVER["DOCUMENT_ROOT"]."/upload/page_hash/".$hashUrl.".txt"),true);
           if(is_array($lastArr) && $lastArr["hash"] && $lastArr["hash"]==$hashArr["hash"]){
               $lastModified =  gmdate("D, d M Y H:i:s \G\M\T", $lastArr["time"]);
               header("Cache-Control: public");
               header('Last-Modified: '.$lastModified);
               if(isset($_SERVER['HTTP_IF_MODIFIED_SINCE']) && strtotime($_SERVER['HTTP_IF_MODIFIED_SINCE']) >= $lastArr["time"]){
                   header('HTTP/1.1 304 Not Modified'); exit();
               }
           }
       }
       if(!$lastModified)file_put_contents($_SERVER["DOCUMENT_ROOT"]."/upload/page_hash/".$hashUrl.".txt", json_encode($hashArr));
   }
}

AddEventHandler("sale", "OnSaleComponentOrderOneStepOrderProps", "OnSaleComponentOrderOneStepOrderProps");
function OnSaleComponentOrderOneStepOrderProps(&$arResult, &$arUserResult, &$arParams)
{
  if(!empty($_COOKIE["location_id"])){
    $arUserResult['DELIVERY_LOCATION'] = $_COOKIE["location_id"];
  }
}
?>
<?
AddEventHandler("main", "OnEpilog", "OnEpilogHandler");
function OnEpilogHandler(){
    global $APPLICATION;
    if (!defined('ERROR_404') && (intval($_GET["PAGEN_1"]) || intval($_GET["PAGEN_2"])) > 0) {
        $curTitle = $APPLICATION->GetPageProperty("title");
        $curDescr = $APPLICATION->GetPageProperty("description");
        $pageNumber = $_GET["PAGEN_1"] ? intval($_GET["PAGEN_1"]) : intval($_GET["PAGEN_2"]);
        $APPLICATION->SetPageProperty("description", $curDescr." Страница № ".$pageNumber);
    }
    if ($_GET['PAGEN_1']==='1' && isset($_GET['PAGEN_1'])) {
        LocalRedirect($APPLICATION->GetCurPageParam("", array("PAGEN_1")));
    }
}?>
