<?php
namespace frontend\widgets;

use Yii;

class RightBottomMenuLinks extends \yii\bootstrap\Widget
{
    public function init()
    {
        $menuInfoLinks = [
            'productcard' => '<a href="' . BASEURL . '/page?article=product-card">Карточка товара</a>',
            'cooperation' => '<a href="' . BASEURL . '/page?article=contribution">Сотрудничество</a>',
            'cooperationTerms' => '<a href="' . BASEURL . '/page?article=contributionrules">Условия сотрудничества</a>',
            'ourModels' => '<a href="' . BASEURL . '/article?view=models">Наши модели</a>',
            'howToOrder' => '<a href="' . BASEURL . '/page?article=howorders">Как сделать заказ</a>',
            'sberOnline' => '<a href="' . BASEURL . '/page?article=sberonline">Оплата через Сбербанк Онлайн</a>',
            'priceXLS' => '<a  href="http://odezhda-master.ru/price_list_xls.php">Прайс-лист *.xls</a>',
            'priceCSV' => '<a href="http://odezhda-master.ru/price_list_csv.php">Прайс-лист *.csv</a>',
            'sizeChart' => '<a href="' . BASEURL . '/article?view=sizes">Размерная сетка</a>'
        ];
        $menuQuestionsLinks = [
            'weekend' => '<a href="' . BASEURL . '/page?article=weekwork">Как вы работаете в выходные?</a>',
            'prepayment' => '<a href="' . BASEURL . '/page?article=prepayorder">Как работать по предоплате?</a>',
            'defect' => '<a href="' . BASEURL . '/page?article=bad_quality">Как оформить претензию?</a>',
            'complaint' => '<a href="' . BASEURL . '/page?article=complaint">Если пришел брак?</a>',
            'delivery' => '<a href="' . BASEURL . '/page?article=delivery">Стоимость и сроки доставки</a>',
            'sendTime' => '<a href="' . BASEURL . '/page?article=timedelivery">Когда отправляете товар?</a>',
            'paymentTime' => '<a href="' . BASEURL . '/page?article=timepay">Сколько дней поступает оплата?</a>',
            'howToPay' => '<a href="' . BASEURL . '/page?article=productpayment">Как оплатить товар?</a>',
            'howToSend' => '<a href="' . BASEURL . '/page?article=deliveryway">Способ доставки?</a>',
            'reOrder' => '<a href="' . BASEURL . '/page?article=order-plus">ДОЗАКАЗ?</a>',
            'changeOrder' => '<a href="' . BASEURL . '/page?article=order-change">Как изменить заказ?</a>',
            'orderBuildTime' => '<a href="' . BASEURL . '/page?article=order-time">Сроки сборки заказа?</a>'
        ];
        echo '<div class="menulinks"><div><div class="menulinks_header">Информация</div>';
        foreach ($menuInfoLinks as $key => $value) {
            echo $value;
        }
        echo '</div><div><div class="menulinks_header">Частые вопросы</div>';
        foreach ($menuQuestionsLinks as $key => $value) {
            echo $value;
        }
        echo '</div></div>';
    }
}