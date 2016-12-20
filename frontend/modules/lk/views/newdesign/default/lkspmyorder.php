<?php
use yii\filters\AccessControl;
use yii\web\User;
/* @var $this yii\web\View */
?>
<?php
use yii\bootstrap\Collapse;
use yii\helpers\Html;


$this -> title = 'Мои заказы';

?>
<form>
    <input type="hidden" value="myorder" name="view">
    <div style="float: left; width: 100%;">
        <?php
        $sorter = '';
        $cs = count($sort_order);
        for($i=0; $i<$cs; $i++){
            switch($i){
                case '0':
                    $addclass = 'first-sorter';
                    break;
                case $cs-1:
                    $addclass = 'last-sorter';
                    break;
                default:
                    $addclass = '';
                    break;
            }

            $sorter .=  '<a class="sort" name="order"  type="submit" href="" ><button style="background: rgb(245, 245, 245) none repeat scroll 0% 0%; border: 1px solid rgb(204, 204, 204); float: left; color: rgb(0, 165, 161); font-size: 16px; border-radius: 4px; font-weight: 500; margin: 0px;" name="filter" type="submit" value="'.$i.'" class="'.$addclass.'">'.$sort_order[$i].'</button></a>';
        }
        ?>
        <div id="" style="width: 50%;">
            <?= $sorter?>
        </div>
        <div id="find-date" style="float: right; width: 30%; text-align: right;">
            <?php
            echo \kartik\date\DatePicker::widget( [
                'language'=>'ru',
                'name' => 'di',
                'type' => \kartik\date\DatePicker::TYPE_INPUT,
                'options' => ['placeholder' => 'от', 'class'=>'no-shadow-form-control', 'style'=>'float: left;width: 45%;'],
                'value'=>Yii::$app->request->getQueryParam('di'),
                'pluginOptions' => [
                    'autoclose' => true,
                    'format' => 'dd.mm.yyyy'
                ]
            ]);?>
            <?php
            echo \kartik\date\DatePicker::widget( [
                'language'=>'ru',
                'name' => 'do',
                'type' => \kartik\date\DatePicker::TYPE_INPUT,
                'value'=>Yii::$app->request->getQueryParam('do'),
                'options' => ['placeholder' => 'до', 'class'=>'no-shadow-form-control', 'style'=>'float: left;width: 45%;'],
                'pluginOptions' => [
                    'autoclose' => true,
                    'format' => 'dd.mm.yyyy'
                ]
            ]);?>
            <button style="background-color: rgb(234, 81, 109); border-color: rgb(234, 81, 109); color: rgb(255, 255, 255); width: 10%; height: 33px; line-height: 1.2; margin-right: 0px;" class="btn" type="submit">»</button>

        </div>
        <div id="find-order"  style="float: right; width: 20%; text-align: right;">
            <input name="id" value="<?= Yii::$app->request->getQueryParam('id');?>" class="no-shadow-form-control" type="text" placeholder="числовой идентификатор"></input>
            <button style="width: 10%; height: 32px; background-color: rgb(234, 81, 109); border-color: rgb(234, 81, 109); color: rgb(255, 255, 255); margin-right: 0px; float: left; position: relative; left: 90%; bottom: 33px; line-height: 1.2;" class="btn" type="submit">»</button>
        </div>
    </div>
</form><?php

