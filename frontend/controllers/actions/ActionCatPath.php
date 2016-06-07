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
        $cat = $this->Catpath($post['category'],'name');
        $cat=end($cat);
        return $cat;
    }
}