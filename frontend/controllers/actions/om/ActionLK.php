<?php
namespace frontend\controllers\actions\om;

use backend\modules\Orders\Orders;
use common\models\Countries;
use common\models\Customers;
use common\models\PartnersUsersInfo;
use common\models\User;
use common\models\Zones;
use yii;


trait ActionLK
{
    public function actionLk()
    {

        if(Yii::$app->user->isGuest || ($cust=User::find()->where(['partners_users.id'=>Yii::$app->user->getId(), 'partners_users.id_partners'=>Yii::$app->params['constantapp']['APP_ID']])->joinWith('userinfo')->joinWith('customers')->joinWith('addressBook')->one()) == FALSE || !isset($cust['customers']['customers_id'])){
            return $this->redirect(Yii::$app->request->referrer);
        }
        $this->layout = 'lk';
        switch (Yii::$app->request->getQueryParam('view')) {
            case 'userinfo':
                return $this->render('lkuserinfo',['cust'=>$cust]);
                break;
            case 'myorder':

                $orders = new yii\data\ActiveDataProvider([
                    'query' => \common\models\Orders::find()->where(['customers_id'=> $cust['customers']['customers_id']])->joinWith('products')->joinWith('productsAttr')->joinWith('productsSP')->groupBy('orders.orders_id'),
                    'pagination' => [
                        'params'=> array_merge($_GET, ['view' => 'myorder']),
                        'defaultPageSize' => 20
                    ]

                ]);
                return $this->render('lkmyorder',['cust'=>$cust, 'orders'=>$orders]);
                break;
            case 'lastorder':
                return $this->render('lklastorder',['cust'=>$cust]);
                break;
            default:
                return $this->render('lk',['cust'=>$cust]);
        }
    }
}