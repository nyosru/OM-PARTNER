<?php
namespace frontend\controllers\actions\om;

use common\models\ClaimForm;
use common\models\PartnersPage;
use Faker\Provider\zh_TW\DateTime;
use Yii;
use common\models\PartnersConfig;

trait ActionSaveClaim
{
    public function actionSaveclaim()
    {
        $claim = new ClaimForm();
        Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        if(Yii::$app->request->post() && !Yii::$app->user->isGuest){

            switch(Yii::$app->request->post('action')) {
                case 'savefiles':
                    $claim->addError('pritenwrite','файлы');
                    return $claim->errors;
                    break;
                case 'savecomment':
                    $claim->formcommentsave();
                    return $claim->errors;
                    break;
                default:
                    $claim->addError('pritenwrite','Авторизуйтесь');
                    return $claim->errors;
            }
//                $claim->myphoto = '';
//                $claim->formimagesave();
//                $claim->pritenwrite = '';
//                $claim->formcommentsave();
//                if($claim->errors) {
//                    return $claim;
//                }else return true;

        }else{
            $claim->addError('pritenwrite','Авторизуйтесь');
            return $claim->errors;
        }
    }
}