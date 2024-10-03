<? IncludeTemplateLangFile(__FILE__);?>

</div>
</div>
</div>


<?if ($APPLICATION->GetCurPage(true) == SITE_DIR.'index.php'):?>

<?if ($mainPageType == "one_col"):?>
<div class="container">
	<div class="row">
		<div class="col-lg-12">
			<?$APPLICATION->IncludeComponent(
				"bitrix:main.include",
				"named_area",
				Array(
					"AREA_FILE_SHOW" => "file",
					"AREA_FILE_SUFFIX" => "inc",
					"EDIT_TEMPLATE" => "",
					"PATH" => SITE_DIR."include/main_page_footer.php",
					"INCLUDE_PTITLE" => GetMessage("GHANGE_MAIN_PAGE_FOOTER")
				),
				false
			);?>
		</div>
	</div>
</div>
<?endif;?>

<?$APPLICATION->IncludeComponent("alexkova.market:catalog.brandblock", "brand_slider", array(
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
);?>
<?endif;?>


<?if (isset($BXReady)):?>
<?$BXReady->showBannerPlace("BOTTOM");?>
<?endif;?>

<footer>
	<div class="footer-line"></div>
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
                    <?/*<div class="col-lg-2 col-md-2 hidden-sm hidden-xs footer-socnet-col">
                        <?$APPLICATION->IncludeComponent(
                            "bitrix:main.include",
                            "named_area",
                            Array(
                                "AREA_FILE_SHOW" => "file",
                                "AREA_FILE_SUFFIX" => "inc",
                                "EDIT_TEMPLATE" => "",
                                "PATH" => SITE_DIR."include/footer_socnet.php",
                                "INCLUDE_PTITLE" => GetMessage("GHANGE_FOOTER_SOCNET")
                            ),
                            false
                        );?>
                        </div>*/?>
                    </div>
                </div>
                <div class="container">
                	<div class="row footerline">
                		<div class="hidden-lg hidden-md col-sm-12 col-xs-12 mobile-footer-menu-tumbl">
                			<i class="fa fa-chevron-down"></i>
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
                		<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 toggled-item">
                			<?
                			$APPLICATION->IncludeComponent(
                				"alexkova.market:menu",
                				"footer_cols",
                				Array(
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
                					"COLS" => "4",
                				),
                				false,
                				array('HIDE_ICONS'=>"Y")
                			);
                			?>
                		</div>
                		<div class="col-lg-2 col-md-2 col-sm-12 col-xs-12">
                			<a href="https://idea-promotion.ru/" target="blank" title="Создание и продвижение сайта - idea-promotion.ru"><img style="width:50%;" src="https://idea-promotion.ru/wp-content/themes/bloom/images/idea-logo.png" alt="Продвижение сайтов - idea-promotion.ru"></a>
                		</div>
                		<div class="hidden-lg hidden-md col-sm-12 col-xs-12 mobile-footer-menu-tumbl">
                			<i class="fa fa-chevron-down"></i>
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
                		<div class="col-lg-2 col-md-2 col-sm-12 col-xs-12 toggled-item">
                			<?
                			$APPLICATION->IncludeComponent("alexkova.market:menu", "footer_cols", Array(
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
                	<div class="col-lg-2 col-md-2 col-sm-12 col-xs-12 footer-about-company">
                		<?$APPLICATION->IncludeComponent(
                			"bitrix:main.include",
                			"named_area",
                			Array(
                				"AREA_FILE_SHOW" => "file",
                				"AREA_FILE_SUFFIX" => "inc",
                				"EDIT_TEMPLATE" => "",
                				"PATH" => SITE_DIR."include/footer_about_company.php",
                				"INCLUDE_PTITLE" => GetMessage("GHANGE_FOOTER_INFO")
                			),
                			false
                		);?>
                	</div>
                    <?/*<div class="hidden-lg hidden-md col-sm-12 col-xs-12">
                        <?$APPLICATION->IncludeComponent(
                            "bitrix:main.include",
                            "named_area",
                            Array(
                                "AREA_FILE_SHOW" => "file",
                                "AREA_FILE_SUFFIX" => "inc",
                                "EDIT_TEMPLATE" => "",
                                "PATH" => SITE_DIR."include/footer_socnet.php",
                                "INCLUDE_PTITLE" => GetMessage("GHANGE_FOOTER_SOCNET")
                            ),
                            false
                        );?>
                        </div>*/?>

                    </div>
                </div>
            </footer>

            <?$formFrame = new \Bitrix\Main\Page\FrameHelper("iblock_form");
            $formFrame->begin();?>
            <?$APPLICATION->IncludeComponent(
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
            );?>
            <?$formFrame->end();?>
            <?$formFrame = new \Bitrix\Main\Page\FrameHelper("iblock_form_request");
            $formFrame->begin();?>
            <?$APPLICATION->IncludeComponent(
            	"alexkova.market:form.iblock",
            	"request_trade",
            	array(
            		"IBLOCK_TYPE" => "forms",
            		"IBLOCK_ID" => "11",
            		"STATUS_NEW" => "NEW",
            		"USE_CAPTCHA" => "N",
            		"USER_MESSAGE_ADD" => GetMessage("FORM_ANSWER_RESULT"),
            		"RESIZE_IMAGES" => "N",
            		"MODE" => "link",
            		"PROPERTY_CODES" => array(
            			0 => "55",
            			1 => "56",
            			2 => "57",
            			3 => "58",
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
            );?>
            <?$formFrame->end();?>
            <?$formFrame = new \Bitrix\Main\Page\FrameHelper("iblock_form_one_click_buy");
            $formFrame->begin();?>
            <?$APPLICATION->IncludeComponent(
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
            );?>
            <?$formFrame->end();?>

            <!-- Yandex.Metrika counter -->
<?/*Old script type="text/javascript">
(function(m,e,t,r,i,k,a){m[i]=m[i]||function(){(m[i].a=m[i].a||[]).push(arguments)}; m[i].l=1*new Date();k=e.createElement(t),a=e.getElementsByTagName(t)[0],k.async=1,k.src=r,a.parentNode.insertBefore(k,a)}) (window, document, "script", "https://mc.yandex.ru/metrika/tag.js", "ym"); ym(49057298, "init", { id:49057298, clickmap:true, trackLinks:true, accurateTrackBounce:true, webvisor:true }); </script> <noscript><div><img src="https://mc.yandex.ru/watch/49057298" style="position:absolute; left:-9999px;" alt="" /></div></noscript*/?>
<!-- /Yandex.Metrika counter -->
<script type="text/javascript" >
	(function (d, w, c) {
		(w[c] = w[c] || []).push(function() {
			try {
				w.yaCounter49057298 = new Ya.Metrika({
					id:49057298,
					clickmap:true,
					trackLinks:true,
					accurateTrackBounce:true,
					webvisor:true
				});
			} catch(e) { }
		});

		var n = d.getElementsByTagName("script")[0],
		s = d.createElement("script"),
		f = function () { n.parentNode.insertBefore(s, n); };
		s.type = "text/javascript";
		s.async = true;
		s.src = "https://mc.yandex.ru/metrika/watch.js";

		if (w.opera == "[object Opera]") {
			d.addEventListener("DOMContentLoaded", f, false);
		} else { f(); }
	})(document, window, "yandex_metrika_callbacks");
</script>
<noscript><div><img src="https://mc.yandex.ru/watch/49057298" style="position:absolute; left:-9999px;" alt="" /></div></noscript>

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
<noscript><div><img src="https://mc.yandex.ru/watch/49057298" style="position:absolute; left:-9999px;" alt="" /></div></noscript>*/?>
<!-- /Yandex.Metrika counter -->

<!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-55778603-40"></script>
<script>
	window.dataLayer = window.dataLayer || [];
	function gtag(){dataLayer.push(arguments);}
	gtag('js', new Date());

	gtag('config', 'UA-55778603-40');
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
