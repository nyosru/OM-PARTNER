<?php
namespace frontend\controllers\actions\om;
use common\models\PartnersCart;
use yii;

trait ActionSaveCart{
    public function actionSavecart(){
        Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        $post=Yii::$app->request->post();
        if(($cart = PartnersCart::find()->where(['id'=>(integer)Yii::$app->request->post('id')])->one()) == FALSE ) {
            if(!yii::$app->user->isGuest) {
                $data = serialize($post['data']);
                $comment = yii\helpers\Html::encode($post['comments']);
                $public = (integer)$post['public'];
                $cart = new PartnersCart();
                $cart->partners_id = Yii::$app->params['constantapp']['APP_ID'];
                $cart->user_id = Yii::$app->user->getIdentity()->getId();
                $cart->comment = $comment;
                $cart->sharing = $public;
                $cart->cart_body = $data;
                $cart->date_added = date("Y-m-d H:i:s");
                $cart->date_modified = date("Y-m-d H:i:s");
                if ($cart->save()) {
                    return 1;
                } else {
                    return 0;
                }
            }else{
                return 2;
            }
        }else{
            if(($param = Yii::$app->request->post('param'))== TRUE){
                if($cart->user_id==yii::$app->user->id) {
                    switch ($param) {
                        case 'share':
                            $cart->sharing = (int)Yii::$app->request->post('data');
                            $cart->save();
                            return 1;
                        case 'delete':
                            $cart->delete();
                            return 1;
                        default: return 0;
                    }
                }else return 2;
            }
            
        }
    }
}