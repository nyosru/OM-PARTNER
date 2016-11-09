<?php
namespace frontend\controllers\actions\om;

use common\models\PartnersCatDescription;
use common\models\ProductsSpecifications;
use Yii;
use common\models\PartnersProducts;
use common\models\PartnersProductsToCategories;
use yii\helpers\ArrayHelper;

trait ActionSpLanding
{
    public function actionSpLanding()
    {

        $this->layout = 'lp';
        return $this->render('sp');
    }

}