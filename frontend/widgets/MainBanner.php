<?php

namespace frontend\widgets;


use Yii;
use yii\bootstrap\Carousel;


class MainBanner extends \yii\bootstrap\Widget
{
    public $position = [
        'medium1' => [
            [
                'image' => '/images/banners/O_2807201_1.png',
                'referal'=> '/catalog?cat=0&count=60&start_price=0&end_price=1000000&prod_attr_query=0&searchword=электрическая%2Bпилка',
                'alttext' => 'Электрическая пилка '
            ],
        ],
        'medium2' => [
            [
                'image' => '/images/banners/O_2807201_2.png',
                'referal'=> '/catalog?cat=0&count=60&start_price=0&end_price=1000000&prod_attr_query=0&searchword=tangle%2Bteezer',
                'alttext' => 'Tangle Teezer'
            ],
        ],
        'small1' => [
            [
                'image' => '/images/banners/O_2807201_3.png',
                'referal'=> '/catalog?cat=1720&count=60&start_price=&end_price=1000000&prod_attr_query=&page=0&sort=0&searchword=',
                'alttext' => 'Платья'
            ],
        ],
        'small2' => [
            [
                'image' => '/images/banners/O_2807201_4.png',
                'referal'=> '/catalog?cat=1574&count=60&start_price=&end_price=1000000&prod_attr_query=&page=0&sort=0&searchword=',
                'alttext' => 'Куклы и мягкие игрушки'
            ],
        ],
        'large' => [
            [
                'image' => '/images/banners/O_2807201_5.png',
                'referal'=> '/catalog?cat=2884&count=60&start_price=&end_price=1000000&prod_attr_query=&page=0&sort=0&searchword=',
                'alttext' => 'Офис и школа'
            ],
        ],
        'long' => [
            [
                'image' => '/images/banners/O_2807201_6.png',
                'referal'=> '/catalog?cat=1978&count=60&start_price=&end_price=1000000&prod_attr_query=&page=0&sort=0&searchword=',
                'alttext' => 'Босоножки, сандалии'
            ],
        ],
        'discont1' => [
            [
                'image' => '/images/banners/B_19072016_1.png',
                'referal'=> '/product?id=902601',
                'alttext' => 'Лодка Intex 68347 Seahawk 200'
            ],
        ],
        'discont2' => [
            [
                'image' => '/images/banners/B_19072016_2.png',
                'referal'=> '/product?id=902491',
                'alttext' => 'Бассейн Intex 28200/56997 на опорах'
            ],
        ],
        'discont3' => [
            [
                'image' => '/images/banners/B_19072016_3.png',
                'referal'=> '/product?id=1461925',
                'alttext' => 'Игровой центр-бассейн'
            ],
        ],
        'discont4' => [
            [
                'image' => '/images/banners/B_19072016_4.png',
                'referal'=> '/product?id=1398409',
                'alttext' => 'Матрас-кровать CLASSIC DOWNY'
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
            $item[] = '<a href="'.BASEURL.$value['referal'].'" >'.
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
                'interval'=>1000000000,
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
