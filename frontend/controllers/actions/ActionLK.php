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
        $cust=User::find()->where(['partners_users.id'=>Yii::$app->user->getId()])->joinWith('userinfo')->joinWith('addressBook')->asArray()->all();
        echo '<pre>';
        print_r($cust);
        echo '</pre>';
        $this->layout = 'lk';
        return $this->render('lk');
        }
    }
}