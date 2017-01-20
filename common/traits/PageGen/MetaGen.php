<?php
namespace common\traits\PageGen;

use common\models\Featured;
use common\models\PartnersProductsToCategories;
use common\traits\Categories\CustomCatalog;
use common\traits\Categories_for_partner;
use Yii;
use yii\helpers\ArrayHelper;
use yii\web\View;


trait MetaGen
{
    /**
     * Generate Meta, Title, H1, Description
     * @param $view \yii\web\View.
     * @param $version string.
     * @param $type string.
     * @param $params mixed.
     * @return string
     */
    static function metaGen($view = '' , $version = '', $type = '',$params = '')
    {

        $h1 = TRUE;
        if (isset($version)) {
            $templates = [];
            if($type == 'catalog'){
                $templates = self::customCatalog()['themes'];
                $version = trim(self::customCatalog()['template'][$params]['name']);
            }
            if (key_exists($version, $templates)) {
                $pattern = [];
                $replace = [];
                $templates = $templates[$version];
                if($type == 'catalog'){
                    $param = self::customCatalog()['template'][$params];
                    foreach ($param['param'] as $key=>$value){
                        if($value) {
                            $pattern[] = '/({\$' . $key . '})/iu';
                            $replace[] = str_replace('"', '', $value);
                        }
                    }
                    $pattern[] = '/({\$cat})/iu';
                    $replace[] = ArrayHelper::index(self::categories_for_partners()[1], 'categories_id')[$params]['categories_name'];
                }
                if(isset($templates['description'])){
                    $description = '';
                    $string = explode(' ', trim(preg_replace($pattern,$replace,$templates['description'])));
                    if(is_array($string)){
                        $string[0] =  mb_convert_case($string[0], MB_CASE_TITLE);
                        $description = implode(' ', $string);
                    }else{
                        $description =  mb_convert_case(trim(preg_replace($pattern,$replace,$templates['description'])), MB_CASE_TITLE);
                    }
                    $view->registerMetaTag(['name' => 'description', 'content' => $description]);
                }
                if(isset($templates['keywords'])){
                    $view->registerMetaTag(['name' => 'keywords', 'content' =>  preg_replace($pattern,$replace,$templates['keywords'])]);
                }
                if(isset($templates['title'])){
                    $string = explode(' ', trim(preg_replace($pattern,$replace,$templates['title'])));
                    if(is_array($string)){
                        $string[0] =  mb_convert_case($string[0], MB_CASE_TITLE);
                        $view->title = implode(' ', $string);
                    }else{
                        $view->title =  mb_convert_case(trim(preg_replace($pattern,$replace,$templates['title'])), MB_CASE_TITLE);
                    }
                }
                if(isset($templates['h1'])){
                    $string = explode(' ', trim(preg_replace($pattern,$replace,$templates['h1'])));
                    if(is_array($string)){
                        $string[0] =  mb_convert_case($string[0], MB_CASE_TITLE);
                        $h1 = implode(' ', $string);
                    }else{
                        $h1 =  mb_convert_case(trim(preg_replace($pattern,$replace,$templates['h1'])), MB_CASE_TITLE);
                    }
                }
                return $h1;
            } else {
                return FALSE;
            }
        } else {
            return FALSE;
        }
    }
}

?>