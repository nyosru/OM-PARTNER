<?php
namespace common\traits;

use common\models\CouponRedeemTrack;
use common\models\Orders;
use common\models\PartnersProductsToCategories;
use Yii;
use common\models\Coupons;
use common\models\PartnersUsersInfo;

trait Coupon
{
    public function findCoupon($coupon_code,$total_price)
    {
        $coupon = Coupons::find()->where(['coupon_code'=>$coupon_code])->one();
        $datetime = date("Y-m-d H:i:s");

        if(empty($coupon)){
            $message['error'] = 'Купон не найден';
        } else {
            $customers_id = PartnersUsersInfo::find()->select(['customers_id'])->where(['id' => Yii::$app->user->getId()])->one()->customers_id;
            $uses_per_user = CouponRedeemTrack::find()->where(['coupon_id'=>$coupon->coupon_id,'customer_id'=>$customers_id])->count(); //сколько раз использовался купон указанным пользователем
            $uses_per_coupon = CouponRedeemTrack::find()->where(['coupon_id'=>$coupon->coupon_id])->count(); //сколько раз использовался этот купон в общем
            if(!$coupon->coupon_active){
                $message['error'] = 'Купон неактивен';
            } elseif ($datetime < $coupon->coupon_start_date){
                $message['error'] = 'Время действия купона еще не началось';
            } elseif ($datetime > $coupon->coupon_expire_date){
                $message['error'] = 'Время действия купона истекло';
            } elseif ($coupon->uses_per_coupon==0 || $coupon->uses_per_user==0 || $uses_per_user>=$coupon->uses_per_user || $uses_per_coupon>=$coupon->uses_per_coupon) {
                $message['error'] = 'Купоны закончились';
            } elseif ($total_price<$coupon->coupon_minimum_order){
                $message['error'] = 'Для действия купона сумма заказа должна превышать '.round($coupon->coupon_minimum_order).' руб.';
            } elseif ($this->restrictUser($coupon->restrict_to_customers,$customers_id)){
                $message['error'] = 'Вы не можете использовать этот купон';
            }elseif($coupon->newcomers_only && Orders::find()->where(['customers_id' => $customers_id, 'orders_status'=>[3,4,5]])->exists()){
                $message['error'] = 'Вы не можете использовать этот купон';
            }
        }

        if(empty($message['error']))
            $message['success'] = 'Вы ввели верный промо-код';
        else
            $coupon = false;

        return ['model'=>$coupon,'message'=>$message];
    }

    private function restrictUser($restrict,$id){
        if(!empty($restrict)){
            $restricts_int = array_map('intval',explode(',',$restrict));
            if(!in_array($id, $restricts_int)){
                return true;
            }
        }
        return false;
    }
}