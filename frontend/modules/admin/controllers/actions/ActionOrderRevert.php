<?php
namespace frontend\modules\admin\controllers\actions;

use common\models\PartnersOrders;
use Yii;
use yii\helpers\ArrayHelper;


trait ActionOrderRevert
{
    public function actionOrderrevert()
    {
        $model = new PartnersOrders();
        if (Yii::$app->request->getQueryParam('id')) {

            $model = $model::findOne((integer)(Yii::$app->request->getQueryParam('id')));

            if ($model->orders_id < 2) {
                $this->redirect('/admin/');
            } else {
                if (($revert = Yii::$app->request->post('revert')) == TRUE) {
                    $order = unserialize($model->order);
                    unset($order['discount'], $order['ship'], $order['discounttotalprice'], $order['paymentmethod']);
                    foreach ($order as $key => $value) {
                        $order[$key][8]['count'] = min(abs((integer)$revert[$key]['count']), $value[4]);
                        $order[$key][8]['reason'] = $this->trim_tags_text($revert[$key]['reason'], $lenght = 180);
                    }
                    $model->order = serialize($order);
                    $model->save();
                    return $this->render('orderrevert', ['modelform' => $model]);
                } else {
                    return $this->render('orderrevert', ['modelform' => $model]);
                }
            }
        } else {
            return $this->redirect('/admin/');
        }
    }
}