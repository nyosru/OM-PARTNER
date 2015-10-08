<?php

namespace frontend\controllers;

 use yii\web\Controller;

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
                     echo '<li class=""><div class="link data-j" data-j="on" data-cat="' . $catdesc . '">' . $catnamearr["$catdesc"] .'</div>';
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

}