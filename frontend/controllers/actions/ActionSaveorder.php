<?php
namespace frontend\controllers\actions;

use Yii;
use common\models\PartnersOrders;
use common\models\PartnersUsersInfo;
use common\models\AddressBook;
use common\models\Countries;
use common\models\Zones;
use common\models\User;

trait ActionSaveorder
{
    public function actionSaveorder()
    {
        Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        $model = new PartnersOrders();
        $order = Yii::$app->request->post('order');
        $order['ship'] = Yii::$app->request->post('ship');
        $order['paymentmethod'] = Yii::$app->request->post('paymentmethod');
        $userdata = Yii::$app->request->post('user');
        $check = Yii::$app->params['constantapp']['APP_ID'];
        $userModel = Yii::$app->user->identity;
        $model->partners_id = $check;
        $model->user_id = $userModel->getId();
        $user = new PartnersUsersInfo();
        if (Yii::$app->params['partnersset']['transport']['active']) {
            $user->scenario = Yii::$app->params['partnersset']['transport']['value'][$order['ship']]['wantpasport'];
        } else {
            $user->scenario = $order['ship'];
        }
        if ($user::findOne($userModel->getId())) {
            $user = $user::findOne($userModel->getId());
            if (Yii::$app->params['partnersset']['transport']['active']) {
                $user->scenario = Yii::$app->params['partnersset']['transport']['value'][$order['ship']]['wantpasport'];
            } else {
                $user->scenario = $order['ship'];
            }
            if ($userdata['pasportser'] != '') {
                $user->pasportser = $userdata['pasportser'];
            }
            if ($userdata['pasportnum'] != '') {
                $user->pasportnum = $userdata['pasportnum'];
            }
            if ($userdata['pasportdate'] != '') {
                $user->pasportdate = $userdata['pasportdate'];
            }
            if ($userdata['pasportwhere'] != '') {
                $user->pasportwhere = $userdata['pasportwhere'];
            }
            if ($user->customers_id > 0) {
                $check_passport_customer = AddressBook::findOne(['customers_id' => $user->customers_id]);
                if ($check_passport_customer->pasport_seria == NULL) {
                    $check_passport_customer->pasport_seria = $userdata['pasportser'];

                }
                if ($check_passport_customer->pasport_nomer == NULL) {
                    $check_passport_customer->pasport_nomer = $userdata['pasportnum'];

                }
                if ($check_passport_customer->pasport_kem_vidan == NULL) {
                    $check_passport_customer->pasport_kem_vidan = $userdata['pasportwhere'];

                }
                if ($check_passport_customer->pasport_kogda_vidan == '0000-00-00' || $check_passport_customer->pasport_kogda_vidan == NULL) {
                    $check_passport_customer->pasport_kogda_vidan = $userdata['pasportdate'];

                }
                $check_passport_customer->entry_gender = 'M';

                $country = new Countries();
                $zones = new Zones();

                $entrycountry = $country->find()->select('countries_id as id')->where(['countries_name' => $userdata['country']])->asArray()->one();
                $entryzones = $zones->find()->select('zone_id as id')->where(['zone_name' => $userdata['state']])->asArray()->one();

                $check_passport_customer->entry_firstname = $userdata['name'];
                $check_passport_customer->entry_lastname = $userdata['lastname'];
                $check_passport_customer->entry_city = $userdata['city'];
                $check_passport_customer->entry_street_address = $userdata['adress'];
                $check_passport_customer->otchestvo = $userdata['secondname'];
                $check_passport_customer->entry_postcode = $userdata['postcode'];
                $check_passport_customer->entry_country_id = $entrycountry['id'];
                $check_passport_customer->entry_zone_id = $entryzones['id'];

                $user->id = $userModel->getId();
                $user->name = $userdata['name'];
                $user->secondname = $userdata['secondname'];
                $user->lastname = $userdata['lastname'];
                $user->country = $userdata['country'];
                $user->state = $userdata['state'];
                $user->city = $userdata['city'];
                $user->adress = $userdata['adress'];
                $user->postcode = $userdata['postcode'];
                $user->telephone = $userdata['telephone'];
                $check_passport_customer->update();
                $user->update();

            } else {
                $user->id = $userModel->getId();
                $user->name = $userdata['name'];
                $user->secondname = $userdata['secondname'];
                $user->lastname = $userdata['lastname'];
                $user->country = $userdata['country'];
                $user->state = $userdata['state'];
                $user->city = $userdata['city'];
                $user->adress = $userdata['adress'];
                $user->postcode = $userdata['postcode'];
                $user->telephone = $userdata['telephone'];
                $user->update();
            }

        } else {
            $user->id = $userModel->getId();
            $user->name = $userdata['name'];
            $user->secondname = $userdata['secondname'];
            $user->lastname = $userdata['lastname'];
            $user->country = $userdata['country'];
            $user->state = $userdata['state'];
            $user->city = $userdata['city'];
            $user->adress = $userdata['adress'];
            $user->postcode = $userdata['postcode'];
            $user->telephone = $userdata['telephone'];
            $user->pasportser = $userdata['pasportser'];
            $user->pasportnum = $userdata['pasportnum'];
            $user->pasportdate = $userdata['pasportdate'];
            $user->pasportwhere = $userdata['pasportwhere'];
        }
        if ($user->validate()) {
            $user->save('false');
            $id = $userModel->getId();
            $model->delivery = serialize($user);
            if (isset(Yii::$app->params['partnersset']['discount']['value']) && Yii::$app->params['partnersset']['discount']['active'] == 1) {
                $order['discount'] = Yii::$app->params['partnersset']['discount']['value'];
            }

            $totalprice = 0;
            foreach ($order as $key => $value) {
                $totalprice += (integer)($value[3]) * (integer)($value[4]);
            }
            $order['discounttotalprice'] = 0;
            if (isset(Yii::$app->params['partnersset']['discounttotalorderprice']['value']) && Yii::$app->params['partnersset']['discounttotalorderprice']['active'] == 1) {
                foreach (Yii::$app->params['partnersset']['discounttotalorderprice']['value'] as $valuediscont) {
                    if ($valuediscont['in'] <= $totalprice && $totalprice < $valuediscont['out'] && (integer)($valuediscont['value']) > 0) {
                        $order['discounttotalprice'] = $valuediscont['value'];
                    }
                }
            }

            if (isset(Yii::$app->params['partnersset']['discounttotalorder']['value']) && Yii::$app->params['partnersset']['discounttotalorder']['active'] == 1) {
                $user_total_order_price = (integer)Yii::$app->user->identity->total_order;
                if ($user_total_order_price > 0) {
                    foreach (Yii::$app->params['partnersset']['discounttotalorder']['value'] as $valuediscontorder) {
                        if($valuediscontorder['in'] <= $user_total_order_price && $user_total_order_price < $valuediscontorder['out'] && (integer)($valuediscontorder['value']) > 0){
                            $order['discounttotalprice'] =  max((integer)$valuediscontorder['value'],(integer)$order['discounttotalprice']);
                        }
                    }
                }
            }

            if (isset(Yii::$app->params['partnersset']['discountgroup']['value'], Yii::$app->user->identity->active_discount) && Yii::$app->params['partnersset']['discountgroup']['active'] == 1) {
                $user_active_group = (integer)Yii::$app->user->identity->active_discount;
                if ($user_active_group > 0 && isset(Yii::$app->params['partnersset']['discountgroup']['value'][$user_active_group]['value']) && Yii::$app->params['partnersset']['discountgroup']['value'][$user_active_group]['active'] == 1) {
                    $order['discounttotalprice'] = max((integer)Yii::$app->params['partnersset']['discountgroup']['value'][$user_active_group]['value'], (integer)$order['discounttotalprice']);
                }
            }


            if (isset(Yii::$app->params['partnersset']['minimalordertotalprice']['value']) && Yii::$app->params['partnersset']['minimalordertotalprice']['active'] == 1) {
                $ch = (integer)(Yii::$app->params['partnersset']['minimalordertotalprice']['value']);
                if ($ch > $totalprice) {
                    return ['exception' => 'Минимальная сумма заказа ' . (integer)(Yii::$app->params['partnersset']['minimalordertotalprice']['value']) . ' Руб. Сумма вашего заказа ' . $totalprice . ' Руб.'];
                }
            }
            $model->order = serialize($order);
            $model->status = 1;
            $model->create_date = date('Y-m-d H:i:s');
            $model->update_date = date('Y-m-d H:i:s');
            if ($model->save()) {
                $username = User::findOne($id)->username;
                $orders_delivery = ' ';
                $site_name = Yii::$app->params['constantapp']['APP_NAME'];
                $date_order = date('m.d.Y');
                Yii::$app->mailer->compose(['html' => 'order-save'], ['order' => $model->order, 'user' => $model->delivery, 'id' => $model->id, 'site' => $_SERVER['HTTP_HOST'], 'site_name' => $site_name, 'date_order' => $date_order])
                    ->setFrom('support@' . $_SERVER['HTTP_HOST'])
                    ->setTo($username)
                    ->setSubject('Заказ на сайте ' . $_SERVER['HTTP_HOST'])
                    ->send();
                return ['id' => $model->id, 'order' => unserialize($model->order)];
            } else {
                return false;
            }
        }
    }
}