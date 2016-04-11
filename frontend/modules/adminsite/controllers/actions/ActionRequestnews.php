<?php
namespace frontend\modules\adminsite\controllers\actions;

use common\models\PartnersNews;
use Yii;
use yii\data\ActiveDataProvider;

trait ActionRequestnews{
    public function actionRequestnews()
    {

        $newsprovider = new ActiveDataProvider([
            'query' => PartnersNews::find()->where(['partners_id' => Yii::$app->params['constantapp']['APP_ID']]),
            'pagination' => [
                'pageSize' => 20,
            ],
        ]);
        Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        return $newsprovider->getModels();
    }
}