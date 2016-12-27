<?php
use yii\bootstrap\Collapse;
?>
<?=Collapse::widget([
    'items' => [
        [
            'label' => 'Претензии',
            'content' => $this->render('_claims-dialog',['orders_products_id'=>$orders_products_id]),
            'options' => ['class' => 'show-dialog', 'data-opid'=>$orders_products_id],
        ],
    ],
]); ?>