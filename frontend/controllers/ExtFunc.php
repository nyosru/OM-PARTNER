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

    public function Imagepreviewcrop($from , $src, $where,  $action = 'none')
    {
        $src = urldecode($src);
        $filename = str_replace('[[[[]]]]', ' ', $src);
        $filename = str_replace('[[[[', '(', $filename);
        $filename = str_replace(']]]]', ')', $filename);
        $split = explode('/', $src);
        if (count($split) > 1) {
            $file = array_splice($split, -1, 1);
            $file = explode('.', $file[0]);
            $ras = array_splice($file, -1, 1);
            $ras[0] = strtolower($ras[0]);
            $namefile = base64_encode(implode('', $file));
            $dir = implode('/', $split) . '/';
        } else {
            $file = $split[0];
            $file = explode('.', $file);
            $ras = array_splice($file, -1, 1);
            $namefile = base64_encode(implode('', $file));
            $dir = '';
        }
        if (!file_exists(Yii::getAlias($where) . $dir . $namefile . '.' . $ras[0]) || $action == 'refresh') {
            if (!is_dir(Yii::getAlias($where) . $dir)) {
                $new_dir = '';
                foreach ($split as $value) {
                    $new_dir .= $value . '/';
                    mkdir(Yii::getAlias($where) . $new_dir);
                }
            }
            if($ras[0] == 'jpg' || $ras[0] == 'jpeg'){
                $image = imagecreatefromjpeg($from . $filename);
            }elseif($ras[0] == 'png'){
                $image = imagecreatefrompng($from . $filename);
            }else{
                $image = imagecreatefromjpeg($from . $filename);
            }
            $width = imagesx($image);
            $height = imagesy($image);
            $original_aspect = $width / $height;
            if ($original_aspect > 1.3) {
                $thumb_width = 300;
                $thumb_height = 180;
            } elseif ($original_aspect < 0.7) {
                $thumb_width = 180;
                $thumb_height = 300;
            } else {
                $thumb_width = 200;
                $thumb_height = 200;
            }
            $thumb_aspect = $thumb_width / $thumb_height;
            if ($original_aspect >= $thumb_aspect) {
                $new_height = $thumb_height;
                $new_width = $width / ($height / $thumb_height);
            } else {
                $new_width = $thumb_width;
                $new_height = $height / ($width / $thumb_width);
            }
            $thumb = imagecreatetruecolor($thumb_width, $thumb_height);
            imagecopyresampled($thumb,
                $image,
                0 - ($new_width - $thumb_width) / 2,
                0 - ($new_height - $thumb_height) / 2,
                0, 0,
                $new_width, $new_height,
                $width, $height);
            imagejpeg($thumb, Yii::getAlias($where) . $dir . $namefile . '.' . $ras[0], 80);
        }

        return file_get_contents(Yii::getAlias($where) . $dir . $namefile . '.' . $ras[0]);
    }
}