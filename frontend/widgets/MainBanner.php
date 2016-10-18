<?php

namespace frontend\widgets;


use Yii;
use yii\bootstrap\Carousel;


class MainBanner extends \yii\bootstrap\Widget
{
    const ROTATE_NONE = '';
    const ROTATE_RAND = 'random';
    const ROTATE_ROLL = 'roll';

    public $position = [

        'medium1' => [
            [
                'image' => '/images/banners/OM_07102016_1.png',
                'referal'=> '/catalog?cat=1775',
                'alttext' => 'Стильные модели',
                'out' => FALSE
            ]
        ],
        'medium2' => [
            [
                'image' => '/images/banners/OM_07102016_4.png',
                'referal'=> '/catalog?cat=1469',
                'alttext' => 'Туники',
                'out' => FALSE
            ]
        ],
        'small1' => [
            [
                'image' => '/images/banners/OM_07102016_3.png',
                'referal'=> '/catalog?cat=1987',
                'alttext' => 'Полусапожки',
                'out' => FALSE
            ]
        ],
        'small2' => [
            [
                'image' => '/images/banners/OM_07102016_2.png',
                'referal'=> '/catalog?cat=2120',
                'alttext' => 'Аксессуары для волос',
                'out' => FALSE
            ],
        ],
        'large' => [
            [
                'image' => '/images/banners/OM_07102016_5.png',
                'referal'=> '/catalog?cat=1720',
                'alttext' => 'Платья',
                'out' => FALSE
            ],
        ],
        'long' => [
            [
                'image' => '/images/banners/OM_07102016_6.png',
                'referal'=> 'https://play.google.com/store/apps/details?id=com.codegeek.omshopmobile&hl=ru',
                'alttext' => 'Все новинки',
                'out' => TRUE
            ]
        ],
        'discont1' => [
            [
                'image' => '/images/banners/B_19072016_1.png',
                'referal'=> '/product?id=902601',
                'alttext' => 'Лодка Intex 68347 Seahawk 200',
                'out' => FALSE
            ],
        ],
        'discont2' => [
            [
                'image' => '/images/banners/B_19072016_2.png',
                'referal'=> '/product?id=902491',
                'alttext' => 'Бассейн Intex 28200/56997 на опорах',
                'out' => FALSE
            ],
        ],
        'discont3' => [
            [
                'image' => '/images/banners/B_19072016_3.png',
                'referal'=> '/product?id=1461925',
                'alttext' => 'Игровой центр-бассейн',
                'out' => FALSE
            ],
        ],
        'discont4' => [
            [
                'image' => '/images/banners/B_19072016_4.png',
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
            $item[] = '<a href="'.$refer.'" '.$out_param.'>'.
                '<img style="display: block;max-width: 100%;height: auto;" src="'.$value['image'].'"  alt="'.$value['alttext'].'">'.
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
