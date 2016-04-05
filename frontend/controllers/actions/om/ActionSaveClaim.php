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
        $claim->load(Yii::$app->request->post());
        if($claim->myphoto){
            $claim->formimagesave();
            if($claim->errors) {
                return $claim;
            }else return true;
        }elseif($claim->pritenwrite){
            $claim->formcommentsave();
            if($claim->errors) {
                return $claim;
            }else return true;
        }
        else return false;
    }
}