<?php
namespace frontend\widgets;

use yii;

/*
 * Отображение продукта Fabia
 */
class ProductCardFabia extends \yii\bootstrap\Widget
{
    public $product;
    public $description;
    public $attrib;
    public $attr_descr;
    public $catpath;
    public $man_time;
    public $category;

    public function init()
    {

    }
    public function run()
    {
        return $this->render('product-card-fabia/grid',[
            'product' => $this->product,
        ]);
    }
}