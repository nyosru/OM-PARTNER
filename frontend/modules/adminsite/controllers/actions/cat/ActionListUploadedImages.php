<?php
namespace frontend\modules\adminsite\controllers\actions\cat;

use common\forms\Cat\CatLandConfigForm;
use Yii;

trait ActionListUploadedImages
{

    public function actionListUploadedImages()
    {
        if (Yii::$app->request->isPost) {
            throw new \yii\web\NotFoundHttpException(404);
        }

        Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;

        $model = new CatLandConfigForm();
        $path_to_pictures = Yii::getAlias($model->getPathSavePictures());

        $scandir_res = scandir($path_to_pictures);
        $scandir_res = array_diff_key($scandir_res, ['.', '..']);
        $scandir_res = array_filter($scandir_res, function($x) use ($path_to_pictures){
            if(!is_dir($path_to_pictures . $x)) {
                return 1;
            }
            return 0;
        });

        foreach ($scandir_res as &$image_name) {
            $image_name = '/images/cat/'.$image_name;
        }

        return $scandir_res;
    }

}