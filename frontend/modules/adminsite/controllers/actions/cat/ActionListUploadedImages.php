<?php
namespace frontend\modules\adminsite\controllers\actions\cat;

use common\forms\Cat\CatLandConfigForm;
use common\traits\Cat\CatImagesService;
use Yii;

trait ActionListUploadedImages
{

    public function actionListUploadedImages()
    {
        if (Yii::$app->request->isPost) {
            throw new \yii\web\NotFoundHttpException(404);
        }

        $CatImagesService = new CatImagesService(new CatLandConfigForm());
        $list_pictures = $CatImagesService->getListPictures();

        Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        return $list_pictures;
    }

}