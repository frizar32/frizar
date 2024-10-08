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

$buttonId = $this->randString();
?>
<div class="bxr-subscribe"  id="sender-subscribe">
<?
$frame = $this->createFrame("sender-subscribe", false)->begin();
?>
	<form role="form" method="post" action="<?=$arResult["FORM_ACTION"]?>">
            <?=bitrix_sessid_post()?>
            <input type="hidden" name="sender_subscription" value="add">
            <div class="bxr-sender-subscribe-container horizontal container-fluid">
                <div class="row">
                    <div class="col-md-4 bxr-subscribe-motto">
                        <img src="<?=$this->GetFolder().'/images/ico_mail.png'?>" alt="" />
                        <div class="bxr-subscribe-text">
                            <b><?=GetMessage("stay_touch")?></b><br>
                           <?=GetMessage("news_reviews_promotions")?>
                        </div>
                    </div>
                    <div class="col-md-3 bxr-subscribe-rubrics">
                        <?if(isset($arParams["SHOW_RUBRICS"]) && $arParams["SHOW_RUBRICS"]=="Y"):?>
                        <?if(count($arResult["RUBRICS"])>0):?>
                            <div class="bxr-subscribe-desc"><?=GetMessage("subscr_form_title_desc")?></div>
                        <?endif;?>
                            <div class="bxr_subscribe_checkbox_container"><ul>
                                <?foreach($arResult["RUBRICS"] as $itemID => $itemValue):?>
                                    <li>
                                        <input type="checkbox" name="SENDER_SUBSCRIBE_RUB_ID[]" id="SENDER_SUBSCRIBE_RUB_ID_<?=$itemValue["ID"]?>" value="<?=$itemValue["ID"]?>"<?if($itemValue["CHECKED"]) echo " checked"?>>
                                        <label for="SENDER_SUBSCRIBE_RUB_ID_<?=$itemValue["ID"]?>"><?=htmlspecialcharsbx($itemValue["NAME"])?></label>
                                    </li>
                                <?endforeach;?>
                            </ul></div>
                        <?endif;?>
                    </div>
                    <div class="col-md-3 bxr-input-group">
                        <input class="bxr-form-control" type="email" name="SENDER_SUBSCRIBE_EMAIL" value="<?=$arResult["EMAIL"]?>" title="<?=GetMessage("subscr_form_email_title")?>" placeholder="<?=htmlspecialcharsbx(GetMessage('subscr_form_email_title'))?>">
                    </div>
                    <div class="col-md-2 bxr_subscribe_submit_container" style="padding-top:17px;">
                        <button id="bxr_subscribe_btn_<?=$buttonId?>" class="bxr-color-button" value="79" tabindex="0"><?=GetMessage("subscr_form_button")?></button>
                    </div>
                </div>
            </div>
	</form>
<?
$frame->beginStub();
?>
	<form role="form" method="post" action="<?=$arResult["FORM_ACTION"]?>" >
            <?=bitrix_sessid_post()?>
            <input type="hidden" name="sender_subscription" value="add">
            <div class="bxr-sender-subscribe-container horizontal container-fluid">
                <div class="row">
                    <div class="col-md-4 bxr-subscribe-motto">
                        <img src="<?=$this->GetFolder().'/images/ico_mail.png'?>" alt="" />
                        <div class="bxr-subscribe-text">
                            <b><?=GetMessage("stay_touch")?></b><br>
                           <?=GetMessage("news_reviews_promotions")?>
                        </div>
                    </div>
                    <div class="col-md-3 bxr-subscribe-rubrics">
                        <?if(isset($arParams["SHOW_RUBRICS"]) && $arParams["SHOW_RUBRICS"]=="Y"):?>
                        <?if(count($arResult["RUBRICS"])>0):?>
                            <div class="bxr-subscribe-desc"><?=GetMessage("subscr_form_title_desc")?></div>
                        <?endif;?>
                            <div class="bxr_subscribe_checkbox_container"><ul>
                                <?foreach($arResult["RUBRICS"] as $itemID => $itemValue):?>
                                    <li>
                                        <input type="checkbox" name="SENDER_SUBSCRIBE_RUB_ID[]" id="SENDER_SUBSCRIBE_RUB_ID_<?=$itemValue["ID"]?>" value="<?=$itemValue["ID"]?>">
                                        <label for="SENDER_SUBSCRIBE_RUB_ID_<?=$itemValue["ID"]?>"><?=htmlspecialcharsbx($itemValue["NAME"])?></label>
                                    </li>
                                <?endforeach;?>
                            </ul></div>
                        <?endif;?>
                    </div>
                    <div class="col-md-3 bxr-input-group">
                        <input class="bxr-form-control" type="email" name="SENDER_SUBSCRIBE_EMAIL" value="" title="<?=GetMessage("subscr_form_email_title")?>" placeholder="<?=htmlspecialcharsbx(GetMessage('subscr_form_email_title'))?>">
                    </div>
                    <div class="col-md-2 bxr_subscribe_submit_container">
                        <button id="bxr_subscribe_btn_<?=$buttonId?>" class="bxr-color-button" value="79" tabindex="0"><?=GetMessage("subscr_form_button")?></button>
                    </div>
                </div>
            </div>
	</form>
<?
$frame->end();
?>
</div>
