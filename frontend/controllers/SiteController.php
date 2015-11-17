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
use frontend\controllers\actions\ActionAbout;
use frontend\controllers\actions\ActionCatalog;
use frontend\controllers\actions\ActionCatPath;
use frontend\controllers\actions\ActionChstatusorder;
use frontend\controllers\actions\ActionContacts;
use frontend\controllers\actions\ActionCountryrequest;
use frontend\controllers\actions\ActionDelivery;
use frontend\controllers\actions\ActionFaq;
use frontend\controllers\actions\ActionImagepreview;
use frontend\controllers\actions\ActionLK;
use frontend\controllers\actions\ActionLogin;
use frontend\controllers\actions\ActionLogout;
use frontend\controllers\actions\ActionOfferta;
use frontend\controllers\actions\ActionPaying;
use frontend\controllers\actions\ActionPrintOrders;
use frontend\controllers\actions\ActionProductinfo;
use frontend\controllers\actions\ActionRequestadress;
use frontend\controllers\actions\ActionRequestemail;
use frontend\controllers\actions\ActionRequestNews;
use frontend\controllers\actions\ActionRequestorders;
use frontend\controllers\actions\ActionRequestPasswordReset;
use frontend\controllers\actions\ActionResetPassword;
use frontend\controllers\actions\ActionSavehtml;
use frontend\controllers\actions\ActionSaveorder;
use frontend\controllers\actions\ActionShippingfields;
use frontend\controllers\actions\ActionSignup;
use frontend\controllers\actions\ActionSiteIndex;
use frontend\controllers\actions\ActionSiteNews;
use frontend\controllers\actions\ActionSiteRequest;
use frontend\controllers\actions\ActionSiteSaveUserProfile;
use frontend\controllers\actions\ActionSiteSearchword;
use frontend\controllers\actions\ActionZonesrequest;
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
use frontend\controllers\actions\ActionNewComments;

/**
 * Контроллер сайта
 */
class SiteController extends Controller
{
    use Fullopcat, View_cat, Load_cat, Hide_manufacturers_for_partners, Categories_for_partner, Imagepreviewcrop,
        Reformat_cat_array, ActionSiteIndex, ActionSiteRequest, ActionSiteSearchword, ActionSiteSaveUserProfile, CacheUserState,
        ActionSiteNews, ActionRequestNews, ActionPrintOrders, ActionCatPath, ActionLogin, ActionLogout, ActionCatalog,
        ActionAbout, ActionLK, ActionContacts, ActionDelivery, ActionOfferta, ActionFaq, ActionPaying, ActionSignup,
        ActionRequestPasswordReset, ActionResetPassword, ActionNewComments, ActionRequestorders, ActionSaveorder,
        ActionRequestadress, ActionCountryrequest, ActionRequestemail, ActionZonesrequest, ActionShippingfields, ActionProductinfo,
        ActionImagepreview, ActionSavehtml, ActionChstatusorder;

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



