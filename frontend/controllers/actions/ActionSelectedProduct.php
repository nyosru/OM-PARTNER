<?php
namespace frontend\controllers\actions;

use common\models\AddressBook;
use common\models\Configuration;
use common\models\Customers;
use common\models\Orders;
use common\models\PartnersProducts;
use common\models\PartnersProductsToCategories;
use common\models\PartnersUsersInfo;
use Yii;
use yii\helpers\ArrayHelper;

trait ActionSelectedProduct
{
    public function actionSelectedproduct()
    {
        if (($products = Yii::$app->request->post('products')) == TRUE && is_array($products)) {
            foreach ($products as $products_key => $products_value) {
                $products[$products_key] = (int)$products_value;
            }
            $prod = PartnersProducts::find()
                ->where(['products.products_id' => $products])
                ->distinct()->orderBy('products_date_added');
            $data = $this->aggregateProductsData($prod, 'productn', 86400);

            if(Yii::$app->request->post('html') != true) {
                Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
                return $data;
            }
            return $this->renderPartial('_ajax-selectedproduct',['data'=>$data]);
        } else {
            return $this->render('selectedproduct');
        }

    }
}