<? IncludeTemplateLangFile(__FILE__); ?>

<? if (CSite::InDir('/prod_selections/')): ?>

	</div>
	</div>

<? endif; ?>

</div>
</div>
</div>

</div>
<? if ($APPLICATION->GetCurPage(true) == SITE_DIR . 'index.php'): ?>

	<? if ($mainPageType == "one_col"): ?>
		<div class="container">
			<div class="row">
				<div class="col-lg-12">
					<? $APPLICATION->IncludeComponent(
						"bitrix:main.include",
						"named_area",
						array(
							"AREA_FILE_SHOW" => "file",
							"AREA_FILE_SUFFIX" => "inc",
							"EDIT_TEMPLATE" => "",
							"PATH" => SITE_DIR . "include/main_page_footer.php",
							"INCLUDE_PTITLE" => GetMessage("GHANGE_MAIN_PAGE_FOOTER")
						),
						false
					); ?>
				</div>
			</div>
		</div>
	<? endif; ?>

	<? $APPLICATION->IncludeComponent(
		"alexkova.market:catalog.brandblock",
		"brand_slider",
		array(
			"IBLOCK_TYPE" => "catalog",
			"IBLOCK_ID" => "12",
			"ELEMENT_ID" => $_REQUEST["ELEMENT_ID"],
			"ELEMENT_CODE" => $_REQUEST["ELEMENT_CODE"],
			"PROP_CODE" => array(
				0 => "Manufacturer",
			),
			"WIDTH" => "0",
			"HEIGHT" => "0",
			"WIDTH_SMALL" => "0",
			"HEIGHT_SMALL" => "0",
			"CACHE_TYPE" => "N",
			"CACHE_TIME" => "3600",
			"CACHE_GROUPS" => "Y",
			"COMPONENT_TEMPLATE" => "brand_slider",
			"SHOW_DEACTIVATED" => "N",
			"SINGLE_COMPONENT" => "Y",
			"ELEMENT_COUNT" => "15"
		),
		false,
		array(
			"ACTIVE_COMPONENT" => "Y"
		)
	); ?>
<? endif; ?>


<? if (isset($BXReady)): ?>
	<? $BXReady->showBannerPlace("BOTTOM"); ?>
<? endif; ?>

