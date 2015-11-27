<?php
namespace frontend\modules\admin\controllers\actions;

use Yii;
use common\models\PartnersNews;

trait ActionNewsupdate{
    public function actionNewsupdate()
    {
        if (Yii::$app->request->getQueryParam('id')) {
            $model = new PartnersNews();
            $model = $model::findOne((integer)(Yii::$app->request->getQueryParam('id')));
            $load = Yii::$app->request->post();
            if (isset($load) && $model->load($load)) {
                $model->date_modified = date('Y-m-d H:i:s');
                $model->partners_id = Yii::$app->params['constantapp']['APP_ID'];
                if ($model->save()) {
                    return $this->redirect('/admin/default/newspage');
                } else {
                    return $this->redirect('/admin/default/newspage');
                }
            } else {
                return $this->render('newsupdate', ['modelform' => $model]);
            }
        } else {
            return $this->redirect('/admin/default/newspage');
        }
    }
}