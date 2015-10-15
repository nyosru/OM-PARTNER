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

        return  $str_load_cat;
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
        $dependency = new DbDependency([
            'sql' => 'SELECT MAX(last_modified) FROM {{%manufacturers}}',
        ]);
        $hide_man = Yii::$app->db->cache(
            function ($db) {
                $man = new Manufacturers();
                return $man->find()->where(['hide_products' => '1'])->select('manufacturers_id')->asArray()->all();
            }, 86400, $dependency
        );
        return $hide_man;
    }
    public function categories_for_partners()
    {


        $dependency = new DbDependency([
            'sql' => 'SELECT MAX(last_modified) FROM {{%categories}}',
        ]);
        $catdataarr = Yii::$app->db->cache(
            function ($db) {
                $categoriess = new PartnersCategories();
                $categoriesd = new PartnersCatDescription();
                return [$categoriess->find()->select(['categories_id', 'parent_id'])->where('categories_status != 0')->asArray()->All(), $categoriesd->find()->select(['categories_id', 'categories_name'])->asArray()->All()];
            }, 3600, $dependency
        );
        return $catdataarr;
    }

}