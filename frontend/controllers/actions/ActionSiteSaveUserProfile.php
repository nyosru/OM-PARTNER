<?php
namespace frontend\controllers\actions;
use common\models\AddressBook;
use common\models\Countries;
use common\models\Customers;
use common\models\PartnersOrders;
use common\models\PartnersUsersInfo;
use common\models\Zones;
use Yii;

trait ActionSiteSaveUserProfile
{
    public function actionSaveuserprofile()
    {
        //Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        $model = new PartnersOrders();
        $userdata = Yii::$app->request->post('user');
        $check = Yii::$app->params['constantapp']['APP_ID'];
        $userModel = Yii::$app->user->identity;
        $model->partners_id = $check;
        $model->user_id = $userModel->getId();
        $user = new PartnersUsersInfo();
        $user->scenario = 'flat2_flat2';
        if ($user::findOne($userModel->getId())) {
            $user = $user::findOne($userModel->getId());
            $user->scenario = 'flat2_flat2';
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
                $check_tel_customer = Customers::findOne(['customers_id' => $user->customers_id]);
                if ($userdata['telephone']) {
                    $check_tel_customer->customers_telephone = $userdata['telephone'];
                    $check_tel_customer->update();
                }
                if ($userdata['pasportser']) {
                    $check_passport_customer->pasport_seria = $userdata['pasportser'];
                }
                if ($userdata['pasportnum']) {
                    $check_passport_customer->pasport_nomer = $userdata['pasportnum'];
                }
                if ($userdata['pasportdate']) {
                    $check_passport_customer->pasport_kem_vidan = $userdata['pasportwhere'];
                }
                if ($userdata['pasportwhere']) {
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
                $user->pasportser = $userdata['pasportser'];
                $user->pasportnum = $userdata['pasportnum'];
                $user->pasportdate = $userdata['pasportdate'];
                $user->pasportwhere = $userdata['pasportwhere'];
                if ($check_passport_customer->update() && $user->update()) {
                } else {
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

        } else {

        }


    }
}