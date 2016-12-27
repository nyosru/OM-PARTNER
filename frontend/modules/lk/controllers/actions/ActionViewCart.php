<?php
namespace frontend\modules\lk\controllers\actions;

use Yii;
use common\models\PartnersCart;
use common\models\User;

trait ActionViewCart
{
    public function actionViewcart()
    {

        if (!\Yii::$app->user->isGuest) {
            $cust = User::find()->where(['partners_users.id' => Yii::$app->user->getId(), 'partners_users.id_partners' => \Yii::$app->params['constantapp']['APP_ID']])->joinWith('userinfo')->one();
            $cart = PartnersCart::find()->where(['user_id' => Yii::$app->user->getId()])->all();
            \Yii::$app->params['modules']['lk']['menu'] = $this->actionMenu() ;
            return $this->render('viewcart', ['cart' => $cart,'cust'=>$cust]);
        } else return $this->redirect('/');
    }
}