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


    public $tpl = [
        'wrap'=>'<div id="{$id}">{$menu}</div>',
        'block'=>'<ul  class="accordion" {$style} data-categories="{$categories}" data-parent="{$parentid}">{$sub}</ul>',
        'link'=>'<li class="{$open}">
                    <div class="link {$checked}"  data-cat="{$catdesc}">
                        {$exhtml}
                        <a class="lock-on {$checked}" href="{$uri}">
                            {$name}
                        </a>
                    </div>
                    {$subcat}
               </li>'
    ];
    public $options = [
       'exhtml'=>[
           'open'=>'<span>+ </span>',
           'close'=>'<span>- </span>',
           'root'=>' ',
           'last'=> '&nbsp;'
       ],
        'active'=>[
            'tag'=> 'open',
            'anchor'=> 'checked'
        ]
    ];

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
        if(isset($this->property['exhtml']['open'])){
            $this->options['exhtml']['open'] = $this->property['exhtml']['open'];
        }
        if(isset($this->property['exhtml']['close'])){
            $this->options['exhtml']['close'] = $this->property['exhtml']['close'];
        }
        if(isset($this->property['exhtml']['root'])){
            $this->options['exhtml']['root'] = $this->property['exhtml']['root'];
        }
        if(isset($this->property['exhtml']['last'])){
            $this->options['exhtml']['last'] = $this->property['exhtml']['last'];
        }
        if(isset($this->property['active']['tag'])){
            $this->options['active']['tag'] = $this->property['active']['tag'];
        }
        if(isset($this->property['active']['anchor'])){
            $this->options['active']['anchor'] = $this->property['active']['anchor'];
        }
        $this->id = $this->property['id'];
    }


    public function run()
    {
        $id = $this->id;
        $menu = $this->view_catphp($this->cat_array['cat'], $this->startcat, $this->cat_array['name'], $this->check, $this->opencat);
        preg_match_all('/{\$(\w*\d*\_*)}/iu',$this->tpl['wrap'],$match);
        foreach ($match[1] as $key=>$value){
            if(isset($$value)) {
                $replace[] = $$value;
                $patterns[] = '/{\$' . $value . '}/iu';
            }
        }
       return preg_replace($patterns, $replace ,$this->tpl['wrap']);
    }

    public function view_catphp($arr, $parent_id = 0, $catnamearr, $allow_cat, $opencat = [])
    {
        $s = '';
        $x = '';
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
            for ($i = 0; $i < count($arr[$parent_id]); $i++) {
                $catdesc = $arr[$parent_id][$i]['categories_id'];
                if (!$arr[$parent_id][$i] == '') {
                    if (in_array($catdesc, $opencat)) {
                        $open = $this->options['active']['tag'];
                    } else {
                        $open = '';
                    }
                    $xcat = count($opencat) - 1;
                    if ($catdesc == $opencat[$xcat]) {
                        $checked = $this->options['active']['anchor'];
                    } else {
                        $checked = '';
                    }
                    if ($parent_id == 0) {
                        $exhtml = $this->options['exhtml']['root'];
                    } elseif (!$arr[$arr[$parent_id][$i]['categories_id']]) {
                        $exhtml = $this->options['exhtml']['last'];
                    } elseif (in_array($catdesc, $opencat)) {
                        $exhtml = $this->options['exhtml']['close'];
                    } else {
                        $exhtml = $this->options['exhtml']['open'];
                    }
                    if(!$this->categoryChpu($catdesc) || $this->chpu == FALSE){
                        $uri = '?cat=' . $catdesc ;
                    }else{
                        $uri = '/'.$this->categoryChpu($catdesc);
                    }
                    if(!$catnamearr["$catdesc"]){
                        $catnamearr["$catdesc"] = 'NoNaMe'.$catdesc;
                    }
                    $subcat = $this->view_catphp($arr, $catdesc, $catnamearr, $allow_cat, $opencat);
                    $name = $catnamearr["$catdesc"];
                    $uri =  BASEURL . '/catalog'.$uri;
                    preg_match_all('/{\$(\w*\d*\_*)}/iu',$this->tpl['link'],$match);
                    $replace = [];
                    $patterns = [];
                    foreach ($match[1] as $key=>$value){
                        if(isset($$value)) {
                            $replace[] = $$value;
                            $patterns[] = '/{\$' . $value . '}/iu';
                        }
                    }
                    $s .= preg_replace($patterns, $replace ,$this->tpl['link']);
                }
            }
            $sub = $s;
            $categories =  $arr[$parent_id]['categories_id'];
            $parentid = $arr[$parent_id]['parent_id'] ;
            $x .= ''.$s;
            preg_match_all('/{\$(\w*\d*\_*)}/iu',$this->tpl['block'],$match);
            foreach ($match[1] as $key=>$value){
                if(isset($$value)) {
                    $replace[] = $$value;
                    $patterns[] = '/{\$' . $value . '}/iu';
                }
            }
        }
        return preg_replace($patterns, $replace ,$this->tpl['block']);
    }

}
