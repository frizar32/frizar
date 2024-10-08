<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?
// подключаем файл модуля капчи
include_once($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/classes/general/captcha.php");

// создаем объект капчи
$cpt = new CCaptcha();

// достаём значение параметра captcha_password из главного модуля
$captchaPass = COption::GetOptionString("main", "captcha_password", "");

// если строка пуста, генерируем случайное значение
If (strlen($captchaPass) <= 0) {
    $captchaPass = randString(10);
    COption::SetOptionString("main", "captcha_password", $captchaPass); }

$cpt->SetCodeCrypt($captchaPass);



foreach($arResult["MESSAGE"] as $itemID=>$itemValue)
	echo ShowMessage(array("MESSAGE"=>$itemValue, "TYPE"=>"OK"));
foreach($arResult["ERROR"] as $itemID=>$itemValue)
	echo ShowMessage(array("MESSAGE"=>$itemValue, "TYPE"=>"ERROR"));

if($arResult["ALLOW_ANONYMOUS"]=="N" && !$USER->IsAuthorized()):
	echo ShowMessage(array("MESSAGE"=>GetMessage("CT_BSE_AUTH_ERR"), "TYPE"=>"ERROR"));
else:
?>
<div class="subscription bxr-subscription">
	<form action="<?=$arResult["FORM_ACTION"]?>" method="post">
	<?echo bitrix_sessid_post();?>
	<input type="hidden" name="PostAction" value="<?echo ($arResult["ID"]>0? "Update":"Add")?>" />
	<input type="hidden" name="ID" value="<?echo $arResult["SUBSCRIPTION"]["ID"];?>" />
	<input type="hidden" name="RUB_ID[]" value="0" />

	<div class="subscription-title">
		<b class="r2"></b><b class="r1"></b><b class="r0"></b>
		<div class="subscription-title-inner"><?echo GetMessage("CT_BSE_SUBSCRIPTION_FORM_TITLE")?></div>
	</div>

	<div class="subscription-form ">

		<table cellspacing="0" class="subscription-layout">
			<tr>
				<td class="field-name"><?echo GetMessage("CT_BSE_EMAIL_LABEL")?></td>
                                <td class="field-form">
                                    <input type="text" name="EMAIL" value="<?echo $arResult["SUBSCRIPTION"]["EMAIL"]!=""? $arResult["SUBSCRIPTION"]["EMAIL"]: $arResult["REQUEST"]["EMAIL"];?>" class="subscription-email" />
				</td>
			</tr>
                        <tr>
                            <td class="field-name"><?echo GetMessage("CT_BSE_FORMAT_LABEL")?></td>
                            <td class="field-form">
				<input type="radio" name="FORMAT" id="MAIL_TYPE_TEXT" value="text" <?if($arResult["SUBSCRIPTION"]["FORMAT"] != "html") echo "checked"?> /><label for="MAIL_TYPE_TEXT"><?echo GetMessage("CT_BSE_FORMAT_TEXT")?></label>&nbsp;<input type="radio" name="FORMAT" id="MAIL_TYPE_HTML" value="html" <?if($arResult["SUBSCRIPTION"]["FORMAT"] == "html") echo "checked"?> /><label for="MAIL_TYPE_HTML"><?echo GetMessage("CT_BSE_FORMAT_HTML")?></label>
                            </td>
                        </tr>
			<tr>
				<td class="field-name"><?echo GetMessage("CT_BSE_RUBRIC_LABEL")?></td>
				<td class="field-form">
					<?foreach($arResult["RUBRICS"] as $itemID => $itemValue):?>
						<div class="subscription-rubric">
							<input type="checkbox" id="RUBRIC_<?echo $itemID?>" name="RUB_ID[]" value="<?=$itemValue["ID"]?>"<?if($itemValue["CHECKED"]) echo " checked"?> /><label for="RUBRIC_<?echo $itemID?>"><b><?echo $itemValue["NAME"]?></b><span><?echo $itemValue["DESCRIPTION"]?></span></label>
						</div>
					<?endforeach;?>
                                </td>
			</tr>
                        <tr>
                            <td class="field-name"></td>
                            <td class="field-form">
                                <?if($arResult["ID"]==0):?>
                                        <div class="subscription-notes"><?echo GetMessage("CT_BSE_NEW_NOTE")?></div>
                                <?else:?>
                                        <div class="subscription-notes"><?echo GetMessage("CT_BSE_EXIST_NOTE")?></div>
                                <?endif?>
								<br/>
								<p style="font-weight:600;">Введите проверочный код:</p>
								<input name="captcha_code"value="<?=htmlspecialchars($cpt->GetCodeCrypt());?>"type="hidden">

<img style="width:165px;" src="/bitrix/tools/captcha.php?captcha_code=<?=htmlspecialchars($cpt->GetCodeCrypt());?>"><br/><br/>

<input id="captcha_word"name="captcha_word"type="text" style="width:165px;">
                                        <div class="subscription-buttons"><input type="submit" name="Save" class="bxr-color-button" value="<?echo ($arResult["ID"] > 0? GetMessage("CT_BSE_BTN_EDIT_SUBSCRIPTION"): GetMessage("CT_BSE_BTN_ADD_SUBSCRIPTION"))?>" /></div>
                            </td>
                        </tr>
		</table>
	</div>

	<?if($arResult["ID"]>0 && $arResult["SUBSCRIPTION"]["CONFIRMED"] <> "Y"):?>
	<div class="subscription-utility">
            <p><?echo GetMessage("CT_BSE_CONF_NOTE")?></p>
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-8">
                        <input name="CONFIRM_CODE" type="text" class="subscription-textbox" value="<?echo GetMessage("CT_BSE_CONFIRMATION")?>" onblur="if (this.value=='')this.value='<?echo GetMessage("CT_BSE_CONFIRMATION")?>'" onclick="if (this.value=='<?echo GetMessage("CT_BSE_CONFIRMATION")?>')this.value=''" />
                    </div>
                    <div class="col-md-4">    
                        <input type="submit" name="confirm" value="<?echo GetMessage("CT_BSE_BTN_CONF")?>" />
                    </div>
                </div>
            </div>
	</div>
	<?endif?>

	</form>

	<?if(!CSubscription::IsAuthorized($arResult["ID"])):?>
	<form action="<?=$arResult["FORM_ACTION"]?>" method="post">
	<?echo bitrix_sessid_post();?>
	<input type="hidden" name="action" value="sendcode" />

	<div class="subscription-utility">
            <p><?echo GetMessage("CT_BSE_SEND_NOTE")?></p>
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-8">
                        <input name="sf_EMAIL" type="text" class="subscription-textbox" value="<?echo GetMessage("CT_BSE_EMAIL")?>" onblur="if (this.value=='')this.value='<?echo GetMessage("CT_BSE_EMAIL")?>'" onclick="if (this.value=='<?echo GetMessage("CT_BSE_EMAIL")?>')this.value=''" />
                    </div>
                    <div class="col-md-4">
                        <input type="submit" class="bxr-color-button" value="<?echo GetMessage("CT_BSE_BTN_SEND")?>" />
                    </div>
                </div>
            </div>
	</div>
	</form>
	<?endif?>

</div>
<?endif;?>