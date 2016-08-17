<?php

namespace frontend\widgets;


use Yii;
use yii\bootstrap\Carousel;


class MainBanner extends \yii\bootstrap\Widget
{
    public $position = [

        'medium1' => [
            [
                'image' => '/images/banners/OM_16082016_1.png',
                'referal'=> '/catalog?cat=2548',
                'alttext' => 'Рюкзаки',
                'out' => FALSE
            ],
            [
                'image' => '/images/banners/OM_12082016_1.png',
                'referal'=> '/catalog?cat=2063',
                'alttext' => 'Расчески и аксессуары для укладки волос',
                'out' => FALSE
            ],
        ],
        'medium2' => [
            [
                'image' => '/images/banners/OM_16082016_2.png',
                'referal'=> '/catalog?cat=1693',
                'alttext' => 'Платья XXL',
                'out' => FALSE
            ],
            [
                'image' => '/images/banners/OM_12082016_2.png',
                'referal'=> '/catalog?cat=1772',
                'alttext' => 'Пижамы',
                'out' => FALSE
            ],
        ],
        'small1' => [
            [
                'image' => '/images/banners/OM_16082016_3.png',
                'referal'=> '/catalog?cat=1993',
                'alttext' => 'Туфли',
                'out' => FALSE
            ],
            [
                'image' => '/images/banners/OM_12082016_3.png',
                'referal'=> '/catalog?cat=2875',
                'alttext' => 'Книги для детей',
                'out' => FALSE
            ],
        ],
        'small2' => [
            [
                'image' => '/images/banners/OM_16082016_4.png',
                'referal'=> '/catalog?cat=2730',
                'alttext' => 'Кальяны',
                'out' => FALSE
            ],
            [
                'image' => '/images/banners/OM_12082016_4.png',
                'referal'=> '/catalog?cat=999',
                'alttext' => 'Серьги, клипсы',
                'out' => FALSE
            ],
        ],
        'large' => [
            [
                'image' => '/images/banners/OM_16082016_5.png',
                'referal'=> '/catalog?cat=1827',
                'alttext' => 'Мужские куртки',
                'out' => FALSE
            ],
            [
                'image' => '/images/banners/OM_12082016_5.png',
                'referal'=> '/catalog?cat=1720',
                'alttext' => 'Платья',
                'out' => FALSE
            ],
        ],
        'long' => [
            [
                'image' => '/images/banners/OM_16082016_6.png',
                'referal'=> '/discountproducts',
                'alttext' => 'Акционные товары!',
                'out' => FALSE
            ],
            [
                'image' => '/images/banners/OM_12082016_6.png',
                'referal'=> '/catalog?cat=2680',
                'alttext' => 'Контейнеры, боксы, коробки',
                'out' => FALSE
            ],
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
                'style'=>''
            ],
            '2' => [
                'id'=>'index-card-6',
                'class'=>'data-j index-card banner-card',
                'position'=> 'small1',
                'style'=>''
            ],
            '3' => [
                'id'=>'index-card-3',
                'class'=>'sort data-j index-sort banner-card',
                'position'=> 'large',
                'style'=>''
            ],
            '4' => [
                'id'=>'index-card-5',
                'class'=>'data-j index-card banner-card',
                'position'=> 'medium2',
                'style'=>'style="float:right"'
            ],

            '5' => [
                'id'=>'index-card-6',
                'class'=>'data-j index-card banner-card',
                'position'=> 'small2',
                'style'=>''
            ],

            '6' => [
                'id'=>'index-card-6',
                'class'=>'data-j index-card banner-card',
                'position'=> 'long',
                'style'=>'style="width: calc(100% - 10px);"'
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
    private function formatting_position($position = []){
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
                '<img src="'.$value['image'].'"  alt="'.$value['alttext'].'">'.
                '</a>';
        }
        $result =  Carousel::widget([
            'items' => $item,
            'showIndicators' => FALSE,
            'controls' => FALSE,
            'options'=>[
                'class'=>'slide',
                'data-ride' => 'carousel',
            ],
            'clientOptions'=>[
                'interval'=>5000,
                'pause'=> 'load',

            ]
        ]);
        return $result;
    }



    private function formatting_template($template = [], $position = []){
        $result = '';
        foreach ($template as $key=>$value){
            $result .=
                '<div id="'.$value['id'].'"  '.$value['style'].'  data-position="'.$key.'">'.
                $this->formatting_position($position[$value['position']]).
                '</div>';
        }
        return $result;
    }
}
