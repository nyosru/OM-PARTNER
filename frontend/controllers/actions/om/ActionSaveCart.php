<?php
namespace frontend\controllers\actions\om;
use common\models\PartnersCart;
use yii;

trait ActionSaveCart{
    public function actionSavecart(){
        Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        $post=Yii::$app->request->post();
        $data=serialize($post['data']);
        $comments=$this->trim_tags_text($post['comments']);
        $public=(integer)$post['public'];
        $cart=new PartnersCart();
        $cart->partners_id = Yii::$app->params['constantapp']['APP_ID'];
        $cart->user_id=Yii::$app->user->getIdentity()->getId();
        $cart->comment=$comments;
        $cart->sharing=$public;
        $cart->cart_body=$data;
        $cart->date_added=date("Y-m-d H:i:s");
        $cart->date_modified=date("Y-m-d H:i:s");
        $cart->validate();
        if($cart->save()){
            return 1;
        }else{
            return 0;
        }
    }
}