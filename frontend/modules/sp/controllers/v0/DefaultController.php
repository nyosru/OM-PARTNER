<?php

namespace frontend\modules\sp\controllers\v0;


use common\traits\Manufacturers\OkSuppliers;
use common\traits\ManufacturersDiapazonData;
use common\traits\Orders\CommonOrdersToOm;
use common\traits\Products\PreCheckProductsToOrder;
use common\traits\Shipping\ShippingMethod;
use common\traits\Wrap\WrapMethod;
use frontend\controllers\actions\ActionShipping;
use frontend\controllers\actions\om\ActionOrdersStatus;
use frontend\modules\sp\controllers\actions\ActionAddClientOrderComments;
use frontend\modules\sp\controllers\actions\ActionAddCommon;
use frontend\modules\sp\controllers\actions\ActionAddCommonOrderComments;
use frontend\modules\sp\controllers\actions\ActionAddPositionOrderComments;
use frontend\modules\sp\controllers\actions\ActionAddProductToOrder;
use frontend\modules\sp\controllers\actions\ActionAllClients;
use frontend\modules\sp\controllers\actions\ActionAttachOrderToCommon;
use frontend\modules\sp\controllers\actions\ActionChangeClientStatus;
use frontend\modules\sp\controllers\actions\ActionChangeOrderStatus;
use frontend\modules\sp\controllers\actions\ActionCheckAlerts;
use frontend\modules\sp\controllers\actions\ActionClientStatus;
use frontend\modules\sp\controllers\actions\ActionCommonOrders;
use frontend\modules\sp\controllers\actions\ActionDeleteOrderFromCommonOrdersLinks;
use frontend\modules\sp\controllers\actions\ActionDetailCommonOrders;
use frontend\modules\sp\controllers\actions\ActionDetailOrder;
use frontend\modules\sp\controllers\actions\ActionEditUserInfo;
use frontend\modules\sp\controllers\actions\ActionIndex;
use frontend\modules\sp\controllers\actions\ActionListCommonOrders;
use frontend\modules\sp\controllers\actions\ActionMailToUser;
use frontend\modules\sp\controllers\actions\ActionOrders;
use frontend\modules\sp\controllers\actions\ActionDeleteProductInOrder;
use frontend\modules\sp\controllers\actions\ActionOrdersEdit;
use frontend\modules\sp\controllers\actions\ActionFindProduct;
use frontend\modules\sp\controllers\actions\ActionSaveCommonOrders;
use frontend\modules\sp\controllers\actions\ActionSaveOneOrder;
use frontend\modules\sp\controllers\actions\ActionSendCommonOrders;
use frontend\modules\sp\controllers\actions\ActionSwapAttachOrderToCommon;
use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;

class DefaultController extends Controller
{

    use ActionIndex,
        ActionCheckAlerts,
        ActionOrders,
        ActionOrdersEdit,
        ActionDeleteProductInOrder,
        ActionCommonOrders,
        ActionDetailOrder,
        ActionMailToUser,
        ActionAllClients,
        ActionListCommonOrders,
        ActionAttachOrderToCommon,
        ActionEditUserInfo,
        ActionDeleteOrderFromCommonOrdersLinks,
        ActionSwapAttachOrderToCommon,
        ActionDetailCommonOrders,
        ActionAddProductToOrder,
        ActionAddCommon,
        ActionOrdersStatus,
        ActionClientStatus,
        ActionChangeClientStatus,
        ActionChangeOrderStatus,
        ActionAddCommonOrderComments,
        ActionAddPositionOrderComments,
        ActionAddClientOrderComments,
        ActionSendCommonOrders,
        CommonOrdersToOm,
        ActionSaveOneOrder,
        ActionSaveCommonOrders,
        PreCheckProductsToOrder,
        ManufacturersDiapazonData,
        OkSuppliers,
        ShippingMethod,
        WrapMethod,
        ActionFindProduct;
    public function behaviors()
    {
        return [
//            'access' => [
//                'class' => AccessControl::className(),
//                'rules' => [
//                    [
//                        'actions' => ['index'],
//                        'allow' => true,
//                        'roles' => ['@','?'],
//
//                    ],
//                ]
//            ]
        ];
    }

    public function actions()
    {
        $this->layout = 'main';
        return 'Реферальная система';
    }
}
