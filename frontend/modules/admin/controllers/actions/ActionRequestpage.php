<?php
namespace frontend\modules\admin\controllers\actions;

use Yii;
use common\models\PartnersRequest;
use yii\data\ActiveDataProvider;

trait ActionRequestpage{
    public function actionRequestpage()
    {

        $model = new PartnersRequest();
        $requestprovider = new ActiveDataProvider([
            'query' => PartnersRequest::find()->where(['partners_id' => Yii::$app->params['constantapp']['APP_ID']]),
            'pagination' => [
                'defaultPageSize' => 20,
            ],
        ]);
        $load = Yii::$app->request->post();
        if ($model->load($load)) {
            $model->date_add = date('Y-m-d h:i:s');
            $model->date_modify = date('Y-m-d h:i:s');
            $model->status = 0;
            $model->partners_id = Yii::$app->params['constantapp']['APP_ID'];
            if ($model->save()) {
                return $this->refresh();
            } else {
                return $this->refresh();
            }
        } else {
            return $this->render('requestpage', ['model' => $requestprovider, 'error' => $model->errors, 'modelform' => $model]);
        }

    }
}