<?php
use yii\grid\GridView;
use yii\helpers\Html;
use yii\helpers\Url;
?>
<?= GridView::widget([
    'dataProvider' => $dataProvider,
    'columns' => [
        'coupon_code',
        'coupon_amount',
        [
            'label'=>'Срок действия купона',
            'format'=>'text',
            'content'=>function($data){
                return $data->coupon_start_date;
            },
        ],
//        'coupon_start_date',
//        'coupon_expire_date',
//        'uses_per_coupon',
//        'uses_per_user',
//        'restrict_to_products',
//        'restrict_to_categories',
//        'restrict_to_customers',
        'coupon_active',
        [
            'class' => 'yii\grid\ActionColumn',
            'template' => '{view} {update} {delete}',
            'header' => 'Управление',
            'buttons' => [
                'view' =>  function ($url, $model, $key) {
                    return '<a data-toggle="modal" href="'.Url::to(['coupons','coupon_id'=>$model->coupon_id,'action'=>'view']).'" data-target="#view-coupon-modal" title="Полная информация" area-label="Полная информация"><span class="glyphicon glyphicon-eye-open"></span></a>';
                },
                'update' =>  function ($url, $model, $key) {
                    return '<a data-toggle="modal" href="'.Url::to(['coupons','coupon_id'=>$model->coupon_id,'action'=>'update']).'" data-target="#update-coupon-modal" title="Изменить" area-label="Изменить"><span class="glyphicon glyphicon-pencil"></span></a>';
                },
                'delete' => function($url, $model, $key){
                    return '<a href="'.Url::to(['coupons','coupon_id'=>$model->coupon_id,'action'=>'delete']).'" aria-label="Удалить" data-confirm="Вы действительно хотите удалить купон?" data-pjax="0" title="Удалить"><span class="glyphicon glyphicon-trash"></span></a>';
                }
            ],
        ],
    ],
]); ?>
<div class="btn btn-primary" data-toggle="modal" data-target="#create-coupon-modal">Добавить</div>
<div class="modal fade" id="create-coupon-modal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">Создать купон</h4>
            </div>
            <?=$this->render('_coupon-form',['model'=>$coupon])?>
        </div>
    </div>
</div>
<div class="modal fade" id="view-coupon-modal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
        </div>
    </div>
</div>
<div class="modal fade" id="update-coupon-modal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
        </div>
    </div>
</div>

<?php
$script = <<< JS
    $('#view-coupon-modal,#update-coupon-modal').on('hidden.bs.modal', function (e) {
        $(this).removeData('bs.modal');
        $(this).find('.modal-content').empty();
    });
JS;
$this->registerJs($script, yii\web\View::POS_READY);
?>