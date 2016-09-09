<?php

namespace frontend\modules\sp\controllers\v0;


use frontend\modules\sp\controllers\actions\admin\ActionAllClients;
use frontend\modules\sp\controllers\actions\admin\ActionCommonOrders;
use frontend\modules\sp\controllers\actions\admin\ActionIndex;
use frontend\modules\sp\controllers\actions\admin\ActionOrders;
use frontend\modules\sp\controllers\actions\admin\ActionOrdersEdit;
use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;

class AdminController extends Controller
{

    use ActionIndex,
        ActionOrders,
        ActionOrdersEdit,
        ActionCommonOrders,
        ActionAllClients;
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
