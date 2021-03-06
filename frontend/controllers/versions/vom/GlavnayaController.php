<?php

namespace frontend\controllers\versions\vom;
use common\traits\AggregateCatalogData;
use common\traits\Categories\CategoryChpu;
use common\traits\Categories\CustomCatalog;
use common\traits\Categories\RestrictedCatalog;
use common\traits\Categories_for_partner;
use common\traits\CatPath;
use common\traits\Coupon;
use common\traits\Fullopcat;
use common\traits\GetSuppliers;
use common\traits\Hide_manufacturers_for_partners;
use common\traits\Imagepreviewcrop;
use common\traits\Load_cat;
use common\traits\Manufacturers\LuxSuppliers;
use common\traits\ManufacturersDiapazonData;
use common\traits\OpenSearch;
use common\traits\Orders\OrdersToOm;
use common\traits\Orders\OrdersToReferrer;
use common\traits\OrdersStatusData;
use common\traits\PageGen\MetaGen;
use common\traits\Products\AggregateProductsData;
use common\traits\Products\FeaturedProducts;
use common\traits\Products\GenerateFileChpu;
use common\traits\Products\NewProducts;
use common\traits\Products\PreCheckProductsToOrder;
use common\traits\Products\RelatedProducts;
use common\traits\RecursCat;
use common\traits\Reformat_cat_array;
use common\traits\Shipping\ShippingMethod;
use common\traits\ThemeResources;
use common\traits\Trim_Tags;
use common\traits\View_cat;
use frontend\controllers\actions\ActionAddSearch;
use frontend\controllers\actions\ActionCart;
use frontend\controllers\actions\ActionSubscription;
use frontend\controllers\actions\ActionTestUnit;
use frontend\controllers\actions\om\ActionAllBrands;
use frontend\controllers\actions\om\ActionAllCategories;
use frontend\controllers\actions\om\ActionCatalog;
use frontend\controllers\actions\ActionCatPath;
use frontend\controllers\actions\ActionChstatusorder;
use frontend\controllers\actions\ActionContactForm;
use frontend\controllers\actions\ActionCountryrequest;
use frontend\controllers\actions\ActionDelivery;
use frontend\controllers\actions\ActionFaq;
use frontend\controllers\actions\ActionImagepreview;
use frontend\controllers\actions\ActionLoginOM;
use frontend\controllers\actions\ActionLogout;
use frontend\controllers\actions\ActionSelectedProduct;
use frontend\controllers\actions\om\ActionChangeCardView;
use frontend\controllers\actions\om\ActionDiscountProducts;
use frontend\controllers\actions\om\ActionInfo;
use frontend\controllers\actions\om\ActionInvite;
use frontend\controllers\actions\om\ActionInviteSP;
use frontend\controllers\actions\om\ActionNewProductDay;
use frontend\controllers\actions\ActionNews;
use frontend\controllers\actions\ActionOfferta;
use frontend\controllers\actions\om\ActionArticle;
use frontend\controllers\actions\om\ActionDayProduct;
use frontend\controllers\actions\om\ActionDiscont;
use frontend\controllers\actions\om\ActionFiguresDays;
use frontend\controllers\actions\om\ActionLoadClaim;
use frontend\controllers\actions\om\ActionPayView;
use frontend\controllers\actions\om\ActionPreCheckProductToOrders;
use frontend\controllers\actions\om\ActionProductsDiscount;
use frontend\controllers\actions\om\ActionRegisterSP;
use frontend\controllers\actions\om\ActionRegisterSuccess;
use frontend\controllers\actions\om\ActionRegRefUserSuccess;
use frontend\controllers\actions\om\ActionSaveCart;
use frontend\controllers\actions\om\ActionSaveClaim;
use frontend\controllers\actions\om\ActionSavepage;
use frontend\controllers\actions\ActionPaying;
use frontend\controllers\actions\ActionPaymentMethod;
use frontend\controllers\actions\ActionPayOrders;
use frontend\controllers\actions\ActionPrintOrders;
use frontend\controllers\actions\om\ActionPage;
use frontend\controllers\actions\ActionTakeOrder;
use frontend\controllers\actions\ActionTimeOrderProducts;
use frontend\controllers\actions\om\ActionCartResult;
use frontend\controllers\actions\om\ActionManList;
use frontend\controllers\actions\om\ActionProduct;
use frontend\controllers\actions\om\ActionProductinfo;
use frontend\controllers\actions\ActionProductinfobymodel;
use frontend\controllers\actions\ActionRequestadress;
use frontend\controllers\actions\ActionRequestemail;
use frontend\controllers\actions\ActionRequestNews;
use frontend\controllers\actions\ActionRequestorders;
use frontend\controllers\actions\ActionRequestPasswordReset;
use frontend\controllers\actions\ActionResetPassword;
use frontend\controllers\actions\ActionSavehtml;
use frontend\controllers\actions\om\ActionSaveorder;
use frontend\controllers\actions\ActionShipping;
use frontend\controllers\actions\ActionShippingfields;
use frontend\controllers\actions\om\ActionShowCart;
use frontend\controllers\actions\om\ActionSignup;
use frontend\controllers\actions\om\ActionSiteIndex;
use frontend\controllers\actions\om\ActionProductsMonth;
use frontend\controllers\actions\om\ActionProductsCloth;
use frontend\controllers\actions\ActionSiteRequest;
use frontend\controllers\actions\ActionSiteSaveUserProfile;
use frontend\controllers\actions\ActionSiteSearchword;
use frontend\controllers\actions\ActionSuppliersLux;
use frontend\controllers\actions\ActionSuppliersOk;
use frontend\controllers\actions\ActionZonesrequest;
use frontend\controllers\actions\CacheUserState;
use frontend\controllers\actions\om\ActionSpLanding;
use frontend\controllers\actions\om\ActionTcncopy;
use frontend\controllers\actions\om\ActionViewCart;
use frontend\controllers\actions\om\ActionOrdersStatus;
use frontend\controllers\actions\om\ActionSuppliers;
use Yii;
use frontend\controllers\actions\ActionNewComments;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\web\Controller;


