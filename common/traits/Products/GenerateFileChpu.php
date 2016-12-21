<?php
namespace common\traits\Products;

use common\models\Featured;
use common\models\PartnersProductsToCategories;
use php_rutils\RUtils;
use Yii;


trait GenerateFileChpu
{
    public function generateFileChpu( $products_name = '', $products_id = 0, $color = '' , $brand = '',$cachedir = '@app/runtime/productcache')
    {
        $colorcache = '';
        if($color != FALSE){
            $colorcache = $color.'-';
        }
        $brandcache = '';
        if($brand != FALSE){
            $brandcache = $brand.'-';
        }
        $product_url = RUtils::translit()
                ->slugify($products_name.'-'. $brandcache. $colorcache. $products_id);
        $product_check_dir =   str_replace('-','/',  $product_url);
        $checkdir =   Yii::getAlias($cachedir.'/'.$product_check_dir);
        if(!file_exists($checkdir)){
            mkdir($checkdir, 0777, TRUE);
        }
        return $product_url;

    }
}

?>