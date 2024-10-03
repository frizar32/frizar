<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetPageProperty("description", "Предлагаем вам ознакомиться с информацией относительно системы доставки заказов в нашем магазине.");
$APPLICATION->SetTitle("Доставка заказов");
?>
    <div class="bxr-delivery-block">
        <p class="delivery-text">
			При заказе на сумму менее 15 000 руб.,  доставка осуществляется любой транспортной компанией за счет покупателя.<br />
При заказе на сумму от 15 000 руб., доставка транспортной компанией ООО «Деловые Линии» до пункта выдачи в вашем городе за счет shop.frizar.ru.<br />
При заказе на сумму от 30 000 руб., доставка транспортной компанией ООО «Деловые Линии» до адреса покупателя, за счет поставщика.<br />
При заказе на сумму от 45 000 руб., доставка предпочтительной для покупателя транспортной компанией или службой доставки до указанного покупателем адреса, за счет shop.frizar.ru. 
        </p>
		<?/*?>
        <div class="delivery-wrap">
            
            <div class="delivery">
                <div class="delivery-head">
                    <div class="delivery-title">До пункта выдачи</div>
                </div>
                <div class="delivery-desc">
                    <div class="delivery-img">
                        <img src="<?=SITE_DIR?>images/delivery/logo_boxberry.png">
                    </div>
                    <div class="delivery-img">
                        <img src="<?=SITE_DIR?>images/delivery/logo_dpdpvz.png">
                    </div>
                    <div class="delivery-img">
                        <img src="<?=SITE_DIR?>images/delivery/logo_hermes-dpd.png">
                    </div>
                    <div class="delivery-img">
                        <img src="<?=SITE_DIR?>images/delivery/logo_imlogisticspvz.png">
                    </div>
                    <div class="delivery-img">
                        <img src="<?=SITE_DIR?>images/delivery/logo_pickpoint.png">
                    </div>
                    <div class="delivery-img">
                        <img src="<?=SITE_DIR?>images/delivery/logo_qiwipost.png">
                    </div>
                </div>
            </div>
            <div class="delivery">
                <div class="delivery-head">
                    <div class="delivery-title">Курьером</div>
                </div>
                <div class="delivery-desc">
                    <div class="delivery-desc-item">
                        <div class="delivery-img">
                            <img src="<?=SITE_DIR?>images/delivery/logo_imlogisticspvz.png">
                        </div>
                        <div class="delivery-item-info">
                            <b>СРОК: 5-6 ДНЕЙ</b><br>
                            при заказе от 3500 Р / при оплате онлайн - <b>бесплатно</b><br>
                            при заказе меньше 3500 Р - <b>190 Р</b><br><br>
                        </div>
                        <div class="delivery-item-text">
                            <b>КАК ДОСТАВЯТ:</b><br>
                                Доставка осуществляется в будние дни с 11.00 до 18.00<br><br>
                            <b>ИНФОРМИРОВАНИЕ О ЗАКАЗЕ:</b><br>
                                Вам придет уведомление по SMS и на e-mail об отправке посылки. Курьер звонит за 40-60 минут до доставки<br><br>
                            <b>КАК МОЖНО ВЕРНУТЬ:</b><br>
                                После получения можно вернуть товар следующими способами:
                                <ul>
                                    <li>IM-Logistics (Курьер). Закажите приезд курьера для принятия возврата через службу 
                                        поддержки и возвратите товар. Получите компенсацию по возврату товара в магазин.</li>
                                    <li>- IM-Logistics (Пункт Выдачи). Закажите возврат посылки в пункт выдачи через службу поддержки 
                                        и возвратите товар. Получите компенсацию по возврату товара в магазин.</li>
                                </ul>
                            <b>КАК ПОЛУЧИТЬ ЧЕК:</b><br>
                                При частичном выкупе товара - выдача чека курьером невозможна. 
                                Если Вы отказались при получении от части товара, чек Вы можете 
                                получить на следующий день после доставки заказа. Для этого Вам необходимо 
                                связаться с курьерской службой IML по телефону: 8(495)988-49-05 (ПН-ПТ 09:00–19:00, СБ 09:00–18:00), 
                                сообщив номер заказа и договориться о доставке чека.<br>
                        </div>
                        <a href="javascript:void(0)" class="delivery-item-more"><span class="fa fa-angle-down"></span> Узнать больше</a>
                        <div class="clear"></div>
                    </div>
                    
                    <div class="delivery-desc-item">
                        <div class="delivery-img">
                            <img src="<?=SITE_DIR?>images/delivery/logo_emspost.png">
                        </div>
                        <div class="delivery-item-info">
                            <b>СРОК: 6-9 ДНЕЙ</b><br>
                            при заказе от 5000 Р - <b>690 Р</b><br>
                            при заказе меньше 5000 Р - <b>1379 Р</b><br><br>
                        </div>
                        <div class="delivery-item-text">
                            <b>КАК ДОСТАВЯТ:</b><br>
                                Экспресс-доставка EMS Почта России доставит Ваш заказ в самые короткие сроки по 
                                всей России (2-5 дня в центральные города области, 3-10 дней в остальные города)<br><br>
                            <b>ИНФОРМИРОВАНИЕ О ЗАКАЗЕ:</b><br>
                                Вам придет уведомление на sms, e-mail об отправке посылки, с указанием 
                                прогнозируемого срока доставки. Перед доставкой с Вами связываются телефону, указанному в заказе.<br><br>
                            <b>КАК МОЖНО ВЕРНУТЬ:</b><br>
                            После получения можно вернуть товар следующими способами:
                            <ul>
                                <li>Почтой России. Заполните заявление, отправьте почтой. Получите компенсацию по приходу возврата в магазин</li>
                                <li>IM-Logistics (Курьер). Закажите приезд курьера для принятия возврата через службу поддержки и возвратите товар. Получите компенсацию по возврату товара в магазин.</li>
                                <li>IM-Logistics (Пункт Выдачи). Закажите возврат посылки в пункт выдачи через службу поддержки и возвратите товар. Получите компенсацию по возврату товара в магазин.</li>
                            </ul>
                        </div>
                        <a href="javascript:void(0)" class="delivery-item-more"><span class="fa fa-angle-down"></span> Узнать больше</a>
                        <div class="clear"></div>
                    </div>
                    <div class="delivery-desc-item">
                        <div class="delivery-img">
                            <img src="<?=SITE_DIR?>images/delivery/logo_dpdpvz.png">
                        </div>
                        <div class="delivery-item-info">
                            <b>СРОК: 5 ДНЕЙ</b><br>
                            при заказе от 8500 Р - <b>450 Р</b><br>
                            при заказе меньше 8500 Р - <b>679 Р</b><br><br>
                        </div>
                        <div class="delivery-item-text">
                            <b>КАК ДОСТАВЯТ:</b><br>
                            Доставка осуществляется курьером по указанному в заказе адресу в кратчайшие сроки. Представитель курьерской службы свяжется с Вами по контактному телефону для согласования даты и времени доставки<br><br>
                            <b>ИНФОРМИРОВАНИЕ О ЗАКАЗЕ:</b><br>
                            Вам придет уведомление по SMS и на e-mail об отправке посылки, а также sms и e-mail о прогнозируемой доставке и телефонный звонок при согласовании времени доставки<br><br>
                            <b>КАК МОЖНО ВЕРНУТЬ:</b><br>
                            После получения можно вернуть товар следующими способами:
                            <ul>
                                <li>Почтой России. Заполните заявление, отправьте почтой. Получите компенсацию по приходу возврата в магазин</li>
                                <li>IM-Logistics (Курьер). Закажите приезд курьера для принятия возврата через службу поддержки и возвратите товар. Получите компенсацию по возврату товара в магазин.</li>
                                <li>IM-Logistics (Пункт Выдачи). Закажите возврат посылки в пункт выдачи через службу поддержки и возвратите товар. Получите компенсацию по возврату товара в магазин.</li>
                            </ul>
                        </div>
                        <a href="javascript:void(0)" class="delivery-item-more"><span class="fa fa-angle-down"></span> Узнать больше</a>
                        <div class="clear"></div>
                    </div>
                </div>
            </div>
            <div class="delivery">
                <div class="delivery-head">
                    <div class="delivery-title">Почтой</div>
                </div>
                <div class="delivery-desc">
                    <div class="delivery-img">
                        <img src="<?=SITE_DIR?>images/delivery/logo_table.png">
                    </div>
                    <div class="delivery-item-info">
                        <b>СРОК: 17 ДНЕЙ</b><br>
                        <b>570 Р</b><br>
                    </div>
                    <div class="delivery-item-text" style="display: block;">
                        <b>КАК ДОСТАВЯТ:</b><br>
                            До отделения почты РФ, по индексу, ближайшему к адресу доставки<br><br>
                        <b>ИНФОРМИРОВАНИЕ О ЗАКАЗЕ:</b><br>
                            Вам придет уведомление по SMS и на e-mail об отправке посылки, а также sms и e-mail о прогнозируемой доставке и извещение в ваш почтовый ящик<br><br>
                        <b>КАК МОЖНО ВЕРНУТЬ:</b><br>
                            После получения можно вернуть товар следующими способами:
                            <ul>
                                <li>Почтой России. Заполните заявление, отправьте почтой. Получите компенсацию по приходу возврата в магазин</li>
                                <li>IM-Logistics (Курьер). Закажите приезд курьера для принятия возврата через службу поддержки и возвратите товар. Получите компенсацию по возврату товара в магазин.</li>
                                <li>IM-Logistics (Пункт Выдачи). Закажите возврат посылки в пункт выдачи через службу поддержки и возвратите товар. Получите компенсацию по возврату товара в магазин.</li>
                            </ul>
                    </div>
                    <div class="clear"></div>
                </div>
            </div>
            
        </div>

        <p>

        </p>
		<?*/?>
    </div>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>

