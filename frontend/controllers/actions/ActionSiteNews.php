<?php
namespace frontend\controllers\actions;

use Yii;
use common\models\PartnersProductsToCategories;

trait ActionSiteNews
{
    public function actionNews()
    {
        $checks = Yii::$app->params['constantapp']['APP_CAT'];
        $check = Yii::$app->params['constantapp']['APP_ID'];
        $categoriesarr = $this->categories_for_partners();
        $categories = $categoriesarr[0];
        $cat = $categoriesarr[1];
        $cat_array = $this->reformat_cat_array($categories, $cat, $checks);
        $view = $this->View_cat($cat_array['cat'], 0, $cat_array['name'], $check);

        return $this->render('news', ['view' => $view]);
    }
}

?>