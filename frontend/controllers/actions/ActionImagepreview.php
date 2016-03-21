<?php
namespace frontend\controllers\actions;


use Yii;

trait ActionImagepreview
{
    public function actionImagepreview()
    {
        $src = Yii::$app->request->getQueryParam('src');
        $action = Yii::$app->request->getQueryParam('action', 'none');
        $headers = Yii::$app->response->headers;
        $headers->add('Content-Type', 'image/jpg');
        $headers->add('Cache-Control', 'max-age=11000');
        Yii::$app->response->format = \yii\web\Response::FORMAT_RAW;
        return $this->Imagepreviewcrop('http://odezhda-master.ru/images/', $src, '@webroot/images/', $action);
    }
}