<?php

namespace common\forms\Cat;

use Yii;
use frontend\widgets\GenBanners;
use yii\base\Model;


class CatLandConfigForm extends Model
{

    public $config_name;

    public $header_tpl;
    public $header_title;
    public $banners_tpl;
    public $images_cfg;
    public $visible_name;
    public $content_tpl;
    public $content_list_products;
    public $special_offer;

    public $footer_tpl;

    protected $path_save_pictures = '@webroot/images/cat/';
    protected $valid_formats = ["jpg", "png", "gif", "jpeg"];

    private $banners_settings = [
        'main' => [
            'name'            => 'Комби',
            'id'              => 'main',
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
        ],
        'tyu' => [
            'name'            => '4 в ряд',
            'id'              => 'tyu',
            'wrap' => '<div id="{id}" data-block="wrap-banners" class="{class}" style="{style}">{block}</div>',
            'block' => '<div data-block="block-banners" >{medium1}{medium2}{medium3}{medium4}</div>',
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
                'medium3' => [
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
                'medium4' => [
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
                ]
            ]
        ],
        'discont' =>[
            'name'            => '3 в ряд',
            'id'              => 'discont',
            'wrap' => '<div id="{id}" data-block="wrap-banners" class="{class}" style="{style}">{block}</div>',
            'block' => '<div data-block="block-banners" >{medium1}{medium2}{medium3}</div>',
            'container' => '<div id="{id}"  {style}  data-position="{position}">{items}</div>',
            'positions' => [
                'medium1' => [
                    'id'=>'index-card-7',
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
                'medium2' => [
                    'id'=>'index-card-7',
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
                'medium3' => [
                    'id'=>'index-card-7',
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
                ]
            ]
        ],
        'triple' =>[
            'name'            => '1 на всю длинну',
            'id'              => 'triple',
            'wrap' => '<div id="{id}" data-block="wrap-banners" class="{class}" style="{style}">{block}</div>',
            'block' => '<div data-block="block-banners" >{medium1}{medium2}{medium3}</div>',
            'container' => '<div id="{id}"  {style}  data-position="{position}">{items}</div>',
            'positions' => [
                'medium1' => [
                    'id'=>'index-card-6',
                    'class'=>'data-j index-card banner-card',
                    'style'=>'style="width: calc(100% - 10px);"',
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
                ]
            ]
        ],
        'nobanners' =>[
            'name'            => 'Без баннеров',
            'id'              => 'nobanners',
            'wrap' => '{block}',
            'block' => '',
            'container' => '{items}',
            'positions' => [
            ]
        ]
    ];

    public function rules()
    {
        return [
            [
                [
                    'header_tpl',
                    'visible_name',
                    'header_title',
                    'content_tpl',
                    'content_list_products',
                    'special_offer',
                    'footer_tpl',
                    'config_name',
                    'banners_tpl',
                    'images_cfg',
                ],
                'string',
            ],
            [['config_name',], 'match', 'pattern' => '/^[a-z]|[а-я][0-9]\w*$/i', 'message' => 'В url должны быть только буквы и цифры'],
            [['config_name'], 'required', 'message' => 'Обязательное поле'],
        ];
    }

    public function getPathSavePictures()
    {
        return $this->path_save_pictures;
    }

    public function storeOrUpdateConfig($config_name)
    {
        if (!$this->validate()) {
            return false;
        }
        $json_config = [
            "visible_name"     => $this->visible_name,
            "header_tpl"     => $this->header_tpl,
            "header_config"  => [
                "header_title"  => $this->header_title,
                "banner_config" => [
                    'template' => $this->getTemplate($this->banners_tpl),
                    'images'   => json_decode($this->images_cfg),
                ],
            ],
            "content_tpl"    => $this->header_tpl,
            "content_config" => [
                "content_list_products" => $this->content_list_products,
                "special_offer"         => $this->special_offer,
            ],
            "footer_tpl"     => $this->footer_tpl,
        ];
        if (!empty($config_name) && $config_name != $this->config_name) {
            unlink(\Yii::getAlias('@runtime') . '/cat/' . $config_name);
        }

        $config_file_extension = '.json';

        $file_special_offers = file_get_contents(Yii::getAlias('@frontend') . '/runtime/cat/store/special_offer' . $config_file_extension);
        $file_special_offers = (array)json_decode($file_special_offers, true);

        if (!in_array($this->special_offer, $file_special_offers)) {
            $file_special_offers[] = $this->special_offer;
        }

        if(!file_exists(Yii::getAlias('@frontend') . '/runtime/cat/store/special_offer'.$config_file_extension)) {
            if (!mkdir(Yii::getAlias('@frontend') . '/runtime/cat/store', 0777, true)) {
                Yii::$app->session->setFlash('error', 'Ошибка, данные не сохранены');

                return false;
            }
        }

        if (!file_put_contents(Yii::getAlias('@frontend') . '/runtime/cat/store/special_offer' . $config_file_extension,
            json_encode($file_special_offers))
        ) {
            Yii::$app->session->setFlash('error', 'Ошибка, данные не сохранены');

            return false;
        }

        if (file_put_contents(Yii::getAlias('@frontend') . '/runtime/cat/' . $this->config_name . $config_file_extension,
            json_encode($json_config))
        ) {
            Yii::$app->session->setFlash('success', 'Удача! Данные сохранены');

            return true;
        }

        Yii::$app->session->setFlash('error', 'Ошибка, данные не сохранены');

        return false;
    }

    public function storeOrUpdatePreviewConfig($config_name)
    {
        if (!$this->validate()) {
            return false;
        }

        $json_config = [
            "visible_name"     => $this->visible_name,
            "header_tpl"     => $this->header_tpl,
            "header_config"  => [
                "header_title"  => $this->header_title,
                "banner_config" => [
                    'template' => $this->getTemplate($this->banners_tpl),
                    'images'   => json_decode($this->images_cfg),
                ],
            ],
            "content_tpl"    => $this->header_tpl,
            "content_config" => [
                "content_list_products" => $this->content_list_products,
                "special_offer"         => $this->special_offer,
            ],
            "footer_tpl"     => $this->footer_tpl,
        ];


        Yii::$app->session->set('preview_config'. $this->config_name, json_encode($json_config));
        return true;

    }

    public function saveImages($files = [])
    {

        if (count($files) == 0) {
            return false;
        }

        $url_files = [];
        $path = Yii::getAlias($this->path_save_pictures);
        foreach ($files as $file) {

            if (!strlen($file->name)) {
                //'Неправильный формат файла..'
                return false;
                continue;
            }

            list($type_info, $type_ext) = explode('/', $file->type);

            if ($type_info != 'image' && !in_array($type_ext, $this->valid_formats)) {
                //'Неправильный формат файла..'
                return false;
                continue;
            }

            if ($file->size > (4 * 1024 * 1024)) {
                //'Максимальный размер файла 4 MB'
                return false;
                continue;
            }

            list($name, $name_ext) = explode('.', $file->name);
            $actual_image_name = md5($name) . "." . $type_ext;

            $tmp = $file->tempName;

            if (!is_file($tmp)) {
                // 'Отсутствует файл, сбой загрузки'
                return false;
                continue;
            }

            if (mkdir($path, 0777, true)) {
                return false;
                continue;
            }

            if (!move_uploaded_file($tmp, $path . $actual_image_name)) {
                // 'Ошибка сохранения'
                return false;
                continue;
            }


            $url_files[] = $actual_image_name;
        }

        return $url_files;
    }
    public function loadBannersSet()
    {
        return $this->banners_settings;

    }
    public function getTemplate($config_name = 'main')
    {
       return $this->loadBannersSet()[$config_name];

    }
    public function getTemplateList()
    {
        $result = [];
        foreach ($this->loadBannersSet() as $key=>$value){
            $result[$value['id']]['id'] = $value['id'];
            $result[$value['id']]['name'] = $value['name'];
        };
        return $result;
    }

}