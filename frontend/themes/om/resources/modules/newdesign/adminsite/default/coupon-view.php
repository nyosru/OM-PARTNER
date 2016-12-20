<?php
use yii\widgets\DetailView;
?>
<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
    <h4 class="modal-title">Купон: <?=$model->coupon_code?></h4>
</div>
<?= DetailView::widget([
    'model' => $model,
    'attributes' => [
        'coupon_id',
        'coupon_type',
        'coupon_code',
        'coupon_amount',
        'coupon_minimum_order',
        'coupon_start_date',
        'coupon_expire_date',
        'uses_per_coupon',
        'uses_per_user',
        'restrict_to_products',
        'restrict_to_categories',
        'restrict_to_customers',
        'coupon_active',
        'date_created',
        'date_modified',
    ],
]) ?>