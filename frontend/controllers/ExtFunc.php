<?php

namespace frontend\controllers;
use Yii;
use yii\web\Controller;
use common\models\PartnersCategories;
use yii\caching\DbDependency;
use common\models\Manufacturers;
use common\models\PartnersCatDescription;

class ExtFunc
{
    public function load_cat($arr, $parent_id = 0, $catnamearr, $allow_cat ) {
        static $str_load_cat;
        if (empty($arr[$parent_id])) {

        } else {
            for ($i = 0; $i < count($arr[$parent_id]); $i++) {
                $catdesc = $arr[$parent_id][$i]['categories_id'];
                if (!$arr[$parent_id][$i] == '') {
                    $str_load_cat[] =  $catdesc;
                    $this->load_cat($arr, $arr[$parent_id][$i]['categories_id'], $catnamearr, $allow_cat);
                }
            }
        }
        if($parent_id != 0){
            $str_load_cat[] =  $parent_id;
        }

        return array_unique($str_load_cat);
    }

    public function view_cat($arr, $parent_id = 0, $catnamearr, $allow_cat) {
        if (empty($arr[$parent_id])) {
            return;
        } else {
            if ($parent_id !== 0) {$style = 'style="display: none;"';
            }
            echo '<ul id="accordion" class="accordion" ' . $style . '">';
            for ($i = 0; $i < count($arr[$parent_id]); $i++) {
                $catdesc = $arr[$parent_id][$i]['categories_id'];
                if (!$arr[$parent_id][$i] == '') {
                    echo '<li class=""><a href="/site/catalog?_escaped_fragment_=cat=' . $catdesc . '&count=20&start_price=&end_price=1000000&prod_attr_query=&page=undefined&sort=0&searchword="></a><div class="link data-j" data-j="on" data-cat="' . $catdesc . '">' . $catnamearr["$catdesc"] .'</div>';
                    $this->view_cat($arr, $arr[$parent_id][$i]['categories_id'], $catnamearr, $allow_cat);
                    echo '</li>';
                }
            }
            echo '</ul>';
        }
    }

    public function reformat_cat_array($catdata, $categories, $checks ){
        foreach ($catdata as $value) {
            if (in_array(intval($value['categories_id']), $checks)) {
                $catdataallow[] = $value;
            }
        }
        for ($i = 0; $i < count($catdataallow); $i++) {
            $row = $catdataallow[$i];
            if (empty($arr_cat[$row['parent_id']])) {
                $arr_cat[$row['parent_id']] = $row;
            }
            $arr_cat[$row['parent_id']][] = $row;
        }
        foreach ($categories as $value) {
            $catnamearr[$value['categories_id']] = $value['categories_name'];
        }

        return ['cat' => $arr_cat, 'name' => $catnamearr];
    }


    public function hide_manufacturers_for_partners()
    {
        $key = Yii::$app->cache->buildKey('hideman');
        $hide_man = Yii::$app->cache->get($key);
        if(!isset($hide_man['data'])) {
            $man = new Manufacturers();
            $hide_man =  $man->find()->where(['hide_products' => '1'])->select('manufacturers_id')->asArray()->all();
            Yii::$app->cache->set($key, ['data' =>$hide_man], 86400);
        }else{
            $hide_man =  $hide_man['data'];
        }
        return $hide_man;
    }
    public function categories_for_partners()
    {
        $categoriess = new PartnersCategories();
        $categoriesd = new PartnersCatDescription();
        $key = Yii::$app->cache->buildKey('categories');
        $data = Yii::$app->cache->get($key);
        if(!isset($data['data'])) {
            $f = $categoriess->find()->select(['categories_id', 'parent_id'])->where('categories_status != 0')->asArray()->All();
            $s = $categoriesd->find()->select(['categories_id', 'categories_name'])->asArray()->All();
            $data = array($f,$s);
            Yii::$app->cache->set($key,['data'=>$data],3600);
        }else{
            $data = $data['data'];
        }
        return $data;
    }

    public function full_op_cat()
    {
        $key = Yii::$app->cache->buildKey('fullopcatcategories');
        $data = Yii::$app->cache->get($key);
        if(!isset($data['data'])) {
            $checks = Yii::$app->params['constantapp']['APP_CAT'];
            $categoriess = new PartnersCategories();
            $categoriesd = new PartnersCatDescription();
            $f = $categoriess->find()->select(['categories_id', 'parent_id'])->where('categories_status != 0')->asArray()->All();
            $s = $categoriesd->find()->select(['categories_id', 'categories_name'])->asArray()->All();
            foreach ($f as $value) {
                if (in_array(intval($value['categories_id']), $checks)) {
                    $catdataallow[] = $value;
                }
            }
            for ($i = 0; $i < count($catdataallow); $i++) {
                $row = $catdataallow[$i];
                if (empty($arr_cat[$row['parent_id']])) {
                    $arr_cat[$row['parent_id']] = $row;
                }
                $arr_cat[$row['parent_id']][] = $row;
            }
            foreach ($s as $value) {
                $catnamearr[$value['categories_id']] = $value['categories_name'];
            }
            Yii::$app->cache->set($key,['data'=>['cat'=> $arr_cat, 'name'=>$catnamearr ]]);
        }else{
            $arr_cat = $data['data']['cat'];
            $catnamearr = $data['data']['name'];
        }
        return ['cat' => $arr_cat, 'name' => $catnamearr];
    }
}