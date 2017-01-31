<?php

namespace frontend\widgets;


use Yii;
use yii\bootstrap\Carousel;


class GenBanners extends \yii\bootstrap\Widget
{
    const ROTATE_NONE = '';
    const ROTATE_RAND = 'random';
    const ROTATE_ROLL = 'roll';
    const IMAGE_PATH = '/images/banners/';
    const CLEAN = TRUE;
    public $utm_enable = FALSE;
    public $out = '';
    public $generator = 'standart';
    public $id = 'main-index';
    public $utm = [
        'campagin' => '',
        'source'=> 'sait_main',
        'medium'=> 'banner_main',
        'term'=> '',
        'content'=> ''
    ];
    public $custom_path = '';
    public $tpl = [
        'wrap' => '<div id="{id}" data-block="wrap-banners" class="{class}" style="{style}">{block}</div>',
        'block' => '<div data-block="block-banners" >{medium1}{small1}{large}{medium2}{small2}{long}</div>',
        'container' => '<div id="{id}"  {style}  data-position="{position}">{items}</div>',
        'positions' => [
            'medium1' => [
                'id'=>'index-card-5',
                'class'=>'data-j index-card banner-card',
                'style'=>'',
                'roll' => GenBanners::ROTATE_NONE,
                'items'=>[
                    [
                        'template'=>'<a href="{referal}"><img style="{style}" src="{image}" alt="{alt}"></a>',
                        'image' =>  'OM_26012017_1.png',
                        'referal'=> '/catalog?cat=3453',
                        'term'=> '',
                        'alttext' => '14 февраля',
                        'out' => FALSE,
                        'header' => 'Заголовок',
                        'text' => 'Подзаголовок',
                        'description' => 'Тестовый текст должен быть достаточно длинным. Может быть даже чуть длиннее. Ну и еще немножко.',
                        'button' => 'Кнопка',
                    ],
                    [
                        'template'=>'<a href="{referal}"><div>{header}</div><div>{text}</div><div>{button}</div><img style="{style}" src="{image}" alt="{alt}"></a>',
                        'image' =>  'OM_26012017_2.png',
                        'referal'=> '/catalog?cat=1987',
                        'term'=> '',
                        'alttext' => 'Полусапожки',
                        'out' => FALSE
                    ]
                ]
            ],
            'small1' => [
                'id'=>'index-card-6',
                'class'=>'data-j index-card banner-card',
                'style'=>'',
                'roll' => GenBanners::ROTATE_NONE,
                'items'=> [
                    [
                        'template'=>'<a href="{referal}"><div>{header}</div><div>{text}</div><div>{button}</div><img style="{style}" src="{image}" alt="{alt}"></a>',
                        'image' =>  'OM_26012017_3.png',
                        'referal'=> '/catalog?cat=1979',
                        'term'=> '',
                        'alttext' => 'Ботильоны',
                        'out' => FALSE
                    ]

                ]
            ],
            'large' => [
                'id'=>'index-card-3',
                'class'=>'sort data-j index-sort banner-card',
                'style'=>'',
                'roll' => GenBanners::ROTATE_NONE,
                'items'=> [
                    [
                        'template'=>'<a href="{referal}"><div>{header}</div><div>{text}</div><div>{button}</div><img style="{style}" src="{image}" alt="{alt}"></a>',
                        'image' => 'OM_26012017_5.png',
                        'referal'=> '/catalog?cat=1749',
                        'term'=> '',
                        'alttext' => 'Пальто',
                        'out' => FALSE
                    ]
                ]
            ],
            'medium2' => [
                'id'=>'index-card-5',
                'class'=>'data-j index-card banner-card',
                'style'=>'style="float:right"',
                'roll' => GenBanners::ROTATE_NONE,
                'items'=> [
                    [
                        'template'=>'<a href="{referal}"><div>{header}</div><div>{text}</div><div>{button}</div><img style="{style}" src="{image}" alt="{alt}"></a>',
                        'image' =>  'OM_26012017_2.png',
                        'referal'=> '/catalog?cat=1987',
                        'term'=> '',
                        'alttext' => 'Полусапожки',
                        'out' => FALSE
                    ]
                ]
            ],
            'small2' => [
                'id'=>'index-card-6',
                'class'=>'data-j index-card banner-card',
                'style'=>'',
                'roll' => GenBanners::ROTATE_NONE,
                'items'=> [
                    [
                        'template'=>'<a href="{referal}"><div>{header}</div><div>{text}</div><div>{button}</div><img style="{style}" src="{image}" alt="{alt}"></a>',
                        'image' => 'OM_26012017_4.png',
                        'referal'=> '/catalog?cat=1765',
                        'term'=> '',
                        'alttext' => 'Комплекты белья',
                        'out' => FALSE
                    ]
                ]
            ],
            'long' => [
                'id'=>'index-card-6',
                'class'=>'data-j index-card banner-card',
                'style'=>'style="width: calc(100% - 10px);"',
                'roll' => GenBanners::ROTATE_NONE,
                'items'=> [
                    [
                        'template'=>'<a href="{referal}"><div>{header}</div><div>{text}</div><div>{button}</div><img style="{style}" src="{image}" alt="{alt}"></a>',
                        'image' => 'OM_26012017_6.png',
                        'referal'=> '/catalog?cat=2047',
                        'alttext' => '2047',
                        'out' => FALSE
                    ]
                ]
            ]
        ]
    ];
    private $tpl_part = [];
    public function init()
    {
        preg_match_all('/{(\w*\d*\_*)}/iu', $this->tpl['wrap'], $this->tpl_part['wrap']);
        preg_match_all('/{(\w*\d*\_*)}/iu', $this->tpl['block'], $this->tpl_part['block']);
        preg_match_all('/{(\w*\d*\_*)}/iu', $this->tpl['container'], $this->tpl_part['container']);
    }
    public function run()
    {
        $generate = 'bannersGen'.mb_convert_case($this->generator, MB_CASE_TITLE);
        if(method_exists($this,$generate)){
            $id = $this->id;
            $html = $this->tpl['wrap'];
            foreach ($this->tpl_part['wrap'][1] as $key => $value) {
                if (isset($$value)) {
                    $html = str_replace('{' . $value . '}', $$value, $html);
                }elseif (self::CLEAN == TRUE && $value != 'block'){
                    $html = str_replace('{' . $value . '}', '', $html);
                }
            }
            $partmenu = explode('{block}', $html);
            return $partmenu[0] . $this->$generate() .$partmenu[1];
        }else{
            return 'Недоступный тип баннера';
        }
    }