/**
 * Контроллер сайта
 */
class GlavnayaController extends Controller
{
    use Trim_Tags,
        CustomCatalog,
        CacheUserState,
        Fullopcat,
        RecursCat,
        Reformat_cat_array,
        ShippingMethod,
        View_cat, Load_cat,
        Imagepreviewcrop,
        Categories_for_partner,
        ThemeResources,
        Hide_manufacturers_for_partners,
        OpenSearch,
        CatPath,
        Coupon,
        GetSuppliers,
        LuxSuppliers,
        OrdersStatusData,
        ManufacturersDiapazonData,
        ActionSiteIndex,
        ActionSuppliers,
        ActionSiteRequest,
        ActionSiteSearchword,
        ActionSiteSaveUserProfile,
        ActionRequestNews,
        ActionPrintOrders,
        ActionCatPath,
        ActionLoginOM,
        ActionLogout,
        ActionCatalog,
        ActionContactForm,
        ActionDelivery,
        ActionOfferta,
        ActionFaq,
        ActionPaying,
        ActionSignup,
        ActionOrdersStatus,
        ActionNewComments,
        ActionRequestorders,
        ActionSaveorder,
        ActionRequestadress,
        ActionCountryrequest,
        ActionRequestemail,
        ActionZonesrequest,
        ActionShippingfields,
        ActionProductinfo,
        ActionImagepreview,
        ActionSavehtml,
        ActionChstatusorder,
        ActionProduct,
        ActionNews,
        ActionShipping,
        ActionPaymentMethod,
        ActionPayOrders,
        ActionAddSearch,
        ActionProductinfobymodel,
        ActionCart,
        ActionTimeOrderProducts,
        ActionCartResult,
        ActionManList,
        ActionPage,
        ActionSavepage,
        ActionArticle,
        ActionDiscont,
        ActionDayProduct,
        ActionFiguresDays,
        ActionSaveClaim,
        ActionChangeCardView,
        ActionLoadClaim,
        ActionNewProductDay,
        ActionProductsMonth,
        ActionProductsCloth,
        ActionSelectedProduct,
        ActionSaveCart,
        ActionRegisterSP,
        ActionViewCart,
        ActionTakeOrder,
        ActionAllCategories,
        ActionShowCart,
        ActionRequestPasswordReset,
        ActionResetPassword,
        ActionPayView,
        ActionTcncopy,
        ActionTestUnit,
        ActionAllBrands,
        RestrictedCatalog,
        FeaturedProducts,
        NewProducts,
        RelatedProducts,
        ActionInfo,
        ActionSuppliersOk,
        ActionSpLanding,
        ActionInviteSP,
        ActionInvite,
        ActionProductsDiscount,
      //  ActionDiscountProducts,
        OrdersToOm,
        OrdersToReferrer,
        ActionRegisterSuccess,
        ActionSuppliersLux,
        ActionPreCheckProductToOrders,
        ActionSubscription,
        GenerateFileChpu,
        MetaGen,
        AggregateProductsData,
        ActionRegRefUserSuccess,
        AggregateCatalogData;


    /**
     * @inheritdoc
     */
    public function init()
    {
        parent::init();
        $this->id = 'site';
    }

    public function behaviors()
    {

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
                    case 'ой' :
                        $search = mb_substr($search, 0, $length, $encode);
                        return $this->checksklonenie($search, $origsearch, $encode);
                    case 'ая' :
                        $search = mb_substr($search, 0, $length, $encode);
                        return $this->checksklonenie($search, $origsearch, $encode);
                    case 'ую' :
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



