<?php

namespace frontend\controllers;
use common\models\OrdersProducts;
use common\models\PartnersProducts;
use common\models\User;
use Yii;
use yii\caching\ChainedDependency;
use yii\caching\DbDependency;
use common\models\CustomersInfo;
use common\models\Customers;
use common\models\AddressBook;
use common\models\PartnersUsersInfo;
use common\models\LoginForm;
use frontend\models\PasswordResetRequestForm;
use frontend\models\ResetPasswordForm;
use frontend\models\SignupForm;
use frontend\models\ContactForm;
use yii\base\InvalidParamException;
use yii\caching\ExpressionDependency;
use yii\helpers\BaseUrl;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use common\models\PartnersCatDescription;
use common\models\PartnersCategories;
use common\models\PartnersProductsToCategories;
use yii\data\SqlDataProvider;
use yii\db\ActiveRecord;
use yii\data\ArrayDataProvider;
use common\models\PartnersOrders;
use common\models\Partners;
use common\models\Countries;
use common\models\Zones;
use common\models\Manufacturers;
use common\models\Orders;
use common\models\PartnersConfig;
use yii\caching\Cache;
use yii\caching\Dependency;
use frontend\controllers\ExtFunc;
/**
 * Контроллер сайта
 */
class SiteController extends Controller
{
    /**
     * @inheritdoc
     */
    private function ExtFuncLoad(){
    return new ExtFunc();
    }

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
                        'roles' => ['?','@'],
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

    private function categories_for_partners(){


     $dependency = new DbDependency([
         'sql' => 'SELECT MAX(last_modified) FROM {{%categories}}',
     ]);
     $catdataarr = Yii::$app->db->cache(
         function ($db) {
             $categoriess = new PartnersCategories();
             $categoriesd = new PartnersCatDescription();
             return [$categoriess->find()->select(['categories_id', 'parent_id'])->where('categories_status != 0')->asArray()->All(), $categoriesd->find()->select(['categories_id', 'categories_name'])->asArray()->All()];
         }, 3600, $dependency
     );
     return $catdataarr;
    }

    private function hide_manufacturers_for_partners(){
        $dependency = new DbDependency([
            'sql' => 'SELECT MAX(last_modified) FROM {{%manufacturers}}',
        ]);
        $hide_man = Yii::$app->db->cache(
            function ($db) {
                $man = new Manufacturers();
                return $man->find()->where(['hide_products' => '1'])->select('manufacturers_id')->asArray()->all();
            }, 86400, $dependency
        );
        return $hide_man;
    }

