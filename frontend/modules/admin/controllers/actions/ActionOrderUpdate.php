<?php
namespace frontend\modules\admin\controllers\actions;
use common\models\PartnersOrders;
use Yii;

trait ActionOrderUpdate{
    public function actionOrderupdate()
    {
        $model = new PartnersOrders();
        if (Yii::$app->request->getQueryParam('id')) {

            $model = $model::findOne((integer)(Yii::$app->request->getQueryParam('id')));

            if ($model->orders_id > 0 || $model->status == 0 || !$model->id) {
                $this->redirect('/admin/');
            } else {
                if (Yii::$app->request->post()) {
                    $post = Yii::$app->request->post('PartnersOrders');
                    $order = unserialize($model->order);
                    // Дефолтные скидка и наценка
                    $olddisc = $order['discount'];
                    // Передаем в модель наценку
                    $order['discount'] = $post['order']['discount'];
                    $order['ship'] = $post['order']['ship'];
                    // Туда же скидку
                    $order['discounttotalprice'] = $post['order']['discounttotalprice'];
                    if (Yii::$app->params['partnersset']['transport']['active'] == 1) {
                        $order['paymentmethod'] = $post['order']['paymentmethod'];
                    }
                    // Удаляем их из поста
                    unset($post['order']['discount'], $post['order']['ship'], $post['order']['discounttotalprice'], $post['order']['paymentmethod']);
                    // для оставшихся элементов в посте меняем количество на заданное
                    foreach ($post['order'] as $key => $value) {
                        // Аннулируем дефолтную наценку и скидку
                        $defprice = ($order[$key]['3'] / (100 + $olddisc)) * 100;
                        // Делаем новую наценку
                        $order[$key]['3'] = $defprice + $defprice * $order['discount'] / 100;
                        $order[$key]['4'] = $value;
                    }

                    $model->order = serialize($order);
                    $model->save();
                    return $this->render('orderupdate', ['modelform' => $model]);
                } else {
                    return $this->render('orderupdate', ['modelform' => $model]);
                }
            }
        } else {
            return $this->redirect('/admin/');
        }
    }
}