<?php
namespace frontend\modules\sp\controllers\actions;

use common\models\PartnersOrders;
use common\models\PartnersProducts;
use common\models\PartnersProductsToCategories;
use common\models\Referrals;
use common\models\ReferralsUser;
use Yii;


trait ActionAddProductToOrder
{
    public function actionAddProductToOrder()
    {
        $referal = \Yii::$app->user->getIdentity()->getReferral()['id'];

        if (Yii::$app->request->isAjax) {
            Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        }

        if (!Yii::$app->request->isPost) {
            return false;
        }

        $order_id = (integer)Yii::$app->request->post('order_id');
        $product_id = (integer)Yii::$app->request->post('product_id');
        $attr = (integer)Yii::$app->request->post('attr');
        $count_val = (integer)Yii::$app->request->post('val');

        $order = PartnersOrders::find()->where(['id' => $order_id])->one();

        if ($order->status != 1) {
            \Yii::$app->getSession()->setFlash('error', 'Ошибка! Заказ не в статусе "Новый"');

            return false;
        }

        $user = ReferralsUser::find()
            ->joinWith('user')
            ->joinWith('userinfo')
            ->where(['referral_id' => $referal])
            ->andWhere(['user_id' => $order->user_id])
            ->limit(1)
            ->one()
        ;

        if (empty($user)) {
            return false;
        }

        $data_product = PartnersProductsToCategories::find()->JoinWith('products')
            ->where('products.`products_id` =:product_id', [':product_id' => $product_id])
            ->JoinWith('productsDescription')
            ->JoinWith('productsAttributes')
            ->groupBy(['products.`products_id` DESC'])
            ->JoinWith('productsAttributesDescr')
            ->asArray()->one()
        ;

        if (!$data_product) {
            \Yii::$app->getSession()->setFlash('error', 'Ошибка! Такого товара нет');
            return false;
        }

        $data_attr = '';
        $data_attr_name = '';
        foreach ($data_product['productsAttributesDescr'] as $atrr_data) {
            if($atrr_data['products_options_values_id'] == $attr) {
                $data_attr = $atrr_data['products_options_values_id'];
                $data_attr_name = $atrr_data['products_options_values_name'];
            }
        }

        if ($count_val > $data_product['products']['products_quantity']) {
            $count_val = $data_product['products']['products_quantity'];
        }

        $is_a_match = false;
        $un_order = unserialize($order->order);
        $updated_product_data = [];
        foreach ($un_order['products'] as $key => &$product) {
            if ($product[2] == $data_attr && $product[0] == $product_id) {
                $count_val = $product[4] + $count_val;
                if ($count_val > $data_product['products']['products_quantity']) {
                    $count_val = $data_product['products']['products_quantity'];
                }
                $product[4] = $count_val;
                $updated_product_data = $product;
                $is_a_match = true;
            }
        }

        $new_product_data = [
            (integer)$data_product['products_id'],
            $data_product['products']['products_model'],
            $data_attr,
            $data_product['products']['products_price'],
            $count_val,
            $data_product['products']['products_image'],
            $data_attr_name,
            $data_product['productsDescription']['products_name'],
            ['comment' => ''],
        ];
        if ($is_a_match === false) {
            array_push($un_order['products'], $new_product_data);
        }

        $un_order['products'] = array_values($un_order['products']);
        $order->order = serialize($un_order);

        if ($order->validate()) {
            if ($is_a_match) {
                return $updated_product_data;
            } else {
                return $new_product_data;
            }
        } else {
            \Yii::$app->getSession()->setFlash('error', 'Ошибка!');
            return false;
        }
    }
}