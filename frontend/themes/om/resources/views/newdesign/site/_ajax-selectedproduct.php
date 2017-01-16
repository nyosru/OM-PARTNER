<?php
use yii\widgets\ListView;
use yii\data\ArrayDataProvider;

$dataProvider = new ArrayDataProvider([
    'allModels' => $data,
    'pagination' => [
        'pageSize' => 9,
    ],
]);

$cardview = (int)$_COOKIE['cardview'] == 1 ? 'list' : 'grid';
echo ListView::widget([
    'dataProvider' => $dataProvider,
    'itemView' => '_ajax-selectedproduct-list',
    'layout' => "<div class='pager'><div class='pages'>{pager}</div></div><ul class='products-".$cardview."'>{items}</ul>",
    'itemOptions' => [
        'tag' => false,
    ],
]);

?>