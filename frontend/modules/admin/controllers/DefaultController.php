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
use frontend\modules\admin\controllers\actions\ActionCancelorder;
use frontend\modules\admin\controllers\actions\ActionCommentscontrol;
use frontend\modules\admin\controllers\actions\ActionCommentspage;
use frontend\modules\admin\controllers\actions\ActionDelegate;
use frontend\modules\admin\controllers\actions\ActionIndex;
use frontend\modules\admin\controllers\actions\ActionNewspage;
use frontend\modules\admin\controllers\actions\ActionNewsupdate;
use frontend\modules\admin\controllers\actions\ActionRequestnews;
use frontend\modules\admin\controllers\actions\ActionRequestorders;
use frontend\modules\admin\controllers\actions\ActionRequestpage;
use frontend\modules\admin\controllers\actions\ActionRequestupdate;
use frontend\modules\admin\controllers\actions\ActionRequestusers;
use frontend\modules\admin\controllers\actions\ActionSavesettings;
use frontend\modules\admin\controllers\actions\ActionTemplateimage;
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
    use Imagepreviewcrop, ThemeResources,ActionIndex,ActionSavesettings,ActionRequestnews,ActionCancelorder,ActionRequestusers,
        ActionTemplateimage,ActionRequestorders,ActionDelegate,ActionNewspage,ActionRequestpage,ActionCommentspage,
        ActionNewsupdate,ActionRequestupdate,ActionCommentscontrol;

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
}
