<?php
namespace frontend\widgets;

use common\traits\Categories\CategoryChpu;
use common\traits\Categories\CustomCatalog;
use common\traits\Categories_for_partner;
use common\traits\RecursCat;
use common\traits\Reformat_cat_array;
use yii\helpers\Html;
use Yii;

class Menuom extends \yii\bootstrap\Widget
{
    use  Reformat_cat_array,Categories_for_partner, CategoryChpu, RecursCat, CustomCatalog;
    public $property;
    private $categoriesarr;
    private $categories;
    private $cat = 0;
    private $checks;
    private $check;
    private $cat_array;
    private $id;
    private $startcat;
    private $opencat;
    private $rend;
    public $chpu = FALSE;
    public $output2 = '';

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


    public function run()
    {
        parent::run();
        if(Yii::$app->params['constantapp']['APP_THEMES'] == 'newdesign'){
            return $this->view_cat($this->cat_array['cat'], $this->startcat, $this->cat_array['name'], $this->check, $this->opencat,1);
        }
        return '<div id="' . $this->id . '">' . $this->view_catphp($this->cat_array['cat'], $this->startcat, $this->cat_array['name'], $this->check, $this->opencat) . '</div>';
    }

    public function view_catphp($arr, $parent_id = 0, $catnamearr, $allow_cat, $opencat = [])
    {
        if ($opencat == NULL) {
            $opencat = [];
        }
        if (empty($arr[$parent_id])) {
            return $this->output2;
        } else {
            if ($parent_id == 0 || in_array($arr[$parent_id]['parent_id'], $opencat)) {
                $style = '';
            } else {
                $style = 'style="display: none;"';
            }
            $this->output2 .= '<ul  class="accordion" ' . $style . ' data-categories="' . $arr[$parent_id]['categories_id'] . '" data-parent="' . $arr[$parent_id]['parent_id'] . '">';
            for ($i = 0; $i < count($arr[$parent_id]); $i++) {
                $catdesc = $arr[$parent_id][$i]['categories_id'];
                if (!$arr[$parent_id][$i] == '') {
                    if (in_array($catdesc, $opencat)) {
                        $openli = 'open';
                    } else {
                        $openli = '';
                    }
                    $xcat = count($opencat) - 1;
                    if ($catdesc == $opencat[$xcat]) {
                        $aclass = 'checked';
                    } else {
                        $aclass = '';
                    }
                    if ($parent_id == 0) {
                        $exthtml = '';
                    } elseif (!$arr[$arr[$parent_id][$i]['categories_id']]) {
                        $exthtml = '&nbsp;';
                    } elseif (in_array($catdesc, $opencat)) {
                        $exthtml = '- ';
                    } else {
                        $exthtml = '+ ';
                    }

                    if(!$this->categoryChpu($catdesc) || $this->chpu == FALSE){
                        $uri = '?cat=' . $catdesc ;
                    }else{
                       $uri = '/'.$this->categoryChpu($catdesc);
                    }
                    if(!$catnamearr["$catdesc"]){
                        $catnamearr["$catdesc"] = 'NoNaMe'.$catdesc;
                    }
                    $this->output2 .= '<li class=" ' . $openli . '"><div class="link ' . $aclass . '"  data-cat="' . $catdesc . '"> ' . $exthtml . '<a class="lock-on ' . $aclass . '" href="' . BASEURL . '/catalog'.$uri.'">' . $catnamearr["$catdesc"] . '</a></div>';
                    $this->view_catphp($arr, $arr[$parent_id][$i]['categories_id'], $catnamearr, $allow_cat, $opencat);
                    $this->output2 .= '</li>';
                }
            }
            $this->output2 .= '</ul>';
        }
        return $this->output2;
    }

    /*
     * Для newdesign
     */
    public function view_cat($arr, $parent_id = 0, $catnamearr, $allow_cat, $opencat = [],$lvl)
    {
        if ($opencat == NULL) {
            $opencat = [];
        }

        if (empty($arr[$parent_id])) {
            return $this->output2;
        }

        $this->output2 .= '<ul data-categories="' . $arr[$parent_id]['categories_id'] . '" data-parent="' . $arr[$parent_id]['parent_id'] . '">';
        for ($i = 0; $i < count($arr[$parent_id]); $i++) {
            $item_category = $arr[$parent_id][$i];
            $open = in_array($item_category['categories_id'], $opencat);
            if ($item_category == '') {
                continue;
            }

            // если открыта категория, остальные категории первого уровня не подгружаем
            if($opencat[0]!=$item_category['categories_id'] && $lvl==1 && end($opencat)){
                continue;
            }

            if ($open) {
                $openli = 'active';
                $exthtml = ' <span class="subDropdown minus">';
            } else {
                $openli = '';
                $exthtml = ' <span class="subDropdown plus">';
            }

            // если категория не имеет дочерних
            if (empty($arr[$item_category['categories_id']])) {
                $exthtml = '';
            }

            $categoryChpu = $this->categoryChpu($item_category['categories_id']);
            if(!$categoryChpu || $this->chpu == FALSE){
                $uri = '?cat=' . $item_category['categories_id'] ;
            }else{
                $uri = '/'.$categoryChpu;
            }
            $this->output2 .= '<li><a class="' . $openli . '" data-cat="' . $item_category['categories_id'] . '" href="' . BASEURL . '/catalog'.$uri.'">' . $catnamearr[$item_category['categories_id']] . $exthtml.'</a>';
            if($open) {
                $this->view_cat($arr, $item_category['categories_id'], $catnamearr, $allow_cat, $opencat, 2);
            }
            $this->output2 .= '</li>';
        }
        $this->output2 .= '</ul>';
        return $this->output2;
    }

}
