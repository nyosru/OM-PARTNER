<?php

namespace backend\modules\orders\controllers;

use Yii;
use yii\web\Controller;
use yii\filters\AccessControl;
use common\models\PartnersOrders;
use common\models\Orders;

class DefaultController extends Controller
{
	
	public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions' => ['index'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                    [
                        'actions' => ['orderslist'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
              ]
         ]
		 ];
     }


	public function actionIndex()
    {
      return $this->render('tab');
    }

    public function actionOrderslist()
    {
        $orderlist = PartnersOrders::find()->asArray()->all();
    foreach($orderlist as $key => $value){
        $orderlist[$key]['order'] = unserialize($value['order']);
        $orderlist[$key]['delivery'] = unserialize($value['delivery']);
    }
        if($orderlist){

        }
        Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        return $orderlist;
    }


	
	
}
