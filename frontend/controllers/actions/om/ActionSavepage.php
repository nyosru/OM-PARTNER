<?php
namespace frontend\controllers\actions\om;

use common\models\PartnersPage;
use Faker\Provider\zh_TW\DateTime;
use Yii;
use common\models\PartnersConfig;

trait ActionSavepage
{
    public function actionSavepage()
    {
        $name = $this->trim_tags_text(Yii::$app->request->post('article'));
        $page = PartnersPage::find()->where(['partners_id'=>Yii::$app->params['constantapp']['APP_ID'], 'type'=>'stringpost', 'name'=>$name])->one();
        if(!$page){
            $page = new PartnersPage();
        }
        if(Yii::$app->request->post('html') && Yii::$app->user->can('admin')){

            $page->content = stripcslashes(Yii::$app->request->post('html'));
            $page->name = $name;
            $page->type = 'stringpost';
            $page->active = 1;
            $page->date_add = 'NULL';
            $page->date_modify = 'NULL';
            $page->partners_id = Yii::$app->params['constantapp']['APP_ID'];
            $page->tags = 'NULL';
            $page->viewed= 0;
            $page->validate();

            $page->save();
        }else{

        }

    }
}