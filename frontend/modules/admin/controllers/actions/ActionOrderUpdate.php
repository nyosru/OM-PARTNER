<?php
namespace frontend\modules\admin\controllers\actions;
use common\models\PartnersOrders;
use Yii;
use yii\helpers\ArrayHelper;

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
                    //   $order['discount'] = $post['order']['discount'];
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
                    if (($postnew = Yii::$app->request->post('new')) == TRUE) {
//                        $chekorderconsitent = new ArrayHelper();
//                        echo '<pre>';
//                        print_r($chekorderconsitent->map($order));
//                        echo '</pre>';
                        foreach ($postnew as $keypost => $valuepost) {
                            foreach ($valuepost['attr'] as $attrkey => $attrvalue) {
                                if (isset($attrvalue['name']) && isset($attrvalue['count'])) {
                                    $check = 0;
                                    foreach ($order as $orderkey => $ordervalue) {
                                        if ($ordervalue[0] == $keypost && $attrkey == $ordervalue[2]) {
                                            $order[$orderkey][4] += $attrvalue['count'];
                                            $check = 1;
                                        };
                                    }
                                    if ($check == 0) {
                                        $order[] = [$keypost, $valuepost['model'], $attrkey, $valuepost['price'], $attrvalue['count'], $valuepost['image'], $attrvalue['name'], $valuepost['description']];
                                    }
                                }
                            }
                        }
                    }
//                    echo '<pre>';
//                    print_r($order);
//                    print_r($postnew);
//                    print_r(Yii::$app->request->post());
//                    echo '<pre>';
                    $model->order = serialize($order);
                    $model->save();
                    return $this->render('orderupdate', ['modelform' => $model]);
                } else if (Yii::$app->request->getQueryParam('action') === 'delete') {
                    $order = unserialize($model->order);
                    $ordernew['ship'] = $order['ship'];
                    $ordernew['discount'] = $order['discount'];
                    $ordernew['discounttotalprice'] = $order['discounttotalprice'];
                    $ordernew['paymentmethod'] = $order['paymentmethod'];
                    unset($order['ship'], $order['discount'], $order['discounttotalprice'], $order['paymentmethod']);
                    $position = (integer)Yii::$app->request->getQueryParam('position');
                    foreach ($order as $key => $value) {
                        if ($position != $key)
                            $ordernew[] = $order[$key];
                    }
                    $model->order = serialize($ordernew);
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