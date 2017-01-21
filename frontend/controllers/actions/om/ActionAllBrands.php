<?php
namespace frontend\controllers\actions\om;

use common\models\PartnersPage;
use common\models\ProductsSpecifications;
use common\models\Specifications;
use common\models\SpecificationValuesDescription;
use yii\bootstrap\Tabs;
use Faker\Provider\zh_TW\DateTime;
use Yii;
use common\models\PartnersConfig;

trait ActionAllBrands
{
    public function actionAllbrands()
    {
        $brands =  $this->findBrands();

        return $this->render('allbrands', ['brands'=>$brands]);
    }
}