<footer>
	<?/*
	<div class="container footer-head hidden-sm hidden-xs">
		<div class="row">

			<div class="col-lg-8 col-md-8 hidden-sm hidden-xs">
				<?$APPLICATION->IncludeComponent(
					"bitrix:main.include",
					"named_area",
					Array(
						"AREA_FILE_SHOW" => "file",
						"AREA_FILE_SUFFIX" => "inc",
						"EDIT_TEMPLATE" => "",
						"PATH" => SITE_DIR."include/footer_catalog_name.php",
						"INCLUDE_PTITLE" => GetMessage("GHANGE_FOOTER_CATALOG")
					),
					false
				);?>
			</div>
			<div class="col-lg-2 col-md-2 hidden-sm hidden-xs">
				<?$APPLICATION->IncludeComponent(
					"bitrix:main.include",
					"named_area",
					Array(
						"AREA_FILE_SHOW" => "file",
						"AREA_FILE_SUFFIX" => "inc",
						"EDIT_TEMPLATE" => "",
						"PATH" => SITE_DIR."include/footer_menu_name.php",
						"INCLUDE_PTITLE" => GetMessage("GHANGE_FOOTER_MENU")
					),
					false
				);?>
			</div>

    </div>
</div>
*/ ?>
	<div class="container">
		<div class="row">
			<div class="col-lg-4 col-md-4 col-sm-12 col-xs-12 footer-about-company">
				<? $APPLICATION->IncludeComponent(
					"bitrix:main.include",
					"named_area",
					array(
						"AREA_FILE_SHOW" => "file",
						"AREA_FILE_SUFFIX" => "inc",
						"EDIT_TEMPLATE" => "",
						"PATH" => SITE_DIR . "include/footer_about_company.php",
						"INCLUDE_PTITLE" => GetMessage("GHANGE_FOOTER_INFO")
					),
					false
				); ?>
				<div class="footer-logo">
					<svg xmlns="http://www.w3.org/2000/svg" width="207" height="70" viewBox="0 0 207 70" fill="none">
						<path d="M5.49976 15.4881L9.37077 7.74609H139.374L106.956 54.4552H201.085L197.214 61.9418H90.8805L123.188 15.4881H5.49976Z" fill="white" />
						<path d="M122.251 37.8625L128.281 30.4181L151.085 30.4181L154.837 46.4569L153.048 51.6082H144.06L141.113 37.8625H122.251Z" fill="white" />
						<path d="M130.433 26.5507L137.061 19.3197L148.879 19.3027L150.684 26.5507L130.433 26.5507Z" fill="white" />
						<path d="M53.3659 19.3633H26.523L22.2945 26.6932H51.2637L53.3659 19.3633Z" fill="white" />
						<path d="M48.3938 37.9478L50.3627 29.753H24.1251L17.4422 51.589H29.7214L33.5318 37.9478H48.3938Z" fill="white" />
						<path d="M81.8614 51.6023C85.8352 40.2242 84.1752 37.212 84.1752 36.3556C86.7517 34.0011 87.8641 32.4195 88.5765 30.3419H55.8755L49.4064 51.6183L59.9895 51.6183L64.149 38.3727H76.0426L72.0332 51.6023H81.8614Z" fill="white" />
						<path d="M54.1262 27.0319L58.2738 19.4717H86.0816C87.7763 20.7333 89.6964 23.4918 89.4608 27.0761L54.1262 27.0319Z" fill="white" />
						<path d="M185.44 51.6018C189.414 40.2237 187.74 37.212 187.74 36.3556C190.317 34.0011 191.429 32.4195 192.141 30.3419H159.44L152.99 51.6045L163.573 51.6045L167.714 38.3727H179.608L175.522 51.6018H185.44Z" fill="white" />
						<path d="M157.691 27.0319L161.839 19.4717H189.646C191.341 20.7333 193.261 23.4918 193.026 27.0761L157.691 27.0319Z" fill="white" />
						<path d="M92.9028 26.5131L95.0192 19.3135H105.898L103.897 26.5131H92.9028Z" fill="white" />
						<path d="M103.293 30.342H92.2987L86.1725 51.5797H97.1665L103.293 30.342Z" fill="white" />
					</svg>
				</div>
			</div>
			<div class="hidden-lg hidden-md col-sm-12 col-xs-12 mobile-footer-menu-tumbl">
				<i class="fa fa-chevron-down"></i>
				<? $APPLICATION->IncludeComponent(
					"bitrix:main.include",
					"named_area",
					array(
						"AREA_FILE_SHOW" => "file",
						"AREA_FILE_SUFFIX" => "inc",
						"EDIT_TEMPLATE" => "",
						"PATH" => SITE_DIR . "include/footer_menu_name.php",
						"INCLUDE_PTITLE" => GetMessage("GHANGE_FOOTER_MENU")
					),
					false
				); ?>
			</div>
			<div class="col-lg-4 col-md-4 col-sm-12 col-xs-12 toggled-item">
				<div class="footer-head hidden-sm hidden-xs">
					<? $APPLICATION->IncludeComponent(
						"bitrix:main.include",
						"named_area",
						array(
							"AREA_FILE_SHOW" => "file",
							"AREA_FILE_SUFFIX" => "inc",
							"EDIT_TEMPLATE" => "",
							"PATH" => SITE_DIR . "include/footer_menu_name.php",
							"INCLUDE_PTITLE" => GetMessage("GHANGE_FOOTER_MENU")
						),
						false
					); ?>
				</div>
				<?
				$APPLICATION->IncludeComponent(
					"alexkova.market:menu",
					"footer_cols",
					array(
						"ROOT_MENU_TYPE" => "footer",	// Тип меню для первого уровня
						"MAX_LEVEL" => "1",	// Уровень вложенности меню
						"CHILD_MENU_TYPE" => "left",	// Тип меню для остальных уровней
						"USE_EXT" => "Y",	// Подключать файлы с именами вида .тип_меню.menu_ext.php
						"DELAY" => "N",	// Откладывать выполнение шаблона меню
						"ALLOW_MULTI_SELECT" => "N",	// Разрешить несколько активных пунктов одновременно
						"MENU_CACHE_TYPE" => "N",	// Тип кеширования
						"MENU_CACHE_TIME" => "3600",	// Время кеширования (сек.)
						"MENU_CACHE_USE_GROUPS" => "Y",	// Учитывать права доступа
						"MENU_CACHE_GET_VARS" => "",	// Значимые переменные запроса
						"COLS" => "1"
					),
					false
				);
				?>
			</div>
			<div class="hidden-lg hidden-md col-sm-12 col-xs-12 mobile-footer-menu-tumbl">
				<i class="fa fa-chevron-down"></i>
				<? $APPLICATION->IncludeComponent(
					"bitrix:main.include",
					"named_area",
					array(
						"AREA_FILE_SHOW" => "file",
						"AREA_FILE_SUFFIX" => "inc",
						"EDIT_TEMPLATE" => "",
						"PATH" => SITE_DIR . "include/footer_catalog_name.php",
						"INCLUDE_PTITLE" => GetMessage("GHANGE_FOOTER_CATALOG")
					),
					false
				); ?>
			</div>
			<div class="col-lg-4 col-md-4 col-sm-12 col-xs-12 toggled-item categories">
				<?
				$APPLICATION->IncludeComponent(
					"alexkova.market:menu",
					"footer_cols",
					array(
						"ROOT_MENU_TYPE" => "bottom_catalog",
						"MAX_LEVEL" => "1",
						"CHILD_MENU_TYPE" => "left",
						"USE_EXT" => "Y",
						"DELAY" => "N",
						"ALLOW_MULTI_SELECT" => "N",
						"MENU_CACHE_TYPE" => "N",
						"MENU_CACHE_TIME" => "3600",
						"MENU_CACHE_USE_GROUPS" => "Y",
						"MENU_CACHE_GET_VARS" => "",
						"COLS" => "1",
					),
					false,
					array('HIDE_ICONS' => "Y")
				);
				?>
			</div>



		</div>
	</div>
