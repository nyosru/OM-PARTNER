<?php
namespace frontend\controllers\actions;

use Yii;
use common\models\PartnersProductsToCategories;

trait ActionTimeOrderProducts
{


    public function actionTimeorderproducts()
    {
        return $this->manufacturers_diapazon((int)Yii::$app->request->getQueryParam('id'));
    }
}