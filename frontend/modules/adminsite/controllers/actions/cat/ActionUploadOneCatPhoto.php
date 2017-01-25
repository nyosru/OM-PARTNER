<?php
namespace frontend\modules\adminsite\controllers\actions\cat;


use common\forms\Cat\CatLandConfigForm;
use Yii;
use yii\web\UploadedFile;

trait ActionUploadOneCatPhoto
{

    public function actionUploadOneCatPhoto()
    {
        if (Yii::$app->request->isGet) {
            throw new \yii\web\NotFoundHttpException(404);
        }

        Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        $file = UploadedFile::getInstancesByName('file');
        $position = Yii::$app->request->post('position');

        $catLandConfigForm = new CatLandConfigForm();
        $save_res = $catLandConfigForm->saveImages($file);
        $res = [];
        if (!$save_res) {
            $res = [$position, $file_name = Yii::$app->request->post('file')];
        } elseif ($save_res) {
            $res = [$position, $save_res[0]];
        } else {
            $res = false;
        }

        return $res;
    }

}