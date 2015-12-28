<?php
namespace frontend\modules\admin\controllers\actions;

use common\models\PartnersSettings;
use Yii;
use common\models\PartnersNews;
use yii\data\ActiveDataProvider;

trait ActionMainpageset
{
    public function actionMainpageset()
    {
        $model = new PartnersSettings();
        $paramset = Yii::$app->params['partnersset'];
        //$model->load($paramset);
        return $this->render('mainpageset', ['model' => $paramset]);

    }
}