<?php
namespace frontend\controllers\actions\om;

use common\models\ClaimForm;
use common\models\PartnersPage;
use Faker\Provider\zh_TW\DateTime;
use Yii;
use common\models\PartnersConfig;
use yii\helpers\FileHelper;
use yii\web\UploadedFile;

trait ActionSaveClaim
{
    public function actionSaveclaim()
    {

        Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        $claim = new ClaimForm();
        if (Yii::$app->request->post() && !Yii::$app->user->isGuest) {
            $claim->opid = (integer)Yii::$app->request->post('opid');
            switch (Yii::$app->request->post('action')) {
                case 'savefiles':
                    if (($files = UploadedFile::getInstancesByName('file')) == TRUE) {
                        foreach ($files as $key => $value) {
                            $claim->myphoto = (array)$value;
                            $state[] = $claim->formimagesave();
                        }
                        return $state;
                    } else $claim->addError('pritenwrite', 'Ошибка загрузки');
                    return $claim->errors;
                    break;
                case 'savecomment':
                    $claim->pritenwrite = $this->trim_tags_text(Yii::$app->request->post('comment'), 500);
                    if ($claim->validate()) {
                        return $claim->formcommentsave();
                    } else {
                        return $claim->errors;
                    }

                    break;
                default:
                    $claim->addError('pritenwrite', 'Авторизуйтесь2');
                    return $claim->errors;
            }

        } else {
            $claim->addError('pritenwrite', 'Авторизуйтесь');
            return $claim->errors;
        }
    }
}