<?php
namespace frontend\widgets;

use common\traits\Categories_for_partner;
use common\traits\Reformat_cat_array;
use common\traits\View_cat2;
use Yii;

class Menuom extends \yii\bootstrap\Widget
{
    use View_cat2, Reformat_cat_array, Categories_for_partner;
    public $opencat = [];
    public $startcat = 0;
    public static $view = '';


    public function run()
    {
        parent::run();
        $categoriesarr = $this->categories_for_partners();
        $categories = $categoriesarr[0];
        $cat = $categoriesarr[1];
        $checks = Yii::$app->params['constantapp']['APP_CAT'];
        $check = Yii::$app->params['constantapp']['APP_ID'];
        $cat_array = $this->reformat_cat_array($categories, $cat, $checks);
        echo $this->view_catphp($cat_array['cat'], $this->startcat, $cat_array['name'], $check, $this->opencat);
    }

}
