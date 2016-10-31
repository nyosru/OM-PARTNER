<?php
namespace common\traits\Categories;

use common\traits\RecursCat;
use php_rutils\RUtils;

trait  CategoryChpu
{
    
    public function categoryChpu($value)
    {
        if (preg_match('/^[0-9\s]+/', $value)){
            $cat = (integer)$value;
            $key = 'chpu-category';
            if(($chpu = \Yii::$app->cache->get($key)) == FALSE || !isset($chpu['id'][$cat])){
                $catdataarr = $this->categories_for_partners();
                $catdata = $catdataarr[0];
                $categories = $catdataarr[1];
                foreach ($categories as $value) {
                    $catnamearr[$value['categories_id']] = $value['categories_name'];
                }
                foreach ($catdata as $value) {
                    $catdatas[$value['categories_id']] = $value['parent_id'];
                }
                $chpu = $this->Requrscat($catdatas, $cat, $catnamearr);
                $resultchpu = [];
                foreach ($chpu as $key => $value) {
                    $resultchpu['id'][] = $value['id'];
                    $resultchpu['name'][] = RUtils::translit()->translify($value['name']);
                }
                //  Yii::$app->cache->set($key, $resultchpu);
                return $resultchpu;
            } else {
                return $chpu['id'][$cat];
            }
        }else{

        }

    }

}

?>