<?php
namespace frontend\controllers\actions;

use Yii;

trait   ActionCatPath
{
    public function actionCatpath()
    {
        $cat = intval(Yii::$app->request->getQueryParam('cat'));
        $catdataarr = $this->categories_for_partners();
        $catdata = $catdataarr[0];
        $categories = $catdataarr[1];
        foreach ($categories as $value) {
            $catnamearr[$value['categories_id']] = $value['categories_name'];
        }
        foreach ($catdata as $value) {
            $catdatas[$value['categories_id']] = $value['parent_id'];
        }
        Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        $chpu = $this->Requrscat($catdatas, $cat, $catnamearr);
        return $chpu;
    }
}