<?php
namespace frontend\modules\lk\controllers\actions;

use common\models\Profile;
use common\models\User;
use yii;


trait ActionUserinfo
{
    public function actionUserinfo()
    {
        if (Yii::$app->user->isGuest || ($cust = User::find()->where(['partners_users.id' => Yii::$app->user->getId(), 'partners_users.id_partners' => Yii::$app->params['constantapp']['APP_ID']])->joinWith('userinfo')->joinWith('customers')->joinWith('addressBook')->one()) == FALSE || !isset($cust['customers']['customers_id'])) {
            return $this->redirect(Yii::$app->request->referrer);
        }

        $savelk = false;
        if (Yii::$app->request->post()) {
            $customer = new Profile();
            $customer->load(Yii::$app->request->post());
            switch (Yii::$app->request->post()['save_lk']) {
                case 'user':
                    if ($customer->saveUserInfo()) {
                        $savelk = true;
                    };
                    break;
                case 'chpassword':
                    $chpass = $customer;
                    $chpass->scenario = 'chpass';
                    $chpass->load(Yii::$app->request->post());
                    if ($chpass->changePassword()) {
                        $savelk = true;
                    }
                    break;
                case 'customer':
                    if ($customer->saveCustomer()) {
                        $savelk = true;
                    }
                    unset($customer);
                    $customer = new Profile();
                    break;
                case 'deliv':
                    if ($customer->saveDeliv()) {
                        $savelk = true;
                    }
                    unset($customer);
                    $customer = new Profile();
                    break;
                case 'address':
                    if ($customer->saveUserDelivery()) {
                        $savelk = true;
                    }
                    unset($customer);
                    $customer = new Profile();
                    break;
                case 'add_address':
                    if ($customer->addUserDelivery()) {
                        $savelk = true;
                    }
                    unset($customer);
                    $customer = new Profile();
                    break;
                case 'addr_del':

                    $addr_id = '';
                    foreach (Yii::$app->request->post()['Profile']['delivery'] as $key => $value) {
                        if (isset($value['address_book_id'])) {
                            $addr_id = $value['address_book_id'];
                            break;
                        }
                    };
                    if ($customer->delUserDeliveryAddress($addr_id)) {
                        $savelk = true;
                    }
                    unset($customer);
                    $customer = new Profile();
                    break;
                case 'addr_default':
                    $addr_id = '';
                    foreach (Yii::$app->request->post()['Profile']['delivery'] as $key => $value) {
                        if (isset($value['address_book_id'])) {
                            $addr_id = $value['address_book_id'];
                            break;
                        }
                    };
                    if ($customer->defaultUserDeliveryAddress($addr_id)) {
                        $savelk = true;
                    }
                    unset($customer);
                    $customer = new Profile();
                    break;
                case 'add_pay':
                    $addr_id = '';
                    foreach (Yii::$app->request->post()['Profile']['delivery'] as $key => $value) {
                        if (isset($value['address_book_id'])) {
                            $addr_id = $value['address_book_id'];
                            break;
                        }
                    };
                    if ($customer->defaultUserPayAddress($addr_id)) {
                        $savelk = true;
                    }
                    unset($customer);
                    $customer = new Profile();
                    break;
                default:
                    echo 'Произошла ошибка';
                    die();
                    break;
            }
        } else {
            $customer = new Profile();
        }
        $customer->loadUserProfile();
        \Yii::$app->params['modules']['lk']['menu'] = $this->actionMenu() ;

        return $this->render('lkuserinfo', ['cust' => $customer, 'savelk' => $savelk]);
    }
}