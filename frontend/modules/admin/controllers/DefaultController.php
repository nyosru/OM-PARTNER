<?php

namespace app\modules\admin\controllers;

use common\models\PartnersComments;
use common\models\PartnersNews;
use common\models\PartnersRequest;
use common\models\PartnersSettings;
use common\models\OrdersTotal;
use common\models\PartnersOrders;
use common\models\PartnersProducts;
use common\models\PartnersUsersInfo;
use common\traits\Imagepreviewcrop;
use common\traits\ThemeResources;
use frontend\assets\AppAsset;
use Yii;
use yii\db\Exception;
use yii\web\Controller;
use yii\filters\AccessControl;
use common\models\User;
use common\models\Partners;
use common\models\AddressBook;
use common\models\Customers;
use common\models\CustomersInfo;
use common\models\Orders;
use common\models\OrdersProducts;
use common\models\OrdersProductsAttributes;
use common\models\Countries;
use common\models\Zones;
use common\models\OrdersStatus;
use yii\data\ActiveDataProvider;

class DefaultController extends Controller
{
    use Imagepreviewcrop, ThemeResources;

    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions' => ['index', 'newspage', 'requestpage', 'commentspage', 'commentscontrol', 'newsupdate', 'savesettings', 'requestusers', 'requestnews', 'requestupdate', 'requestorders', 'delegate', 'cancelorder', 'templateimage'],
                        'allow' => true,
                        'roles' => ['admin'],

                    ],
                ]
            ]
        ];
    }


    private function id_partners()
    {
        return Yii::$app->params['constantapp']['APP_ID'];
    }

    public function actions()
    {
        $this->layout = 'main';
        return 'Админка';
    }

    public function actionIndex()
    {
        $model = new PartnersSettings();
        $paramset = Yii::$app->params['partnersset'];
        $contacts = Yii::$app->params['partnersset']['contacts'];
        $model->mailcounter['value'] = $paramset['mailcounter']['value'];
        $model->mailcounter['active'] = $paramset['mailcounter']['active'];
        $model->yandexcounter['value'] = $paramset['yandexcounter']['value'];
        $model->yandexcounter['active'] = $paramset['yandexcounter']['active'];
        $model->discount['value'] = $paramset['discount']['value'];
        $model->discount['active'] = $paramset['discount']['active'];
        $model->minimalordertotalprice['value'] = $paramset['minimalordertotalprice']['value'];
        $model->minimalordertotalprice['active'] = $paramset['minimalordertotalprice']['active'];
        $model->contacts['adress']['value'] = $contacts['adress']['value'];
        $model->contacts['adress']['active'] = $contacts['adress']['active'];
        $model->contacts['telephone']['value'] = $contacts['telephone']['value'];
        $model->contacts['telephone']['active'] = $contacts['telephone']['active'];
        $model->contacts['fax']['value'] = $contacts['fax']['value'];
        $model->contacts['fax']['active'] = $contacts['fax']['active'];
        $model->contacts['email']['value'] = $contacts['email']['value'];
        $model->contacts['email']['active'] = $contacts['email']['active'];
        $model->contacts['graf_work']['activated'] = $contacts['graf_work']['activated'];
        $model->template = $paramset['template']['value'];
        $model->contacts['graf_work']['mon']['active'] = $contacts['graf_work']['mon']['active'];
        $model->contacts['graf_work']['mon']['w']['in'] = $contacts['graf_work']['mon']['w']['in'];
        $model->contacts['graf_work']['mon']['wm']['in'] = $contacts['graf_work']['mon']['wm']['in'];
        $model->contacts['graf_work']['mon']['w']['out'] = $contacts['graf_work']['mon']['w']['out'];
        $model->contacts['graf_work']['mon']['wm']['out'] = $contacts['graf_work']['mon']['wm']['out'];
        $model->contacts['graf_work']['mon']['o']['active'] = $contacts['graf_work']['mon']['o']['active'];
        $model->contacts['graf_work']['mon']['o']['in'] = $contacts['graf_work']['mon']['o']['in'];
        $model->contacts['graf_work']['mon']['om']['in'] = $contacts['graf_work']['mon']['om']['in'];
        $model->contacts['graf_work']['mon']['o']['out'] = $contacts['graf_work']['mon']['o']['out'];
        $model->contacts['graf_work']['mon']['om']['out'] = $contacts['graf_work']['mon']['om']['out'];
        $model->contacts['graf_work']['tue']['active'] = $contacts['graf_work']['tue']['active'];
        $model->contacts['graf_work']['tue']['w']['in'] = $contacts['graf_work']['tue']['w']['in'];
        $model->contacts['graf_work']['tue']['wm']['in'] = $contacts['graf_work']['tue']['wm']['in'];
        $model->contacts['graf_work']['tue']['w']['out'] = $contacts['graf_work']['tue']['w']['out'];
        $model->contacts['graf_work']['tue']['wm']['out'] = $contacts['graf_work']['tue']['wm']['out'];
        $model->contacts['graf_work']['tue']['o']['active'] = $contacts['graf_work']['tue']['o']['active'];
        $model->contacts['graf_work']['tue']['o']['in'] = $contacts['graf_work']['tue']['o']['in'];
        $model->contacts['graf_work']['tue']['om']['in'] = $contacts['graf_work']['tue']['om']['in'];
        $model->contacts['graf_work']['tue']['o']['out'] = $contacts['graf_work']['tue']['o']['out'];
        $model->contacts['graf_work']['tue']['om']['out'] = $contacts['graf_work']['tue']['om']['out'];
        $model->contacts['graf_work']['wed']['active'] = $contacts['graf_work']['wed']['active'];
        $model->contacts['graf_work']['wed']['w']['in'] = $contacts['graf_work']['wed']['w']['in'];
        $model->contacts['graf_work']['wed']['wm']['in'] = $contacts['graf_work']['wed']['wm']['in'];
        $model->contacts['graf_work']['wed']['w']['out'] = $contacts['graf_work']['wed']['w']['out'];
        $model->contacts['graf_work']['wed']['wm']['out'] = $contacts['graf_work']['wed']['wm']['out'];
        $model->contacts['graf_work']['wed']['o']['active'] = $contacts['graf_work']['wed']['o']['active'];
        $model->contacts['graf_work']['wed']['o']['in'] = $contacts['graf_work']['wed']['o']['in'];
        $model->contacts['graf_work']['wed']['om']['in'] = $contacts['graf_work']['wed']['om']['in'];
        $model->contacts['graf_work']['wed']['o']['out'] = $contacts['graf_work']['wed']['o']['out'];
        $model->contacts['graf_work']['wed']['om']['out'] = $contacts['graf_work']['wed']['om']['out'];
        $model->contacts['graf_work']['thu']['active'] = $contacts['graf_work']['thu']['active'];
        $model->contacts['graf_work']['thu']['w']['in'] = $contacts['graf_work']['thu']['w']['in'];
        $model->contacts['graf_work']['thu']['wm']['in'] = $contacts['graf_work']['thu']['wm']['in'];
        $model->contacts['graf_work']['thu']['w']['out'] = $contacts['graf_work']['thu']['w']['out'];
        $model->contacts['graf_work']['thu']['wm']['out'] = $contacts['graf_work']['thu']['wm']['out'];
        $model->contacts['graf_work']['thu']['o']['active'] = $contacts['graf_work']['thu']['o']['active'];
        $model->contacts['graf_work']['thu']['o']['in'] = $contacts['graf_work']['thu']['o']['in'];
        $model->contacts['graf_work']['thu']['om']['in'] = $contacts['graf_work']['thu']['om']['in'];
        $model->contacts['graf_work']['thu']['o']['out'] = $contacts['graf_work']['thu']['o']['out'];
        $model->contacts['graf_work']['thu']['om']['out'] = $contacts['graf_work']['thu']['om']['out'];
        $model->contacts['graf_work']['fri']['active'] = $contacts['graf_work']['fri']['active'];
        $model->contacts['graf_work']['fri']['w']['in'] = $contacts['graf_work']['fri']['w']['in'];
        $model->contacts['graf_work']['fri']['wm']['in'] = $contacts['graf_work']['fri']['wm']['in'];
        $model->contacts['graf_work']['fri']['w']['out'] = $contacts['graf_work']['fri']['w']['out'];
        $model->contacts['graf_work']['fri']['wm']['out'] = $contacts['graf_work']['fri']['wm']['out'];
        $model->contacts['graf_work']['fri']['o']['active'] = $contacts['graf_work']['fri']['o']['active'];
        $model->contacts['graf_work']['fri']['o']['in'] = $contacts['graf_work']['fri']['o']['in'];
        $model->contacts['graf_work']['fri']['om']['in'] = $contacts['graf_work']['fri']['om']['in'];
        $model->contacts['graf_work']['fri']['o']['out'] = $contacts['graf_work']['fri']['o']['out'];
        $model->contacts['graf_work']['fri']['om']['out'] = $contacts['graf_work']['fri']['om']['out'];
        $model->contacts['graf_work']['sat']['active'] = $contacts['graf_work']['sat']['active'];
        $model->contacts['graf_work']['sat']['w']['in'] = $contacts['graf_work']['sat']['w']['in'];
        $model->contacts['graf_work']['sat']['wm']['in'] = $contacts['graf_work']['sat']['wm']['in'];
        $model->contacts['graf_work']['sat']['w']['out'] = $contacts['graf_work']['sat']['w']['out'];
        $model->contacts['graf_work']['sat']['wm']['out'] = $contacts['graf_work']['sat']['wm']['out'];
        $model->contacts['graf_work']['sat']['o']['active'] = $contacts['graf_work']['sat']['o']['active'];
        $model->contacts['graf_work']['sat']['o']['in'] = $contacts['graf_work']['sat']['o']['in'];
        $model->contacts['graf_work']['sat']['om']['in'] = $contacts['graf_work']['sat']['om']['in'];
        $model->contacts['graf_work']['sat']['o']['out'] = $contacts['graf_work']['sat']['o']['out'];
        $model->contacts['graf_work']['sat']['om']['out'] = $contacts['graf_work']['sat']['om']['out'];
        $model->contacts['graf_work']['sun']['active'] = $contacts['graf_work']['sun']['active'];
        $model->contacts['graf_work']['sun']['w']['in'] = $contacts['graf_work']['sun']['w']['in'];
        $model->contacts['graf_work']['sun']['wm']['in'] = $contacts['graf_work']['sun']['wm']['in'];
        $model->contacts['graf_work']['sun']['w']['out'] = $contacts['graf_work']['sun']['w']['out'];
        $model->contacts['graf_work']['sun']['wm']['out'] = $contacts['graf_work']['sun']['wm']['out'];
        $model->contacts['graf_work']['sun']['o']['active'] = $contacts['graf_work']['sun']['o']['active'];
        $model->contacts['graf_work']['sun']['o']['in'] = $contacts['graf_work']['sun']['o']['in'];
        $model->contacts['graf_work']['sun']['om']['in'] = $contacts['graf_work']['sun']['om']['in'];
        $model->contacts['graf_work']['sun']['o']['out'] = $contacts['graf_work']['sun']['o']['out'];
        $model->contacts['graf_work']['sun']['om']['out'] = $contacts['graf_work']['sun']['om']['out'];
        $model->yandexmap['value'] = $paramset['yandexmap']['value'];
        $model->yandexmap['active'] = $paramset['yandexmap']['active'];
        $model->googlemap['value'] = $paramset['googlemap']['value'];
        $model->googlemap['active'] = $paramset['googlemap']['active'];
        $model->logotype['active'] = $paramset['logotype']['active'];
        $model->logotype['value'] = $paramset['logotype']['value'];
        $model->discounttotalorderprice['value'] = $paramset['discounttotalorderprice']['value'];
        $model->discounttotalorderprice['active'] = $paramset['discounttotalorderprice']['active'];
        $model->slogan['active'] = $paramset['slogan']['active'];
        $model->slogan['value'] = $paramset['slogan']['value'];
        $model->newsonindex['value'] = $paramset['newsonindex']['value'];
        $model->newsonindex['active'] = $paramset['newsonindex']['active'];
        $model->commentsonindex['value'] = $paramset['commentsonindex']['value'];
        $model->commentsonindex['active'] = $paramset['commentsonindex']['active'];
        return $this->render('index', ['model' => $model]);
    }

    public function actionSavesettings()
    {
        $model = new PartnersSettings();
        $model->load($_POST);
        $model->SaveSet();
        $temlate_key = Yii::$app->cache->buildKey('templatepartners-' . Yii::$app->params['constantapp']['APP_ID']);
        $partnersettings = new PartnersSettings();
        $partnerset = $partnersettings->LoadSet();
        Yii::$app->assetManager->appendTimestamp = true;
        if (isset($partnerset['template']['value'])) {
            $theme = $this->ThemeResourcesload($partnerset['template']['value'], 'site')['view'];
        } else {
            $theme = Yii::$app->params['constantapp']['APP_THEMES'];
        }
        $asset = new AppAsset();
        $assetsite = $asset->LoadAssets($partnerset['template']['value'], 'site');
        $asset = new AppAsset();
        $adminasset = $asset->LoadAssets($partnerset['template']['value'], 'back');
        Yii::$app->cache->set($temlate_key, ['data' => $assetsite, 'dataadmin' => $adminasset, 'theme' => $theme, 'partnerset' => $partnerset]);
        return $this->render('index', ['model' => $model, 'exception' => '']);
    }

    public function actionRequestnews()
    {

        $newsprovider = new ActiveDataProvider([
            'query' => PartnersNews::find()->where(['partners_id' => Yii::$app->params['constantapp']['APP_ID']]),
            'pagination' => [
                'pageSize' => 20,
            ],
        ]);
        Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        return $newsprovider->getModels();
    }

    public function actionCancelorder()
    {
        $id = Yii::$app->request->post('id');
        $orders = new PartnersOrders();
        $orders_data = $orders->findOne($id);
        if (isset($orders_data) && $orders_data !== 9999) {
            if (Yii::$app->params['constantapp']['APP_ID'] == $orders_data->partners_id) {
                if ($orders_data->orders_id == NULL || $orders_data->orders_id == '') {
                    $orders_data->status = 0;
                    if ($orders_data->update()) {
                        $username = User::findOne($orders_data->user_id)->username;
                        Yii::$app->mailer->compose(['html' => 'order-cancel'], ['order' => $orders_data->order, 'user' => $orders_data->delivery, 'id' => $orders_data->id, 'site' => $_SERVER['HTTP_HOST'], 'site_name' => Yii::$app->params['constantapp']['APP_NAME'], 'date_order' => $orders_data->create_date])
                            ->setFrom('support@' . $_SERVER['HTTP_HOST'])
                            ->setTo($username)
                            ->setSubject('Ваш заказ отменен')
                            ->send();
                    } else {
                        return 'Ошибка обновления статуса заказа';
                    }
                } else {
                    return 'Заказ уже передан в ОМ';
                }
            } else {
                return 'Вы не можете редактировать данный заказ';
            }
        } else {
            return 'Нет такого заказа';
        }

    }

    public function actionRequestusers()
    {
        $check = $this->id_partners();
        Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        $query = User::find()->select('id, username, email, created_at, updated_at')->where('id_partners=' . $check)->asArray()->all();
        return $query;
    }

    public function actionTemplateimage()
    {
        $src = Yii::$app->request->getQueryParam('src');
        $action = Yii::$app->request->getQueryParam('action', 'none');
        $template = Yii::$app->request->getQueryParam('template');
        $path = Yii::getAlias('@app');
        $headers = Yii::$app->response->headers;
        $headers->add('Content-Type', 'image/jpg');
        $headers->add('Cache-Control', 'max-age=68200');
        Yii::$app->response->format = \yii\web\Response::FORMAT_RAW;
        return $this->Imagepreviewcrop($path . '/themes/', $template . '/' . $src, '@webroot/images/', $action = 'none');
    }

    public function actionRequestorders()
    {
        $model = new PartnersOrders();
        $check = $this->id_partners();
        $page = intval(Yii::$app->request->getQueryParam('page'));
        Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        $count = $model->find()->where(['partners_id' => $check])->count();
        if ($count <= $page * 10) {
            $page = $page - 1;
        }
        $query = $model->find()->where(['partners_id' => $check])->limit(1000)->offset($page * 10)->joinWith('userDescription')->asArray()->all();


        $orders_status_arr = OrdersStatus::find()->asArray()->all();


        foreach ($orders_status_arr as $valueos) {
            $orders_status[$valueos[0]] = $valueos[1];
        }
        $check = array();
        foreach ($query as $key => $value) {
            $query[$key]['order'] = unserialize($value['order']);
            $discount[$value['orders_id']] = $query[$key]['order']['discount'];
            $discounttotal[$value['orders_id']] = $query[$key]['order']['discounttotalprice'];
            unset($query[$key]['order']['ship']);
            unset($query[$key]['order']['discount']);
            unset($query[$key]['order']['discounttotalprice']);
            $query[$key]['userDescription'] = $query[$key]['userDescription']['email'];
            $query[$key]['delivery'] = unserialize($value['delivery']);
            $query[$key]['discounttotal'] = $discounttotal[$value['orders_id']];
            if ($value['orders_id'] != '' and $value['orders_id'] != NULL) {
                $check[] = $value['orders_id'];
            };

        }

        if (count($check) > 1) {
            $checkstr = implode(',', $check);
        } elseif (count($check) == 1) {
            $checkstr = $check[0];
        }
        if ($checkstr != '') {
            $orders = new Orders();
            // $query[ordersatus] = $checkstr;
            $ordersatusn = $orders->find()->select('orders.`orders_id`, orders.`orders_status`, orders.`delivery_lastname`, orders.`delivery_name`,orders.`delivery_otchestvo`, orders.`delivery_postcode`, orders.`delivery_state`, orders.`delivery_country`, orders.`delivery_state`, orders.`delivery_city`, orders.`delivery_street_address`, orders.`customers_telephone`')->where('orders.`orders_id` IN (' . $checkstr . ')')->joinWith('products')->joinWith('productsAttr')->asArray()->all();
//            foreach ($ordersatusn as $valuesn) {
//                $valuesn = $orders_status;
//            }
            foreach ($query as $key => $value) {
                $query['ordersatus'][$ordersatusn[$key]['orders_id']] = $ordersatusn[$key];
                //   $query['ordersatus'][$ordersatusn[$key]['orders_status']] = $ordersatusn[$key];
                if (isset($discount[$ordersatusn[$key]['orders_id']])) {
                    $query['ordersatus'][$ordersatusn[$key]['orders_id']]['discount'] = $discount[$ordersatusn[$key]['orders_id']];
                }
            }
        }
        if ($count <= $page * 10) {
            $page = $page - 1;;
        } elseif ($page < 1) {
            $query['page'] = 0;

        } else {
            $query['page'] = $page;
        }
        return $query;
    }

    public function actionDelegate()
    {
        // Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        $data = intval(Yii::$app->request->post('id'));
        $self = intval(Yii::$app->request->post('self'), 0);
        $ordersdata = new PartnersOrders();
        $userpartnerdata = new User();
        $userdata = new PartnersUsersInfo();
        $ordersparamlock = $ordersdata->findOne(['id' => $data]);
        $ordersparam = $ordersdata->find()->where(['id' => $data])->asArray()->one();
        if ($ordersparamlock->status !== 9999) {
            $ordersparamlock->status = 9999;
            $ordersparamlock->update();
            $transaction = Yii::$app->db->beginTransaction();
            try {
                $userparam = $userdata->find()->where(['id' => $ordersparam['user_id']])->asArray()->one();
                $userpartnersparam = $userpartnerdata->find()->select('email,id_partners')->where(['id' => $ordersparam['user_id']])->asArray()->one();
                if ($userparam['customer_id'] == '') {
                    $country = new Countries();
                    $zones = new Zones();
                    $entrycountry = $country->find()->select('countries_id as id')->where(['countries_name' => $userparam['country']])->asArray()->one();
                    $entryzones = $zones->find()->select('zone_id as id')->where(['zone_name' => $userparam['state']])->asArray()->one();
                    $userOM = new AddressBook();
                    $userCustomer = new Customers();
                    $partner = Partners::findOne($userpartnersparam['id_partners']);
                    $check_email = $userCustomer->find()->where(['customers_email_address' => 'partnerom' . $partner->id . '@@@' . $userpartnersparam['email']])->asArray()->one();

                    if (!$check_email) {
                        $userOM->entry_firstname = $userparam['name'];
                        $userOM->entry_lastname = $userparam['lastname'];
                        $userOM->entry_city = $userparam['city'];
                        $userOM->entry_street_address = $userparam['adress'];
                        $userOM->otchestvo = $userparam['secondname'];
                        $userOM->pasport_seria = $userparam['pasportser'];
                        $userOM->pasport_nomer = $userparam['pasportnum'];
                        $userOM->pasport_kem_vidan = $userparam['pasportwhere'];
                        if (isset($userparam['pasportdate'])) {
                            $userOM->pasport_kogda_vidan = $userparam['pasportdate'];
                        } else {
                            $userOM->pasport_kogda_vidan = date();
                        }
                        $userOM->entry_postcode = $userparam['postcode'];
                        $userOM->entry_gender = 'M';
                        $userOM->entry_country_id = $entrycountry['id'];
                        $userOM->entry_zone_id = $entryzones['id'];
                        if ($userOM->save()) {
                            $userCustomer->customers_firstname = $userparam['name'];
                            $userCustomer->customers_lastname = $userparam['lastname'];
                            $userCustomer->customers_email_address = 'partnerom' . $partner->id . '@@@' . $userpartnersparam['email'];
                            $userCustomer->customers_default_address_id = $userOM->GetId();
                            $userCustomer->customers_selected_template = '1';
                            $userCustomer->customers_telephone = $userparam['telephone'];
                            $password = $userpartnersparam['password_hash'];
                            for ($i = 0; $i < 10; $i++) {
                                $password .= rand(0, 10);
                            }
                            $salt = substr(md5($password), 0, 2);
                            $password = md5($salt . $password) . ':' . $salt;
                            $userCustomer->customers_password = $password;
                            $userCustomer->customers_newsletter = '1';
                            $userCustomer->delivery_adress_id = $userOM->GetId();
                            $userCustomer->delivery_adress_id = $userOM->GetId();
                            $userCustomer->pay_adress_id = $userOM->GetId();
                            if ($userCustomer->save()) {
                                $customer_id = $userCustomer->GetId();
                                $userOM->customers_id = $customer_id;
                                $userOM->update();
                                if ($customer_id % 2 == 0) {
                                    $userCustomer->default_provider = 1;
                                    $userCustomer->update();
                                } else {
                                    $userCustomer->default_provider = 2;
                                    $userCustomer->update();
                                }
                                $userCustomerInfo = new CustomersInfo();
                                $userCustomerInfo->customers_info_id = $customer_id;
                                $userCustomerInfo->customers_info_date_account_created = date("Y-m-d h:i:s");
                                if ($userCustomerInfo->save()) {
                                    $newuserpartnerscastid = PartnersUsersInfo::findOne($userparam['id']);
                                    $newuserpartnerscastid->customers_id = $customer_id;
                                    $newuserpartnerscastid->update();
                                } else {
                                    return $userCustomerInfo;
                                }
                            } else {

                                return $userCustomer;
                            }
                        } else {
                            return $userOM;
                        }
                    } else {

                        $newuserpartnerscastid = PartnersUsersInfo::findOne($userparam['id']);
                        $customer_id = $newuserpartnerscastid->customers_id;

                    }
                }

                if (intval($self) !== 0) {

                    $check = Yii::$app->params['constantapp']['APP_ID'];
                    $custompartnersid = Partners::findOne($check);
                    $customer_id_delivery = $custompartnersid->customers_id;
                }

                if ($customer_id !== '' and $ordersparam['orders_id'] == '') {
                    if ($userCustomer->GetId()) {

                    } else {
                        $userCustomer = Customers::findOne($customer_id);
                        $userOM = AddressBook::findOne($userCustomer->delivery_adress_id);
                    }
                    $entrycountry = Countries::findOne($userOM->entry_country_id);
                    $entryzones = Zones::findOne($userOM->entry_zone_id);
                    $orders = new Orders();
                    $orderforsavedata = PartnersOrders::findOne($data);
                    $partner_id = $orderforsavedata->partners_id;
                    $partner_user_id = $orderforsavedata->user_id;
                    $partnerorder = unserialize($orderforsavedata->order);
                    $ship = $partnerorder['ship'];
                    $discount = $partnerorder['discount'];
                    unset($partnerorder['ship']);
                    unset($partnerorder['discount']);
                    unset($partnerorder['discounttotalprice']);
                    $orders->ur_or_fiz = 'f';
                    $orders->customers_id = $userCustomer->customers_id;
                    $orders->customers_name = $userCustomer->customers_firstname . ' ' . $userCustomer->customers_lastname;
                    $orders->customers_groups_id = 1;
                    $orders->customers_country = $entrycountry->countries_name;
                    $orders->customers_state = $entryzones->zone_name;
                    $orders->customers_city = $userOM->entry_city;
                    $orders->customers_street_address = $userOM->entry_street_address;
                    $orders->customers_postcode = $userOM->entry_postcode;
                    $orders->customers_address_format_id = 1;
                    $orders->customers_telephone = $userCustomer->customers_telephone;
                    $orders->customers_email_address = $userCustomer->customers_email_address;
                    if (isset($customer_id_delivery)) {
                        $userCustomerDelivery = AddressBook::findOne(Customers::findOne($customer_id_delivery)->delivery_adress_id);
                        $entrycountrydelivery = Countries::findOne($userCustomerDelivery->entry_country_id);
                        $entryzonesdelivery = Zones::findOne($userCustomerDelivery->entry_zone_id);
                        $orders->delivery_name = $userCustomerDelivery->entry_firstname;
                        $orders->delivery_lastname = $userCustomerDelivery->entry_lastname;
                        $orders->delivery_otchestvo = $userCustomerDelivery->otchestvo;
                        $orders->delivery_country = $entrycountrydelivery->countries_name;
                        $orders->delivery_state = $entryzonesdelivery->zone_name;
                        $orders->delivery_city = $userCustomerDelivery->entry_city;
                        $orders->delivery_street_address = $userCustomerDelivery->entry_street_address;
                        $orders->delivery_postcode = $userCustomerDelivery->entry_postcode;
                        $orders->delivery_adress_id = $userCustomerDelivery->id;
                        $orders->delivery_pasport_seria = $userCustomerDelivery->pasport_seria;
                        $orders->delivery_pasport_nomer = $userCustomerDelivery->pasport_nomer;
                        $orders->delivery_pasport_kogda_vidan = $userCustomerDelivery->pasport_kogda_vidan;
                        $orders->delivery_pasport_kem_vidan = $userCustomerDelivery->pasport_kem_vidan;
                        $orders->delivery_address_format_id = 1;
                        $orders->shipping_module = $ship;
                    } else {
                        $orders->delivery_name = $userOM->entry_firstname;
                        $orders->delivery_lastname = $userOM->entry_lastname;
                        $orders->delivery_otchestvo = $userOM->otchestvo;
                        $orders->delivery_country = $entrycountry->countries_name;
                        $orders->delivery_state = $entryzones->zone_name;
                        $orders->delivery_city = $userOM->entry_city;
                        $orders->delivery_street_address = $userOM->entry_street_address;
                        $orders->delivery_postcode = $userOM->entry_postcode;
                        $orders->delivery_adress_id = $userOM->id;
                        $orders->delivery_pasport_seria = $userOM->pasport_seria;
                        $orders->delivery_pasport_nomer = $userOM->pasport_nomer;
                        $orders->delivery_pasport_kogda_vidan = $userOM->pasport_kogda_vidan;
                        $orders->delivery_pasport_kem_vidan = $userOM->pasport_kem_vidan;
                        $orders->delivery_address_format_id = 1;
                        $orders->shipping_module = $ship;
                    }
                    $orders->billing_name = $userCustomer->customers_firstname . ' ' . $userCustomer->customers_lastname;
                    $orders->billing_country = $entrycountry->countries_name;
                    $orders->billing_state = $entryzones->zone_name;
                    $orders->billing_city = $userOM->entry_street_address;
                    $orders->billing_street_address = $userOM->entry_street_address;
                    $orders->billing_postcode = $userOM->entry_postcode;
                    $orders->billing_address_format_id = 1;

                    $validkey = '';
                    $char = "QWERTYUPASDFGHJKLZXCVBNMqwertyuopasdfghjkzxcvbnm123456789";
                    $site = $_SERVER['HTTP_HOST'];
                    while (strlen($validkey) < 20) {
                        $validkey .= $char[mt_rand(0, strlen($char))];
                    }

                    $orders->customers_referer_url = '{"Partner":' . $partner_id . ',"User":' . $partner_user_id . ',"Key":"' . $validkey . '","Site":"' . $site . '"}';
                    $orders->currency = 'RUR';
                    $orders->currency_value = '1.000000';
                    $orders->last_modified = date("Y-m-d h:i:s");
                    $orders->date_purchased = date("Y-m-d h:i:s");
                    $orders->date_akt = date("Y-m-d h:i:s");
                    $orders->payment_info = '';
                    $orders->orders_status = 1;
                    $orders->site_side_email_flag = 0;
                    $orders->default_provider = $userCustomer->default_provider;
                    $orders->payment_method = 'Оплата <font size="4" color="red">Для физических лиц</font>';
                    $buh_id = Orders::find()->where(['default_provider' => $userCustomer->default_provider])->orderBy('orders_id DESC')->one();
                    $orders->buh_orders_id = intval($buh_id->buh_orders_id) + 1;
                    if ($orders->save()) {
                        $price_total = '';
                        foreach ($partnerorder as $value) {
                            $ordersprod = new OrdersProducts();
                            $prod = new PartnersProducts();
                            $proddata = $prod->find()->where(['products.`products_id`' => $value[0], 'products_options_values.`products_options_values_id`' => $value[2]])->JoinWith('productsDescription')->JoinWith('productsAttributes')->JoinWith('productsAttributesDescr')->groupBy('products.`products_id`')->asArray()->one();
                            if (!$proddata) {
                                $proddata = $prod->find()->where(['products.`products_id`' => $value[0]])->JoinWith('productsDescription')->groupBy('products.`products_id`')->asArray()->one();
                            }
                            $ordersprod->first_quant = intval($value[4]);
                            $ordersprod->products_quantity = intval($value[4]);
                            $ordersprod->orders_id = $orders->GetId();
                            $ordersprod->products_id = intval($value[0]);
                            $ordersprod->products_model = $proddata['products_model'];
                            $ordersprod->products_name = $proddata['productsDescription']['products_name'];
                            $ordersprod->final_price = $proddata['products_price'];
                            $ordersprod->products_price = $proddata['products_price'];
                            $ordersprod->price_coll = $proddata['price_coll'];
                            $ordersprod->products_status = $proddata['products_status'];
                            $price_total += intval($price_total) + $ordersprod['products_price'] * $ordersprod->products_quantity;
                            if ($ordersprod->save()) {
                                if ($proddata['productsAttributes']['products_attributes_id']) {
                                    $ordersprodattr = new OrdersProductsAttributes();
                                    $ordersprodattr->orders_products_id = $ordersprod->GetId();
                                    $ordersprodattr->orders_id = $orders->GetId();
                                    $ordersprodattr->products_options = 'Размер';
                                    $ordersprodattr->products_options_values = $value[6];
                                    $ordersprodattr->options_values_price = '0.0000';
                                    $ordersprodattr->vid = $value[2];
                                    $ordersprodattr->oid = '1';
                                    $ordersprodattr->sub_vid = 0;
                                    if ($ordersprodattr->save()) {
                                    } else {
                                        return false;
                                    }
                                } else {
                                }
                            } else {
                                return false;
                            }
                        }
                        $orderstotalprice = new OrdersTotal();
                        $orderstotalprice->orders_id = $orders->GetId();
                        $dostavka = ['flat1_flat1' => 'Бесплатная доставка до ТК Деловые Линии', 'flat2_flat2' => 'Бесплатная доставка до ТК ЖелДорЭкспедиция', 'flat3_flat3' => 'Бесплатная доставка до ТК ПЭК', 'flat7_flat7' => 'Почта ЕМС России',];
                        $orderstotalprice->title = $dostavka[$ship];
                        $orderstotalprice->text = '0.00 руб';
                        $orderstotalprice->value = '0.0000';
                        $orderstotalprice->class = 'ot_shipping';
                        $orderstotalprice->sort_order = 2;
                        $orderstotalprice->save();
                        $orderstotalship = new OrdersTotal();
                        $orderstotalship->orders_id = $orders->GetId();
                        $orderstotalship->title = 'Всего: ';
                        $orderstotalship->text = '<b>' . $price_total . ' руб.</b>';
                        $orderstotalship->value = $price_total;
                        $orderstotalship->class = 'ot_total';
                        $orderstotalship->sort_order = 800;
                        $orderstotalship->save();
                        $orderstotalprint = new OrdersTotal();
                        $orderstotalprint->orders_id = $orders->GetId();
                        $orderstotalprint->title = 'Стоимость товара: ';
                        $orderstotalprint->text = $price_total . ' руб.';
                        $orderstotalprint->value = $price_total;
                        $orderstotalprint->class = 'ot_subtotal';
                        $orderstotalprint->sort_order = 1;
                        $orderstotalprint->save();
                        $neworderpartner = PartnersOrders::findOne($ordersparam['id']);
                        $neworderpartner->orders_id = $orders->GetId();
                        if ($self == 0) {
                            $neworderpartner->status = 20;
                        } elseif ($self == 1) {
                            $neworderpartner->status = 10;
                        }
                        $neworderpartner->update_date = date("Y-m-d H:i:s");
                        $neworderpartner->update();
                    } else {
                        //  print_r($userOM);
                    }
                } else {
                    return false;
                }
                $transaction->commit('suc');
            } catch (Exception $e) {
                $transaction->rollBack();

            }
        }
    }

    public function actionNewspage()
    {
        $model = new PartnersNews();
        $newsprovider = new ActiveDataProvider([
            'query' => PartnersNews::find()->where(['partners_id' => Yii::$app->params['constantapp']['APP_ID']]),
            'pagination' => [
                'defaultPageSize' => 20,
            ],
        ]);
        $load = Yii::$app->request->post();
        if ($model->load($load)) {
            $model->date_added = date('Y-m-d h:i:s');
            $model->date_modified = date('Y-m-d h:i:s');
            $model->partners_id = Yii::$app->params['constantapp']['APP_ID'];
            if ($model->save()) {
                return $this->refresh();
            } else {
                return $this->refresh();
            }
        } else {
            return $this->render('newspage', ['model' => $newsprovider, 'modelform' => $model]);
        }
    }

    public function actionRequestpage()
    {

        $model = new PartnersRequest();
        $requestprovider = new ActiveDataProvider([
            'query' => PartnersRequest::find()->where(['partners_id' => Yii::$app->params['constantapp']['APP_ID']]),
            'pagination' => [
                'defaultPageSize' => 20,
            ],
        ]);
        $load = Yii::$app->request->post();
        if ($model->load($load)) {
            $model->date_add = date('Y-m-d h:i:s');
            $model->date_modify = date('Y-m-d h:i:s');
            $model->status = 0;
            $model->partners_id = Yii::$app->params['constantapp']['APP_ID'];
            if ($model->save()) {
                return $this->refresh();
            } else {
                return $this->refresh();
            }
        } else {
            return $this->render('requestpage', ['model' => $requestprovider, 'error' => $model->errors, 'modelform' => $model]);
        }

    }


    public function actionCommentspage()
    {
        $model = new PartnersComments();
        $newsprovider = new ActiveDataProvider([
            'query' => PartnersComments::find()->select([
                'partners_comments.id',
                'partners_comments.user_id',
                'partners_comments.post',
                'partners_comments.status',
                'partners_comments.date_added',
                'partners_users.username',
            ])->where([
                'partners_id' => Yii::$app->params['constantapp']['APP_ID']
            ])->joinWith('user'),
            'pagination' => [
                'defaultPageSize' => 20,
            ],
        ]);
        $load = Yii::$app->request->post();
        if ($model->load($load)) {
            $model->date_added = date('Y-m-d h:i:s');
            $model->date_modified = date('Y-m-d h:i:s');
            $model->partners_id = Yii::$app->params['constantapp']['APP_ID'];
            if ($model->save()) {
                return $this->refresh();
            } else {
                return $this->refresh();
            }
        } else {
            return $this->render('commentspage', ['model' => $newsprovider, 'modelform' => $model]);
        }
    }
    public function actionNewsupdate()
    {
        if (Yii::$app->request->getQueryParam('id')) {
            $model = new PartnersNews();
            $model = $model::findOne(intval(Yii::$app->request->getQueryParam('id')));
            $load = Yii::$app->request->post();
            if (isset($load) && $model->load($load)) {
                $model->date_modified = date('Y-m-d h:i:s');
                $model->partners_id = Yii::$app->params['constantapp']['APP_ID'];
                if ($model->save()) {
                    return $this->redirect('/admin/default/newspage');
                } else {
                    return $this->redirect('/admin/default/newspage');
                }
            } else {
                return $this->render('newsupdate', ['modelform' => $model]);
            }
        } else {
            return $this->redirect('/admin/default/newspage');
        }
    }
    public function actionRequestupdate()
    {
        $id = Yii::$app->request->getQueryParam('id', 'none');

        if (isset($id) && $id !== 'none') {
            $model = new PartnersRequest();
            $model = $model::findOne(intval(Yii::$app->request->getQueryParam('id')));
            $modelc = new PartnersRequest();
            $load = Yii::$app->request->post();
            if (isset($load['PartnersRequest']['comments']['text'])) {
                $comments = unserialize($model->comments);
                $newcomment['text'] = $load['PartnersRequest']['comments']['text'];
                $newcomment['who'] = yii::$app->user->id;
                $newcomment['date'] = date('Y-m-d h:i:s');
                $comments[] = $newcomment;
                $model->comments = serialize($comments);
                $model->save();

            } else {
                return $this->render('requestupdate', ['modelform' => $model, 'modelc' => $modelc, 'errors' => $model->errors]);
            }
            return $this->render('requestupdate', ['modelform' => $model, 'modelc' => $modelc, 'errors' => $model->errors]);
        } else {
            return $this->redirect('/admin/default/requestpage');
        }
    }

    public function actionCommentscontrol()
    {
        if (Yii::$app->request->getQueryParam('id')) {
            $model = new PartnersComments();
            $model = $model::findOne(intval(Yii::$app->request->getQueryParam('id')));
            if ($model) {
                if (Yii::$app->request->getQueryParam('action') === 'add') {
                    $model->status = 1;
                } else {
                    $model->status = 0;
                }
                if ($model->save()) {
                    return $this->redirect('/admin/default/commentspage');
                } else {
                    return $this->redirect('/admin/default/commentspage');
                }
            } else {
                return $this->redirect('/admin/default/commentspage');
            }
        } else {
            return $this->redirect('/admin/default/commentspage');
        }
    }
}
