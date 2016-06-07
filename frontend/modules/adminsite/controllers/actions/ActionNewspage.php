<?php
namespace frontend\modules\adminsite\controllers\actions;

use Yii;
use common\models\PartnersNews;
use yii\data\ActiveDataProvider;

trait ActionNewspage
{
    public function actionNewspage()
    {
        $model = new PartnersNews();
        $newsprovider = new ActiveDataProvider([
            'query' => PartnersNews::find()->where(['partners_id' => Yii::$app->params['constantapp']['APP_ID']]),
            'pagination' => [
                'defaultPageSize' => 20,
            ],
        ]);
        $load = Yii::$app->request->post();
        if ($model->load($load)) {
            $model->date_added = date('Y-m-d H:i:s');
            $model->date_modified = date('Y-m-d H:i:s');
            $model->partners_id = Yii::$app->params['constantapp']['APP_ID'];
            if ($model->save()) {
                return $this->refresh();
            } else {
                return $this->refresh();
            }
        } else {
            return $this->render('newspage', ['model' => $newsprovider, 'modelform' => $model]);
        }
    }
}