<?php
namespace frontend\widgets;

use Yii;

class RightTopMenuLinks extends \yii\bootstrap\Widget
{
    public function init()
    {
        $menuInfoLinks=[
            'cooperation'=>'<a href="'.BASEURL.'/discont">Распродажа</a>',
//            'ourModels'=>'<a href="'.BASEURL.'/odezhda-i-obuv">Новинки одежда и обувь</a>',
//            'cooperationTerms'=>'<a href="'.BASEURL.'/other-product">Другие новинки</a>',
            'contacts'=>'<a href="'.BASEURL.'/dayproduct">Все новинки за сегодня</a>',
             'newmonth'=>'<a href="'.BASEURL.'/productsmonth">Все новинки за месяц</a>',
             'newcloth'=>'<a href="'.BASEURL.'/productscloth">Новинки одежды и обуви за месяц</a>',
            'newday'=>'<a href="'.BASEURL.'/contactform"><strong>Контакты</strong></a>',

//       'howToOrder'=>'<a href="'.BASEURL.'/page?article=howorders">Как сделать заказ</a>',
//        'sberOnline'=>'<a href="'.BASEURL.'/page?article=sberonline">Оплата через Сбербанк Онлайн</a>',
//        'priceXLS'=>'<a  href="http://odezhda-master.ru/price_list_xls.php">Прайс-лист *.xls</a>',
//        'priceCSV'=>'<a href="http://odezhda-master.ru/price_list_csv.php">Прайс-лист *.csv</a>',
//        'sizeChart'=>'<a href="'.BASEURL.'/article?view=sizes">Размерная сетка</a>'
    ];
//        $menuQuestionsLinks=[
//        'weekend'=>'<a href="'.BASEURL.'/page?article=weekwork">Как вы работаете в выходные?</a>',
//        'prepayment'=>'<a href="'.BASEURL.'/page?article=prepayorder">Как работать по предоплате?</a>',
//        'defect'=>'<a href="'.BASEURL.'/page?article=bad_quality">Если пришел брак?</a>',
//        'delivery'=>'<a href="'.BASEURL.'/page?article=delivery">Стоимость и сроки доставки</a>',
//        'sendTime'=>'<a href="'.BASEURL.'/page?article=timedelivery">Когда отправляете товар?</a>',
//        'paymentTime'=>'<a href="'.BASEURL.'/page?article=timepay">Сколько дней поступает оплата?</a>',
//        'howToPay'=>'<a href="'.BASEURL.'/page?article=productpayment">Как оплатить товар?</a>',
//        'howToSend'=>'<a href="'.BASEURL.'/page?article=deliveryway">Способ доставки?</a>',
//        'reOrder'=>'<a href="'.BASEURL.'/page?article=order-plus">ДОЗАКАЗ?</a>',
//        'changeOrder'=>'<a href="'.BASEURL.'/page?article=order-change">Как изменить заказ?</a>',
//        'orderBuildTime'=>'<a href="'.BASEURL.'/page?article=order-time">Сроки сборки заказа?</a>'
//    ];
        echo '<div class="menulinks"><div style="border-bottom: 1px solid rgb(204, 204, 204); margin-bottom: 5px;">';
        foreach ($menuInfoLinks as $key=>$value){
            echo $value;
        }
        echo'</div></div>';

    }
}