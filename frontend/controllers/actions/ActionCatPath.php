<?php
namespace frontend\controllers\actions;


use yii;
use common\traits\Categories_for_partner;
use common\traits\CatPath;

trait   ActionCatPath
{

    public function actionCatpath()
    {
        $post=Yii::$app->request->post();
        $cat=array_pop($this->Catpath($post['category'],'name'));
        return $cat;
    }
}