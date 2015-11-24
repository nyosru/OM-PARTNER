<?php
namespace frontend\modules\admin\controllers\actions;

use Yii;
use common\models\User;
trait ActionRequestusers{
    public function actionRequestusers()
    {
        $check = $this->id_partners();
        Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        $query = User::find()->select('id, username, email, created_at, updated_at')->where('id_partners=' . $check)->asArray()->all();
        return $query;
    }
}