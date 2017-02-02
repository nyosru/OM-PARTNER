<?php
namespace frontend\widgets;

use common\traits\Categories\CategoryChpu;
use common\traits\Categories\CustomCatalog;
use common\traits\Categories_for_partner;
use frontend\widgets\MainBanner;
use common\traits\RecursCat;
use common\traits\Reformat_cat_array;
use yii\helpers\Html;
use Yii;

class NewMenuom extends \yii\bootstrap\Widget
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
    public $html = true;
    public $recursion = false;

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

        if($this->property['type']=='images') {
            return $this->view_cat_images($this->cat_array['cat'], $this->startcat, $this->cat_array['name'], $this->check, $this->opencat, 1);
        }
        // костыль для горизонтального меню ¯\_(ツ)_/¯
        if($this->property['type']=='top-menu'){
            $result = [];
            if(is_array($this->startcat)){
                foreach($this->startcat as $startcat){
                    $result += $this->view_cat_menu($this->cat_array['cat'], $startcat, $this->cat_array['name']);
                }
            } else {
                $result = $this->view_cat_menu($this->cat_array['cat'], $this->startcat, $this->cat_array['name']);
            }
            ksort($result);
            $html = '';
            foreach($result as $item){
                $html .= '<li><a href="'.$item['url'].'">'.$item['name'].'</a></li>';
            }
            return $html;
        }
        return $this->view_cat($this->cat_array['cat'], $this->startcat, $this->cat_array['name'], $this->check, $this->opencat, 1);
    }

    public function view_cat_menu($arr, $parent_id = 0, $catnamearr)
    {
        for ($i = 0; $i < count($arr[$parent_id]); $i++) {
            $item_category = $arr[$parent_id][$i];
            $name = $catnamearr[$item_category['categories_id']];

            if ($item_category == '')
                continue;

            $key = $this->allow_cat($name);
            if($key !== false) {
                $result[$key] = [
                    'url' => $this->get_url($item_category['categories_id']),
                    'name' => $name,
                ];
            }
        }
        return $result;
    }

    /*
     * Для newdesign banners
     */
    public function view_cat_images($arr, $parent_id = 0, $catnamearr, $allow_cat, $opencat = [])
    {
        for ($i = 0; $i < count($arr[$parent_id]); $i++) {
            $item_category = $arr[$parent_id][$i];
            if ($item_category == '')
                continue;

            $result[$i] = [
                //'image' =>  'cat-'.$item_category['categories_id'],
                'image' =>  'cat-1544.png',
                'referal'=> $this->get_url($item_category['categories_id']),
                'alttext' => $catnamearr[$item_category['categories_id']],
            ];
        }
        $html = MainBanner::widget([
            'template'=>'top-banner',
            'banners' => [
                'top-banner' => $result,
            ],
            'path_image' => '/images/categories/',
        ]);
        return $html;
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
            $name = $catnamearr[$item_category['categories_id']];

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

            $this->output2 .= '<li><a class="' . $openli . '" data-cat="' . $item_category['categories_id'] . '" href="'.$this->get_url($item_category['categories_id']).'">' . $name . $exthtml.'</a>';
            if($open || $this->recursion) {
                $this->view_cat($arr, $item_category['categories_id'], $catnamearr, $allow_cat, $opencat, 2);
            }
            $this->output2 .= '</li>';
        }
        $this->output2 .= '</ul>';
        return $this->output2;
    }

    private function get_url($category_id)
    {
        $categoryChpu = $this->categoryChpu($category_id);
        if(!$categoryChpu || $this->chpu == FALSE){
            $url = '?cat=' . $category_id;
        }else{
            $url = '/'.$categoryChpu;
        }
        return BASEURL . '/catalog' . $url;
    }

    private function allow_cat($name)
    {
        if(!empty($this->property['allow'])){
            return array_search($name, $this->property['allow']);
        }
        return false;
    }
}
