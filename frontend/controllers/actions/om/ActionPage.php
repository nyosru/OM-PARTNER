<?php
namespace frontend\controllers\actions\om;

use common\models\PartnersPage;
use yii\bootstrap\Tabs;
use Faker\Provider\zh_TW\DateTime;
use Yii;
use common\models\PartnersConfig;

trait ActionPage
{
    public function actionPage()
    {
        $name = $this->trim_tags_text(Yii::$app->request->getQueryParam('article'));
        $page = PartnersPage::find()->where(['partners_id' => Yii::$app->params['constantapp']['APP_ID'], 'type' => 'post', 'name' => $name])->one();
        if (!$page) {
            $page = new PartnersPage();
        }
        if (Yii::$app->request->post('PartnersPage')['content'] && Yii::$app->user->can('admin')) {
            $page->content = stripcslashes(Yii::$app->request->post('PartnersPage')['content']);
            $page->name = $name;
            $page->type = 'post';
            $page->active = 1;
            $page->date_add = 'NULL';
            $page->date_modify = 'NULL';
            $page->partners_id = Yii::$app->params['constantapp']['APP_ID'];
            $page->tags = 'NULL';
            $page->viewed = 0;
            $page->validate();
            $page->save();
        } else {

        }
        $this->layout = 'main';
        return $this->render('page', ['page' => $page, 'error' => $page->errors]);

    }
}