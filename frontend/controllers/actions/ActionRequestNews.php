<?php
namespace frontend\controllers\actions;

use common\models\PartnersNews;
use Yii;
use yii\data\ActiveDataProvider;

trait ActionRequestNews
{
    public function actionRequestNews()
    {

        $newsprovider = new ActiveDataProvider([
            'query' => PartnersNews::find()->where(['partners_id' => Yii::$app->params['constantapp']['APP_ID']]),
            'pagination' => [
                'pageSize' => 20,
            ],
        ]);

        return $this->render('news', ['news' => $newsprovider->getModels()]);
    }
}

?>