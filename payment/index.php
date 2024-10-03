<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetPageProperty("description", "В данном разделе представлена информация о способах оплаты, доступных на нашем сайте.");
$APPLICATION->SetTitle("Способы оплаты");
?><div class="bxr-payment-block">
	<p class="pay-text">
		 Возможна <b>безналичная оплата</b>, для выставления счета необходимо обратиться к нашему менеджеру. <br>
		<br>
		 Для <b>онлайн оплаты</b> на нашем сайте мы предлагаем множество вариантов:
	</p>
	<div class="pay-wrap">
		<div class="pay">
			<div class="pay-head">
				<div class="pay-title">
					Банковские карты
				</div>
			</div>
			<div class="pay-desc">
				<div class="pay-img">
 <img src="<?=SITE_DIR?>images/payment/visa.png">
				</div>
				<div class="pay-img">
 <img src="<?=SITE_DIR?>images/payment/mastercard.png">
				</div>
			</div>
		</div>
		<div class="pay">
			<div class="pay-head">
				<div class="pay-title">
					Электронные деньги
				</div>
			</div>
			<div class="pay-desc">
				<div class="pay-img">
 <img src="<?=SITE_DIR?>images/payment/web_money.png">
				</div>
				<div class="pay-img">
 <img src="<?=SITE_DIR?>images/payment/qiwi_wallet.png">
				</div>
				<div class="pay-img">
 <img src="<?=SITE_DIR?>images/payment/dengi-mail.png">
				</div>
			</div>
		</div>
		<div class="pay">
			<div class="pay-head">
				<div class="pay-title">
					Терминалы моментальной оплаты
				</div>
			</div>
			<div class="pay-desc">
				<div class="pay-img">
 <img src="<?=SITE_DIR?>images/payment/qiwi.png">
				</div>
				<div class="pay-img">
 <img src="<?=SITE_DIR?>images/payment/elexnet.png">
				</div>
				<div class="pay-img">
 <img src="<?=SITE_DIR?>images/payment/mobil-e.png">
				</div>
				<div class="pay-img">
 <img src="<?=SITE_DIR?>images/payment/pinpay.png">
				</div>
			</div>
		</div>
		<div class="pay">
			<div class="pay-head">
				<div class="pay-title">
					Салоны связи
				</div>
			</div>
			<div class="pay-desc">
				<div class="pay-img">
 <img src="<?=SITE_DIR?>images/payment/svyaznoy.png">
				</div>
				<div class="pay-img">
 <img src="<?=SITE_DIR?>images/payment/evroset.png">
				</div>
			</div>
		</div>
		<div class="pay">
			<div class="pay-head">
				<div class="pay-title">
					Интернет банки
				</div>
			</div>
			<div class="pay-desc">
				<div class="pay-img">
 <img src="<?=SITE_DIR?>images/payment/sberbank.png">
				</div>
				<div class="pay-img">
 <img src="<?=SITE_DIR?>images/payment/abank.png">
				</div>
				<div class="pay-img">
 <img src="<?=SITE_DIR?>images/payment/vtb.png">
				</div>
				<div class="pay-img">
 <img src="<?=SITE_DIR?>images/payment/russtandart.png">
				</div>
			</div>
		</div>
	</div>
	<p>
 <b>Обращаем Ваше внимание, что если Вы хотите оплатить заказ в терминале или салоне связи, то вначале необходимо получить счет, используя сервис Мои заказы на нашем сайте. При необходимости обращайтесь за помощью к нашим менеджерам.</b>
	</p>
	<div class="pay-wrap">
		<div class="pay">
			<div class="pay-head">
				<div class="pay-title">
					Процесс передачи данных
				</div>
			</div>
			<div>
				Для оплаты (ввода реквизитов Вашей карты) Вы будете перенаправлены на платежный шлюз ПАО СБЕРБАНК.<br>
				 Соединение с платежным шлюзом и передача информации осуществляется в защищенном режиме с использованием протокола шифрования SSL. В случае если Ваш банк поддерживает технологию безопасного проведения интернет-платежей Verified By Visa или MasterCard SecureCode для проведения платежа также может потребоваться ввод специального пароля. Настоящий сайт поддерживает 256-битное шифрование. Конфиденциальность сообщаемой персональной информации обеспечивается ПАО СБЕРБАНК. Введенная информация не будет предоставлена третьим лицам за исключением случаев, предусмотренных законодательством РФ. Проведение платежей по банковским картам осуществляется в строгом соответствии с требованиями платежных систем МИР, Visa Int. и MasterCard Europe Sprl.
			</div>
		</div>
	</div>
</div><?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>