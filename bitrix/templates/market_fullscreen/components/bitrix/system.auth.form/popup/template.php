<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
/** @var array $arParams */
/** @var array $arResult */
/** @global CMain $APPLICATION */
/** @global CUser $USER */
/** @global CDatabase $DB */
/** @var CBitrixComponentTemplate $this */
/** @var string $templateName */
/** @var string $templateFile */
/** @var string $templateFolder */
/** @var string $componentPath */
/** @var CBitrixComponent $component */

CJSCore::Init(array("popup"));
?>
<div class="bx_login_block">
	<span id="login-line">
	<?
	$frame = $this->createFrame("login-line", false)->begin();
		if ($arResult["FORM_TYPE"] == "login")
		{
		?>
			<a class="bx_login_top_inline_link" title="<?=GetMessage("AUTH_LOGIN")?>" href="javascript:void(0)<?//=$arResult["AUTH_URL"]?>" onclick="openAuthorizePopup()">
				<svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 22 22" fill="none">
						<path fill-rule="evenodd" clip-rule="evenodd" d="M2.69934 5.00001C2.69934 3.0394 4.28873 1.45001 6.24934 1.45001H18.2493C20.21 1.45001 21.7993 3.0394 21.7993 5.00001V17C21.7993 18.9606 20.21 20.55 18.2493 20.55H6.24934C4.28873 20.55 2.69934 18.9606 2.69934 17V14.7064H3.79934V17C3.79934 18.3531 4.89624 19.45 6.24934 19.45H18.2493C19.6024 19.45 20.6993 18.3531 20.6993 17V5.00001C20.6993 3.64691 19.6024 2.55001 18.2493 2.55001H6.24934C4.89624 2.55001 3.79934 3.64691 3.79934 5.00001V7.2286H2.69934V5.00001Z" fill="#070707"/>
						<path fill-rule="evenodd" clip-rule="evenodd" d="M10.3695 7.11092L13.8697 10.6111C14.0844 10.8259 14.0844 11.1741 13.8697 11.3889L10.3695 14.8891C10.1547 15.1039 9.80644 15.1039 9.59166 14.8891C9.37687 14.6743 9.37687 14.3261 9.59166 14.1113L12.1529 11.55L0.200562 11.55L0.200562 10.45L12.1529 10.45L9.59166 7.88874C9.37687 7.67395 9.37687 7.32571 9.59166 7.11092C9.80644 6.89613 10.1547 6.89613 10.3695 7.11092Z" fill="black"/>
				</svg>
				<span><?=GetMessage("AUTH_LOGIN")?></span>
			</a>
			<?if($arResult["NEW_USER_REGISTRATION"] == "Y"):?>
			<a class="bx_login_top_inline_link" href="<?=$arResult["AUTH_REGISTER_URL"]?>" >
				<svg xmlns="http://www.w3.org/2000/svg" width="21" height="20" viewBox="0 0 21 20" fill="none">
						<path d="M19.4058 6.99372V15.9911C19.4058 17.6479 18.0626 18.9911 16.4058 18.9911H4.40576C2.74891 18.9911 1.40576 17.6479 1.40576 15.9911V3.99106C1.40576 2.3342 2.74891 0.991058 4.40576 0.991058H13.4292" stroke="#070707" stroke-width="1.1"/>
						<mask id="path-2-inside-1_342_170" fill="white">
						<rect x="18.3501" y="0.15387" width="3.32035" height="13.9444" rx="0.75" transform="rotate(47.4777 18.3501 0.15387)"/>
						</mask>
						<rect x="18.3501" y="0.15387" width="3.32035" height="13.9444" rx="0.75" transform="rotate(47.4777 18.3501 0.15387)" stroke="#070707" stroke-width="1" mask=""/>
						<path d="M9.89438 12.6298L7.54321 10.0648L6.66813 13.1085L9.89438 12.6298Z" fill="#070707"/>
				</svg>
				<span><?=GetMessage("AUTH_REGISTER")?></span>
			</a>
			<?endif;
		}
		else
		{
			$name = trim($USER->GetFullName());
			if (strlen($name) <= 0)
				$name = $USER->GetLogin();
		?>

			<a class="bx_login_top_inline_link" href="<?=$APPLICATION->GetCurPageParam("logout=yes", Array("logout"))?>">
				<svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 22 22" fill="none">
				<path fill-rule="evenodd" clip-rule="evenodd" d="M2.69934 5.00001C2.69934 3.0394 4.28873 1.45001 6.24934 1.45001H18.2493C20.21 1.45001 21.7993 3.0394 21.7993 5.00001V17C21.7993 18.9606 20.21 20.55 18.2493 20.55H6.24934C4.28873 20.55 2.69934 18.9606 2.69934 17V14.7064H3.79934V17C3.79934 18.3531 4.89624 19.45 6.24934 19.45H18.2493C19.6024 19.45 20.6993 18.3531 20.6993 17V5.00001C20.6993 3.64691 19.6024 2.55001 18.2493 2.55001H6.24934C4.89624 2.55001 3.79934 3.64691 3.79934 5.00001V7.2286H2.69934V5.00001Z" fill="#070707"/>
				<path fill-rule="evenodd" clip-rule="evenodd" d="M6.66129 14.9393L3.16111 11.4391C2.94632 11.2243 2.94632 10.876 3.16111 10.6613L6.66129 7.16108C6.87608 6.94629 7.22432 6.94629 7.43911 7.16108C7.65389 7.37586 7.65389 7.72411 7.43911 7.93889L4.87784 10.5002L16.8302 10.5002L16.8302 11.6002L4.87784 11.6002L7.43911 14.1614C7.65389 14.3762 7.65389 14.7245 7.43911 14.9393C7.22432 15.154 6.87608 15.154 6.66129 14.9393Z" fill="black"/>
				</svg>
				<span><?=GetMessage("AUTH_LOGOUT")?></span>
			</a>
			<a class="bx_login_top_inline_link" href="<?=$arResult['PROFILE_URL']?>">
				<svg xmlns="http://www.w3.org/2000/svg" width="21" height="20" viewBox="0 0 21 20" fill="none">
						<path d="M19.4058 6.99372V15.9911C19.4058 17.6479 18.0626 18.9911 16.4058 18.9911H4.40576C2.74891 18.9911 1.40576 17.6479 1.40576 15.9911V3.99106C1.40576 2.3342 2.74891 0.991058 4.40576 0.991058H13.4292" stroke="#070707" stroke-width="1.1"/>
						<mask id="path-2-inside-1_342_170" fill="white">
						<rect x="18.3501" y="0.15387" width="3.32035" height="13.9444" rx="0.75" transform="rotate(47.4777 18.3501 0.15387)"/>
						</mask>
						<rect x="18.3501" y="0.15387" width="3.32035" height="13.9444" rx="0.75" transform="rotate(47.4777 18.3501 0.15387)" stroke="#070707" stroke-width="1" mask=""/>
						<path d="M9.89438 12.6298L7.54321 10.0648L6.66813 13.1085L9.89438 12.6298Z" fill="#070707"/>
				</svg>
				<span><?=htmlspecialcharsEx($name);?></span>
			</a>
		<?
		}
	$frame->beginStub();
		?>
		<a class="bx_login_top_inline_link" href="javascript:void(0)<?//=$arResult["AUTH_URL"]?>" onclick="openAuthorizePopup()"><?=GetMessage("AUTH_LOGIN")?></a>
		<?if($arResult["NEW_USER_REGISTRATION"] == "Y"):?>
			<a class="bx_login_top_inline_link" href="<?=$arResult["AUTH_REGISTER_URL"]?>" ><?=GetMessage("AUTH_REGISTER")?></a>
		<?endif;
	$frame->end();
	?>
	</span>
