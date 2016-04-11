<?php
namespace frontend\modules\adminsite\controllers\actions;

use Yii;
trait ActionTemplateimage{
    public function actionTemplateimage()
    {
        $src = Yii::$app->request->getQueryParam('src');
        $action = Yii::$app->request->getQueryParam('action', 'none');
        $template = Yii::$app->request->getQueryParam('template');
        $path = Yii::getAlias('@app');
        $headers = Yii::$app->response->headers;
        $headers->add('Content-Type', 'image/jpg');
        $headers->add('Cache-Control', 'max-age=68200');
        Yii::$app->response->format = \yii\web\Response::FORMAT_RAW;
        return $this->Imagepreviewcrop($path . '/themes/', $template . '/' . $src, '@webroot/images/', $action = 'none');
    }
}