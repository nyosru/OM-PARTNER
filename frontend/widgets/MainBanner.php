<?php

namespace frontend\widgets;


use Yii;
use yii\bootstrap\Carousel;


class MainBanner extends \yii\bootstrap\Widget
{
    public $position = [
        'medium1' => [
            [
                'image' => '/images/banners/11072016_1.png',
                'referal'=> '/catalog?cat=1839&count=60&start_price=&end_price=1000000&prod_attr_query=&page=0&sort=0&searchword=',
            ],
            [
                'image' => '/images/banners/OM_14072016_1.png',
                'referal'=> '/catalog?cat=1977&count=60&start_price=&end_price=1000000&prod_attr_query=&page=0&sort=0&searchword=',
            ],
            [
                'image' => '/images/banners/04072016_1.png',
                'referal'=> '/catalog?cat=1558&count=60&start_price=&end_price=1000000&prod_attr_query=&page=0&sort=0&searchword= ',
            ],
        ],
        'medium2' => [
            [
                'image' => '/images/banners/11072016_3.png',
                'referal'=> '/catalog?cat=1714&count=60&start_price=&end_price=1000000&prod_attr_query=&page=0&sort=0&searchword=',
            ],
            [
                'image' => '/images/banners/OM_14072016_2.png',
                'referal'=> '/catalog?cat=1348&count=60&start_price=&end_price=1000000&prod_attr_query=&page=0&sort=0&searchword=',
            ],
            [
                'image' => '/images/banners/04072016_2.png',
                'referal'=> '/catalog?cat=2902&count=60&start_price=&end_price=1000000&prod_attr_query=&page=0&sort=0&searchword= ',
            ],

        ],
        'small1' => [
            [
                'image' => '/images/banners/11072016_5.png',
                'referal'=> '/catalog?cat=2449&count=60&start_price=&end_price=1000000&prod_attr_query=&page=0&sort=0&searchword=',
            ],
            [
                'image' => '/images/banners/OM_14072016_3.png',
                'referal'=> '/catalog?cat=1714&count=60&start_price=&end_price=1000000&prod_attr_query=&page=0&sort=0&searchword=',
            ],
            [
                'image' => '/images/banners/04072016_3.png',
                'referal'=> '/catalog?cat=2926&count=60&start_price=&end_price=1000000&prod_attr_query=&page=0&sort=0&searchword= ',
            ],
        ],
        'small2' => [
            [
                'image' => '/images/banners/11072016_4.png',
                'referal'=> '/catalog?cat=1549&count=60&start_price=&end_price=1000000&prod_attr_query=&page=0&sort=0&searchword=',
            ],
            [
                'image' => '/images/banners/OM_14072016_4.png',
                'referal'=> '/catalog?cat=2548&count=60&start_price=&end_price=1000000&prod_attr_query=&page=0&sort=0&searchword= ',
            ],
            [
                'image' => '/images/banners/04072016_4.png',
                'referal'=> '/catalog?cat=2008&count=60&start_price=&end_price=1000000&prod_attr_query=&page=0&sort=0&searchword= '
            ],
        ],
        'large' => [
            [
                'image' => '/images/banners/11072016_2.png',
                'referal'=> '/catalog?cat=1720&count=60&start_price=&end_price=1000000&prod_attr_query=&page=0&sort=0&searchword=',
            ],
            [
                'image' => '/images/banners/OM_14072016_5.png',
                'referal'=> '/catalog?cat=1720&count=60&start_price=&end_price=1000000&prod_attr_query=&page=0&sort=0&searchword=',
            ],
            [
                'image' => '/images/banners/04072016_5.png',
                'referal'=> '/catalog?cat=543&count=60&start_price=&end_price=1000000&prod_attr_query=&page=0&sort=0&searchword= ',
            ],
        ],
        'long' => [
            [
                'image' => '/images/banners/11072016_6.png',
                'referal'=> '/catalog?cat=1762&count=60&start_price=&end_price=1000000&prod_attr_query=&page=0&sort=0&searchword=',
            ],
            [
                'image' => '/images/banners/11072016_6.png',
                'referal'=> '/catalog?cat=1762&count=60&start_price=&end_price=1000000&prod_attr_query=&page=0&sort=0&searchword=',
            ],
            [
                'image' => '/images/banners//04072016_6.png',
                'referal'=> '/catalog?cat=2954&count=60&start_price=&end_price=1000000&prod_attr_query=&page=0&sort=0&searchword=',
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
