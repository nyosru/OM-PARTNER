<?php
namespace frontend\controllers\actions\om;

use common\models\PartnersCatDescription;
use common\models\ProductsSpecifications;
use frontend\models\InviteSPForm;
use frontend\widgets\Timer;
use Yii;
use common\models\PartnersProducts;
use common\models\PartnersProductsToCategories;
use yii\helpers\ArrayHelper;

trait ActionSpLanding
{
    public function actionSpLanding()
    {

        $this->layout = 'lp';
        $model = new InviteSPForm();
        if($model->load(Yii::$app->request->post()) && $model->validate()){
            if($model->InviteSp()){
                Yii::$app->params['params']['products_mail'] =  $this->NewProducts(6,'mail_new-34', 7200);
                Yii::$app->params['params']['utm'] =  [
                    'source'=>'newom',
                    'medium'=>'email',
                    'campaign'=>'om',
                    'content'=>'invite-sp'
                ];
                Yii::$app->mailer->htmlLayout = 'layouts-om/html';
                Yii::$app->mailer->compose('invite-sp')
                    ->setFrom('odezhdamaster@gmail.com')
                    ->setTo($model->email)
                    ->setSubject('Приглашение в сервис  '  . $_SERVER['HTTP_HOST'])
                    ->send();
                \Yii::$app->getSession()->setFlash('success', 'Успешно отправлено');

                return $this->redirect(['sp-landing', ['model'=> $model]]);
            }
        }
        if($model->errors){
            foreach ($model->errors as $err){
                \Yii::$app->getSession()->setFlash('error', $err);
            }
        }
        return $this->render('sp', ['model'=>$model]);
    }

}