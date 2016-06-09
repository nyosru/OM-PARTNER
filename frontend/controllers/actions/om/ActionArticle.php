<?php
namespace frontend\controllers\actions\om;

use common\models\PartnersPage;
use yii\bootstrap\Tabs;
use Faker\Provider\zh_TW\DateTime;
use Yii;
use common\models\PartnersConfig;

trait ActionArticle
{
    public function actionArticle()
    {
        $param = $this->trim_tags_text(Yii::$app->request->getQueryParam('view'));
        try {
            $this->layout = 'catalog';
            return $this->render('article/' . $param);
        } catch (\Exception $e) {
            return $this->redirect(Yii::$app->homeUrl);
        }
    }
}