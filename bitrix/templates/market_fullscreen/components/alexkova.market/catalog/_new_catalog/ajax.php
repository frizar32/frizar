<?php
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");
define("NO_KEEP_STATISTIC", true);
define("NOT_CHECK_PERMISSIONS", true);

$request = Bitrix\Main\Context::getCurrent()->getRequest();
$request->getPost("params");


$paramsGoodsComponent = \Bitrix\Main\Component\ParameterSigner::unsignParameters(
  'goods_params',
  $request->getPost("params")
);

print_r($paramsGoodsComponent);
