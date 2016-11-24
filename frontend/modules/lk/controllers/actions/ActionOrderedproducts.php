<?php
namespace frontend\modules\lk\controllers\actions;

use common\models\Customers;
use common\models\OrdersProducts;
use common\models\OrdersProductsPriten;
use common\models\PartnersProducts;
use common\models\PartnersUsersInfo;
use common\models\Profile;
use common\models\User;
use common\models\Orders;
use frontend\widgets\ProductCard;
use yii;


trait ActionOrderedproducts
{
    public function actionOrderedproducts()
    {
        if (Yii::$app->user->isGuest || ($cust = User::find()->where(['partners_users.id' => Yii::$app->user->getId(), 'partners_users.id_partners' => Yii::$app->params['constantapp']['APP_ID']])->joinWith('userinfo')->joinWith('customers')->joinWith('addressBook')->one()) == FALSE || !isset($cust['customers']['customers_id'])) {
            return $this->redirect(Yii::$app->request->referrer);
        }

        $list = array();
        $hide_man = $this->hide_manufacturers_for_partners();
        foreach ($hide_man as $value) {
            $list[] = $value['manufacturers_id'];
        }

        $hide_man = implode(',', $list);
        $orderedproducts = new yii\data\ActiveDataProvider([
            'query' => OrdersProducts::find()->select('products.products_id')->joinWith('products')->joinWith('order')->where(['customers_id' => $cust['customers']['customers_id']])->andWhere('products.manufacturers_id NOT IN (' . $hide_man . ') and products.products_status=1  and products.products_quantity > 0 and products.products_price>0')->groupBy('`products_id` DESC'),
            'pagination' => [
                'defaultPageSize' => 60,
                'pageSizeLimit' => [0, 60]
            ],
        ]);
        $pagination = $orderedproducts->getPagination();
        $orprod = [];
        $gmorprod = $orderedproducts->getModels();
        foreach ($gmorprod as $key => $value) {
            if (!in_array($value['products_id'], $orprod)) {
                $orprod[] = $value['products_id'];
            }
        }

        if($orprod) {
            $orprodstring = implode(',', $orprod);

            $opprovider = new yii\data\ActiveDataProvider([
                'query' => PartnersProducts::find()->joinWith('productsDescription')->joinWith('productsAttributes')->joinWith('productsAttributesDescr')->where('products.products_id IN (' . $orprodstring . ')')->distinct(),
                'pagination' => [
                    'defaultPageSize' => 60,
                    'pageSizeLimit' => [0, 60]
                ],
            ]);
            $orderedproducts = $opprovider->getModels();
        }else{
            $orderedproducts = [];
        }

        $catpath = ['num' => ['0' => 0], 'name' => ['0' => 'Каталог']];
        $man_time = $this->manufacturers_diapazon_id();
        \Yii::$app->params['modules']['lk']['menu'] = $this->actionMenu() ;

        return $this->render('lkorderedproducts', ['orderedproducts' => $orderedproducts, 'pagination' => $pagination, 'catpath' => $catpath, 'man_time' => $man_time,'title'=>'Мои товары']);
    }
}