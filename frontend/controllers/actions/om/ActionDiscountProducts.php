<?php
namespace frontend\controllers\actions\om;

use common\models\OrdersProducts;
use common\models\PartnersProducts;
use common\models\PartnersProductsAttributes;
use common\models\PartnersProductsOptionVal;
use common\models\PartnersProductsToCategories;
use Yii;
use yii\data\ActiveDataProvider;
use yii\db\Query;
use yii\helpers\ArrayHelper;

trait ActionDiscountProducts
{
    public function actionDiscountproducts()
    {

//        $actionproducts = [];
//
//        $list = array();
//        $hide_man = $this->hide_manufacturers_for_partners();
//        foreach ($hide_man as $value) {
//            $list[] = $value['manufacturers_id'];
//        }
//
//        $hide_man = implode(',', $list);
//        $orderedproducts = new ActiveDataProvider([
//            'query' => PartnersProducts::find()->select('products.products_id')->where(['products.products_model' => $actionproducts])->andWhere('products.manufacturers_id NOT IN (' . $hide_man . ') and products.products_status=1  and products.products_quantity > 0 and products.products_price>0')->groupBy('`products_id` DESC'),
//            'pagination' => [
//                'defaultPageSize' => 60,
//                'pageSizeLimit' => [0, 60]
//            ],
//        ]);
//        $pagination = $orderedproducts->getPagination();
//        $orprod = [];
//        $gmorprod = $orderedproducts->getModels();
//        foreach ($gmorprod as $key => $value) {
//            if (!in_array($value['products_id'], $orprod)) {
//                $orprod[] = $value['products_id'];
//            }
//        }
//
//        if ($orprod) {
//            $orprodstring = implode(',', $orprod);
//
//            $opprovider = new ActiveDataProvider([
//                'query' => PartnersProducts::find()->joinWith('productsDescription')->joinWith('productsAttributes')->joinWith('productsAttributesDescr')->where('products.products_id IN (' . $orprodstring . ')')->distinct(),
//                'pagination' => [
//                    'defaultPageSize' => 60,
//                    'pageSizeLimit' => [0, 60]
//                ],
//            ]);
//            $orderedproducts = $opprovider->getModels();
//        } else {
//            $orderedproducts = [];
//        }
//
//        $catpath = ['num' => ['0' => 0], 'name' => ['0' => 'Каталог']];
//        $man_time = $this->manufacturers_diapazon_id();
//
//        return $this->render('lkorderedproducts', ['orderedproducts' => $orderedproducts, 'pagination' => $pagination, 'catpath' => $catpath, 'man_time' => $man_time, 'title'=>'Специальное предложение']);
    }
}