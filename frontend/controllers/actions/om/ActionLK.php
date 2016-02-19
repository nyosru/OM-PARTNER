<?php
namespace frontend\controllers\actions\om;

use common\models\Customers;
use common\models\PartnersUsersInfo;
use common\models\Profile;
use common\models\User;
use yii;


trait ActionLK
{
    public function actionLk()
    {
        if(Yii::$app->user->isGuest){
            header('location',BASEURL);
        }else{
            if(Yii::$app->request->post()){
                $cust=new Profile();
                $cust->load(Yii::$app->request->post());
                $cust->saveUserProfile();
            }else{
                $cust=new Profile();
                $cust->loadUserProfile();
            }
            $this->layout = 'lk';
            return $this->render('lk',['cust'=>$cust]);
        }


        }
    }
//}