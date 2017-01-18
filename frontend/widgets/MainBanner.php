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
    public $utm_enable = FALSE;
    public $utm = [
        'campagin' => '',
        'source'=> 'sait_main',
        'medium'=> 'banner_main',
        'term'=> '',
        'content'=> ''
    ];

    public $banners = [
        'top-banner' => [
            [
                'image' =>  'OM_14122016_1.png',
                'referal'=> '/catalog?cat=1729',
                'term'=> '',
                'alttext' => 'Нарядный образ на работу',
                'out' => FALSE
            ], [
                'image' =>  'OM_14122016_2.png',
                'referal'=> '/product?id=1774488',
                'term'=> '',
                'alttext' => 'Уютные кофточки',
                'out' => FALSE
            ], [
                'image' =>  'OM_14122016_1.png',
                'referal'=> '/catalog?cat=1729',
                'term'=> '',
                'alttext' => 'Нарядный образ на работу',
                'out' => FALSE
            ],
        ],
        'top-slider' => [
            [
                'image' => 'OM_14122016_5.png',
                'referal'=> '/catalog?cat=1725',
                'term'=> '',
                'alttext' => 'В новый год на корпоратив',
                'out' => FALSE
            ], [
                'image' =>  'OM_14122016_2.png',
                'referal'=> '/product?id=1774488',
                'term'=> '',
                'alttext' => 'Уютные кофточки',
                'out' => FALSE
            ], [
                'image' =>  'OM_14122016_1.png',
                'referal'=> '/catalog?cat=1729',
                'term'=> '',
                'alttext' => 'Нарядный образ на работу',
                'out' => FALSE
            ],
        ],
        'offer-slider' => [
            [
                'h1' => 'Заголовок',
                'h2' => 'Подзаголовок',
                'p' => 'Тестовый текст должен быть достаточно длинным. Может быть даже чуть длиннее. Ну и еще немножко.',
                'button' => 'Кнопка',
                'referal'=> '/catalog?cat=1725',
                'out' => FALSE
            ], [
                'h1' => 'Hello hotness!',
                'h2' => 'Summer collection',
                'p' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut non libero magna. Sed et quam lacus.
                    Fusce condimentum eleifend enim a feugiat.',
                'button' => 'View More',
                'referal'=> '/catalog?cat=1725',
                'out' => FALSE
            ],
        ],
        'social' => [
            [
                'image' =>  'OM_14122016_1.png',
                'referal'=> 'http://vk.com/',
                'alttext' => 'ВК',
            ], [
                'image' =>  'OM_14122016_1.png',
                'referal'=> 'http://fb.com/',
                'alttext' => 'FB',
            ], [
                'image' =>  'OM_14122016_1.png',
                'referal'=> 'http://tw.com/',
                'alttext' => 'TW',
            ], [
                'image' =>  'OM_14122016_1.png',
                'referal'=> 'http://ok.com/',
                'alttext' => 'OK',
            ],
        ],
        'category-slider' => [
            [
                'image' => 'OM_14122016_6.png',
                'referal'=> '/catalog?cat=1725',
                'term'=> '',
                'alttext' => 'В новый год на корпоратив',
                'out' => FALSE
            ], [
                'image' => 'OM_14122016_6.png',
                'referal'=> '/product?id=1774488',
                'term'=> '',
                'alttext' => 'Уютные кофточки',
                'out' => FALSE
            ], [
                'image' => 'OM_14122016_6.png',
                'referal'=> '/catalog?cat=1729',
                'term'=> '',
                'alttext' => 'Нарядный образ на работу',
                'out' => FALSE
            ],
        ],
    ];

    public $position = [

        'medium1' => [
            [
                'image' =>  'OM_16012017_1.png',
                'referal'=> '/catalog?cat=1725',
                'term'=> '',
                'alttext' => 'Короткие платья',
                'out' => FALSE
            ]
        ],
        'medium2' => [
            [
                'image' =>  'OM_16012017_2.png',
                'referal'=> '/catalog?cat=1731',
                'term'=> '',
                'alttext' => 'Туники',
                'out' => FALSE
            ]
        ],
        'small1' => [
            [
                'image' =>  'OM_16012017_3.png',
                'referal'=> '/catalog?cat=1751',
                'term'=> '',
                'alttext' => 'Зимние куртки и пуховики',
                'out' => FALSE
            ]
        ],
        'small2' => [
            [
                'image' => 'OM_16012017_4.png',
                'referal'=> '/catalog?cat=1574',
                'term'=> '',
                'alttext' => 'Куклы и мягкие игрушки',
                'out' => FALSE
            ],
        ],
        'large' => [
            [
                'image' => 'OM_16012017_5.png',
                'referal'=> '/catalog?cat=1729',
                'term'=> '',
                'alttext' => 'Блузы',
                'out' => FALSE
            ],
        ],
        'long' => [
            [
                'image' => 'OM_16012017_6.png',
                'referal'=> '/products-discount',
                'alttext' => 'Скидки для всех',
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

    }
    public function run()
    {
        if(gettype($this->template) == 'string'){
            return $this->render('main-banner/'.$this->template,[
                'banners' => $this->banners[$this->template],
            ]);
        }
        return $this->render('main-banner/default',[
            'template'=>$this->template['main'],
            'position'=> $this->position,
            'ROTATE_NONE' => self::ROTATE_NONE,
            'ROTATE_RAND' => self::ROTATE_RAND,
            'ROTATE_ROLL' => self::ROTATE_ROLL,
            'IMAGE_PATH' => self::IMAGE_PATH,
            'utm_enable' => $this->utm_enable,
            'utm' => $this->utm,
        ]);
    }
}
