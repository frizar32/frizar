<div class="bxr-full-width bxr-container-headline head_v1 <?=($BXReady->inverseHead) ? 'bxr-inverse':''?>">
    <div class="container">
        <div class="row headline">
            <div class="col-lg-2 col-md-2 col-sm-6 col-xs-4 bxr-v-autosize">
                <?$APPLICATION->IncludeComponent(
                    "bitrix:main.include",
                    "named_area",
                    Array(
                        "AREA_FILE_SHOW" => "file",
                        "AREA_FILE_SUFFIX" => "inc",
                        "EDIT_TEMPLATE" => "",
                        "PATH" => SITE_DIR."include/logo.php",
                        "INCLUDE_PTITLE" => GetMessage("GHANGE_LOGO")
                    ),
                    false
                );?>
            </div>
            <div class="col-lg-1 col-md-1 hidden-sm hidden-xs bxr-v-autosize ololo">
                <?$APPLICATION->IncludeComponent(
					"bitrix:main.include",
					"include_with_btn",
					array(
						"AREA_FILE_SHOW" => "file",
						"AREA_FILE_SUFFIX" => "inc",
						"EDIT_TEMPLATE" => "",
						"PATH" => SITE_DIR."include/phone.php",
						"INCLUDE_PTITLE" => GetMessage("GHANGE_PHONE"),
						"COMPONENT_TEMPLATE" => "include_with_btn",
						"SHOW_BTN" => "Y",
						"BTN_TYPE" => "BTN",
						"BTN_CLASS" => "recall-btn open-answer-form",
						"FLOAT" => "RIGHT",
						"LINK_TEXT" => "Заказать обратный звонок"
					),
					false
				);?>
				<?/*<br><br>
				<p><a href="http://frizar.ru" target="_blank" class="pull-right">frizar.ru</a></p>*/?>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-8 bxr-v-autosize">
                <?
                $APPLICATION->IncludeComponent(
	"alexkova.new:search.title", 
	"rounded1", 
	array(
		"COMPONENT_TEMPLATE" => "rounded1",
		"NUM_CATEGORIES" => "1",
		"TOP_COUNT" => "50",
		"ORDER" => "rank",
		"USE_LANGUAGE_GUESS" => "Y",
		"CHECK_DATES" => "N",
		"SHOW_OTHERS" => "N",
		"PAGE" => "#SITE_DIR#catalog/",
		"SHOW_INPUT" => "Y",
		"INPUT_ID" => "title-search-input",
		"CONTAINER_ID" => "title-search",
		"CATEGORY_0_TITLE" => "Товары",
		"CATEGORY_0" => array(
			0 => "iblock_catalog",
		),
		"PRICE_CODE" => array(
			0 => "Продажи через сайт",
			1 => "Продажи через сайт РУБ",
			2 => "roznitsa",
		),
		"PRICE_VAT_INCLUDE" => "Y",
		"PREVIEW_TRUNCATE_LEN" => "200",
		"SHOW_PREVIEW" => "Y",
		"CONVERT_CURRENCY" => "Y",
		"PREVIEW_WIDTH" => "75",
		"PREVIEW_HEIGHT" => "75",
		"CATEGORY_0_iblock_catalog" => array(
			0 => "17",
		),
		"CURRENCY_ID" => "RUB",
		"COMPOSITE_FRAME_MODE" => "A",
		"COMPOSITE_FRAME_TYPE" => "AUTO",
		"FILTER_MD5" => $arResult["FILTER_MD5"]
	),
	false
);
                ?>
            </div>
            <div class="col-lg-3 col-md-3 hidden-sm hidden-xs bxr-v-autosize">
                <div class="slogan-wrap">
                    <?/*$APPLICATION->IncludeComponent(
                        "bitrix:main.include",
                        "named_area",
                        Array(
                            "AREA_FILE_SHOW" => "file",
                            "AREA_FILE_SUFFIX" => "inc",
                            "EDIT_TEMPLATE" => "",
                            "PATH" => SITE_DIR."include/slogan.php",
                            "INCLUDE_PTITLE" => GetMessage("GHANGE_SLOGAN")
                        ),
                        false
                    );*/?>
                    <div class="vcard">
						<span style="display:none" class="fn org">ООО "Фризар"</span>
						<span style="margin-top:0px;" class="bxr-color bxr-bg-hover-light fa fa-phone open-answer-form bxr-recall-btn"></span>
						<p class="tel">+7 (4832) 58-66-33</p>
						<!-- <p class="tel">+7 (4832) 58-66-38</p> -->
						<!--<span class="adr">г. Брянск ул. Литейная, д. 36А, офис 703/1</span>-->
						<div class="clearfix"></div>
			            <a class="bxr-font-color bxr-recall-link open-answer-form"><?=$arParams["LINK_TEXT"]?></a>
					</div>
                </div>
            </div>

			<div class="hidden-lg hidden-md col-sm-3 col-xs-12 bxr-v-autosize" id="bxr-basket-mobile">
				<?// this block if basket mobile container base?>

			</div>
			<div class="hidden-lg hidden-md col-sm-12 col-xs-12">
				<p><a href="https://frizar.ru" target="_blank" class="pull-right" style="margin-top: 10px;">frizar.ru</a></p>
			</div>
            <div class="clearfix"></div>
        </div>
    </div>
</div>
