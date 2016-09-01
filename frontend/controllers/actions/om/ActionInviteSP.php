<?php
namespace frontend\controllers\actions\om;

use common\models\Customers;
use common\models\PartnersPage;
use common\models\Specifications;
use common\models\User;
use yii\bootstrap\Tabs;
use Faker\Provider\zh_TW\DateTime;
use Yii;
use common\models\PartnersConfig;
use yii\validators\EmailValidator;

trait ActionInviteSP
{
    public function actionInviteSp()
    {
       print_r(Yii::$app->session);
       die();
        $validator = new EmailValidator();
        if(
            ($mail = Yii::$app->request->post('mail')) == TRUE 
            && $validator->validate($mail)
        ){
            
        }
     
    }
}