</footer>



<? $formFrame = new \Bitrix\Main\Page\FrameHelper("iblock_form");
$formFrame->begin(); ?>
<? $APPLICATION->IncludeComponent(
	"alexkova.market:form.iblock",
	"callback",
	array(
		"IBLOCK_TYPE" => "forms",
		"IBLOCK_ID" => "10",
		"STATUS_NEW" => "NEW",
		"USE_CAPTCHA" => "N",
		"USER_MESSAGE_ADD" => GetMessage("FORM_ANSWER_RESULT"),
		"RESIZE_IMAGES" => "N",
		"MODE" => "link",
		"PROPERTY_CODES" => array(
			0 => "47",
			1 => "48",
			2 => "49",
		),
		"NAME_FROM_PROPERTY" => "48",
		"GROUPS" => array(
			0 => "2",
		),
		"MAX_FILE_SIZE" => "0",
		"EVENT_CLASS" => "open-answer-form",
		"BUTTON_TEXT" => "",
		"POPUP_TITLE" => GetMessage("RECALL_MESSAGE"),
		"SEND_EVENT" => "KZNC_NEW_FORM_PHONE_RESULT",
		"COMPONENT_TEMPLATE" => "callback",
		"PERSONAL_DATA" => "N",
		"PERSONAL_DATA_TEXT" => "Cогласен на обработку персональных данных в соответсвии с положением",
		"PERSONAL_DATA_CAPTION" => "",
		"PERSONAL_DATA_URL" => "/privacy-policy/",
		"PERSONAL_DATA_ERROR" => "Обработка вашей заявки без согласия на обработку персональных данных невозможна."
	),
	false
); ?>
<? $formFrame->end(); ?>
<? $formFrame = new \Bitrix\Main\Page\FrameHelper("iblock_form_request");
$formFrame->begin(); ?>
<? $APPLICATION->IncludeComponent(
	"alexkova.market:form.iblock",
	/*"request_trade"*/
	".default",
	array(
		"IBLOCK_TYPE" => "forms",
		"IBLOCK_ID" => "11",
		"STATUS_NEW" => "NEW",
		"USE_CAPTCHA" => "N",
		"USER_MESSAGE_ADD" => GetMessage("FORM_ANSWER_RESULT"),
		"RESIZE_IMAGES" => "N",
		"MODE" => "link",
		"PROPERTY_CODES" => array(
			0 => "51",
			1 => "55",
			2 => "53",
			3 => "54",
			4 => "55",
			5 => "57",
			6 => "58",
		),
		"NAME_FROM_PROPERTY" => "57",
		"GROUPS" => array(
			0 => "2",
		),
		"MAX_FILE_SIZE" => "0",
		"EVENT_CLASS" => "bxr-trade-request",
		"BUTTON_TEXT" => "",
		"POPUP_TITLE" => GetMessage("REQUEST_TRADE"),
		"SEND_EVENT" => "KZNC_NEW_FORM_REQUEST_RESULT",
		"COMPONENT_TEMPLATE" => "request_trade",
		"PERSONAL_DATA" => "N",
		"PERSONAL_DATA_TEXT" => "Cогласен на обработку персональных данных в соответсвии с положением",
		"PERSONAL_DATA_CAPTION" => "Положение",
		"PERSONAL_DATA_URL" => "",
		"PERSONAL_DATA_ERROR" => "Обработка вашей заявки без согласия на обработку персональных данных невозможна.",
		"COMPOSITE_FRAME_MODE" => "A",
		"COMPOSITE_FRAME_TYPE" => "AUTO"
	),
	false
); ?>
<? $formFrame->end(); ?>
<? $formFrame = new \Bitrix\Main\Page\FrameHelper("iblock_form_one_click_buy");
$formFrame->begin(); ?>
<? $APPLICATION->IncludeComponent(
	"alexkova.market:form.iblock",
	".default",
	array(
		"IBLOCK_TYPE" => "forms",
		"IBLOCK_ID" => "9",
		"STATUS_NEW" => "NEW",
		"USE_CAPTCHA" => "N",
		"USER_MESSAGE_ADD" => GetMessage("FORM_ANSWER_RESULT"),
		"RESIZE_IMAGES" => "N",
		"MODE" => "link",
		"PROPERTY_CODES" => array(
			0 => "39",
			1 => "40",
			2 => "41",
			3 => "42",
			4 => "43",
			5 => "44",
			6 => "45",
			7 => "46",
		),
		"NAME_FROM_PROPERTY" => "45",
		"GROUPS" => array(
			0 => "2",
		),
		"MAX_FILE_SIZE" => "0",
		"EVENT_CLASS" => "bxr-one-click-buy",
		"BUTTON_TEXT" => "",
		"POPUP_TITLE" => GetMessage("ONE_CLICK_FORM_TITLE"),
		"SEND_EVENT" => "KZNC_NEW_FORM_CLICK_RESULT",
		"COMPONENT_TEMPLATE" => ".default",
		"PERSONAL_DATA" => "N",
		"PERSONAL_DATA_TEXT" => "Cогласен на обработку персональных данных в соответсвии с положением",
		"PERSONAL_DATA_CAPTION" => "Положение",
		"PERSONAL_DATA_URL" => "",
		"PERSONAL_DATA_ERROR" => "Обработка вашей заявки без согласия на обработку персональных данных невозможна.",
		"COMPOSITE_FRAME_MODE" => "A",
		"COMPOSITE_FRAME_TYPE" => "AUTO"
	),
	false
); ?>
<? $formFrame->end(); ?>


