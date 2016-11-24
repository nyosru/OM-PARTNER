<?php
namespace frontend\modules\sp\controllers\actions;

use common\models\PartnersOrders;
use common\models\Referrals;
use common\models\ReferralsUser;
use Yii;


trait ActionOrdersEdit
{
    public function actionOrdersEdit()
    {
        if (
            ($id = (integer)Yii::$app->request->post('id')) == TRUE
            && ($referal = Referrals::find()->where(['user_id'=>Yii::$app->user->getId()])->asArray()->one()) == TRUE
            && ($order = PartnersOrders::find()->where(['id'=>$id, 'partners_id'=>Yii::$app->params['constantapp']['APP_ID'], 'status'=>[1]])->asArray()->one()) == TRUE
            && ($referaluser = ReferralsUser::find()->where(['user_id'=>$order['user_id'], 'referral_id'=>$referal['id']])->exists()) == TRUE
        ) {
            $model = new PartnersOrders();
            $action = Yii::$app->request->post('action');
            switch($action){
                case 'new':{
                    if (($postnew = Yii::$app->request->post('new')) == TRUE) {
                        foreach ($postnew as $keypost => $valuepost) {
                            foreach ($valuepost['attr'] as $attrkey => $attrvalue) {
                                if (isset($attrvalue['name']) && isset($attrvalue['count'])) {
                                    $check = 0;
                                    foreach ($order['products'] as $orderkey => $ordervalue) {
                                        if ($ordervalue[0] == $keypost && $attrkey == $ordervalue[2]) {
                                            $order['products'][$orderkey][4] += $attrvalue['count'];
                                            $check = 1;
                                        };
                                    }
                                    if ($check == 0) {
                                        $order['products'][] = [$keypost, $valuepost['model'], $attrkey, $valuepost['price'], $attrvalue['count'], $valuepost['image'], $attrvalue['name'], $valuepost['description']];
                                    }
                                }
                            }
                        }
                    }
                    return 'new';
                    break;
                }
                case 'delete':{
                    $order = unserialize($model->order);
                    $order = $order['products'];
                    $position = (integer)Yii::$app->request->getQueryParam('position');
                    foreach ($order as $key => $value) {
                        if ($position != $key)
                            $ordernew['products'][] = $order[$key];
                    }
                    $model->order = serialize($ordernew);
                    $model->save();
                    return 'delete';
                    break;
                }
                default:{
                    $post = Yii::$app->request->post('PartnersOrders');
                    $order = unserialize($model->order);
                    $olddisc = $order['discount'];
                    $order['ship'] = $post['order']['ship'];
                    $order['discounttotalprice'] = $post['order']['discounttotalprice'];
                    if (Yii::$app->params['partnersset']['transport']['active'] == 1) {
                        $order['paymentmethod'] = $post['order']['paymentmethod'];
                    }
                    unset($post['order']['discount'], $post['order']['ship'], $post['order']['discounttotalprice'], $post['order']['paymentmethod']);
                    foreach ($post['order'] as $key => $value) {
                        // Аннулируем дефолтную наценку и скидку
                        $defprice = ($order['products'][$key]['3'] / (100 + $olddisc)) * 100;
                        // Делаем новую наценку
                        $order['products'][$key]['3'] = $defprice + $defprice * $order['discount'] / 100;
                        $order['products'][$key]['4'] = $value;
                    }
                    $model->order = serialize($order);
                    $model->save();
                    return $order['user_id'];
                    break;
                }
            }
        }else{
            if(!$id){
                return json_encode([Yii::$app->request->post()]);
            }else if(!$referal){
                return json_encode([Yii::$app->request->post()]);
            }else if(!$referaluser){
                return json_encode([Yii::$app->request->post()]);
            }
        }
    }
}