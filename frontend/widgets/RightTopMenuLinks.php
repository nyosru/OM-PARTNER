<?php
namespace frontend\widgets;

use Yii;

class RightTopMenuLinks extends \yii\bootstrap\Widget
{
    public function init()
    {
        $menuInfoLinks = [
            'cooperation' => '<a href="' . BASEURL . '/discont">Распродажа</a>',
            'contacts' => '<a href="' . BASEURL . '/dayproduct">Новинки дня</a>',
            'newmonth' => '<a href="' . BASEURL . '/productsmonth">Другие новинки</a>',
            'newcloth' => '<a href="' . BASEURL . '/productscloth">Новинки одежды и обуви</a>',
            'products-discount' => '<a href="' . BASEURL . '/products-discount"><strong>Все скидки тут!</strong></a>',
            'newday' => '<a href="' . BASEURL . '/contactform"><strong>Контакты</strong></a>',
            'allcategories' => '<a href="' . BASEURL . '/allcategories"><strong>Все категории</strong></a>',
            'allbrands' => '<a href="' . BASEURL . '/allbrands"><strong>Бренды</strong></a>',


        ];

        echo '<div class="menulinks"><div style="border-bottom: 1px solid rgb(204, 204, 204); margin-bottom: 5px;">';
        foreach ($menuInfoLinks as $key => $value) {
            echo $value;
        }
        echo '</div></div>';

    }
}