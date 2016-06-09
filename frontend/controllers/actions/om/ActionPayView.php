<?php
/**
 * Created by PhpStorm.
 * User: dmitriy
 * Date: 18.05.16
 * Time: 16:08
 */

namespace frontend\controllers\actions\om;

use common\models\AdminCompanies;
use common\models\AdminCompaniesBank;
use common\models\OrdersToPartners;
use Yii;
use common\models\Orders;
use common\models\User;

trait ActionPayView
{
    public function actionPayview()
    {

        if (($customer = User::find()->where(['partners_users.id' => Yii::$app->user->getId(), 'partners_users.id_partners' => Yii::$app->params['constantapp']['APP_ID']])->joinWith('userinfo')->joinWith('customers')->joinWith('addressBook')->one()) == TRUE) {
            $order_id = (integer)Yii::$app->request->getQueryParam('id');
            if (($order = Orders::find()->where(['orders.customers_id' => $customer['customers']['customers_id'], 'orders.orders_id' => $order_id])->joinWith('products')->joinWith('productsAttr')->joinWith('productsSP')->joinWith('ordersBanks')->groupBy('orders.`orders_id` DESC')->asArray()->one()) == TRUE && $order['orders_status'] != '1') {
                $ordernum = Orders::find()->where(['orders.customers_id' => $customer['customers']['customers_id'], 'orders.orders_id' => $order_id])->one()->NumOrder();

                if (!$order['ordersBanks']) {
                    $order['ordersBanks'] = AdminCompaniesBank::find()->where(['admin_companies_id' => $order['default_provider'], 'default_b' => '1'])->asArray()->one();
                }
                if (($provider['partner'] = OrdersToPartners::find()->where(['order_id' => $order_id])->joinWith('partnersCompanies')->asArray()->one()) == TRUE) {
                    foreach ($provider['partner']['partnersCompanies'] as $key => $value) {
                        $provider['partner'][$key] = $value;
                    }
                    unset($provider['partner']['partnersCompanies']);
                    $provider['type'] = 'partner';
                } else {
                    $provider['partner'] = AdminCompanies::find()->where(['companies_id' => $order['default_provider']])->asArray()->one();
                    $provider['type'] = 'default';
                }
                $this->layout = 'print';
                return $this->render('printpay', ['order' => $order, 'customer' => $customer, 'partner' => $provider, 'ordernum' => $ordernum]);
            } else {
                return $this->redirect('/');
            }

        } else {
            return $this->redirect('/');
        }


    }

}