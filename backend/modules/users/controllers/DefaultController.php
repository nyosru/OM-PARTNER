<?php

namespace backend\modules\users\controllers;

use common\models\PartnersUsersInfo;
use common\models\User;
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
                    [
                        'actions' => ['userslist'],
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

    public function actionUserslist()
    {

        $userlist = User::find()->select('partners_users.id, partners_users.id_partners, partners_users.created_at, partners_users.email, partners_users.role, partners_users.updated_at, partners_users.username, partners_users.status, partners_users_info.name, partners_users_info.secondname, partners_users_info.lastname, partners_users_info.adress, partners_users_info.city, partners_users_info.state, partners_users_info.country, partners_users_info.postcode, partners_users_info.telephone, partners_users_info.pasportser, partners_users_info.pasportnum, partners_users_info.pasportdate, partners_users_info.pasportwhere, partners_users_info.customers_id')->JoinWith('userinfo')->asArray()->all();

        Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        return $userlist;
    }

	
	
}
