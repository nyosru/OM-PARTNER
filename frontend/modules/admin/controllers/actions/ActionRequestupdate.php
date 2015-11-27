<?php
namespace frontend\modules\admin\controllers\actions;

use Yii;
use common\models\PartnersRequest;


trait ActionRequestupdate{
    public function actionRequestupdate()
    {
        $id = Yii::$app->request->getQueryParam('id', 'none');

        if (isset($id) && $id !== 'none') {
            $model = new PartnersRequest();
            $model = $model::findOne(intval(Yii::$app->request->getQueryParam('id')));
            $modelc = new PartnersRequest();
            $load = Yii::$app->request->post();
            if (isset($load['PartnersRequest']['comments']['text'])) {
                $comments = unserialize($model->comments);
                $newcomment['text'] = $load['PartnersRequest']['comments']['text'];
                $newcomment['who'] = yii::$app->user->id;
                $newcomment['date'] = date('Y-m-d h:i:s');
                $comments[] = $newcomment;
                $model->comments = serialize($comments);
                $model->date_modify = date('Y-m-d h:i:s');
                $model->save();

            } else {
                return $this->render('requestupdate', ['modelform' => $model, 'modelc' => $modelc, 'errors' => $model->errors]);
            }
            return $this->render('requestupdate', ['modelform' => $model, 'modelc' => $modelc, 'errors' => $model->errors]);
        } else {
            return $this->redirect('/admin/default/requestpage');
        }
    }
}