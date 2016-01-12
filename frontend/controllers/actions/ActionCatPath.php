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
        if (($action = Yii::$app->request->getQueryParam('action')) == TRUE && $action == 'name') {
            $resultchpu = [];
            foreach ($chpu as $key => $value) {
                $resultchpu[] = $value['name'];
            }
            return $resultchpu;
        } elseif ($action == 'num') {
            $resultchpu = [];
            foreach ($chpu as $key => $value) {
                $resultchpu[] = $value['id'];
            }
            return $resultchpu;
        } elseif ($action == 'namenum') {
            $resultchpu = [];
            foreach ($chpu as $key => $value) {
                $resultchpu['num'][] = $value['id'];
                $resultchpu['name'][] = $value['name'];
            }
            return $resultchpu;
        } else {
            return $chpu;
        }

    }
}