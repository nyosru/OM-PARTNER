<?php
namespace frontend\controllers\actions;

use common\models\Customers;
use common\models\PartnersUsersInfo;
use common\models\User;
use yii;


trait ActionLK
{
    public function actionLk()
    {
        if(Yii::$app->user->isGuest){
            header('location',BASEURL);
        }
        else{
        $cust=User::find()->where(['partners_users.id'=>Yii::$app->user->getId()])->joinWith('userinfo')->joinWith('customers')->joinWith('addressBook')->all();
        $this->layout = 'lk';
        return $this->render('lk',['cust'=>$cust]);
        }
    }
}