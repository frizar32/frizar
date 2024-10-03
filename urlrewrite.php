<?php
$arUrlRewrite=array (
  100 => 
  array (
    'CONDITION' => '#^/company/brands/([0-9a-zA-Z_-]+)/([0-9a-zA-Z_-]+)/(\\\\?(.*))?#',
    'RULE' => 'ELEMENT_CODE=$1&SECTION_CODE=$2',
    'ID' => '',
    'PATH' => '/company/brands/detail.php',
    'SORT' => 100,
  ),
  0 => 
  array (
    'CONDITION' => '#^/online/([\\.\\-0-9a-zA-Z]+)(/?)([^/]*)#',
    'RULE' => 'alias=$1',
    'ID' => NULL,
    'PATH' => '/desktop_app/router.php',
    'SORT' => 100,
  ),
  25 => 
  array (
    'CONDITION' => '#^/video/([\\.\\-0-9a-zA-Z]+)(/?)([^/]*)#',
    'RULE' => 'alias=$1&videoconf',
    'ID' => 'bitrix:im.router',
    'PATH' => '/desktop_app/router.php',
    'SORT' => 100,
  ),
  1 => 
  array (
    'CONDITION' => '#^/bitrix/services/ymarket/#',
    'RULE' => '',
    'ID' => '',
    'PATH' => '/bitrix/services/ymarket/index.php',
    'SORT' => 100,
  ),
  111 => 
  array (
    'CONDITION' => '#^/examplecompany/actions/#',
    'RULE' => '',
    'ID' => 'bxready:news',
    'PATH' => '/examplecompany/actions/index.php',
    'SORT' => 100,
  ),
  112 => 
  array (
    'CONDITION' => '#^/examplepersonal/order/#',
    'RULE' => '',
    'ID' => 'bitrix:sale.personal.order',
    'PATH' => '/examplepersonal/order/index.php',
    'SORT' => 100,
  ),
  113 => 
  array (
    'CONDITION' => '#^/examplecompany/news/#',
    'RULE' => '',
    'ID' => 'bxready:news',
    'PATH' => '/examplecompany/news/index.php',
    'SORT' => 100,
  ),
  2 => 
  array (
    'CONDITION' => '#^/online/(/?)([^/]*)#',
    'RULE' => '',
    'ID' => NULL,
    'PATH' => '/desktop_app/router.php',
    'SORT' => 100,
  ),
  3 => 
  array (
    'CONDITION' => '#^/stssync/calendar/#',
    'RULE' => '',
    'ID' => 'bitrix:stssync.server',
    'PATH' => '/bitrix/services/stssync/calendar/index.php',
    'SORT' => 100,
  ),
  4 => 
  array (
    'CONDITION' => '#^/company/actions/#',
    'RULE' => '',
    'ID' => 'bxready:news',
    'PATH' => '/company/actions/index.php',
    'SORT' => 100,
  ),
  114 => 
  array (
    'CONDITION' => '#^/exampleservices/#',
    'RULE' => '',
    'ID' => 'bxready:news',
    'PATH' => '/exampleservices/index.php',
    'SORT' => 100,
  ),
  115 => 
  array (
    'CONDITION' => '#^/examplearticles/#',
    'RULE' => '',
    'ID' => 'bxready:news',
    'PATH' => '/examplearticles/index.php',
    'SORT' => 100,
  ),
  21 => 
  array (
    'CONDITION' => '#^/dokumentatsiya/#',
    'RULE' => '',
    'ID' => 'alexkova.market:catalog',
    'PATH' => '/dokumentatsiya/index.php',
    'SORT' => 100,
  ),
  5 => 
  array (
    'CONDITION' => '#^/personal/order/#',
    'RULE' => '',
    'ID' => 'bitrix:sale.personal.order',
    'PATH' => '/personal/order/index.php',
    'SORT' => 100,
  ),
  109 => 
  array (
    'CONDITION' => '#^/company/brands/#',
    'RULE' => '',
    'ID' => 'bitrix:news',
    'PATH' => '/company/brands/index.php',
    'SORT' => 100,
  ),
  116 => 
  array (
    'CONDITION' => '#^/examplecatalog/#',
    'RULE' => '',
    'ID' => 'alexkova.market:catalog',
    'PATH' => '/examplecatalog/index.php',
    'SORT' => 100,
  ),
  117 => 
  array (
    'CONDITION' => '#^/examplebrands/#',
    'RULE' => '',
    'ID' => 'alexkova.market:catalog',
    'PATH' => '/examplebrands/index.php',
    'SORT' => 100,
  ),
  27 => 
  array (
    'CONDITION' => '#^/company/news/#',
    'RULE' => '',
    'ID' => 'bxready:news',
    'PATH' => '/company/news/index.php',
    'SORT' => 100,
  ),
  30 => 
  array (
    'CONDITION' => '#^/new_catalog/#',
    'RULE' => '',
    'ID' => 'alexkova.market:catalog',
    'PATH' => '/new_catalog/index.php',
    'SORT' => 100,
  ),
  7 => 
  array (
    'CONDITION' => '#^/articles/#',
    'RULE' => '',
    'ID' => 'bxready:news',
    'PATH' => '/articles/index.php',
    'SORT' => 100,
  ),
  8 => 
  array (
    'CONDITION' => '#^/personal/#',
    'RULE' => '',
    'ID' => 'bitrix:sale.personal.section',
    'PATH' => '/personal/index.php',
    'SORT' => 100,
  ),
  110 => 
  array (
    'CONDITION' => '#^/catalog/#',
    'RULE' => '',
    'ID' => 'alexkova.market:catalog',
    'PATH' => '/catalog/index.php',
    'SORT' => 100,
  ),
  10 => 
  array (
    'CONDITION' => '#^/brands/#',
    'RULE' => '',
    'ID' => 'alexkova.market:catalog',
    'PATH' => '/brands/index.php',
    'SORT' => 100,
  ),
  103 => 
  array (
    'CONDITION' => '#^/stati/#',
    'RULE' => '',
    'ID' => 'bxready:news',
    'PATH' => '/stati/index.php',
    'SORT' => 100,
  ),
  108 => 
  array (
    'CONDITION' => '#^\\??(.*)#',
    'RULE' => '&$1',
    'ID' => 'bxready:ecommerce.list',
    'PATH' => '/bitrix/templates/market_fullscreen/components/bitrix/news.detail/brand_detail/component_epilog.php',
    'SORT' => 100,
  ),
  11 => 
  array (
    'CONDITION' => '#^/rest/#',
    'RULE' => '',
    'ID' => NULL,
    'PATH' => '/bitrix/services/rest/index.php',
    'SORT' => 100,
  ),
);
