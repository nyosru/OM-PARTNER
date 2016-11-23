<?php

namespace frontend\widgets;


use Yii;
use yii\bootstrap\Carousel;


class MainBanner extends \yii\bootstrap\Widget
{
    const ROTATE_NONE = '';
    const ROTATE_RAND = 'random';
    const ROTATE_ROLL = 'roll';
    const IMAGE_PATH = '/images/banners/';
    public $utm_enable = TRUE;
    public $utm = [
        'campagin' => '',
        'source'=> 'sait_main',
        'medium'=> 'banner_main',
        'term'=> '',
        'content'=> ''
    ];

    public $position = [

        'medium1' => [
            [
                'image' =>  'OM_14112016_1.png',
                'referal'=> '/catalog?searchword=&cat=1791&count=&start_price=0&end_price=3554&date_start=&date_end=&sfilt%5B%5D=2409&sfilt%5B%5D=15462&sfilt%5B%5D=16124',
                'alttext' => 'Для зимних пробежек',
                'out' => FALSE
            ]
        ],
        'medium2' => [
            [
                'image' =>  'OM_14112016_2.png',
                'referal'=> '/catalog?cat=1544',
                'alttext' => 'Зоотовары',
                'out' => FALSE
            ]
        ],
        'small1' => [
            [
                'image' =>  'OM_14112016_3.png',
                'referal'=> '/catalog?cat=2092',
                'alttext' => 'Лак для ногтей',
                'out' => FALSE
            ]
        ],
        'small2' => [
            [
                'image' => 'OM_14112016_4.png',
                'referal'=> '/catalog?searchword=&cat=1976&count=&start_price=0&end_price=6933&date_start=&date_end=&sfilt%5B%5D=2409&sfilt%5B%5D=16124&sfilt%5B%5D=15462',
                'alttext' => 'Зимние сапожки',
                'out' => FALSE
            ],
        ],
        'large' => [
            [
                'image' => 'OM_14112016_5.png',
                'referal'=> '/catalog?cat=1751',
                'alttext' => 'Ультрамодные пуховики',
                'out' => FALSE
            ],
        ],
        'long' => [
            [
                'image' => 'OM_14112016_6.png',
                'referal'=> '/catalog?cat=2393',
                'alttext' => 'Коньки',
                'out' => FALSE
            ]
        ],
        'discont1' => [
            [
                'image' => 'B_19072016_1.png',
                'referal'=> '/product?id=902601',
                'alttext' => 'Лодка Intex 68347 Seahawk 200',
                'out' => FALSE
            ],
        ],
        'discont2' => [
            [
                'image' => 'B_19072016_2.png',
                'referal'=> '/product?id=902491',
                'alttext' => 'Бассейн Intex 28200/56997 на опорах',
                'out' => FALSE
            ],
        ],
        'discont3' => [
            [
                'image' => 'B_19072016_3.png',
                'referal'=> '/product?id=1461925',
                'alttext' => 'Игровой центр-бассейн',
                'out' => FALSE
            ],
        ],
        'discont4' => [
            [
                'image' => 'B_19072016_4.png',
                'referal'=> '/product?id=1398409',
                'alttext' => 'Матрас-кровать CLASSIC DOWNY',
                'out' => FALSE
            ],
        ],
    ];

    public $template = [
        'main' => [
            '1' => [
                'id'=>'index-card-5',
                'class'=>'data-j index-card banner-card',
                'position'=> 'medium1',
                'style'=>'',
                'roll' => self::ROTATE_NONE
            ],
            '2' => [
                'id'=>'index-card-6',
                'class'=>'data-j index-card banner-card',
                'position'=> 'small1',
                'style'=>'',
                'roll' => self::ROTATE_NONE
            ],
            '3' => [
                'id'=>'index-card-3',
                'class'=>'sort data-j index-sort banner-card',
                'position'=> 'large',
                'style'=>'',
                'roll' => self::ROTATE_NONE
            ],
            '4' => [
                'id'=>'index-card-5',
                'class'=>'data-j index-card banner-card',
                'position'=> 'medium2',
                'style'=>'style="float:right"',
                'roll' => self::ROTATE_NONE
            ],

            '5' => [
                'id'=>'index-card-6',
                'class'=>'data-j index-card banner-card',
                'position'=> 'small2',
                'style'=>'',
                'roll' => self::ROTATE_NONE
            ],

            '6' => [
                'id'=>'index-card-6',
                'class'=>'data-j index-card banner-card',
                'position'=> 'long',
                'style'=>'style="width: calc(100% - 10px);"',
                'roll' => self::ROTATE_NONE
            ]
        ],
        'discont' => [
            '1' => [
                'id'=>'index-card-6',
                'class'=>'data-j index-card banner-card',
                'position'=> 'discont1',
                'style'=>''
            ],
            '2' => [
                'id'=>'index-card-6',
                'class'=>'data-j index-card banner-card',
                'position'=> 'discont2',
                'style'=>''
            ],
            '3' => [
                'id'=>'index-card-6',
                'class'=>'sort data-j index-sort banner-card',
                'position'=> 'discont3',
                'style'=>''
            ],
            '4' => [
                'id'=>'index-card-6',
                'class'=>'data-j index-card banner-card',
                'position'=> 'discont4',
                'style'=>'style="float:right"'
            ],
        ]
    ];
    public function init()
    {
        ?>
        <div id="main-index">
            <?php
            //  echo $this->formatting_template($this->template['discont'], $this->position);
            echo $this->formatting_template($this->template['main'], $this->position) ;?>
        </div>
        <?php
    }
    private function formatting_position($position = [], $roll = ''){
        $result = '';
        $item = [];
        foreach ($position as $key=>$value){
            $refer = '';
            $out_param = '';


            if($value['out']){
                $out_param = ' target="_blank" ';
                $refer = $value['referal'];
            }else{
                $refer = BASEURL.$value['referal'];
            }
            $utm_link = '';
            if($this->utm_enable === TRUE){
                $this->utm['term'] = mb_substr($refer,0,10);
                $this->utm['content'] = $value['image'];
                $utm_link = UtmLinker::widget([
                   'param'=> $this->utm
                ]);
            }
            
            $item[] = '<a href="'.$refer. '?'.$utm_link.'" '.$out_param.'>'.
                '<img style="display: block;max-width: 100%;height: auto;" src="'.self::IMAGE_PATH.$value['image'].'"  alt="'.$value['alttext'].'">'.
                '</a>';
        }
        switch($roll){
            case self::ROTATE_ROLL :{
                $result =  Carousel::widget([
                    'items' => $item,
                    'showIndicators' => FALSE,
                    'controls' => FALSE,
                    'options'=>[
                        'class'=>'slide',
                        'data-ride' => 'carousel',
                    ],
                    'clientOptions'=>[
                        'interval'=>3000,
                        'pause'=> 'load',

                    ]
                ]);
                break;
            }
            case self::ROTATE_RAND:{
                $rf = shuffle($item);
                $result =  array_shift($item);
                break;
                break;
            }
            default:{
                $result =   array_shift($item);
                break;
            }
        }
        return $result;
    }



    private function formatting_template($template = [], $position = []){
        $result = '';
        foreach ($template as $key=>$value){
            $result .=
                '<div id="'.$value['id'].'"  '.$value['style'].'  data-position="'.$key.'">'.
                $this->formatting_position($position[$value['position']], $value['roll']).
                '</div>';
        }
        return $result;
    }
}
