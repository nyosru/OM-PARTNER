<?php
namespace frontend\controllers\actions;


use Yii;

trait ActionImagepreview
{
    public function actionImagepreview()
    {
        $src = Yii::$app->request->getQueryParam('src');
        $action = Yii::$app->request->getQueryParam('action', 'none');
        $sub = Yii::$app->request->getQueryParam('sub', FALSE);
        $headers = Yii::$app->response->headers;
        $headers->add('Content-Type', 'image/jpg');
        $headers->add('Accept-Encoding', 'gzip, deflate');
        $headers->add('Expires', gmdate('D, d M Y H:i:s \G\M\T', time() + (60 * 60 * 24 * 14)));
        Yii::$app->response->format = \yii\web\Response::FORMAT_RAW;
        return $this->Imagepreviewcrop('http://odezhda-master.ru/images/', $src, '@webroot/images/', $action, $sub);
    }
}