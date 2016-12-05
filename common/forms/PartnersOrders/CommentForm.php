<?php

namespace common\forms\PartnersOrders;
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


class CommentForm extends Model
{

    public $attr;
    public $order;
    public $id;
    public $comment;

    public function rules()
    {
        return [
            [['attr','order','id'], 'integer'],
            [['attr','order','id'], 'required'],
            ['comment', 'string'],
            ['comment', 'required']
        ];
    }

    public function loadComment()
    {
        if(
            ($referral = Referrals::find()
                ->where('user_id = :user',[':user'=>Yii::$app->user->getId()])
                ->asArray()
                ->one()) == TRUE
            &&
            ($order_data = PartnersOrders::find()
                ->where(PartnersOrders::tableName().'.id = :id',
                    [':id'=>$this->order])
                ->andWhere('referral_id = :ref',
                    [':ref'=>$referral['id']])
                ->joinWith('referralUser')
                ->asArray()->one()) == TRUE)
        {
            foreach (unserialize($order_data['order'])['products'] as $key=>$value){
                if($value[2] == $this->attr && $value[0] == $this->id){
                    if(isset($value['comment']) &&  $value['comment'] != FALSE){
                        $comment = $value['comment'];
                    }else{
                        $comment = '';
                    }
                    break;
                }
            }
            return $comment;
        }else{
            return $this->addError('order', 'Заказ не найден');
        }
    }

    public function saveComment()
    {
        if(
            ($referral = Referrals::find()
                ->where('user_id = :user',[':user'=>Yii::$app->user->getId()])
                ->asArray()
                ->one()) == TRUE
            &&
            ($order_data = PartnersOrders::find()
                ->where(PartnersOrders::tableName().'.id = :id',
                    [':id'=>$this->order])
                ->andWhere('referral_id = :ref',
                    [':ref'=>$referral['id']])
                ->joinWith('referralUser')
                ->one()) == TRUE)
        {
            $new_value = unserialize($order_data->order);
            foreach ($new_value['products'] as $key=>$value){
                if($value[2] == $this->attr && $value[0] == $this->id){
                    $value['comment'] = $this->comment;
                }
                $new_value['products'][$key] = $value;
            }
            $order_data->order = $new_value;
            if($order_data->save()){
                return $order_data->errors;
            }else{
                return $this->addError('order', 'Заказ не сохранен');
            }
        }else{
            return $this->addError('order', 'Заказ не найден');
        }
    }

}