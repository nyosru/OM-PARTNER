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
                \Yii::$app->getSession()->setFlash('success', 'Успешно отправлено');
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