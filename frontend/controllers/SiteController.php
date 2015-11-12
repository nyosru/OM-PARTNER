<?php

namespace frontend\controllers;

use common\models\User;
use common\traits\Categories_for_partner;
use common\traits\Fullopcat;
use common\traits\Hide_manufacturers_for_partners;
use common\traits\Imagepreviewcrop;
use common\traits\Load_cat;
use common\traits\Reformat_cat_array;
use common\traits\View_cat;
use frontend\controllers\actions\ActionSiteIndex;
use frontend\controllers\actions\ActionSiteRequest;
use frontend\controllers\actions\ActionSiteSaveUserProfile;
use frontend\controllers\actions\ActionSiteSearchword;
use frontend\controllers\actions\CacheUserState;
use frontend\controllers\actions\CasheUserState;
use Yii;
use yii\base\Exception;
use yii\caching\ChainedDependency;
use yii\caching\DbDependency;
use common\models\Customers;
use common\models\AddressBook;
use common\models\PartnersUsersInfo;
use common\models\LoginForm;
use frontend\models\PasswordResetRequestForm;
use frontend\models\ResetPasswordForm;
use frontend\models\SignupForm;
use yii\base\InvalidParamException;
use yii\caching\ExpressionDependency;
use yii\helpers\BaseUrl;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use common\models\PartnersProductsToCategories;
use yii\data\SqlDataProvider;
use yii\db\ActiveRecord;
use yii\data\ArrayDataProvider;
use common\models\PartnersOrders;
use common\models\Partners;
use common\models\Countries;
use common\models\Zones;
use common\models\Orders;
use common\models\PartnersConfig;
use yii\caching\Cache;
use yii\caching\Dependency;

/**
 * Контроллер сайта
 */
class SiteController extends Controller
{
    use Fullopcat, View_cat, Load_cat, Hide_manufacturers_for_partners, Categories_for_partner, Imagepreviewcrop,
        Reformat_cat_array, ActionSiteIndex, ActionSiteRequest, ActionSiteSearchword, ActionSiteSaveUserProfile, CacheUserState;

