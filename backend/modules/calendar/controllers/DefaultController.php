<?php

namespace app\modules\calendar\controllers;

use Yii;
use yii\web\Controller;
use yii\filters\AccessControl;


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
              ]
         ]
		 ];
     }


	public function actionIndex()
    {
      return $this->render('tab');
    }



	
	
}