    public function actionRequest()
    {
        $cat_start = intval(Yii::$app->request->getQueryParam('cat'));
        $check = Yii::$app->params['constantapp']['APP_ID'];
        $checks = Yii::$app->params['constantapp']['APP_CAT'];
        $start_price =  intval(Yii::$app->request->getQueryParam('start_price', 0));
        $end_price =  intval(Yii::$app->request->getQueryParam('end_price', 1000000));
        $prod_attr_query =  intval(Yii::$app->request->getQueryParam('prod_attr_query', ''));
        $count =  intval(Yii::$app->request->getQueryParam('count', 20));
        $page =  intval(Yii::$app->request->getQueryParam('page', 0));
        $start_arr=  intval($page*$count);
        $sort = intval(Yii::$app->request->getQueryParam('sort', 10));
        if($sort == 'undefined'){
            $sort = 10;
        }
        if($page == 'undefined'){
            $page = 0;
        }
        $searchword = Yii::$app->request->getQueryParam('searchword', '');
        if($searchword == '') {
            $catdataarr = $this->categories_for_partners();
            $catdata = $catdataarr[0];
            $categories = $catdataarr[1];
            foreach ($categories as $value) {
                $catnamearr[$value['categories_id']] = $value['categories_name'];
            }
            foreach ($catdata as $value) {
                $catdatas[$value['categories_id']] = $value['parent_id'];
            }
        $chpu = $this->Requrscat($catdatas, $cat_start, $catnamearr);


        }
        $categoriesarr = $this->categories_for_partners();
        $categories = $categoriesarr[0];
        $catdataw = $categoriesarr[1];
        $categoriesarr = $this->ExtFuncLoad()->reformat_cat_array($categories, $catdataw, $checks );

        $cat = implode(',', $this->ExtFuncLoad()->load_cat($categoriesarr['cat'] ,  $cat_start ,$categoriesarr['name'], $checks));

        switch ($sort) {
            case 0:
                $order = ['products_date_added' => SORT_ASC, 'products_options_values_name' => SORT_ASC ];
                break;
           case 1:
                $order =  ['products_price' => SORT_ASC, 'products_options_values_name' => SORT_ASC ];
                break;
            case 2:
                $order = ['products_name' => SORT_ASC, 'products_options_values_name' => SORT_ASC ];
                break;
            case 3:
                $order =  ['products_model' => SORT_ASC, 'products_options_values_name' => SORT_ASC ];
                break;
            case 4:
                $order = ['products_ordered' => SORT_ASC, 'products_options_values_name' => SORT_ASC ];
                break;
            case 10:
                $order = ['products_date_added' => SORT_DESC, 'products_options_values_name' => SORT_ASC ];
               break;
            case 11:
                $order =  ['products_price' => SORT_DESC, 'products_options_values_name' => SORT_ASC ];
                break;
            case 12:
                $order = ['products_name' => SORT_DESC, 'products_options_values_name' => SORT_ASC ];
                break;
            case 13:
                $order =  ['products_model' => SORT_DESC];
                break;
            case 14:
                $order = ['products_ordered' => SORT_DESC];
                break;
       }
        switch ($sort) {
            case 0:
                $orders = ['products_date_added' => SORT_ASC];
                break;
            case 1:
                $orders =  ['products_price' => SORT_ASC];
                break;
            case 2:
                $orders = ['products_name' => SORT_ASC];
                break;
            case 3:
                $orders =  ['products_model' => SORT_ASC];
                break;
            case 4:
                $orders = ['products_ordered' => SORT_ASC];
                break;
            case 10:
                $orders = ['products_date_added' => SORT_DESC];
                break;
            case 11:
                $orders =  ['products_price' => SORT_DESC];
                break;
            case 12:
                $orders = ['products_name' => SORT_DESC];
                break;
            case 13:
                $orders =  ['products_model' => SORT_DESC];
                break;
            case 14:
                $orders = ['products_ordered' => SORT_DESC];
                break;
        }


        $type = '';
        $hide_man = $this->hide_manufacturers_for_partners();
        foreach($hide_man as $value){
            $list[] = $value['manufacturers_id'];
        }
        $hide_man = implode(',' , $list);

        if($prod_attr_query == '' && $searchword == ''){
            $x =  PartnersProductsToCategories::find()->select('MAX(products.`products_last_modified`) as products_last_modifieds ')->distinct()->JoinWith('productsDescription')->JoinWith('products')->where('categories_id IN ('.$cat.')')->asArray()->one();
            $prod =  PartnersProductsToCategories::find()->select('products.products_id as prod,  products.products_last_modified as last ')->JoinWith('products')->where(' ( categories_id IN ('.$cat.')) and (products_status = 1) and (products_image IS NOT NULL) and ( products.products_quantity > 1 )  and (products_price <= :end_price) and (products_price >= :start_price)  and (products.manufacturers_id NOT IN ('.$hide_man.'))',[':start_price' => $start_price, ':end_price' => $end_price])->limit($count)->offset($start_arr)->JoinWith('productsDescription')->JoinWith('productsAttributes')->JoinWith('productsAttributesDescr')->groupBy(['products.`products_id` DESC'])->distinct()->orderBy($orders)->asArray()->all();
            foreach($prod as $values){
                $dataprod = Yii::$app->cache->get(urlencode('prod'.$values['prod']));
                if(isset($dataprod) && (date($dataprod['last']) - date($values['last'])) > 3600){
                    $data[] =  $dataprod['data'];
                }else{
                    $nodata[] = $values['prod'];
                }
            }
            if(isset($nodata)  && count($nodata) > 0){
                $prodarr = implode(',', $nodata);
                $datar = PartnersProductsToCategories::find()->JoinWith('products')->where('products.products_id IN ('.$prodarr.')')->JoinWith('productsDescription')->JoinWith('productsAttributes')->JoinWith('productsAttributesDescr')->groupBy(['products.`products_id` DESC'])->distinct()->asArray()->all();

                foreach($datar as $valuesr){
                   Yii::$app->cache->delete(urlencode('prod'.$valuesr['products']['products_id']), ['data' => $valuesr, 'last' => $valuesr['products']['products_last_modified']]);
                    Yii::$app->cache->set(urlencode('prod'.$valuesr['products']['products_id']), ['data' => $valuesr, 'last' => $valuesr['products']['products_last_modified']], 86400);
                $data[] = $valuesr;
                }
            }

            if(!isset($x['products_last_modifieds'])){
           $checkcache = '0000-00-00';
       }else {
           $checkcache = $x['products_last_modifieds'];

       }
            $dataque = Yii::$app->cache->get(urlencode('first-'.$cat_start.'-'.$hide_man.'-'.$start_price.'-'.$end_price.'-'.$count.'-page'.$page.'-'.$sort));
           if(isset($dataque) && $checkcache !== $dataque['checkcache']){
                 Yii::$app->cache->delete(urlencode('first-'.$cat_start.'-'.$hide_man.'-'.$start_price.'-'.$end_price.'-'.$count.'-page'.$page.'-'.$sort));
            }
           if ($dataque === false || ($checkcache !== $dataque['checkcache'])) {
               $productattrib = PartnersProductsToCategories::find()->select(['products_options_values.products_options_values_id','products_options_values.products_options_values_name'])->distinct()->JoinWith('products')->where('categories_id IN ('.$cat.')    and products.products_quantity > 0  and (products_image IS NOT NULL)  and products_status=1  and products_price <= :end_price and products_price >= :start_price  and products.manufacturers_id NOT IN ('.$hide_man.')  ',[':start_price' => $start_price, ':end_price' => $end_price])->orderBy('`products_price` DESC')->JoinWith('productsDescription')->JoinWith('productsAttributes')->JoinWith('productsAttributesDescr')->asArray()->all();
               $count_arrs = PartnersProductsToCategories::find()->JoinWith('products')->where('categories_id IN ('.$cat.') and products_status=1  and products.products_quantity > 0   and products_price <= :end_price  and (products_image IS NOT NULL)   and products_price >= :start_price  and products.manufacturers_id NOT IN ('.$hide_man.')',[':start_price' => $start_price, ':end_price' => $end_price])->groupBy(['products.`products_id` DESC'])->count();
               $price_max = PartnersProductsToCategories::find()->select('MAX(`products_price`) as maxprice')->distinct()->JoinWith('products')->where('categories_id IN ('.$cat.')     and products.products_quantity > 0     and (products_image IS NOT NULL)   and products_status=1 and products.manufacturers_id NOT IN ('.$hide_man.') ')->asArray()->one();
                  Yii::$app->cache->set(urlencode('first-'.$cat_start.'-'.$hide_man.'-'.$start_price.'-'.$end_price.'-'.$count.'-page'.$page.'-'.$sort), ['productattrib' => $productattrib, 'count_arrs' => $count_arrs, 'price_max' =>  $price_max, 'checkcache' => $checkcache]);
           }else{
               $productattrib =$dataque['productattrib'];
               $count_arrs = $dataque['count_arrs'];
               $price_max = $dataque['price_max'];
             }
       }elseif($prod_attr_query != '' && $searchword == '') {
            $x =  PartnersProductsToCategories::find()->select('MAX(products.`products_last_modified`) as products_last_modifieds ')->distinct()->JoinWith('products')->where('categories_id IN ('.$cat.')')->asArray()->one();
            if(!isset($x['products_last_modifieds'])){
                $checkcache = '0000-00-00';
            }else {
                $checkcache = $x['products_last_modifieds'];

            }
            if(isset($data) && $checkcache !== $data['checkcache']){
                Yii::$app->cache->delete(urlencode('two-'.$cat_start.'-'.$hide_man.'-'.$start_price.'-'.$end_price.'-'.$count.'-page'.$page.'-'.$prod_attr_query.'-'.$sort.'-'.$searchword));
            }
           $data = Yii::$app->cache->get(urlencode('two-'.$cat_start.'-'.$hide_man.'-'.$start_price.'-'.$end_price.'-'.$count.'-page'.$page.'-'.$prod_attr_query.'-'.$sort.'-'.$searchword));
           if ($data === false) {
               $productattrib = PartnersProductsToCategories::find()->select(['products_options_values.products_options_values_id','products_options_values.products_options_values_name'])->distinct()->JoinWith('products')->where('categories_id IN ('.$cat.')  and products.removable != 1      and products.products_quantity > 0     and products_status=1 and products_price <= :end_price and products_price >= :start_price  and products.manufacturers_id NOT IN ('.$hide_man.')', [':start_price' => $start_price, ':end_price' => $end_price])->orderBy('`products_price` DESC')->JoinWith('productsDescription')->JoinWith('productsAttributes')->JoinWith('productsAttributesDescr')->asArray()->all();
               $count_arrs = PartnersProductsToCategories::find()->JoinWith('products')->where('categories_id IN ('.$cat.') and products_status=1  and products.products_quantity > 0      and products.removable != 1   and products_price <= :end_price and products_price >= :start_price and options_values_id IN (:prod_attr_query) and products.manufacturers_id NOT IN ('.$hide_man.')', [':start_price' => $start_price, ':end_price' => $end_price, ':prod_attr_query' => $prod_attr_query])->JoinWith('productsDescription')->JoinWith('productsAttributes')->JoinWith('productsAttributesDescr')->groupBy(['products.`products_id` DESC'])->orderBy($order)->count();
               $price_max = PartnersProductsToCategories::find()->select('MAX(`products_price`) as maxprice')->distinct()->JoinWith('products')->where('categories_id IN ('.$cat.')  and products_status=1    and products.products_quantity > 0   and products.removable != 1      and options_values_id IN (:prod_attr_query)   and products.manufacturers_id NOT IN ('.$hide_man.')', [':prod_attr_query' => $prod_attr_query])->JoinWith('productsDescription')->JoinWith('productsAttributes')->JoinWith('productsAttributesDescr')->asArray()->one();
               $data = PartnersProductsToCategories::find()->JoinWith('products')->where('categories_id IN ('.$cat.') and products_status=1      and products.products_quantity > 0    and products_price <= :end_price and products_price >= :start_price  and products.removable != 1   and options_values_id IN (:prod_attr_query)   and products.manufacturers_id NOT IN ('.$hide_man.')', [':start_price' => $start_price, ':end_price' => $end_price, ':prod_attr_query' => $prod_attr_query])->JoinWith('productsDescription')->JoinWith('productsAttributes')->JoinWith('productsAttributesDescr')->groupBy(['products.`products_id` DESC'])->orderBy($order)->limit($count)->offset($start_arr)->asArray()->all();
               Yii::$app->cache->set(urlencode('two-'.$cat_start.'-'.$hide_man.'-'.$start_price.'-'.$end_price.'-'.$count.'-page'.$page.'-'.$prod_attr_query.'-'.$sort.'-'.$searchword), ['productattrib' => $productattrib, 'count_arrs' => $count_arrs, 'price_max' =>  $price_max, 'data' => $data, 'checkcache' => $checkcache ]);
           }else{
               $productattrib = $data['productattrib'];
               $count_arrs = $data['count_arrs'];
               $price_max = $data['price_max'];
               $data =  $data['data'];
           }
       }elseif(preg_match('/^[0-9]+$/', $searchword)){
           $productattrib = PartnersProductsToCategories::find()->select(['products_options_values.products_options_values_id','products_options_values.products_options_values_name'])->distinct()->JoinWith('products')->where('products.removable != 1    and products.products_quantity > 0      and products_status=1 and products_price <= :end_price and products_price >= :start_price and products.products_model=:searchword   and products.manufacturers_id NOT IN ('.$hide_man.')',[':start_price' => $start_price, ':end_price' => $end_price, ':searchword' => $searchword])->orderBy('`products_price` DESC')->JoinWith('productsDescription')->JoinWith('productsAttributes')->JoinWith('productsAttributesDescr')->asArray()->all();
           $count_arrs = PartnersProductsToCategories::find()->JoinWith('products')->where('products_status=1    and products.products_quantity > 0       and products_price <= :end_price  and products.removable != 1  and products_price >= :start_price and products.products_model=:searchword    and products.manufacturers_id NOT IN ('.$hide_man.')',[':start_price' => $start_price, ':end_price' => $end_price, ':searchword' => $searchword])->groupBy(['products.`products_id` DESC'])->orderBy('`products_price` DESC')->count();
           $price_max = PartnersProductsToCategories::find()->select('MAX(`products_price`) as maxprice')->distinct()->JoinWith('products')->where('products.products_quantity > 0    and products.removable != 1     and products_status=1 and products.products_model=:searchword   and products.manufacturers_id NOT IN ('.$hide_man.')',[':searchword' => $searchword])->JoinWith('productsDescription')->JoinWith('productsAttributes')->JoinWith('productsAttributesDescr')->asArray()->one();
           $data = PartnersProductsToCategories::find()->JoinWith('products')->where('products.products_status=1 and products.products_price <= :end_price     and products.products_quantity > 0   and products.removable != 1      and products_price >= :start_price  and products.products_model=:searchword   and products.manufacturers_id NOT IN ('.$hide_man.')',[':start_price' => $start_price, ':end_price' => $end_price, ':searchword' => $searchword])->JoinWith('productsDescription')->JoinWith('productsAttributes')->groupBy(['products.`products_id` DESC'])->JoinWith('productsAttributesDescr')->orderBy($order)->limit($count)->offset($start_arr)->asArray()->all();
       }elseif(preg_match('/^[a-zа-я]+$/iu', $searchword)){
           $productattrib = PartnersProductsToCategories::find()->select(['products_options_values.products_options_values_id','products_options_values.products_options_values_name'])->distinct()->JoinWith('products')->where('products.removable != 1    and products.products_quantity > 0      and products_status=1 and products_price <= :end_price and products_price >= :start_price and products_description.products_name=:searchword   and products.manufacturers_id NOT IN ('.$hide_man.')',[':start_price' => $start_price, ':end_price' => $end_price, ':searchword' => $searchword])->orderBy('`products_price` DESC')->JoinWith('productsDescription')->JoinWith('productsAttributes')->JoinWith('productsAttributesDescr')->asArray()->all();
           $count_arrs = PartnersProductsToCategories::find()->JoinWith('products')->JoinWith('productsDescription')->where('products_status=1    and products.products_quantity > 0       and products_price <= :end_price  and products.removable != 1  and products_price >= :start_price and products_description.products_name=:searchword    and products.manufacturers_id NOT IN ('.$hide_man.')',[':start_price' => $start_price, ':end_price' => $end_price, ':searchword' => $searchword])->groupBy(['products.`products_id` DESC'])->orderBy('`products_price` DESC')->count();
           $price_max = PartnersProductsToCategories::find()->select('MAX(`products_price`) as maxprice')->distinct()->JoinWith('products')->where('products.products_quantity > 0    and products.removable != 1     and products_status=1 and products_description.products_name=:searchword   and products.manufacturers_id NOT IN ('.$hide_man.')',[':searchword' => $searchword])->JoinWith('productsDescription')->JoinWith('productsAttributes')->JoinWith('productsAttributesDescr')->asArray()->one();
           $data = PartnersProductsToCategories::find()->JoinWith('products')->where('products.products_status=1 and products.products_price <= :end_price     and products.products_quantity > 0   and products.removable != 1      and products_price >= :start_price  and products_description.products_name=:searchword   and products.manufacturers_id NOT IN ('.$hide_man.')',[':start_price' => $start_price, ':end_price' => $end_price, ':searchword' => $searchword])->JoinWith('productsDescription')->JoinWith('productsAttributes')->groupBy(['products.`products_id` DESC'])->JoinWith('productsAttributesDescr')->orderBy($order)->limit($count)->offset($start_arr)->asArray()->all();
       }
        $count_arr = count($data);
        if($start_arr + $count <= $count_arr ) {
            $end_arr = $start_arr + $count;
        }else{$end_arr =$start_arr + $count_arr; }
        if(count($productattrib)>0) {
        }else{$productattrib = 'none';}
        if($price_max > 0) {
        }else{$price_max = 'none';}
        if(isset($data[0])){
        }else{  $data = 'Не найдено!';}
        $countfilt = count($data);
        $start = $start_arr;
        Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        return array($data, $count_arrs, $price_max, $productattrib, $start, $end_arr, $countfilt, $start_price, $end_price, $prod_attr_query, $page, $sort, $cat_start, $searchword, $type, $hide_man, $chpu) ;
    }

