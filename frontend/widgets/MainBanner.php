<?php

namespace frontend\widgets;


use Yii;
use yii\bootstrap\Carousel;


class MainBanner extends \yii\bootstrap\Widget
{
    public $position = [
        'medium1' => [
            [
                'image' => '/images/banners/23062016_1.png',
                'referal'=> '/catalog?count=60&sfilt%5B%5D=2696 ',
            ],
            [
                'image' => '/images/banners/27062016_1.png',
                'referal'=> '/catalog?cat=2054&count=60&start_price=&end_price=1000000&prod_attr_query=&page=0&sort=0&searchword=',
            ],
        ],
        'medium2' => [
            [
                'image' => '/images/banners/23062016_2.png',
                'referal'=> '/catalog?cat=835&count=60&start_price=&end_price=1000000&prod_attr_query=&page=0&sort=0&searchword=',
            ],
            [
                'image' => '/images/banners/27062016_2.png',
                'referal'=> '/catalog?cat=1839&count=60&start_price=&end_price=1000000&prod_attr_query=&page=0&sort=0&searchword=',
            ],

        ],
        'small1' => [
            [
                'image' => '/images/banners/23062016_3.png',
                'referal'=> '/catalog?cat=1734&count=60&start_price=&end_price=1000000&prod_attr_query=&page=0&sort=0&searchword=',
            ],
            [
                'image' => '/images/banners/27062016_3.png',
                'referal'=> '/catalog?cat=1727&count=60&start_price=&end_price=1000000&prod_attr_query=&page=0&sort=0&searchword=',
            ],
        ],
        'small2' => [
            [
                'image' => '/images/banners/23062016_4.png',
                'referal'=> '/catalog?cat=1434&count=60&start_price=&end_price=1000000&prod_attr_query=&page=0&sort=0&searchword=',
            ],
            [
                'image' => '/images/banners/27062016_4.png',
                'referal'=> '/catalog?cat=1983&count=60&start_price=&end_price=1000000&prod_attr_query=&page=0&sort=0&searchword=',
            ],
        ],
        'large' => [
            [
                'image' => '/images/banners/23062016_5.png',
                'referal'=> '/catalog?cat=1787&count=60&start_price=&end_price=1000000&prod_attr_query=&page=0&sort=0&searchword=',
            ],
            [
                'image' => '/images/banners/27062016_5.png',
                'referal'=> '/catalog?cat=1911&count=60&start_price=&end_price=1000000&prod_attr_query=&page=0&sort=0&searchword=',
            ],
        ],
        'long' => [
            [
                'image' => '/images/banners/01062016_6.png',
                'referal'=> '/catalog?cat=1762&count=60&start_price=&end_price=1000000&prod_attr_query=&page=undefined&sort=0&searchword=',
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
        ]
    ];
    public function init()
    {
    ?>
        <div id="main-index">
        <?php
        echo $this->formatting_template($this->template['main'], $this->position) ;?>
        </div>
<?php
    }
    private function formatting_position($position = []){
        $result = '';
        $item = [];
        foreach ($position as $key=>$value){
            $item[] = '<a href="'.BASEURL.$value['referal'].'" >'.
                '<img src="'.$value['image'].'" >'.
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
