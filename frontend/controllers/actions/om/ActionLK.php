<?php
namespace frontend\controllers\actions\om;

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
            $cust=User::find()->where(['partners_users.id'=>Yii::$app->user->getId()])->joinWith('userinfo')->joinWith('customers')->joinWith('addressBook')->one();
            $data=Yii::$app->request->post();
            if(!empty($data)) {
                if($data['profile-id']=='userinfo'){
                    $user=User::find()->where(['id'=>Yii::$app->user->getId()])->one();
                    $user->email=$data['User']['email'];
                    $user->username=$data['User']['email'];
                    $user->validate();
                    $user->update();
                    $userinfo=PartnersUsersInfo::find()->where(['id'=>Yii::$app->user->getId()])->one();
                    $userinfo->name=$data['PartnersUsersInfo']['name'];
                    $userinfo->secondname=$data['PartnersUsersInfo']['secondname'];
                    $userinfo->lastname=$data['PartnersUsersInfo']['lastname'];
                    $userinfo->validate();
                    $userinfo->update();
                    $customer=Customers::find()->where(['customers_id'=>$userinfo->customers_id])->one();
                    $customer->customers_email_address=$data['User']['email'];
                    $customer->customers_telephone=$data['Customers']['customers_telephone'];
                    $customer->customers_fax=$data['Customers']['customers_fax'];
                    $customer->validate();
                    $customer->update();
                }
                else{
                    $prof=$data['profile-id'];
                    echo '<pre>';
                    print_r($data);
                    print_r($cust);
                    echo '</pre>';
                    die();
                }
            }
            $this->layout = 'lk';
            return $this->render('lk',['cust'=>$cust]);
        }
    }
}