<? $formFrame = new \Bitrix\Main\Page\FrameHelper("iblock_form_analog");
$formFrame->begin(); ?>
<? $APPLICATION->IncludeComponent(
	"alexkova.market:form.iblock",
	".default",
	array(
		"IBLOCK_TYPE" => "forms",
		"IBLOCK_ID" => "25",
		"STATUS_NEW" => "NEW",
		"USE_CAPTCHA" => "N",
		"USER_MESSAGE_ADD" => GetMessage("FORM_ANSWER_RESULT"),
		"RESIZE_IMAGES" => "N",
		"MODE" => "link",
		"PROPERTY_CODES" => array(
			0 => "327",
			1 => "328",
			2 => "329",
			3 => "330",
			4 => "331",
			5 => "332",
			6 => "333",
			7 => "334",
		),
		"NAME_FROM_PROPERTY" => "333",
		"GROUPS" => array(
			0 => "2",
		),
		"MAX_FILE_SIZE" => "0",
		"EVENT_CLASS" => "bxr-analog",
		"BUTTON_TEXT" => "",
		"POPUP_TITLE" => GetMessage("ANALOG_FORM_TITLE"),
		"SEND_EVENT" => "KZNC_NEW_FORM_ANALOG_RESULT",
		"COMPONENT_TEMPLATE" => ".default",
		"PERSONAL_DATA" => "N",
		"PERSONAL_DATA_TEXT" => "Cогласен на обработку персональных данных в соответсвии с положением",
		"PERSONAL_DATA_CAPTION" => "Положение",
		"PERSONAL_DATA_URL" => "",
		"PERSONAL_DATA_ERROR" => "Обработка вашей заявки без согласия на обработку персональных данных невозможна.",
		"COMPOSITE_FRAME_MODE" => "A",
		"COMPOSITE_FRAME_TYPE" => "AUTO"
	),
	false
); ?>
<? $formFrame->end(); ?>





