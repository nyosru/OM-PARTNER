<?php
namespace frontend\widgets;

use common\traits\Categories_for_partner;
use common\traits\Reformat_cat_array;
use common\traits\View_cat2;
use Yii;

class Menu2 extends \yii\bootstrap\Widget
{
    use View_cat2, Reformat_cat_array, Categories_for_partner;

    public function init()
    {
        $categoriesarr = $this->categories_for_partners();
        $categories = $categoriesarr[0];
        $cat = $categoriesarr[1];
        $checks = Yii::$app->params['constantapp']['APP_CAT'];
        $check = Yii::$app->params['constantapp']['APP_ID'];
        $cat_array = $this->reformat_cat_array($categories, $cat, $checks);
        $view = $this->view_cat($cat_array['cat'], 0, $cat_array['name'], $check);
        echo $view;
    }
}
