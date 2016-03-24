<?php
namespace frontend\controllers\actions\om;

use common\models\PartnersPage;
use Faker\Provider\zh_TW\DateTime;
use Yii;
use common\models\PartnersConfig;

trait ActionPage
{
    public function actionPage()
    {
        $type = $this->trim_tags_text(Yii::$app->request->post('category', 'page'));
        $name = $this->trim_tags_text(Yii::$app->request->post('article', 'default'));

        $page = PartnersPage::find()->where(['partners_id'=>Yii::$app->params['constantapp']['APP_ID'], 'type'=>$type, 'name'=>$name])->asArray()->one();
        $this->layout = 'catalog';
        return $this->render('page', ['page'=>$page]);

    }
}