<!-- Yandex.Metrika counter -->
<?/*Old script type="text/javascript">
(function(m,e,t,r,i,k,a){m[i]=m[i]||function(){(m[i].a=m[i].a||[]).push(arguments)}; m[i].l=1*new Date();k=e.createElement(t),a=e.getElementsByTagName(t)[0],k.async=1,k.src=r,a.parentNode.insertBefore(k,a)}) (window, document, "script", "https://mc.yandex.ru/metrika/tag.js", "ym"); ym(49057298, "init", { id:49057298, clickmap:true, trackLinks:true, accurateTrackBounce:true, webvisor:true }); </script> <noscript><div><img src="https://mc.yandex.ru/watch/49057298" style="position:absolute; left:-9999px;" alt="" /></div></noscript*/ ?>
<!-- /Yandex.Metrika counter -->
<script type="text/javascript">
	(function(d, w, c) {
		(w[c] = w[c] || []).push(function() {
			try {
				w.yaCounter49057298 = new Ya.Metrika({
					id: 49057298,
					clickmap: true,
					trackLinks: true,
					accurateTrackBounce: true,
					webvisor: true
				});
			} catch (e) {}
		});

		var n = d.getElementsByTagName("script")[0],
			s = d.createElement("script"),
			f = function() {
				n.parentNode.insertBefore(s, n);
			};
		s.type = "text/javascript";
		s.async = true;
		s.src = "https://mc.yandex.ru/metrika/watch.js";

		if (w.opera == "[object Opera]") {
			d.addEventListener("DOMContentLoaded", f, false);
		} else {
			f();
		}
	})(document, window, "yandex_metrika_callbacks");
</script>
<noscript>
	<div><img src="https://mc.yandex.ru/watch/49057298" style="position:absolute; left:-9999px;" alt="" /></div>
</noscript>

<!-- Yandex.Metrika counter -->
<?/*<script type="text/javascript" >
   (function(m,e,t,r,i,k,a){m[i]=m[i]||function(){(m[i].a=m[i].a||[]).push(arguments)};
   m[i].l=1*new Date();k=e.createElement(t),a=e.getElementsByTagName(t)[0],k.async=1,k.src=r,a.parentNode.insertBefore(k,a)})
   (window, document, "script", "https://mc.yandex.ru/metrika/tag.js", "ym");

   ym(49057298, "init", {
        clickmap:true,
        trackLinks:true,
        accurateTrackBounce:true,
        webvisor:true
   });
</script>
<noscript><div><img src="https://mc.yandex.ru/watch/49057298" style="position:absolute; left:-9999px;" alt="" /></div></noscript>*/ ?>
<!-- /Yandex.Metrika counter -->

<!-- Google tag (gtag.js) -->
<script async src="https://www.googletagmanager.com/gtag/js?id=G-6C2V6MVD7Z"></script>
<script>
	window.dataLayer = window.dataLayer || [];

	function gtag() {
		dataLayer.push(arguments);
	}
	gtag('js', new Date());

	gtag('config', 'G-6C2V6MVD7Z');
</script>

<script>
	//отложенная загрузка стилей
	var stylesheet = document.createElement('link');
	stylesheet.href = 'https://fonts.googleapis.com/css?family=Open+Sans:300,300italic,400,400italic,700,700italic&subset=latin,cyrillic,cyrillic-ext';
	stylesheet.rel = 'stylesheet';
	stylesheet.type = 'text/css';
	document.getElementsByTagName('head')[0].appendChild(stylesheet);
</script>
</body>

</html>