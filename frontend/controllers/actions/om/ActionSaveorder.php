<?php

namespace frontend\controllers\actions\om;


use common\models\AdminCompaniesBank;
use common\models\AdminCompaniesBankToOrders;
use common\models\Configuration;
use common\models\LastPartnersIds;
use common\models\OrdersStatusHistory;
use common\models\OrdersToPartners;
use common\models\PartnersProductsAttributes;
use common\models\PartnersToRegion;
use common\models\ProductsCache;
use common\models\SelerAnket;
use common\models\SpsrZones;
use Yii;
use common\models\PartnersOrders;
use common\models\User;
use common\models\PartnersUsersInfo;
use common\models\Countries;
use common\models\Zones;
use common\models\AddressBook;
use common\models\Customers;
use common\models\Partners;
use common\models\CustomersInfo;
use common\models\Orders;
use common\models\OrdersProducts;
use common\models\PartnersProducts;
use common\models\OrdersProductsAttributes;
use common\models\OrdersTotal;
use yii\base\Exception;
use yii\helpers\ArrayHelper;

trait ActionSaveorder
{
    public function actionSaveorder()
    {
        if(($id = Yii::$app->user->GetId()) == TRUE){
            return $this->OrdersToReferrer();
        }else{
            return  $this->OrdersToOm();
        }

    }
}