echo \yii\grid\GridView::widget([
    'dataProvider' => $orders,
    'layout' => '<div class="pag">{pager}</div><br>{items}',
    'options' => ['class' => 'grid-view admin-news', 'style'=>'float: left; width: 100%;'],
    'columns' => [
        [
            'attribute' => 'orders_id',
            'label' => 'Номер заказа',
            'headerOptions' => ['style' => 'background:  none repeat scroll 0% 0%; '],
            'contentOptions' => function ($model, $key, $index, $column) {
                return ['class' => 'user-order-table-row'];
            },
            'content' => function ($data) {
                return '<a class="collapse-toggle" style="color:#007BC1" href="#expanded-order-'.$data->id.'" data-toggle="collapse" data-parent="#expanded-order-'.$data->id.'">'.$data->id.'</a>';
            }
        ],
        [
            'attribute' => 'create_date',
            'label' => 'Дата',
            'headerOptions' => ['style' => 'background: none repeat scroll 0% 0%;'],
            'contentOptions' => function ($model, $key, $index, $column) {
                return ['class' => 'user-order-table-row'];
            },
            'content' => function ($data) {
                return date('d.m.Y',strtotime($data->create_date));
            }
        ],
        [
            'attribute' => 'order',
            'label' => 'Заказ',
            'contentOptions' => function ($model, $key, $index, $column) {
                return ['class' => 'user-order-table-row'];
            },
            'content'=>function ($data) {
                $id= $data->id;
                $data = unserialize($data->order)['products'];
                $result =
                    '<div id="expanded-order-'.$id.'" style="margin: 0px;" aria-expanded="true" class="panel-group collapse">'.
                    '<div class="panel-body"><table   class="table table-bordered table-striped">
                        <thead>
                            <tr>
        <th style="background: #FFBF08 none repeat scroll 0% 0%;">ID товара</th>
        <th style="background: #FFBF08 none repeat scroll 0% 0%;">Артикул</th>
        <th style="background: #FFBF08 none repeat scroll 0% 0%;">Размер</th>
        <th style="background: #FFBF08 none repeat scroll 0% 0%;">Цена</th>
        <th style="background: #FFBF08 none repeat scroll 0% 0%;">Картинка</th>
        <th style="background: #FFBF08 none repeat scroll 0% 0%;">Количество</th>
         <th style="background: #FFBF08 none repeat scroll 0% 0%;">Сумма</th>
    </tr>
    </thead>
    <tbody>';
                $sum_order = 0;
    foreach ($data as $key => $value) {

    if ($value[6] == 'undefined') {
    $value[6] = 'Без размера';
    }
        $sum_order += round(round($value[3]))*$value[4];
    $result .='<tr>
        <td>'.$value[0].'</td>
        <td>'.$value[1].'</td>
        <td>'.$value[6].'</td>
        <td>'.round(round($value[3])).'</td>
        <td>
            <img width="50%" src="'.BASEURL.'/imagepreview?src='.$value[0].'">
        </td>
        <td>'.$value[4].'</td>
       <td>'.round(round($value[3]))*$value[4].'</td>
    </tr>';
    }
                $result .='</tbody>
    <tfoot>
    <tr>
    <td colspan="3">Сумма заказа</td>
    <td colspan="4">'.$sum_order.'</td>
    </tr>
    </tfoot>
</table>
</div></div>';
                return $result;
            }
        ],
        [
            'attribute' => 'orders_status',
            'label' => 'Статус заказа',
            'headerOptions' => ['style' => 'background: none repeat scroll 0% 0%;'],
            'contentOptions' => function ($model, $key, $index, $column) {
                return ['class' => 'user-order-table-row'];
            },
            'content' => function ($data) {
                switch ($data->status) {
                    case '100':
                        return 'Обработка заказа';
                    case '1':
                        return 'Ожидает проверки';
                    case '22':
                        return 'Объединен';
                    case '2':
                        return 'Ждём оплаты';
                    case '3':
                        return 'Оплачен';
                    case '4':
                        return 'Оплачен - Доставляется';
                    case '5':
                        return 'Оплачен - Доставлен';
                    case '6':
                        return 'Отменён';
                    case '11':
                        return 'Сборка';
                    case '0':
                        return 'Спецпредложение';
                    default:
                        return $data->status;
                }

            }

        ],
       [
        'attribute' => 'payment',
        'label' => 'Счет',
        'headerOptions' => ['style' => 'background: none repeat scroll 0% 0%;'],
        'contentOptions' => function ($model, $key, $index, $column) {
            return ['class' => 'user-order-table-row'];
        },
        'content' => function ($data) {
            if($data->status != 1) {
                return '<a href="' . BASEURL . '/payview?id=' . $data->id . '">Счет</a>';
            }else{
                return 'Не выставлен';
            }
        }
        ],
    ],
    'tableOptions' => ['class' => 'table table-striped admin-news-grid'],

]);


?>
