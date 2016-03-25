<?php
namespace frontend\controllers\actions;

use Yii;
use common\models\PartnersUsersInfo;
use common\models\Customers;
use common\models\AddressBook;
use common\models\Countries;
use common\models\Zones;

trait ActionRequestadress
{
    public function actionRequestadress()
    {
        Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        $userModel = Yii::$app->user->identity;
        $user = PartnersUsersInfo::findOne($userModel->getId());
        $ship = Yii::$app->request->post('ship');
        $userdatafilt = new PartnersUsersInfo();
        $userdatalable = $userdatafilt->attributeLabels();
        $userdatafilt = $userdatafilt->scenarios();
        $userdatafilt = $userdatafilt[$ship];
        $result = [];
        if ($user->customers_id != '') {
            $usercustomers = Customers::findOne($user->customers_id);
            if(
                ($id  = (int)Yii::$app->request->post('id')) == TRUE &&
                ($useradressbook = AddressBook::find()->where(['customers_id'=>$usercustomers->customers_id, 'address_book_id'=>$id])->one()) == TRUE
            ){

            }
            else{
                $useradressbook = AddressBook::findOne($usercustomers->delivery_adress_id);}
//            echo'<pre>';
//            print_r($id);
//            echo'</pre>';
//            die();
            $usercountry = Countries::findOne($useradressbook->entry_country_id)->countries_name;
            $userstate = Zones::findOne($useradressbook->entry_zone_id)->zone_name;
            $entryarr = array('name' => $useradressbook->entry_firstname, 'lastname' => $useradressbook->entry_lastname, 'secondname' => $useradressbook->otchestvo, 'country' => $usercountry, 'state' => $userstate, 'city' => $useradressbook->entry_city, 'adress' => $useradressbook->entry_street_address, 'postcode' => $useradressbook->entry_postcode, 'telephone' => $usercustomers->customers_telephone, 'pasportser' => $useradressbook->pasport_seria, 'pasportnum' => $useradressbook->pasport_nomer, 'pasportdate' => $useradressbook->pasport_kogda_vidan, 'pasportwhere' => $useradressbook->pasport_kem_vidan);
            foreach ($userdatafilt as $value) {
                $result[][$value][$userdatalable[$value]] = $entryarr[$value];
            }
            return $result;

        } else {
            $useradressdata = new PartnersUsersInfo();
            $useradressdata = $useradressdata->findOne($userModel->getId());
            $entryarr = array('name' => $useradressdata->name, 'lastname' => $useradressdata->lastname, 'secondname' => $useradressdata->secondname, 'country' => $useradressdata->country, 'state' => $useradressdata->state, 'city' => $useradressdata->city, 'adress' => $useradressdata->adress, 'postcode' => $useradressdata->postcode, 'telephone' => $useradressdata->telephone, 'pasportser' => $useradressdata->pasportser, 'pasportnum' => $useradressdata->pasportnum, 'pasportdate' => $useradressdata->pasportdate, 'pasportwhere' => $useradressdata->pasportwhere);
            foreach ($userdatafilt as $value) {
                $result[][$value][$userdatalable[$value]] = $entryarr[$value];
            }

            return $result;
        }

    }
}