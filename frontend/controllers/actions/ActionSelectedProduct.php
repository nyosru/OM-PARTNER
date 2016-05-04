<?php
namespace frontend\controllers\actions;

use common\models\AddressBook;
use common\models\Configuration;
use common\models\Customers;
use common\models\Orders;
use common\models\PartnersProducts;
use common\models\PartnersUsersInfo;
use Yii;
trait ActionSelectedProduct{
    public function actionSelectedproduct()
    {


        return $this->render('selectedproduct');
    }
}