<?php
namespace frontend\widgets;

use Yii;

class RightTopMenuLinks extends \yii\bootstrap\Widget
{
    public function init()
    {
        $menuInfoLinks=[
            'cooperation'=>'<a href="'.BASEURL.'/discont">Распродажа</a>',
            'contacts'=>'<a href="'.BASEURL.'/dayproduct">Все новинки за сегодня</a>',
             'newmonth'=>'<a href="'.BASEURL.'/productsmonth">Все новинки за месяц</a>',
             'newcloth'=>'<a href="'.BASEURL.'/productscloth">Новинки одежды и обуви за месяц</a>',
            'newday'=>'<a href="'.BASEURL.'/contactform"><strong>Контакты</strong></a>',
            'allcategories'=>'<a href="'.BASEURL.'/allcategories"><strong>Все категории</strong></a>',

    ];

        echo '<div class="menulinks"><div style="border-bottom: 1px solid rgb(204, 204, 204); margin-bottom: 5px;">';
        foreach ($menuInfoLinks as $key=>$value){
            echo $value;
        }
        echo'</div></div>';

    }
}