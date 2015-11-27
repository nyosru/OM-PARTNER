<?php
namespace frontend\modules\admin\controllers\actions;

use Yii;
use common\models\PartnersComments;
use yii\data\ActiveDataProvider;

trait ActionCommentspage{
    public function actionCommentspage()
    {
        $model = new PartnersComments();
        $newsprovider = new ActiveDataProvider([
            'query' => PartnersComments::find()->select([
                'partners_comments.id',
                'partners_comments.user_id',
                'partners_comments.post',
                'partners_comments.status',
                'partners_comments.date_added',
                'partners_users.username',
                'partners_comments.relate_id',
            ])->where([
                'partners_id' => Yii::$app->params['constantapp']['APP_ID']
            ])->joinWith('user'),
            'pagination' => [
                'defaultPageSize' => 20,
            ],
        ]);
        $load = Yii::$app->request->post();
        if ($model->load($load)) {
            $model->date_added = date('Y-m-d h:i:s');
            $model->date_modified = date('Y-m-d h:i:s');
            $model->partners_id = Yii::$app->params['constantapp']['APP_ID'];
            if ($model->save()) {
                return $this->refresh();
            } else {
                return $this->refresh();
            }
        } else {
            return $this->render('commentspage', ['model' => $newsprovider, 'modelform' => $model]);
        }
    }
}