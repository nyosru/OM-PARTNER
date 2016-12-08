<?php
namespace frontend\modules\adminsite\controllers\actions;

use Yii;
use common\models\Coupons;
use yii\data\ActiveDataProvider;

/*
 * Управление купонами
 */
trait ActionCoupons
{
    public function actionCoupons($coupon_id=0)
    {
        $dataProvider = new ActiveDataProvider([
            'query' => Coupons::find(),
        ]);

        $coupon = new Coupons();
        $post = Yii::$app->request->post();
        if($coupon_id){
            $coupon = Coupons::find()->where(['coupon_id'=>$coupon_id])->one();
            $action = Yii::$app->request->get('action');
            if(Yii::$app->request->isAjax) {
                switch($action){
                    case 'view':
                        return $this->renderAjax('coupon-view', ['model' => $coupon]);
                    case 'update':
                        return $this->renderAjax('coupon-update', ['model' => $coupon]);
                }
            }
            if($action == 'delete') {
                if ($coupon->delete()) {
                    Yii::$app->session->setFlash('success', 'Купон удален');
                } else {
                    Yii::$app->session->setFlash('error', 'Ошибка при удалении');
                }
                return $this->redirect(['coupons']);
            }
        }
        if($coupon->load($post)){
            if($coupon->save()) {
                Yii::$app->session->setFlash('success', 'Данные сохранены');
                return $this->redirect(['coupons']);
            } else {
                Yii::$app->session->setFlash('error', 'Ошибка при сохранении: '.array_values($coupon->firstErrors)[0]);
            }
        }
        return $this->render('coupons', [
            'dataProvider' => $dataProvider,
            'coupon' => $coupon,
        ]);
    }
}