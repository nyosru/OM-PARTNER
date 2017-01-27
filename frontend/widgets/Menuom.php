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
    use  Reformat_cat_array, Categories_for_partner, CategoryChpu, RecursCat, CustomCatalog;
    public $property;
    private $categoriesarr;
    private $check;
    private $cat_array;
    private $id;
    private $startcat;
    private $opencat;
    public $chpu = FALSE;
    public $output2 = '';

    public $tpl = [
        'wrap' => '<div data-wrap="1" id="{id}">{menu}</div>',
        'block' => '<ul  class="accordion" {style} data-level="{level}" data-categories="{categories}" data-parent="{parentid}">{sub}</ul>',
        'link' => '<li class="{open}"><div class="link {checked}"  data-cat="{catdesc}">{exhtml}<a class="lock-on {checked}" href="{uri}">{name}</a></div>{subcat}</li>'
    ];
    private $settingsopt = [
        'exhtml' => [
            'open' => '+ ',
            'close' => '- ',
            'root' => ['enable' => FALSE, 'open' => '', 'close' => ''],
            'last' => ['enable' => FALSE, 'open' => '', 'close' => ''],
        ],
        'active' => [
            'tag' => 'open',
            'anchor' => 'checked'
        ],
        'start_level' => 0,
        'generator' => 'standart',
        'baseuri' => '/catalog',
        'limit' => 4
    ];
    private $tpl_part = [];

    public function init()
    {
        parent::init();
        $this->categoriesarr = $this->categories_for_partners();
        $categories = $this->categoriesarr[0];
        $cat = $this->categoriesarr[1];
        $checks = Yii::$app->params['constantapp']['APP_CAT'];
        $this->check = Yii::$app->params['constantapp']['APP_ID'];
        $this->cat_array = $this->reformat_cat_array($categories, $cat, $checks);
        $this->startcat = $this->property['target'];
        $this->opencat = $this->property['opencat'];
        if (isset($this->property['generator'])) {
            $this->settingsopt['generator'] = $this->property['generator'];
        }
        if (isset($this->property['exhtml']['open'])) {
            $this->settingsopt['exhtml']['open'] = $this->property['exhtml']['open'];
        }
        if (isset($this->property['exhtml']['close'])) {
            $this->settingsopt['exhtml']['close'] = $this->property['exhtml']['close'];
        }
        if (isset($this->property['exhtml']['root'])) {
            $this->settingsopt['exhtml']['root'] = $this->property['exhtml']['root'];
        }
        if (isset($this->property['exhtml']['last'])) {
            $this->settingsopt['exhtml']['last'] = $this->property['exhtml']['last'];
        }
        if (isset($this->property['active']['tag'])) {
            $this->settingsopt['active']['tag'] = $this->property['active']['tag'];
        }
        if (isset($this->property['active']['anchor'])) {
            $this->settingsopt['active']['anchor'] = $this->property['active']['anchor'];
        }
        if (isset($this->property['start_level'])) {
            $this->settingsopt['start_level'] = $this->property['start_level'];
        }
        preg_match_all('/{(\w*\d*\_*)}/iu', $this->tpl['wrap'], $this->tpl_part['wrap']);
        preg_match_all('/{(\w*\d*\_*)}/iu', $this->tpl['block'], $this->tpl_part['block']);
        preg_match_all('/{(\w*\d*\_*)}/iu', $this->tpl['link'], $this->tpl_part['link']);
    }


    public function run()
    {
        parent::run();
        $id = $this->id;
        $generate = 'menuGen'.mb_convert_case($this->settingsopt['generator'], MB_CASE_TITLE);
        if(method_exists($this,$generate)){
            $menu_html = $this->tpl['wrap'];
            foreach ($this->tpl_part['wrap'][1] as $key => $value) {
                if (isset($$value)) {
                    $menu_html = str_replace('{' . $value . '}', $$value, $menu_html);
                }
            }
            $partmenu = explode('{menu}', $menu_html);
            return $partmenu[0] . $this->$generate($this->startcat, $this->settingsopt['start_level']) .$partmenu[1];
        }else{
            return '<div>Переключите меню</div>';
        }

    }

    public function menuGenStandart($parent_id = 0, $level)
    {
        if ($level > $this->settingsopt['limit']) {
            return '';
        }
        if ($this->opencat == NULL) {
            $this->opencat = [];
        }
        if (empty($this->cat_array['cat'][$parent_id])) {
            return $this->output2;
        } else {
            if ($parent_id == 0 || in_array($this->cat_array['cat'][$parent_id]['parent_id'], $this->opencat)) {
                $style = '';
            } else {
                $style = 'style="display: none;"';
            }
            $categories = $this->cat_array['cat'][$parent_id]['categories_id'];
            $parentid = $this->cat_array['cat'][$parent_id]['parent_id'];
            $menu_html = $this->tpl['block'];
            foreach ($this->tpl_part['block'][1] as $key => $value) {
                if (isset($$value)) {
                    $menu_html = str_replace('{' . $value . '}', $$value, $menu_html);
                }
            }
            $partblock = explode('{sub}', $menu_html);
            $this->output2 .= $partblock[0];
            for ($i = 0; $i < count($this->cat_array['cat'][$parent_id]); $i++) {
                if (!$this->cat_array['cat'][$parent_id][$i] == '') {
                    if (in_array($this->cat_array['cat'][$parent_id][$i]['categories_id'], $this->opencat)) {
                        $open = $this->settingsopt['active']['tag'];
                    } else {
                        $open = '';
                    }
                    $xcat = count($this->opencat) - 1;
                    if ($this->cat_array['cat'][$parent_id][$i]['categories_id'] == $this->opencat[$xcat]) {
                        $checked = $this->settingsopt['active']['anchor'];
                    } else {
                        $checked = '';
                    }
                    if ($parent_id == 0 && $this->settingsopt['exhtml']['root']['enable'] == FALSE) {
                        $exhtml = '';
                    } elseif (!$this->cat_array['cat'][$this->cat_array['cat'][$parent_id][$i]['categories_id']] && $this->settingsopt['exhtml']['last']['enable'] == FALSE) {
                        $exhtml = '';
                    } elseif (in_array($this->cat_array['cat'][$parent_id][$i]['categories_id'], $this->opencat)) {
                        if ($this->settingsopt['exhtml']['root']['enable'] == TRUE && $parent_id == 0) {
                            $open_tag = $this->settingsopt['exhtml']['root']['close'];
                        } elseif ($this->settingsopt['exhtml']['last']['enable'] == TRUE && (!$this->cat_array['cat'][$this->cat_array['cat'][$parent_id][$i]['categories_id']]) || ($level == $this->settingsopt['limit'])) {
                            $open_tag = $this->settingsopt['exhtml']['last']['close'];
                        } else {
                            $open_tag = $this->settingsopt['exhtml']['close'];
                        }
                        $exhtml = $open_tag;
                    } else {
                        if ($this->settingsopt['exhtml']['root']['enable'] == TRUE && $parent_id == 0) {
                            $open_tag = $this->settingsopt['exhtml']['root']['open'];
                        } elseif ($this->settingsopt['exhtml']['last']['enable'] == TRUE && (!$this->cat_array['cat'][$this->cat_array['cat'][$parent_id][$i]['categories_id']]) || ($level == $this->settingsopt['limit'])) {
                            $open_tag = $this->settingsopt['exhtml']['last']['open'];
                        } else {
                            $open_tag = $this->settingsopt['exhtml']['open'];
                        }
                        $exhtml = $open_tag;
                    }
                    if (Yii::$app->params['seourls'] == FALSE && !$this->categoryChpu($this->cat_array['cat'][$parent_id][$i]['categories_id']) || $this->chpu == FALSE) {
                        $uri = '?cat=' . $this->cat_array['cat'][$parent_id][$i]['categories_id'];
                    } else {
                        $uri = '/' . $this->categoryChpu($this->cat_array['cat'][$parent_id][$i]['categories_id']);
                    }
                    if (!$this->cat_array['name'][$this->cat_array['cat'][$parent_id][$i]['categories_id']]) {
                        $this->cat_array['name'][$this->cat_array['cat'][$parent_id][$i]['categories_id']] = 'NoNaMe' . $this->cat_array['cat'][$parent_id][$i]['categories_id'];
                    }
                    $name = $this->cat_array['name'][$this->cat_array['cat'][$parent_id][$i]['categories_id']];
                    $catdesc  = $this->cat_array['cat'][$parent_id][$i]['categories_id'];
                    $uri = BASEURL . $this->settingsopt['baseuri'] . $uri;
                    $menu_html = $this->tpl['link'];
                    foreach ($this->tpl_part['link'][1] as $key => $value) {
                        if (isset($$value)) {
                            $menu_html = str_replace('{' . $value . '}', $$value, $menu_html);
                        }
                    }
                    $part = explode('{subcat}', $menu_html);
                    $this->output2 .= $part[0];
                    $this->menuGenStandart($catdesc, $level + 1);
                    $this->output2 .= $part[1];
                }
            }
            $this->output2 .= $partblock[1];
        }
        return $this->output2;
    }
}