<?php
namespace frontend\modules\admin\controllers\actions;

use Yii;
use common\models\User;
use yii\data\ActiveDataProvider;

trait ActionRequestusers
{
    public function actionRequestusers()
    {

        $usersprovider = new ActiveDataProvider([
            'query' => User::find()->select('id, username, email, created_at, updated_at, role, active_discount, total_order')->where('id_partners=' . Yii::$app->params['constantapp']['APP_ID']),
            'pagination' => [
                'defaultPageSize' => 20,
            ],
        ]);

        return $this->render('userspage', ['model' => $usersprovider]);
    }


}