    /**
     * @inheritdoc
     */


    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout', 'signup', 'saveorder', 'requestadress', 'productinfo', 'lk', 'requestorders', 'requestemail', 'saveuserprofile', 'savehtml', 'chstatusorder'],
                'rules' => [
                    [
                        'actions' => ['signup'],
                        'allow' => true,
                        'roles' => ['?'],
                    ],
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                    [
                        'actions' => ['saveuserprofile'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                    [
                        'actions' => ['saveorder'],
                        'allow' => true,
                        'roles' => ['register', 'admin'],
                    ],
                    [
                        'actions' => ['requestadress'],
                        'allow' => true,
                        'roles' => ['register', 'admin'],
                    ],
                    [
                        'actions' => ['productinfo'],
                        'allow' => true,
                        'roles' => ['?', '@'],
                    ],
                    [
                        'actions' => ['lk'],
                        'allow' => true,
                        'roles' => ['register', 'admin'],
                    ],
                    [
                        'actions' => ['requestorders'],
                        'allow' => true,
                        'roles' => ['register', 'admin'],
                    ],
                    [
                        'actions' => ['requestemail'],
                        'allow' => true,
                        'roles' => ['register', 'admin'],
                    ],
                    [
                        'actions' => ['savehtml'],
                        'allow' => true,
                        'roles' => ['admin'],
                    ],
                    [
                        'actions' => ['chstatusorder'],
                        'allow' => true,
                        'roles' => ['@', '?'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    private function id_partners()
    {
        return Yii::$app->params['constantapp']['APP_ID'];
    }

    public function actionCatpath()
    {
        $cat =  intval(Yii::$app->request->getQueryParam('cat'));
        $catdataarr = $this->categories_for_partners();
        $catdata = $catdataarr[0];
        $categories = $catdataarr[1];
        foreach ($categories as $value) {
            $catnamearr[$value['categories_id']] = $value['categories_name'];
        }
        foreach ($catdata as $value) {
            $catdatas[$value['categories_id']] = $value['parent_id'];
        }
        Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        $chpu = $this->Requrscat($catdatas, $cat, $catnamearr);
        return $chpu;

    }


    public function actionLogin()
    {
        if (!\Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        } else {
            return $this->render('login', [
                'model' => $model,
            ]);
        }
    }

    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    public function actionCatalog()
    {
        $categoriesarr = $this->categories_for_partners();
        $categories = $categoriesarr[0];
        $cat = $categoriesarr[1];
        $checks = Yii::$app->params['constantapp']['APP_CAT'];
        $check = Yii::$app->params['constantapp']['APP_ID'];
        $cat_array = $this->reformat_cat_array($categories, $cat, $checks);
        $view = $this->view_cat($cat_array['cat'], 0, $cat_array['name'], $check);
        $this->getView()->params['Chpu'] = '';
        $state = $this->CasheUserStateGet();
        return $this->render('catalog', ['view' => $view, 'state' => $state] );
    }

    public function actionAbout()
    {
        $checks = Yii::$app->params['constantapp']['APP_CAT'];
        $check = Yii::$app->params['constantapp']['APP_ID'];
        $categoriesarr = $this->categories_for_partners();
        $categories = $categoriesarr[0];
        $cat = $categoriesarr[1];
        $cat_array = $this->reformat_cat_array($categories, $cat, $checks);
        $view = $this->View_cat($cat_array['cat'], 0, $cat_array['name'], $check);
        return $this->render('about', ['view' => $view]);
    }

    public function actionLk()
    {
        return $this->render('lk');
    }

    public function actionContacts()
    {
        $categoriesarr = $this->categories_for_partners();
        $categories = $categoriesarr[0];
        $cat = $categoriesarr[1];
        $checks = Yii::$app->params['constantapp']['APP_CAT'];
        $check = Yii::$app->params['constantapp']['APP_ID'];
        $cat_array = $this->reformat_cat_array($categories, $cat, $checks);
        $view = $this->view_cat($cat_array['cat'], 0, $cat_array['name'], $check);
        return $this->render('contacts', ['view' => $view]);
    }

    public function actionDelivery()
    {
        $categoriesarr = $this->categories_for_partners();
        $categories = $categoriesarr[0];
        $cat = $categoriesarr[1];
        $checks = Yii::$app->params['constantapp']['APP_CAT'];
        $check = Yii::$app->params['constantapp']['APP_ID'];
        $cat_array = $this->reformat_cat_array($categories, $cat, $checks);
        $view = $this->view_cat($cat_array['cat'], 0, $cat_array['name'], $check);
        return $this->render('delivery', ['view' => $view]);
    }

    public function actionOfferta()
    {
        $categoriesarr = $this->categories_for_partners();
        $categories = $categoriesarr[0];
        $cat = $categoriesarr[1];
        $checks = Yii::$app->params['constantapp']['APP_CAT'];
        $check = Yii::$app->params['constantapp']['APP_ID'];
        $cat_array = $this->reformat_cat_array($categories, $cat, $checks);
        $view = $this->view_cat($cat_array['cat'], 0, $cat_array['name'], $check);
        return $this->render('offerta', ['view' => $view]);
    }

    public function actionFaq()
    {
        $categoriesarr = $this->categories_for_partners();
        $categories = $categoriesarr[0];
        $cat = $categoriesarr[1];
        $checks = Yii::$app->params['constantapp']['APP_CAT'];
        $check = Yii::$app->params['constantapp']['APP_ID'];
        $cat_array = $this->reformat_cat_array($categories, $cat, $checks);
        $view = $this->view_cat($cat_array['cat'], 0, $cat_array['name'], $check);
        return $this->render('faqpage', ['view' => $view]);
    }

    public function actionPaying()
    {
        $categoriesarr = $this->categories_for_partners();
        $categories = $categoriesarr[0];
        $cat = $categoriesarr[1];
        $checks = Yii::$app->params['constantapp']['APP_CAT'];
        $check = Yii::$app->params['constantapp']['APP_ID'];
        $cat_array = $this->reformat_cat_array($categories, $cat, $checks);
        $view = $this->view_cat($cat_array['cat'], 0, $cat_array['name'], $check);
        return $this->render('paying', ['view' => $view]);
    }

    public function actionSignup()
    {
        $model = new SignupForm();
        if ($model->load(Yii::$app->request->post())) {
            if ($user = $model->signup()) {
                if (Yii::$app->getUser()->login($user)) {
                    return $this->goHome();
                }
            }
        }
        return $this->render('signup', [
            'model' => $model,
        ]);
    }

    public function actionRequestPasswordReset()
    {
        $model = new PasswordResetRequestForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail()) {
                Yii::$app->getSession()->setFlash('success', 'Check your email for further instructions.');

                return $this->goHome();
            } else {
                Yii::$app->getSession()->setFlash('error', 'Sorry, we are unable to reset password for email provided.');
            }
        }
        return $this->render('requestPasswordResetToken', [
            'model' => $model,
        ]);
    }

    public function actionResetPassword($token)
    {
        try {
            $model = new ResetPasswordForm($token);
        } catch (InvalidParamException $e) {
            throw new BadRequestHttpException($e->getMessage());
        }

        if ($model->load(Yii::$app->request->post()) && $model->validate() && $model->resetPassword()) {
            Yii::$app->getSession()->setFlash('success', 'New password was saved.');

            return $this->goHome();
        }

        return $this->render('resetPassword', [
            'model' => $model,
        ]);
    }

    public function actionRequestorders()
    {
        $id = Yii::$app->user->identity->getId();
        $model = new PartnersOrders();
        $page = intval(Yii::$app->request->getQueryParam('page'));

        $check = $this->id_partners();
        Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        $count = $model->find()->where(['partners_id' => $check, 'user_id' => $id])->count();
        if ($count < ($page) * 10) {
            $page = $page - 1;
        }
        $query = $model->find()->where(['partners_id' => $check, 'user_id' => $id])->limit(10)->offset($page * 10)->asArray()->all();

        $check = array();
        foreach ($query as $key => $value) {
            $query[$key]['order'] = unserialize($value['order']);
            $discount[$value['orders_id']] = $query[$key]['order']['discount'];
            $discounttotal[$value['orders_id']] = $query[$key]['order']['discounttotalprice'];
            unset($query[$key]['order']['ship']);
            unset($query[$key]['order']['discount']);
            unset($query[$key]['order']['discounttotalprice']);
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
            foreach ($query as $key => $value) {
                $query['ordersatus'][$ordersatusn[$key]['orders_id']] = $ordersatusn[$key];
                if (isset($discount[$ordersatusn[$key]['orders_id']])) {
                    foreach ($query['ordersatus'][$ordersatusn[$key]['orders_id']]['products'] as $prkey => $prval) {
                        $query['ordersatus'][$ordersatusn[$key]['orders_id']]['products'][$prkey]['products_price'] =
                            intval($query['ordersatus'][$ordersatusn[$key]['orders_id']]['products'][$prkey]['products_price']) +
                            intval($query['ordersatus'][$ordersatusn[$key]['orders_id']]['products'][$prkey]['products_price']) / 100 *
                            $discount[$ordersatusn[$key]['orders_id']];
                    }
                }

            }
        }

        if ($count < ($page) * 10) {
            $query['page'] = $count / 10;
        } elseif ($page < 1) {
            $query['page'] = 0;

        } else {
            $query['page'] = $page;
        }

        return $query;
    }

    public function actionSaveorder()
    {
            Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
            $model = new PartnersOrders();
            $order = Yii::$app->request->post('order');
            $order['ship'] = Yii::$app->request->post('ship');
            $userdata = Yii::$app->request->post('user');
            $check = Yii::$app->params['constantapp']['APP_ID'];
            $userModel = Yii::$app->user->identity;
            $model->partners_id = $check;
            $model->user_id = $userModel->getId();
            $user = new PartnersUsersInfo();
            $user->scenario = $order['ship'];
            if ($user::findOne($userModel->getId())) {
                $user = $user::findOne($userModel->getId());
                $user->scenario = $order['ship'];
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
                $id = $userModel->getId();
                $model->delivery = serialize($user);
                if(isset(Yii::$app->params['partnersset']['discount']['value']) && Yii::$app->params['partnersset']['discount']['active'] == 1 ){
                    $order['discount'] = Yii::$app->params['partnersset']['discount']['value'];
                }

                $totalprice = 0;
                foreach($order as $key => $value){
                $totalprice += intval($value[3])*intval($value[4]);
                }

                if (isset(Yii::$app->params['partnersset']['discounttotalorderprice']['value']) && Yii::$app->params['partnersset']['discounttotalorderprice']['active'] == 1) {
                    foreach (Yii::$app->params['partnersset']['discounttotalorderprice']['value'] as $valuediscont) {
                        if ($valuediscont['in'] <= $totalprice && $totalprice < $valuediscont['out'] && intval($valuediscont['value']) > 0) {
                            $order['discounttotalprice'] = $valuediscont['value'];
                        }
                    }
                }

                if(isset(Yii::$app->params['partnersset']['minorderprice']['value']) && Yii::$app->params['partnersset']['minorderprice']['active'] == 1){
                  $ch =   intval(Yii::$app->params['partnersset']['minorderprice']['value']);
                    if($ch  > $totalprice) {
                        return ['exception' => 'Минимальная сумма заказа ' . intval(Yii::$app->params['partnersset']['minorderprice']['value']) . ' Руб. Сумма вашего заказа ' . $totalprice . ' Руб.'];
                    }else{

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
            } else {
            }
    }


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
            $useradressbook = AddressBook::findOne($usercustomers->delivery_adress_id);
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

    public function actionCountryrequest()
    {

        $data = Yii::$app->cache->get(urlencode('data_country-' . Yii::$app->params['constantapp']['APP_ID']));
        $countryfirst = ['Российская Федерация'];
        if ($data === false) {
            $country_data = new Countries();
            $data = $country_data->find()->select('countries_id as id, countries_name as title')->asArray()->all();

            Yii::$app->cache->set(urlencode('data_country-' . Yii::$app->params['constantapp']['APP_ID']), ['data_country' => $data], 86400);

        } else {
            $data = $data['data_country'];
        }
        foreach($data as $key=>$val){
            if(in_array($val['title'], $countryfirst)){
                $tmp = $data[$key];
                unset($data[$key]);
                array_unshift($data,  $tmp);
            }
        }
        $result['response'] = ['count' => count($data), 'items' => $data];
        Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;

        return $result;
    }

    public function actionRequestemail()
    {
        return Yii::$app->user->identity->username;
    }

    public function actionZonesrequest($id)
    {

        $data = Yii::$app->cache->get(urlencode('zones_data-' . $id));
        if ($data === false) {
            $zones_data = new Zones();
            $data = $zones_data->find()->select('zone_id as id, zone_name as title')->where(['zone_country_id' => intval($id)])->asArray()->all();
            Yii::$app->cache->set(urlencode('zones_data-' . $id), ['zones_data' => $data], 86400);
        } else {
            $data = $data['zones_data'];
        }
        $result['response'] = ['count' => count($data), 'items' => $data];
        Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        return $result;
    }

    public function actionShippingfields($id)
    {
        $model = new PartnersUsersInfo();
        $result = $model->getScenario($id);
        Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        return $result;
    }

    public function actionProductinfo()
    {
        if (Yii::$app->request->isPost) {
            $id = Yii::$app->request->post('id');
        } else {
            $id = Yii::$app->request->getQueryParam('id');
        }
        $keyprod = Yii::$app->cache->buildKey('product-' . $id);
        $data = Yii::$app->cache->get($keyprod);
        if (!$data) {
            $data = PartnersProductsToCategories::find()->JoinWith('products')->where('products.`products_id` =:id', [':id' => $id])->JoinWith('productsDescription')->JoinWith('productsAttributes')->groupBy(['products.`products_id` DESC'])->JoinWith('productsAttributesDescr')->asArray()->one();
        } else {
            $data = $data['data'];
        }
        Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        if (isset(Yii::$app->params['partnersset']['discount']['value']) && Yii::$app->params['partnersset']['discount']['active'] == 1) {

            $data['products']['products_price'] = intval($data['products']['products_price']) + (intval($data['products']['products_price']) / 100 * intval(Yii::$app->params['partnersset']['discount']['value']));

        }
        return $data;

    }

    public function actionImagepreview()
    {

        $src = Yii::$app->request->getQueryParam('src');
        $action = Yii::$app->request->getQueryParam('action', 'none');
        $headers = Yii::$app->response->headers;
        $headers->add('Content-Type', 'image/jpg');
        $headers->add('Cache-Control', 'max-age=68200');
        Yii::$app->response->format = \yii\web\Response::FORMAT_RAW;
        return $this->Imagepreviewcrop('http://odezhda-master.ru/images/', $src, '@webroot/images/', $action);
    }

    public function actionSavehtml()
    {
        if (isset($_POST['html']) && isset($_POST['page'])) {
            $html = addslashes($_POST['html']);
            $page = addslashes($_POST['page']);
            $data = new PartnersConfig();
            $check = Yii::$app->params['constantapp']['APP_ID'];

            $data = $data->find()->where(['partners_id' => $check, 'type' => $page])->one();
            if ($data) {
                $data->partners_id = $check;
                $data->type = $page;
                $data->value = $html;
                $data->active = 1;
            } else {
                $data = new PartnersConfig();
                $data->partners_id = $check;
                $data->type = $page;
                $data->value = $html;
                $data->active = 1;
            }
            if ($data->save()) {
                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    public function actionChstatusorder()
    {
        $id = intval(Yii::$app->request->getQueryParam('id'));
        $key = Yii::$app->request->getQueryParam('key');
        $status = intval(Yii::$app->request->getQueryParam('status'));

        $order = new Orders();
        $orderdata = $order->find()->where(['orders_id' => $id])->asArray()->one();
        $data = $orderdata['customers_referer_url'];
        $data = json_decode($data);
        if ($key == $data->Key && isset($key) && $key != '') {

            $new_tok_order = Orders::findOne($id);
            $validkey = '';
            $char = 'QWERTYUPASDFGHJKLZXCVBNMqwertyuopasdfghjkzxcvbnm123456789';
            while (strlen($validkey) < 20) {
                $validkey .= $char[mt_rand(0, strlen($char))];
            }
            $new_tok_order->customers_referer_url = '{"Partner":"' . $data->Partner . '","User":"' . $data->User . '","Key":"' . $validkey . '","Site":"' . $data->Site . '"}';
            if ($new_tok_order->update()) {
                if ($status == 2) {
                    $model_order_partner = PartnersOrders::findOne(['orders_id' => $new_tok_order->id]);
                    $date_order = explode(' ', $model_order_partner->create_date);
                    $date_order = $date_order[0];
                    $partners_id = $model_order_partner->partners_id;
                    $partners = Partners::findOne($partners_id);
                    $site = $partners->domain;
                    $site_name = $partners->name;
                    $orders = new Orders();
                    $query = $orders->find()->select('orders.`orders_id`, orders.`orders_status`, orders.`delivery_lastname`, orders.`delivery_name`,orders.`delivery_otchestvo`, orders.`delivery_postcode`, orders.`delivery_state`, orders.`delivery_country`, orders.`delivery_state`, orders.`delivery_city`, orders.`delivery_street_address`, orders.`customers_telephone`')->where('orders.`orders_id` IN (' . $model_order_partner->orders_id . ')')->joinWith('products')->joinWith('productsAttr')->asArray()->one();

                    $prodarr = [];
                    foreach ($query['products'] as $value) {
                        $prodarr[] = $value['products_id'];

                    }
                    $mail = explode('@@@', $new_tok_order->customers_email_address);
                    $mail = $mail[1];
                    Yii::$app->mailer->compose(['html' => 'order-ch-status'], ['model' => $model_order_partner, 'order' => $query, 'id' => $model_order_partner->id, 'site' => $site, 'site_name' => $site_name, 'date_order' => $date_order])
                        ->setFrom('support@' . $site)
                        ->setTo($mail)
                        ->setSubject('Заказ на сайте ' . $site)
                        ->send();
                }
                return '1';
            } else {
                return '0';
            }
        } else {
            return '0';
        }

    }

    public function Requrscat($arr, $firstval, $catnamearr)
    {
        static $chpu;
        static $item;
        $item = $firstval;
        if (isset($arr[$item])) {
            while ($arr[$item] != '0') {
                if (isset($catnamearr[$item])) {
                    $chpu[] = ['name' => $catnamearr[$item], 'id' => $item];

                    $item = $arr[$item];
                }
            }
            if (isset($catnamearr[$item])) {
                $chpu[] = ['name' => $catnamearr[$item], 'id' => $item];
            }
        }
        return array_reverse($chpu);
    }

    private function sklonenie($search)
    {

        $encode = mb_detect_encoding($search);
        $search = $origsearch = mb_strtolower($search, $encode);
        $tolength = mb_strlen($search, $encode);
        $length = $tolength - 3;
        $substr = mb_substr($search, $length, $tolength - $length, $encode);
        switch ($substr) {
            case 'ами':
                $search = mb_substr($search, 0, $length, $encode);
                return $this->checksklonenie($search, $origsearch, $encode);
            case 'ями':
                $search = mb_substr($search, 0, $length, $encode);
                return $this->checksklonenie($search, $origsearch, $encode);
            default:
                $length = $length + 1;
                $substr = mb_substr($search, $length, $tolength - $length, $encode);
                switch ($substr) {
                    case 'ов' :
                        $search = mb_substr($search, 0, $length, $encode);
                        return $this->checksklonenie($search, $origsearch, $encode);
                    case 'ев' :
                        $search = mb_substr($search, 0, $length, $encode);
                        return $this->checksklonenie($search, $origsearch, $encode);
                    case 'ей' :
                        $search = mb_substr($search, 0, $length, $encode);
                        return $this->checksklonenie($search, $origsearch, $encode);
                    case 'ам' :
                        $search = mb_substr($search, 0, $length, $encode);
                        return $this->checksklonenie($search, $origsearch, $encode);
                    case 'ям' :
                        $search = mb_substr($search, 0, $length, $encode);
                        return $this->checksklonenie($search, $origsearch, $encode);
                    case 'ах' :
                        $search = mb_substr($search, 0, $length, $encode);
                        return $this->checksklonenie($search, $origsearch, $encode);
                    case 'ях' :
                        $search = mb_substr($search, 0, $length, $encode);
                        return $this->checksklonenie($search, $origsearch, $encode);
                    case 'ою' :
                        $search = mb_substr($search, 0, $length, $encode);
                        return $this->checksklonenie($search, $origsearch, $encode);
                    case 'ею' :
                        $search = mb_substr($search, 0, $length, $encode);
                        return $this->checksklonenie($search, $origsearch, $encode);
                    case 'ом' :
                        $search = mb_substr($search, 0, $length, $encode);
                        return $this->checksklonenie($search, $origsearch, $encode);
                    case 'ем' :
                        $search = mb_substr($search, 0, $length, $encode);
                        return $this->checksklonenie($search, $origsearch, $encode);
                    default:
                        $length = $length + 1;
                        $substr = mb_substr($search, $length, $tolength - $length, $encode);
                        switch ($substr) {
                            case 'а' :
                                $search = mb_substr($search, 0, $length, $encode);
                                return $this->checksklonenie($search, $origsearch, $encode);
                            case 'я' :
                                $search = mb_substr($search, 0, $length, $encode);
                                return $this->checksklonenie($search, $origsearch, $encode);
                            case 'о' :
                                $search = mb_substr($search, 0, $length, $encode);
                                return $this->checksklonenie($search, $origsearch, $encode);
                            case 'е' :
                                $search = mb_substr($search, 0, $length, $encode);
                                return $this->checksklonenie($search, $origsearch, $encode);
                            case 'ы' :
                                $search = mb_substr($search, 0, $length, $encode);
                                return $this->checksklonenie($search, $origsearch, $encode);
                            case 'и':
                                $search = mb_substr($search, 0, $length, $encode);
                                return $this->checksklonenie($search, $origsearch, $encode);
                            case 'у' :
                                $search = mb_substr($search, 0, $length, $encode);
                                return $this->checksklonenie($search, $origsearch, $encode);
                            case 'ю' :
                                $search = mb_substr($search, 0, $length, $encode);
                                return $this->checksklonenie($search, $origsearch, $encode);
                            default:
                                return $this->checksklonenie($search, $origsearch, $encode);
                        }
                }
        }

    }

    private function checksklonenie($pattern, $search, $encode = 'UTF-8')
    {
        if (mb_strlen($pattern, $encode) < 3 && !preg_match('/(а|о|э|и|у|ы|е|ё|ю|я)+/iu', $pattern)) {
            return $search;
        } else {
            return $pattern;
        }
    }
}



