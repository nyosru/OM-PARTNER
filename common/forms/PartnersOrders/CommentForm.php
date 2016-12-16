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
            [['order'], 'required'],
            ['comment', 'string'],
            ['comment', 'required',  'message' => 'Необходимо заполнить']
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
                if(($value[2] == $this->attr || !$value[2]) && $value[0] == $this->id){
                    if(isset($value[8]['comment']) &&  $value[8]['comment'] != FALSE){
                        $this->comment = $value[8]['comment'];
                    }else{
                        $this->comment = '';
                    }
                    break;
                }
            }
            return true;
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
                ->andWhere([PartnersOrders::tableName().'.status'=> '1'])
                ->andWhere('referral_id = :ref',
                    [':ref'=>$referral['id']])
                ->joinWith('referralUser')
                ->one()) == TRUE)
        {
            $new_value = unserialize($order_data->order);
            foreach ($new_value['products'] as $key=>$value){
                if(($value[2] == $this->attr || !$value[2]) && $value[0] == $this->id){
                    $value[8]['comment'] = $this->comment;
                }
                $new_value['products'][$key] = $value;
            }
            $order_data->order = serialize($new_value);
            if($order_data->validate() && $order_data->save()){
                return true;
            }else{
                return $this->addError('comment', 'Заказ не сохранен');
            }
        }else{
            return $this->addError('comment', 'Заказ не найден 23');
        }
    }

    public function saveOrderComment()
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
            $new_value['comment'] = $this->comment;
            $order_data->order = serialize($new_value);
            if($order_data->validate() && $order_data->save()){
                return true;
            }else{
                return $this->addError('comment', 'Заказ не сохранен');
            }
        }else{
            return $this->addError('comment', 'Заказ не найден 23');
        }
    }



}