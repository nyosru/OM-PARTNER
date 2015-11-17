<?php
namespace frontend\controllers\actions;

use Yii;
use common\models\PartnersProductsToCategories;

trait ActionSiteNews
{
    public function actionNews()
    {
        return $this->render('news');
    }
}

?>