    public function bannersGenStandart()
    {
        $this->out = '';
        $html = $this->tpl['block'];
        foreach ($this->tpl_part['block'][1] as $key => $value) {
            if (isset($this->tpl['positions'][$value])) {
                $id = $this->tpl['positions'][$value]['id'];
                $style = $this->tpl['positions'][$value]['style'];
                $position =  $value ;
                $container_html = $this->tpl['container'];
                foreach ($this->tpl_part['container'][1] as $keycont => $valuecont) {
                    if (isset($$valuecont)) {
                        $container_html = str_replace('{' . $valuecont . '}', $$valuecont, $container_html);
                    }
                }
                $partcontainer = explode('{items}', $container_html);
                $this->out .= $partcontainer[0];
                //  $this->out .= '<div id="' . $this->tpl['positions'][$value]['id'] . '"  ' . $this->tpl['positions'][$value]['style'] . '  data-position="' . $value . '">';
                $result = '';
                $item = [];
                foreach ($this->tpl['positions'][$value]['items'] as $keyr => $valuer) {
                    $refer = '';
                    $out_param = '';
                    if ($valuer['out']) {
                        $out_param = ' target="_blank" ';
                        $refer = $valuer['referal'];
                    } else {
                        $refer = BASEURL . $valuer['referal'];
                    }
                    $utm_link = '';
                    if ($this->utm_enable === TRUE) {
                        $utm['term'] = $valuer['term'];
                        $utm['content'] = $valuer['image'];
                        $utm_link = UtmLinker::widget([
                            'param' => $utm
                        ]);
                        $divider = '?';
                        if (mb_substr_count($refer, '?')) {
                            $divider = '&amp;';
                        }
                    }
                    $item_html = $valuer['template'];
                    preg_match_all('/{(\w*\d*\_*)}/iu', $item_html, $match);
                    $referal = $refer . $divider . $utm_link . '" ' . $out_param;
                    $style = "display: block;max-width: 100%;height: auto;";
                    $image = self::IMAGE_PATH . $valuer['image'];
                    $alt = $valuer['alttext'];
                    $header = $valuer['header'];
                    $text = $valuer['text'];
                    $button = $valuer['button'];
                    $description = $valuer['description'];
                    foreach ($match[1] as $keyitem => $valueitem) {
                        if (isset($$valueitem)) {
                            $item_html = str_replace('{' . $valueitem . '}', $$valueitem, $item_html);
                        } elseif (self::CLEAN == TRUE) {
                            $item_html = str_replace('{' . $valueitem . '}', '', $item_html);
                        }
                    }
                    $item[] = $item_html;

                }
                switch ($this->tpl['positions'][$value]['roll']) {
                    case self::ROTATE_ROLL : {
                        $result = Carousel::widget([
                            'items' => $item,
                            'showIndicators' => FALSE,
                            'controls' => FALSE,
                            'options' => [
                                'class' => 'slide',
                                'data-ride' => 'carousel',
                            ],
                            'clientOptions' => [
                                'interval' => 3000,
                                'pause' => 'load',

                            ]
                        ]);
                        break;
                    }
                    case self::ROTATE_RAND: {
                        $rf = shuffle($item);
                        $result = array_shift($item);
                        break;
                    }
                    default: {
                        $result = array_shift($item);
                        break;
                    }
                }
                $this->out .= $result;
                $this->out .= $partcontainer[1];
            }else {

            }
        }
        return $this->out;
    }
}
