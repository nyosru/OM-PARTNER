<?php

namespace frontend\widgets;


use Yii;
use yii\bootstrap\Carousel;


class MainBanner extends \yii\bootstrap\Widget
{
    public $position = [
        'medium1' => [
            [
                'image' => '/images/banners/OM_02082016_1.png',
                'referal'=> '/catalog?cat=835&count=60&start_price=&end_price=1000000&prod_attr_query=&page=0&sort=0&searchword=',
                'alttext' => 'Блузы',
                'out' => FALSE
            ],
        ],
        'medium2' => [
            [
                'image' => '/images/banners/OM_02082016_2.png',
                'referal'=> '/catalog?cat=1984&count=60&start_price=&end_price=1000000&prod_attr_query=&page=0&sort=0&searchword=',
                'alttext' => 'Парфюмерия',
                'out' => FALSE
            ],
        ],
        'small1' => [
            [
                'image' => '/images/banners/OM_02082016_3.png',
                'referal'=> 'http://new.odezhda-master.ru/catalog?cat=1980&count=60&start_price=&end_price=1000000&prod_attr_query=&page=0&sort=0&searchword=',
                'alttext' => 'Книги для детей',
                'out' => FALSE
            ],
        ],
        'small2' => [
            [
                'image' => '/images/banners/OM_02082016_4.png',
                'referal'=> '/catalog?cat=2493&count=60&start_price=&end_price=1000000&prod_attr_query=&page=0&sort=0&searchword=',
                'alttext' => 'Комбинезоны',
                'out' => FALSE
            ],
        ],
        'large' => [
            [
                'image' => '/images/banners/OM_02082016_5.png',
                'referal'=> '/catalog?cat=1911&count=60&start_price=&end_price=1000000&prod_attr_query=&page=0&sort=0&searchword=',
                'alttext' => 'Одежда Мастер',
                'out' => FALSE
            ],
        ],
        'long' => [
            [
                'image' => '/images/banners/OM_02082016_6.png',
                'referal'=> '/catalog?cat=2112&count=60&start_price=&end_price=1000000&prod_attr_query=&page=0&sort=0&searchword=',
                'alttext' => 'Зоотовары',
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
