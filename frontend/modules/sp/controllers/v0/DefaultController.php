<?php

namespace frontend\modules\sp\controllers\v0;


use frontend\modules\sp\controllers\actions\ActionAddProductToOrder;
use frontend\modules\sp\controllers\actions\ActionAllClients;
use frontend\modules\sp\controllers\actions\ActionAttachOrderToCommon;
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
use frontend\modules\sp\controllers\actions\ActionSwapAttachOrderToCommon;
use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;

class DefaultController extends Controller
{

    use ActionIndex,
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
        return 'Админка';
    }
}
