<?php
namespace frontend\widgets;

use common\traits\Products\ProductVariants;
use common\traits\Products\GenerateFileChpu;
use yii;
use yii\helpers\ArrayHelper;
use yii\bootstrap\Html;
use yii\helpers\Url;

/*
 * Отображение продукта Fabia
 */
class ProductCardFabia extends \yii\bootstrap\Widget
{
    use ProductVariants, GenerateFileChpu;

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
    public $favorites = 0; // для формирования списка избранных продуктов

    public $name;
    public $main_image;
    public $product_link;
    public $sizes = [];

    public function init()
    {
        $this->name = Html::encode($this->description['products_name']);
        $this->main_image = BASEURL . '/imagepreview?src=' . $this->product['products_id'];
        $this->product_link = $this->link();
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
        //размеры товара
        if(!empty($this->attr_descr)){

        }
        $this->sizes = $this->product_variants([
            'products' => $this->product,
            'productsAttributes' => $this->attrib,
            'productsAttributesDescr' => $this->attr_descr,
        ]);
    }

    public function run()
    {
        return $this->render('product-card-fabia/'.$this->template, ArrayHelper::toArray($this));
    }

    private function link()
    {
        if(
            Yii::$app->params['seourls'] == TRUE &&
            (
            (
                (isset($this->product['product_seo']) && $seourl = $this->product['product_seo'] ) ||
                ($seourl = $this->generateFileChpu($this->name, $this->product['products_id'], '', '')
                ) == TRUE
            )
            )){
            $link = BASEURL .'/product/'.$seourl;
        }else{
            $link =  BASEURL . '/product?id=' . $this->product['products_id'];
        }
        return $link;
    }
}