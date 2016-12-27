<?php
namespace common\traits\Categories;


use php_rutils\RUtils;

trait  CategoryChpu
{
    public function categoryChpu($value)
    {

        if (preg_match('/^[0-9\s]+/', $value)){
            $cat = (integer)$value;
            $key_chpu_category = \Yii::$app->cache->buildKey('chpu-categories-normal-89-'.\Yii::$app->params['customcat']);
            if(($chpu_cache = \Yii::$app->cache->get($key_chpu_category)) == FALSE || !isset($chpu_cache['id'][$cat])){
                $catdataarr = $this->categories_for_partners();
                $catdata = $catdataarr[0];
                $categories = $catdataarr[1];
                foreach ($categories as $value) {
                    $catnamearr[$value['categories_id']] = $value['categories_name'];
                }
                foreach ($catdata as $value) {
                    $catdatas[$value['categories_id']] = $value['parent_id'];
                    if(!$catnamearr[$value['categories_id']]){
                        $catnamearr[$value['categories_id']] = 'NoName'.$value['categories_id'];
                    }
                }
                $chpu = $this->Requrscat($catdatas, $cat, $catnamearr);
                $resultchpu = [];
                foreach ($chpu as $key => $value) {
                  //  $value['name'] = preg_replace("/[^a-zA-ZА-Яа-я0-9]/iu","_",mb_strtolower($value['name']));
                    $resultchpu['name'][] = RUtils::translit()->slugify($value['name']);
                }
                $chpu_cache = \Yii::$app->cache->get($key_chpu_category);
                $chpu_string = implode('/',$resultchpu['name']);
                $chpu_string_key = md5($chpu_string);
                $chpu_cache['id'][$cat] = $chpu_string;
                $chpu_cache['string'][$chpu_string_key] = $cat;
                if($chpu_string){
                    \Yii::$app->cache->set($key_chpu_category, $chpu_cache, 100000000);
                }
                return $chpu_string;
            }  elseif( isset($chpu_cache['id'][$cat])) {
                return $chpu_cache['id'][$cat] ;
            }
        }else{
            $key_chpu_category = \Yii::$app->cache->buildKey('chpu-categories-normal-89-'.\Yii::$app->params['customcat']);
            $chpu_cache = \Yii::$app->cache->get($key_chpu_category);
            $chpu_string_key = md5($value);
           if(isset($chpu_cache['string'][$chpu_string_key])){
               return $chpu_cache['string'][$chpu_string_key];
           }else{
               return '0';
           }
        }
    }

}

?>