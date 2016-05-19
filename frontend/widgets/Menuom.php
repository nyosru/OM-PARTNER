<?php
namespace frontend\widgets;

use common\traits\Categories_for_partner;
use common\traits\Reformat_cat_array;
use common\traits\View_cat2;
use yii\helpers\Html;
use Yii;
class Menuom extends \yii\bootstrap\Widget
{
    use View_cat2, Reformat_cat_array, Categories_for_partner;
    public $property;
    private $categoriesarr;
    private $categories ;
    private $cat = 0;
    private $checks;
    private $check;
    private $cat_array;
    private $id;
    private $startcat;
    private $opencat;
    private $rend;
    public function init()
    {
        parent::init();
        $this->categoriesarr = $this->categories_for_partners();
        $this->categories = $this->categoriesarr[0];
        $this->cat = $this->categoriesarr[1];
        $this->checks = Yii::$app->params['constantapp']['APP_CAT'];
        $this->check = Yii::$app->params['constantapp']['APP_ID'];
        $this->cat_array = $this->reformat_cat_array($this->categories, $this->cat, $this->checks);
        $this->startcat = $this->property['target'];
        $this->opencat = $this->property['opencat'];
        $this->id = $this->property['id'];
    }


    public function run(){
        parent::run();
	        return '<div id="'.$this->id.'">'.$this->view_catphp($this->cat_array['cat'], $this->startcat, $this->cat_array['name'], $this->check, $this->opencat).'</div>';
	    }

}
