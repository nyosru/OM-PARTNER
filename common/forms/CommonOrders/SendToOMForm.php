<?php

namespace common\forms\CommonOrders;
/**
 * Created by PhpStorm.
 * User: dmitriy
 * Date: 04.04.16
 * Time: 13:16
 */


use common\models\PartnersOrders;
use common\models\Referrals;
use Yii;
use yii\base\Model;


class SendToOMForm extends Model
{

    public $idorder;
    public $comment;
    public $shipping_method;
    public $address;
    public $wrap;
    public $shipping_fields;
    public $address_fields;
    public $wrap_fields;

    public function rules()
    {
        return [
            [['idorder','address'], 'integer'],
            [['idorder','address','shipping_method', 'wrap'], 'required', 'message'=>'Обязательное поле'],
            [['comment','shipping_method','wrap'], 'string'],
        ];
    }

    public function renderForm()
    {
        $form = \yii\bootstrap\ActiveForm::begin([
            'options' => ['data-pjax' => true],
            'id'=>'product-comment',
            'action'=>'/sp/send-common-orders',
            'method'=> 'post',
            'enableClientScript' => true
        ]);
        echo $form->field($this, 'idorder',['options'=>['style'=>' margin:10px']])->label('Заказ № '. $this->idorder)->hiddenInput();
        echo $form->field($this, 'wrap',['options'=>['style'=>' margin:10px']])->label('Способ упаковки ')->dropDownList(
            $this->wrap_fields
        );
        echo $form->field($this, 'shipping_method',['options'=>['style'=>' margin:10px']])->label('Способ доставки ')->dropDownList(
            $this->shipping_fields
        );
        echo $form->field($this, 'address',['options'=>['style'=>' margin:10px']])->label('Адрес доставки ')->dropDownList(
            $this->address_fields
        );
        echo $form->field($this, 'comment', ['options'=> ['style'=>'width:100%', 'class'=>'col-md-8']])
            ->label('Комментарий к заказу')->textarea(['rows' => '6',
                'style'=>'resize: vertical;display:width:100%;min-height: 100px;']);
        echo \yii\helpers\Html::submitButton('Сохранить', ['class' => 'btn btn-primary', 'name' => 'common', 'style'=>"margin: 15px"]);
        $form = \yii\bootstrap\ActiveForm::end();
    }


}