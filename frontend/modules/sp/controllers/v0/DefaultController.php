<?php

namespace frontend\modules\sp\controllers\v0;


use frontend\modules\sp\controllers\actions\ActionIndex;
use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;

class DefaultController extends Controller
{

    use ActionIndex;
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
