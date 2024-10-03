<?$_SESSION["BXR_BASKET_TEMPLATE"] = "dinamic";?>
<div class="bxr-full-width bxr-top-headline" data-version="v31">
	<div class="container">
		<div class="row  bxr-basket-row">
			<div class="col-sm-2 col-xs-2 hidden-lg hidden-md bxr-mobile-login-area">
				<div class="bxr-counter-mobile hidden-lg hidden-md bxr-mobile-login-icon">
					<i class="fa fa-phone"></i>
				</div>
			</div>
			<div class="col-sm-10 col-xs-10 hidden-lg hidden-md bxr-mobile-phone-area">
				<div class="bxr-top-line-phones">
					<?$APPLICATION->IncludeComponent(
						"bitrix:main.include",
						"named_area",
						Array(
							"AREA_FILE_SHOW" => "file",
							"AREA_FILE_SUFFIX" => "inc",
							"EDIT_TEMPLATE" => "",
							"PATH" => SITE_DIR."include/mobile_phone.php",
							"INCLUDE_PTITLE" => GetMessage("GHANGE_MOBILE_PHONE")
						),
						false
					);?>
				</div>
			</div>
			<div class="col-sm-10 col-xs-10 col-lg-5 col-md-3  bxr-mobile-login-area">
				<div class="bxr-top-line-auth pull-left">
					<!-- <p>Официальный сайт компании <a href="https://frizar.ru" target="blank">frizar.ru</a></p> -->
					<?/*$basketFrame = new \Bitrix\Main\Page\FrameHelper("bxr_login_frame");
					$basketFrame->begin();?>
					<?$APPLICATION->IncludeComponent(
						"bitrix:system.auth.form",
						"popup",
						array(
							"REGISTER_URL" => SITE_DIR."auth/",
							"FORGOT_PASSWORD_URL" => SITE_DIR."auth/",
							"PROFILE_URL" => SITE_DIR."personal/",
							"SHOW_ERRORS" => "Y",
							"COMPONENT_TEMPLATE" => "popup"
						),
						false
					);?>
					<?$basketFrame->beginStub();
					echo "...";
					$basketFrame->end();*/?>
				</div>
			</div>
			<div class="col-sm-2 col-xs-2 hidden-lg hidden-md bxr-mobile-phone-area">
				<div class="bxr-counter-mobile hidden-lg hidden-md bxr-mobile-phone-icon">
					<i class="fa fa-user"></i>
				</div>
			</div>



			<div class="col-lg-12 hidden-sm hidden-xs text-right">
				<?/*$APPLICATION->IncludeComponent(
					"alexkova.market:menu",
					"top-line",
					array(
						"COMPONENT_TEMPLATE" => "top-line",
						"ROOT_MENU_TYPE" => "topline",
						"MENU_CACHE_TYPE" => "A",
						"MENU_CACHE_TIME" => "3600",
						"MENU_CACHE_USE_GROUPS" => "Y",
						"MENU_CACHE_GET_VARS" => array(
						),
						"MAX_LEVEL" => "1",
						"CHILD_MENU_TYPE" => "service",
						"USE_EXT" => "N",
						"DELAY" => "N",
						"ALLOW_MULTI_SELECT" => "N"
					),
					false
				);*/?>

				<?
				$basketFrame = new \Bitrix\Main\Page\FrameHelper("bxr_small_basket");
				$basketFrame->begin();?>
				<?$APPLICATION->IncludeComponent(
					"alexkova.market:basket.small",
					"dinamic",
					array(
						"COMPONENT_TEMPLATE" => "dinamic",
						"PATH_TO_BASKET" => SITE_DIR."personal/basket/",
						"PATH_TO_ORDER" => SITE_DIR."personal/order/",
						"USE_COMPARE" => "Y",
						"IBLOCK_TYPE" => "catalog",
						"IBLOCK_ID" => "17",
						"USE_DELAY" => "Y",
						"PRODUCT_PROVIDER_CLASS" => "",
						"MOBILE_BLOCK" => "bxr-basket-mobile"
					),
					false
				);?>
				<?$basketFrame->beginStub();
				echo "...";
				$basketFrame->end();?>
				<div class="bxr-top-line-auth pull-right">
					<?$basketFrame = new \Bitrix\Main\Page\FrameHelper("bxr_login_frame");
						$basketFrame->begin();?>
						<?$APPLICATION->IncludeComponent(
							"bitrix:system.auth.form",
							"popup",
							array(
								"REGISTER_URL" => SITE_DIR."auth/",
								"FORGOT_PASSWORD_URL" => SITE_DIR."auth/",
								"PROFILE_URL" => SITE_DIR."personal/",
								"SHOW_ERRORS" => "Y",
								"COMPONENT_TEMPLATE" => "popup"
							),
							false
						);?>
					<?$basketFrame->beginStub();
						echo "...";
					$basketFrame->end();?>
				</div>
			</div>


			<div class="clearfix"></div>
		</div>
	</div>
</div>
