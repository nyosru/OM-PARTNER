<?php
namespace frontend\widgets;

use yii;
use yii\helpers\ArrayHelper;
use yii\bootstrap\Html;
use yii\helpers\Url;

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
    public $showdiscount;
    public $template;
    public $css;

    public $name;
    public $main_image;
    public $product_link;

    public function init()
    {
        $this->name = Html::encode($this->description['products_name']);
        $this->main_image = BASEURL . '/imagepreview?src=' . $this->product['products_id'];
        $this->product_link = Url::to(['product','id'=>$this->product['products_id']]);
        if(empty($this->css['imageHeight'])){
            switch ($this->template) {
                case 'grid':
                    $this->css['imageHeight'] = '386px';
                    break;
                case 'list':
                    $this->css['imageHeight'] = '300px';
                    break;
            }
        }
    }

    public function run()
    {
        return $this->render('product-card-fabia/'.$this->template, ArrayHelper::toArray($this));
    }
}