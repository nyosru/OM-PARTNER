<?php
namespace frontend\modules\adminsite\controllers\actions\cat;

use common\forms\Cat\CatLandConfigForm;
use Yii;
use yii\data\ArrayDataProvider;

trait ActionListUploadedImages
{

    public function actionListUploadedImages()
    {
        if (Yii::$app->request->isPost) {
            throw new \yii\web\NotFoundHttpException(404);
        }

        $model = new CatLandConfigForm();
        $path_to_pictures = Yii::getAlias($model->getPathSavePictures());

        $scandir_res = scandir($path_to_pictures);
        $scandir_res = array_diff_key($scandir_res, ['.', '..']);
        $scandir_res = array_filter($scandir_res, function ($x) use ($path_to_pictures) {
            if (!is_dir($path_to_pictures . $x)) {
                return 1;
            }

            return 0;
        });

        foreach ($scandir_res as &$image_name) {
            $image_name = '/images/cat/' . $image_name;
        }

        if (Yii::$app->request->isPjax) {
            $array_data_provider = new ArrayDataProvider([
                'allModels' => $scandir_res,
                'pagination' => [
                    'pageSize' => 10,
                ],
            ]);
            echo '<pre>' . print_r($array_data_provider, true) . '</pre>';
            return $this->render('modal-content', ['array_data_provider' => $array_data_provider]);
        }

        Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;

        return $scandir_res;


    }

}