</div>

<?if ($arResult["FORM_TYPE"] == "login"):?>
	<div id="bx_auth_popup_form" style="display:none;" class="bx_login_popup_form">
	<?$APPLICATION->IncludeComponent("bitrix:system.auth.form", "popup_auth",
		array(
			"BACKURL" => $arResult["BACKURL"],
			"AUTH_FORGOT_PASSWORD_URL" => $arResult["AUTH_FORGOT_PASSWORD_URL"],
		),
		false
	);
	?>
	</div>

	<script>
		function openAuthorizePopup()
		{
			<?
			$sizes = "width:400px;height:300px";
			$allowSocAuth = COption::GetOptionString("main","allow_socserv_authorization","Y");
			if($allowSocAuth == "Y" && $arResult["AUTH_SERVICES"])
				$sizes =  "width:500px;height:400px";
			?>
			var authPopup = BX.PopupWindowManager.create("AuthorizePopup", null, {
				autoHide: true,
				//	zIndex: 0,
				offsetLeft: 0,
				offsetTop: 0,
				overlay : true,
				draggable: {restrict:true},
				closeByEsc: true,
				closeIcon: { right : "12px", top : "10px"},
				titleBar: {content: BX.create("span", {html: "<div><?=GetMessage("AUTH_TITLE");?></div>"})},
				content: '<div style="<?=$sizes?>; text-align: center;"><span style="position:absolute;left:50%; top:50%"><img src="<?=$this->GetFolder()?>/images/wait.gif"/></span></div>',
				events: {
					onAfterPopupShow: function()
					{
						this.setContent(BX("bx_auth_popup_form"));
					}
				}
			});
			authPopup.show();
		}
	</script>
<?endif?>