    public function actionIndex()
    {
        $categoriesarr = $this->categories_for_partners();
        $categories = $categoriesarr[0];
        $cat = $categoriesarr[1];
        return $this->render('indexpage', ['categories' => $cat, 'catdata' => $categories]);
    }


    public function actionTest()
    {

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


        return $this->render('catalog', ['categories' => $cat, 'catdata' => $categories]);
    }

    public function actionAbout()
    {
        return $this->render('about');
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
        return $this->render('contacts', ['categories' => $cat, 'catdata' => $categories]);
    }

    public function actionDelivery()
    {
        $categoriesarr = $this->categories_for_partners();
        $categories = $categoriesarr[0];
        $cat = $categoriesarr[1];
        return $this->render('delivery', ['categories' => $cat, 'catdata' => $categories]);
    }

    public function actionOfferta()
    {
        $categoriesarr = $this->categories_for_partners();
        $categories = $categoriesarr[0];
        $cat = $categoriesarr[1];
        return $this->render('offerta', ['categories' => $cat, 'catdata' => $categories]);
    }
    public function actionFaq()
    {
        $categoriesarr = $this->categories_for_partners();
        $categories = $categoriesarr[0];
        $cat = $categoriesarr[1];
        return $this->render('faqpage', ['categories' => $cat, 'catdata' => $categories]);
    }
    public function actionPaying()
    {
        $categoriesarr = $this->categories_for_partners();
        $categories = $categoriesarr[0];
        $cat = $categoriesarr[1];
        return $this->render('paying', ['categories' => $cat, 'catdata' => $categories]);
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
        $count = $model->find()->where(['partners_id' => $check, 'user_id'=> $id])->count();
        if($count < ($page)*10){
            $page = $page-1;}
        $query = $model->find()->where(['partners_id' => $check, 'user_id'=> $id])->limit(10)->offset($page*10)->asArray()->all();

        $check = array();
        foreach ($query as $key => $value) {
            $query[$key]['order'] = unserialize($value['order']);
            unset($query[$key]['order']['ship']);
            $query[$key]['delivery'] = unserialize($value['delivery']);
            if($value['orders_id'] != '' and $value['orders_id'] != NULL){$check[]= $value['orders_id'];};
        }

        if(count($check) > 1){
            $checkstr = implode(',', $check);
        }elseif(count($check) == 1){
            $checkstr = $check[0];
        }
        if($checkstr != '') {
            $orders = new Orders();
            // $query[ordersatus] = $checkstr;
            $ordersatusn = $orders->find()->select('orders.`orders_id`, orders.`orders_status`, orders.`delivery_lastname`, orders.`delivery_name`,orders.`delivery_otchestvo`, orders.`delivery_postcode`, orders.`delivery_state`, orders.`delivery_country`, orders.`delivery_state`, orders.`delivery_city`, orders.`delivery_street_address`, orders.`customers_telephone`')->where('orders.`orders_id` IN (' . $checkstr . ')')->joinWith('products')->joinWith('productsAttr')->asArray()->all();
            foreach ($query as $key => $value) {
                $query['ordersatus'][$ordersatusn[$key]['orders_id']] = $ordersatusn[$key];
            }
        }
        if($count < ($page)*10){
            $query['page'] = $count/10;
        }elseif($page < 1 ){
            $query['page'] = 0;

        }else{
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
        if($user::findOne($userModel->getId())){
            $user = $user::findOne($userModel->getId());
            $user->scenario = $order['ship'];
            if($userdata['pasportser'] != '') {
                $user->pasportser = $userdata['pasportser'];
            }
            if($userdata['pasportnum'] != '') {
                $user->pasportnum = $userdata['pasportnum'];
            }
            if($userdata['pasportdate'] != '' ) {
                $user->pasportdate = $userdata['pasportdate'];
            }
            if($userdata['pasportwhere'] != '') {
                $user->pasportwhere = $userdata['pasportwhere'];
            }
            if($user->customers_id > 0) {
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
                    $check_passport_customer->pasport_kogda_vidan =  $userdata['pasportdate'] ;

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
                $check_passport_customer->otchestvo =  $userdata['secondname'];
                $check_passport_customer->entry_postcode =  $userdata['postcode'];
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


                if($check_passport_customer->update() && $user->update()){
                }else{
                }
            }else{
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

        }else{
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
        if($user->validate()){


            $user->save('false');
            $id = $userModel->getId();
            $model->delivery = serialize($user);
            $model->order = serialize($order);
            $model->status = 1;
            $model->create_date = date('Y-m-d H:i:s');
            $model->update_date = date('Y-m-d H:i:s');
            if ($model->save()) {
                $username = User::findOne($id)->username;
                $orders_delivery = ' ';
                $site_name = Yii::$app->params['constantapp']['APP_NAME'];
                $date_order = date('m.d.Y');
                Yii::$app->mailer->compose(['html' => 'order-save'], ['order' => $model->order, 'user' => $model->delivery, 'id' => $model->id, 'site'=> $_SERVER['HTTP_HOST'], 'site_name'=> $site_name, 'date_order'=> $date_order])
                    ->setFrom('support@'.$_SERVER['HTTP_HOST'])
                    ->setTo($username)
                    ->setSubject('Заказ на сайте '.$_SERVER['HTTP_HOST'])
                    ->send();
                return ['id' => $model->id, 'order'=> unserialize($model->order)];
            } else {
                return false;
            }
         }else{
        }
    }

    public function actionSaveuserprofile()
    {
        Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        $model = new PartnersOrders();
        $userdata = Yii::$app->request->post('user');
        $check = Yii::$app->params['constantapp']['APP_ID'];
        $userModel = Yii::$app->user->identity;
        $model->partners_id = $check;
        $model->user_id = $userModel->getId();
        $user = new PartnersUsersInfo();
        $user->scenario = 'flat2_flat2';
        if($user::findOne($userModel->getId())){
            $user = $user::findOne($userModel->getId());
            $user->scenario = 'flat2_flat2';
            if($userdata['pasportser'] != '') {
                $user->pasportser = $userdata['pasportser'];
            }
            if($userdata['pasportnum'] != '') {
                $user->pasportnum = $userdata['pasportnum'];
            }
            if($userdata['pasportdate'] != '' ) {
                $user->pasportdate = $userdata['pasportdate'];
            }
            if($userdata['pasportwhere'] != '') {
                $user->pasportwhere = $userdata['pasportwhere'];
            }
            if($user->customers_id > 0) {
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
                    $check_passport_customer->pasport_kogda_vidan =  $userdata['pasportdate'] ;
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
                $check_passport_customer->otchestvo =  $userdata['secondname'];
                $check_passport_customer->entry_postcode =  $userdata['postcode'];
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
                if($check_passport_customer->update() && $user->update()){
                }else{
                }
            }else{
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
        }else{
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
        if($user->validate()){
            $user->save('false');
            $id = $userModel->getId();
        }else{

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
        if($user->customers_id != ''){
            $usercustomers = Customers::findOne($user->customers_id);
            $useradressbook = AddressBook::findOne($usercustomers->delivery_adress_id);
            $usercountry = Countries::findOne($useradressbook->entry_country_id)->countries_name;
            $userstate = Zones::findOne($useradressbook->entry_zone_id)->zone_name;
            $entryarr = array('name' => $useradressbook->entry_firstname, 'lastname' => $useradressbook->entry_lastname, 'secondname' => $useradressbook->otchestvo, 'country' => $usercountry , 'state' => $userstate , 'city' => $useradressbook->entry_city, 'adress' => $useradressbook->entry_street_address, 'postcode' => $useradressbook->entry_postcode, 'telephone' =>$usercustomers->customers_telephone, 'pasportser' => $useradressbook->pasport_seria, 'pasportnum' =>$useradressbook->pasport_nomer, 'pasportdate' =>$useradressbook->pasport_kogda_vidan, 'pasportwhere' =>$useradressbook->pasport_kem_vidan);
            foreach($userdatafilt as $value){
                $result[][$value][$userdatalable[$value]] = $entryarr[$value];
            }
            return $result;

        }else{
            $useradressdata = new PartnersUsersInfo();
            $useradressdata = $useradressdata->findOne($userModel->getId());
            $entryarr = array('name' => $useradressdata->name, 'lastname' => $useradressdata->lastname, 'secondname' => $useradressdata->secondname, 'country' => $useradressdata->country, 'state' => $useradressdata->state, 'city' => $useradressdata->city, 'adress' => $useradressdata->adress, 'postcode' => $useradressdata->postcode, 'telephone' =>$useradressdata->telephone, 'pasportser' => $useradressdata->pasportser,  'pasportnum' => $useradressdata->pasportnum, 'pasportdate' =>$useradressdata->pasportdate, 'pasportwhere' =>$useradressdata->pasportwhere);
            foreach($userdatafilt as $value){
                $result[][$value][$userdatalable[$value]] = $entryarr[$value];
            }

            return $result;
        }

    }

    public function actionCountryrequest(){

        $data = Yii::$app->cache->get(urlencode('data_country-'.Yii::$app->params['constantapp']['APP_ID']));
        if ($data === false) {
            $country_data = new Countries();
            $data = $country_data->find()->select('countries_id as id, countries_name as title')->asArray()->all();
            Yii::$app->cache->set(urlencode('data_country-'.Yii::$app->params['constantapp']['APP_ID']), ['data_country' => $data], 86400);
        }else{
            $data = $data['data_country'];
        }
        $result['response']= ['count' => count($data)  , 'items' => $data];
        Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;

        return $result;
    }

    public function actionRequestemail(){
        return Yii::$app->user->identity->username;
    }
    public function actionZonesrequest($id){

        $data = Yii::$app->cache->get(urlencode('zones_data-'.Yii::$app->params['constantapp']['APP_ID']));
        if ($data === false) {
            $zones_data = new Zones();
            $data= $zones_data->find()->select('zone_id as id, zone_name as title')->where(['zone_country_id'=> intval($id)])->asArray()->all();
            Yii::$app->cache->set(urlencode('zones_data-'.Yii::$app->params['constantapp']['APP_ID']), ['zones_data' => $data], 86400);
        }else{
            $data = $data['zones_data'];
        }
          $result['response']= ['count' => count($data)  , 'items' => $data];
        Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        return $result;
    }
    public function actionShippingfields($id){
        $model = new PartnersUsersInfo();
        $result = $model->getScenario($id);
        Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        return $result;
    }

    public function actionProductinfo(){
        if(Yii::$app->request->isPost){
            $id = Yii::$app->request->post('id');
        }else{
            $id = Yii::$app->request->getQueryParam('id');
        }
        $data = PartnersProductsToCategories::find()->JoinWith('products')->where('products.`products_id` =:id',[':id' => $id])->JoinWith('productsDescription')->JoinWith('productsAttributes')->groupBy(['products.`products_id` DESC'])->JoinWith('productsAttributesDescr')->asArray()->all();
        Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        return $data;
    }
    public function actionImagepreview()
    {
        $src = Yii::$app->request->getQueryParam('src');
        $action = Yii::$app->request->getQueryParam('action', 'none');
        $src = urldecode($src);
        $filename = str_replace('[[[[]]]]',' ', $src);
        $filename = str_replace('[[[[','(', $filename);
        $filename = str_replace(']]]]',')', $filename);
        $split = explode('/', $src);
        if(count($split) > 1 ) {
            $file = array_splice($split, -1,1);
            $file = explode('.', $file[0]);
            $ras = array_splice($file, -1,1);
            $namefile = base64_encode(implode('', $file));
            $dir = implode('/', $split).'/';
        }else{
            $file = $split[0];
            $file = explode('.',$file);
            $ras = array_splice($file, -1,1);
            $namefile =  base64_encode(implode('', $file));
            $dir = '';
        }
        if(!file_exists(Yii::getAlias('@webroot/images/').$dir.$namefile.'.'.$ras[0]) || $action == 'refresh') {
            if (!is_dir(Yii::getAlias('@webroot/images/') . $dir)) {
              $new_dir = '';
                foreach($split as $value){
                  $new_dir .= $value.'/';
                  mkdir(Yii::getAlias('@webroot/images/') . $new_dir);
              }

            }

            $image = imagecreatefromjpeg('http://odezhda-master.ru/images/'.$filename);
            $width = imagesx($image);
            $height = imagesy($image);
            $original_aspect = $width / $height;
            if ($original_aspect > 1.3) {
                $thumb_width = 300;
                $thumb_height = 180;
            } elseif ($original_aspect < 0.7) {
                $thumb_width = 180;
                $thumb_height = 300;
            } else {
                $thumb_width = 200;
                $thumb_height = 200;
            }
            $thumb_aspect = $thumb_width / $thumb_height;
            if ($original_aspect >= $thumb_aspect) {
                $new_height = $thumb_height;
                $new_width = $width / ($height / $thumb_height);
            } else {
                $new_width = $thumb_width;
                $new_height = $height / ($width / $thumb_width);
            }
            $thumb = imagecreatetruecolor($thumb_width, $thumb_height);
            imagecopyresampled($thumb,
                $image,
                0 - ($new_width - $thumb_width) / 2,
                0 - ($new_height - $thumb_height) / 2,
                0, 0,
                $new_width, $new_height,
                $width, $height);
            imagejpeg($thumb, Yii::getAlias('@webroot/images/').$dir.$namefile.'.'.$ras[0], 80);
        }
        $headers = Yii::$app->response->headers;
        $headers->add('Content-Type', 'image/jpg');
        $headers->add('Cache-Control', 'max-age=68200');
        Yii::$app->response->format = \yii\web\Response::FORMAT_RAW;

        return   file_get_contents(Yii::getAlias('@webroot/images/').$dir.$namefile.'.'.$ras[0]);
    }

    public function actionSavehtml(){
        if(isset($_POST['html']) && isset($_POST['page'])) {
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
        }else{
            return false;
        }
    }

    public function actionChstatusorder()
    {
        $id = intval(Yii::$app->request->getQueryParam('id'));
        $key =  Yii::$app->request->getQueryParam('key');
        $status =  intval(Yii::$app->request->getQueryParam('status'));

        $order = new Orders();
        $orderdata = $order->find()->where(['orders_id'=>$id])->asArray()->one();
        $data = $orderdata['customers_referer_url'];
        $data = json_decode($data);
        if($key == $data->Key && isset($key) && $key != ''){

            $new_tok_order = Orders::findOne($id);
            $validkey = '';
            $char='QWERTYUPASDFGHJKLZXCVBNMqwertyuopasdfghjkzxcvbnm123456789';
            while(strlen($validkey) < 20){$validkey.=$char[mt_rand(0,strlen($char))];}
            $new_tok_order->customers_referer_url = '{"Partner":"' . $data->Partner . '","User":"' . $data->User .'","Key":"'.$validkey.'","Site":"'.$data->Site.'"}';
            if($new_tok_order->update()){
if($status == 2) {
    $model_order_partner = PartnersOrders::findOne(['orders_id'=>$new_tok_order->id]);
    $date_order = explode(' ', $model_order_partner->create_date);
    $date_order = $date_order[0];
    $partners_id = $model_order_partner->partners_id;
    $partners = Partners::findOne($partners_id);
    $site = $partners->domain;
    $site_name = $partners->name;
    $orders = new Orders();
    $query = $orders->find()->select('orders.`orders_id`, orders.`orders_status`, orders.`delivery_lastname`, orders.`delivery_name`,orders.`delivery_otchestvo`, orders.`delivery_postcode`, orders.`delivery_state`, orders.`delivery_country`, orders.`delivery_state`, orders.`delivery_city`, orders.`delivery_street_address`, orders.`customers_telephone`')->where('orders.`orders_id` IN (' . $model_order_partner->orders_id . ')')->joinWith('products')->joinWith('productsAttr')->asArray()->one();

    $prodarr = [];
    foreach($query['products'] as $value){
    $prodarr[] = $value['products_id'];

    }
    $mail = explode('@@@', $new_tok_order->customers_email_address);
    $mail = $mail[1];
    Yii::$app->mailer->compose(['html' => 'order-ch-status'], ['model'=>$model_order_partner,'order' => $query, 'id' => $model_order_partner->id, 'site' => $site, 'site_name' => $site_name, 'date_order' => $date_order])
        ->setFrom('support@' . $site)
        ->setTo($mail)
        ->setSubject('Заказ на сайте ' . $site)
        ->send();
}
               return '1';
           }else{
               return '0';
           }
        }else{
            return '0';
        }

    }
    private function Requrscat($arr, $firstval, $catnamearr){
        static $chpu;
        static $item;
        $item = $firstval;
        if(isset($arr[$item])) {
            while ($arr[$item] != '0') {
                if (isset($catnamearr[$item])) {
                    $chpu[] = $catnamearr[$item];
                    $item = $arr[$item];
                }
            }
            if (isset($catnamearr[$item])) {
                $chpu[] = $catnamearr[$item];
            }
        }
        return array_reverse($chpu);
    }



}



