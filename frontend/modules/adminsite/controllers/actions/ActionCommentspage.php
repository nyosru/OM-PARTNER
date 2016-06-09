<?php
namespace frontend\modules\adminsite\controllers\actions;

use Yii;
use common\models\PartnersComments;
use yii\data\ActiveDataProvider;

trait ActionCommentspage
{
    public function actionCommentspage()
    {
        $commentssprovider = new ActiveDataProvider([
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


        return $this->render('commentspage', ['model' => $commentssprovider]);

    }
}