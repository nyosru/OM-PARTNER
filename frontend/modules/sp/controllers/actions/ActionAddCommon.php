<?php
namespace frontend\modules\sp\controllers\actions;

use common\models\CommonOrders;
use common\models\PartnersOrders;
use common\models\Referrals;
use common\models\ReferralsUser;
use Yii;
use yii\base\Exception;
use yii\data\ActiveDataProvider;
use yii\data\Sort;
use yii\validators\DateValidator;
use yii\web\HttpException;


trait ActionAddCommon
{
    public function actionAddCommon()
    {

        if(($referal = Referrals::find()->where(['user_id'=>Yii::$app->user->getId()])->asArray()->one())==TRUE){
            $result = new CommonOrders();
            if($result->load(Yii::$app->request->post())){
                $result->referral_id = $referal['id'];
                $result->status = 1;
                if($result->save()){
                    echo '<script>
                        alert(\'Общий заказ создан! Номер заказа : '.$result->id.'\');
                    </script>';
                 //   Yii::$app->session->setFlash('alert-info', 'Общий заказ создан! Номер заказа : '.$result->id);
                    $form = \yii\bootstrap\ActiveForm::begin([
                        'options' => [
                            'data-pjax' => true,
                            'data-close'=>true
                        ],
                        'id'=>'groupdiscountuser',
                        'action'=>'/sp/add-common',
                        'method'=> 'post',
                        'enableClientScript' => true
                    ]);
                    $commonmodel = new \common\models\CommonOrders();
                    echo $form->field($commonmodel, 'header')->label('Наименование заказа')->input('text');
                    echo $form->field($commonmodel, 'description')->label('Краткое описание')->input('text');
                    echo \yii\helpers\Html::submitButton('Создать', ['class' => 'btn btn-primary', 'name' => 'common']);
                    $form = \yii\bootstrap\ActiveForm::end();

                }else{
                    return false;
                }
            }
        }else{
            return false;
        }

    }
}