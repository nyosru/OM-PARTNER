<?php
use yii\bootstrap\Modal;
use yii\bootstrap\ActiveForm;

Modal::begin([
    'header' => '<h2>Претензии</h2>',
    'toggleButton' => [
        'tag' => 'button',
        'class' => 'button btn-block btn-info show-dialog',
        'data-opid' => $orders_products_id,
        'label' => 'ОТКРЫТЬ',
    ]
]);
echo $this->render('_claims-dialog',['orders_products_id'=>$orders_products_id]);

Modal::end();
?>