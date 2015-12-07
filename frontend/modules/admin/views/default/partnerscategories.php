<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\bootstrap\Tabs;
use yii\bootstrap\Carousel;
use yii\bootstrap\Alert;
use yii\helpers\BaseHtml;
use yii\bootstrap\Modal;

$this->title = 'Категории';

function viewTree($arr, $parent, $arr2, $arr3)
{
    echo '<ul style="list-style: none">';
    foreach ($arr[$parent] as $key => $value) {
        if (in_array($value['categories_id'], $arr3)) {
            $check = 'checked';
        } else {
            $check = '';
        }
        echo '<li>';
        echo '<input type="checkbox" ' . $check . '>' . $arr2[$value['categories_id']] . '<br>';
        echo '</li>';
        viewTree($arr, $value['categories_id'], $arr2, $arr3);
    }
    echo '</ul>';
}

//$form = ActiveForm::begin(['id' => 'categories', 'action' => '']);
//echo '<pre>';
viewTree($arr_cat, 0, $catnamearr, Yii::$app->params['constantapp']['APP_CAT']);
//echo '</pre>';
//ActiveForm::end();