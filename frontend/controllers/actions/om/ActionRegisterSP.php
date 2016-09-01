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

trait ActionRegisterSP
{
    public function actionRegisterSp()
    {
        if(Yii::$app->user->isGuest){
            $validator = new EmailValidator();
            if(
                ($mail = $this->trim_tags_text(Yii::$app->request->post('mail'))) == TRUE
                && $validator->validate($mail)
            ){
                if(
                    $mail && ($user = User::find()->where(['email'=>$mail])->asArray()->one()) == TRUE
                    && ($customer = Customers::find()->where(['customers_email_address'=>$mail])->asArray()->one()) == TRUE
                ){
                    return $this->render('registersp', ['type'=>'allow', 'message'=>'']);
                }elseif(!$user || !$customer){
                    return $this->render('registersp', ['type'=>'nouser', 'message'=>'Необходмо зарегистрироваться']);
                }else{
                    return $this->render('registersp', ['type'=>'noemail', 'message'=>'Не указана почта']);
                }
            }else{
                return $this->redirect('/');
            }
        }else{
            return $this->render('registersp', ['type'=>'userallow', 'message'=>'Подтвердите регистрацию']);
        }


    }
}