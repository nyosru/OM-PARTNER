<?php
namespace frontend\modules\adminsite\controllers\actions;

use Yii;
use common\models\PartnersComments;

trait ActionCommentscontrol
{
    public function actionCommentscontrol()
    {
        if (Yii::$app->request->getQueryParam('id')) {
            $model = new PartnersComments();
            $model = $model::findOne((integer)(Yii::$app->request->getQueryParam('id')));
            if ($model) {
                if (Yii::$app->request->getQueryParam('action') === 'add') {
                    $model->status = 1;
                } else {
                    $model->status = 0;
                }
                $model->date_modified = date('Y-m-d H:i:s');
                if ($model->save()) {
                    return $this->redirect(Yii::$app->request->referrer);
                } else {
                    return $this->redirect(Yii::$app->request->referrer);
                }
            } else {
                return $this->redirect(Yii::$app->request->referrer);
            }
        } else {
            return $this->redirect(Yii::$app->request->referrer);
        }
    }
}