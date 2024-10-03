<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetPageProperty("description", "В данном разделе представлена контактная и юридическая информация о нашем интернет-магазине.");
$APPLICATION->SetTitle("Наши контакты");
?><div class="bxr-contacts-block">
	<div class="vcard">
 <span style="display:none" class="fn org">ООО "Фризар"</span> <b>Телефоны:</b> <a href="tel:+74832586633" class="tel">+7 (4832) 58-66-33</a>, <a href="tel:+74832586638" class="tel">58-66-38</a>, <a href="tel:+74832586628" class="tel">58-66-28</a><br>
 <b>Адрес:</b>&nbsp;<span class="adr">241035, г. Брянск, ул. Ульянова, стр.4, офис 413A</span><br>
 <b>Адрес для корреспонденции:</b> РФ, 241035, г. Брянск, ул. Ульянова, стр.4, офис 413A.<br>
 <b>e-mail для заказов:</b> <a href="mailto:shop@frizar.ru">shop@frizar.ru</a> <br>
 <b>e-mail для предложений и запросов информации:</b> <a href="mailto:info@frizar.ru">info@frizar.ru</a> <br>
 <b>Время работы:</b> 8.30 - 17.30 <br>
 <br>
 <b>ООО "Фризар"</b> <br>
 <b>ИНН:</b> 3250534321 <br>
 <b>ОГРН:</b> 1123256019457
	</div>
</div>
 <br>
 <b>Как до нас добраться: <br>
 </b><b>&nbsp;&nbsp;</b><?$APPLICATION->IncludeComponent(
	"bitrix:map.yandex.view", 
	".default", 
	array(
		"COMPONENT_TEMPLATE" => ".default",
		"CONTROLS" => array(
			0 => "ZOOM",
			1 => "TYPECONTROL",
			2 => "SCALELINE",
		),
		"INIT_MAP_TYPE" => "MAP",
		"MAP_DATA" => "a:4:{s:10:\"yandex_lat\";d:53.302323365527;s:10:\"yandex_lon\";d:34.312898657892;s:12:\"yandex_scale\";i:16;s:10:\"PLACEMARKS\";a:1:{i:0;a:3:{s:3:\"LON\";d:34.312898657892;s:3:\"LAT\";d:53.302323365527;s:4:\"TEXT\";s:6:\"Frizar\";}}}",
		"MAP_HEIGHT" => "300",
		"MAP_ID" => "",
		"MAP_WIDTH" => "100%",
		"OPTIONS" => array(
			0 => "ENABLE_DBLCLICK_ZOOM",
			1 => "ENABLE_DRAGGING",
		),
		"API_KEY" => "",
		"COMPOSITE_FRAME_MODE" => "A",
		"COMPOSITE_FRAME_TYPE" => "AUTO"
	),
	false
);?><?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>