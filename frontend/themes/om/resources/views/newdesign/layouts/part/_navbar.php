<?php
use yii\bootstrap\ActiveForm;
use frontend\widgets\NewMenuom;
$menu = [];
$menu['zhenshhinam'] = [
    [
        'id' => 1720,
        'name' => 'Платья',
        'url' => '/catalog/zhenshhinam/odezhda/platya',
        'children' => [
            'Длинные платья',
            'Вечерние платья',
            'Короткие платья',
            'Платья миди',
            'Трикотажные платья',
            'Сарафаны',
            'Вязаные платья',
            'На выпускной',
        ]
    ], [
        'id' => 1746,
        'name' => 'Верхняя одежда',
        'url' => '/catalog/zhenshhinam/odezhda/verxnyaya-odezhda',
        'children' => [
            'Шубы',
            'Жилетки',
            'Дубленки',
            'Куртки',
            'Пальто',
            'Пуховики',
            'Парки',
            'Зимние комбинезоны',
        ]
    ], [
        'id' => 1632,
        'name' => 'Блузки, кофты',
        'url' => '#',
        'children' => [
            'Блузки',
            'Рубашки',
            'Футболки и лонгсливы',
            'Майки и топы',
            'Водолазки',
            'Жакеты и пиджаки',
            'Толстовки',
            'Джемпера и кофты',
        ]
    ], [
        'id' => 1632,
        'name' => 'Брюки, юбки',
        'url' => '#',
        'children' => [
            'Брюки и шорты',
            'Комбинезоны',
            'Лосины и легинсы',
            'Джинсы',
            'Юбки',
            'Костюмы',
        ]
    ], [
        'id' => [100000,1632],
        'name' => '',
        'url' => '',
        'children' => [
            'Колготки и носки',
            'Нижнее белье',
            'Пляжная одежда',
            'Домашняя одежда',
            'Будущие мамы и кормящие',
            'Спортивная одежда',
        ]
    ],
];
$menu['muzhchinam'] = [
    [
        'id' => 1826,
        'name' => 'Верхняя одежда',
        'url' => '/catalog/muzhchinam/odezhda/verxnyaya-odezhda',
        'children' => [
            'Дубленки',
            'Куртки',
            'Пальто',
            'Жилетки',
            'Полупальто',
            'Пуховики',
            'Ветровки',
            'Парки',
        ],
    ], [
        'id' => 1859,
        'name' => 'Нижнее белье',
        'url' => '/catalog/muzhchinam/nizhnee-bele',
        'children' => [
            'Трусы',
            'Майки нательные',
            'Трико',
            'Термобелье',
            'Комплекты',
            'Эротическое белье',
            'Кальсоны',
            'Корректирующее белье',
        ],
    ], [
        'id' => 1668,
        'name' => '',
        'url' => '',
        'children' => [
            'Рубашки',
            'Рубашки поло',
            'Футболки и майки',
            'Водолазки',
            'Жакеты и пиджаки',
            'Толстовки',
            'Джемпера и кофты',
            'Комбинезоны',
        ],
    ], [
        'id' => [100195,1668,1859],
        'name' => '',
        'url' => '',
        'children' => [
            'Шорты',
            'Брюки',
            'Джинсы',
            'Спортивная одежда',
            'Домашняя одежда',
            'Плавки',
            'Носки',
            'Камуфляж',
        ],
    ],
];
$menu['detyam'] = [
    [
        'id' => 100276,
        'name' => 'Одежда',
        'url' => '/catalog/detyam/odezhda',
        'children' => [
            'Для девочек',
            'Для мальчиков',
            'Для новорожденных',
        ],
    ], [
        'id' => 100386,
        'name' => 'Колготки и носки',
        'url' => '/catalog/detyam/kolgotki-i-noski',
        'children' => [
            'Колготки',
            'Носки',
            'Гольфы',
            'Гетры',
        ],
    ], [
        'id' => [100400,100275],
        'name' => 'Нижнее белье',
        'url' => '/catalog/detyam/nizhnee-bele',
        'children' => [
            'Купальники и плавки',
            'Купальники',
            'Плавки',
        ],
    ],
];
$menu['obuv'] = [
    [
        'id' => 1976,
        'name' => 'Женская',
        'url' => '/catalog/obuv/zhenskaya',
        'children' => [
            'Туфли',
            'Босоножки',
            'Ботинки',
            'Резиновая обувь',
            'Кроссовки',
            'Полусапожки',
            'Сапоги',
            'Домашняя обувь',
        ],
    ], [
        'id' => 1996,
        'name' => 'Мужская',
        'url' => '/catalog/obuv/muzhskaya',
        'children' => [
            'Сандалии',
            'Ботинки',
            'Кроссовки',
            'Мокасины',
            'Полуботинки',
            'Резиновая обувь',
            'Сапоги',
            'Домашняя обувь',
        ],
    ], [
        'id' => 2008,
        'name' => 'Детская',
        'url' => '/catalog/obuv/detskaya',
        'children' => [
            'Для девочек',
            'Для мальчиков',
        ],
    ], [
        'id' => [1562,100526],
        'name' => 'Аксессуары',
        'url' => '/catalog/obuv/aksessuary-dlya-obuvi',
        'children' => [
            'Стельки',
            'Шнурки',
            'Ложки для обуви',
            'Сушилки',
            'Мешки для обуви',
            'Средства по уходу',
        ],
    ],
];
$menu['sumki'] = [
    [
        'label' => 'Женские',
        'url' => '/catalog/sumki/zhenskie',
    ],[
        'label' => 'Мужские',
        'url' => '/catalog/sumki/muzhskie',
    ],[
        'label' => 'Детские сумки',
        'url' => '/catalog/sumki/detskie-sumki',
    ],[
        'label' => 'Наборы сумок',
        'url' => '/catalog/sumki/nabory-sumok',
    ],[
        'label' => 'Для ноутбуков',
        'url' => '/catalog/sumki/dlya-noutbukov',
    ],[
        'label' => 'Дорожные сумки',
        'url' => '/catalog/sumki/dorozhnye-sumki',
    ],[
        'label' => 'Спортивные сумки',
        'url' => '/catalog/sumki/sportivnye-sumki',
    ],[
        'label' => 'Хозяйственные сумки',
        'url' => '/catalog/sumki/xozyajstvennye-sumki',
    ],
];
$menu['aksessuary'] = [
    [
        'id' => 100671,
        'name' => 'Женские',
        'url' => '/catalog/aksessuary/zhenskie',
        'children' => [
            'Платки, шарфы, палантины',
            'Головные уборы',
            'Перчатки и варежки',
            'Аксессуары для волос',
            'Солнцезащитные очки',
            'Часы и ремешки',
            'Ремни и пояса',
            'Кошельки и портмоне',
        ],
    ],[
        'id' => 100713,
        'name' => 'Мужские',
        'url' => '/catalog/aksessuary/muzhskie',
        'children' => [
            'Шарфы и платки',
            'Головные уборы',
            'Солнцезащитные очки',
            'Часы и ремешки',
            'Перчатки и варежки',
            'Ремни и подтяжки',
            'Кошельки и портмоне',
            'Галстуки и бабочки',
        ],
    ],[
        'id' => 1906,
        'name' => 'Детские',
        'url' => '/catalog/aksessuary/detskie',
        'children' => [
            'Головные уборы',
            'Шарфы',
            'Часы и ремешки',
            'Зонты',
            'Перчатки и варежки',
            'Кошельки',
            'Аксессуары для волос',
            'Носовые платки',
        ],
    ],[
        'id' => 932,
        'name' => 'Разное',
        'url' => '#',
        'children' => [
            'Зонты',
            'Ключницы',
            'Монетницы',
            'Обложки для документов',
            'Визитницы',
            'Платки носовые',
            'Папки из кожи',
        ],
    ],[
        'id' => 1549,
        'name' => 'Украшения, бижутерия',
        'url' => '/catalog/ukrasheniya-bizhuteriya',
        'children' => [
            'Гарнитуры',
            'Татуировки и пирсинг',
            'Броши',
            'Браслеты',
            'Серьги, клипсы',
            'Кольца и перстни',
            'Детская бижутерия',
            'Бусы, колье, ожерелье',
        ],
    ],
];
$menu[0] = [
    [
        'id' => 0,
        'name' => '',
        'url' => '',
        'children' => [
            'Дом и дача',
            'Игрушки, сувениры',
            'Спорт, туризм',
            'Хобби, увлечение',
        ],
    ],[
        'id' => 0,
        'name' => '',
        'url' => '',
        'children' => [
            'Книги',
            'Офис и школа',
            'Электроника',
            'Автотовары',
        ],
    ],[
        'id' => 0,
        'name' => '',
        'url' => '',
        'children' => [
            'Спецодежда',
            'Зоотовары',
            'Строительные инструменты',
            'Бытовая техника',
        ],
    ],
];
$menu['stock'] = [
    [
        'label' => 'Новинки одежды',
        'url' => '#',
        'img' => '/images/new/menu_man_sunglass.png',
    ],[
        'label' => 'Новинки обуви',
        'url' => '#',
        'img' => '/images/new/menu_man_sunglass.png',
    ],[
        'label' => 'Другие новинки',
        'url' => '#',
        'img' => '/images/new/menu_man_sunglass.png',
    ],[
        'label' => 'Скидки',
        'url' => '#',
        'img' => '/images/new/menu_man_sunglass.png',
    ],
];

?>
<!-- Navbar -->
<nav>
    <div class="container">
        <div class="row">
            <div class="mm-toggle-wrap">
                <div class="mm-toggle"><i class="icon-reorder"></i><span class="mm-label">Menu</span> </div>
            </div>
            <div class="nav-inner col-lg-12">
                <ul id="nav" class="hidden-xs">
                    <li class="mega-menu">
                        <a href="/catalog/zhenshhinam" class="level-top"><span>Женщинам</span></a>
                        <div class="level0-wrapper dropdown-6col">
                            <div class="container">
                                <div class="level0-wrapper2">
                                    <div class="nav-block nav-block-center">
                                        <ul class="level0">
                                            <?php foreach($menu['zhenshhinam'] as $item){ ?>
                                                <li class="<?=empty($item['name'])?'li2':'';?>">
                                                    <?php if(!empty($item['name'])) { ?>
                                                        <a href="<?=$item['url']?>"><span><?=$item['name']?></span></a>
                                                    <?php } ?>
                                                    <?php if(!empty($item['children'])) { ?>
                                                        <ul class="<?=empty($item['name'])?'bold-ul':'';?>">
                                                            <?= NewMenuom::widget([
                                                                'chpu' =>Yii::$app->params['seourls'],
                                                                'property' => [
                                                                    'target' => $item['id'],
                                                                    'allow' => $item['children'],
                                                                    'type' => 'top-menu'
                                                                ]
                                                            ]); ?>
                                                        </ul>
                                                    <?php } ?>
                                                </li>
                                            <?php } ?>
                                        </ul>
                                    </div>
                                    <div class="nav-add">
                                        <div class="push_item">
                                            <div class="push_img"><a href="#"><img alt="sunglass" src="/images/new/menu_man_sunglass.png"></a></div>
                                        </div>
                                        <div class="push_item">
                                            <div class="push_img"><a href="#"><img alt="watch" src="/images/new/menu_man_sunglass.png"></a></div>
                                        </div>
                                        <div class="push_item">
                                            <div class="push_img"><a href="#"><img alt="jeans" src="/images/new/menu_man_sunglass.png"></a></div>
                                        </div>
                                        <div class="push_item push_item_last">
                                            <div class="push_img"><a href="#"><img alt="shoes" src="/images/new/menu_man_sunglass.png"></a></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </li>
                    <li class="mega-menu">
                        <a href="/catalog/muzhchinam" class="level-top"><span>Мужчинам</span></a>
                        <div class="level0-wrapper dropdown-6col">
                            <div class="container">
                                <div class="level0-wrapper2">
                                    <div class="col-1">
                                        <div class="nav-block nav-block-center">
                                            <ul class="level0">
                                                <?php foreach($menu['muzhchinam'] as $item){ ?>
                                                    <li>
                                                        <?php if(!empty($item['name'])) { ?>
                                                            <a href="<?=$item['url']?>"><span><?=$item['name']?></span></a>
                                                        <?php } ?>
                                                        <?php if(!empty($item['children'])) { ?>
                                                            <ul class="<?=empty($item['name'])?'bold-ul':'';?>">
                                                                <?= NewMenuom::widget([
                                                                    'chpu' =>Yii::$app->params['seourls'],
                                                                    'property' => [
                                                                        'target' => $item['id'],
                                                                        'allow' => $item['children'],
                                                                        'type' => 'top-menu'
                                                                    ]
                                                                ]); ?>
                                                            </ul>
                                                        <?php } ?>
                                                    </li>
                                                <?php } ?>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="col-2">
                                        <div class="menu_image"><a href="#" title=""><img src="/images/new/menu_image.jpg" alt="menu_image"></a></div>
                                        <div class="menu_image1"><a href="#" title=""><img src="/images/new/menu_image.jpg" alt="menu_image"></a></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </li>
                    <li class="mega-menu">
                        <a class="level-top" href="/catalog/detyam"><span>Детям</span></a>
                        <div class="level0-wrapper dropdown-6col">
                            <div class="container">
                                <div class="level0-wrapper2">
                                    <div class="nav-block nav-block-center grid12-8 itemgrid itemgrid-4col">
                                        <ul class="level0">
                                            <?php foreach($menu['detyam'] as $item){ ?>
                                                <li>
                                                    <?php if(!empty($item['name'])) { ?>
                                                        <a href="<?=$item['url']?>"><span><?=$item['name']?></span></a>
                                                    <?php } ?>
                                                    <?php if(!empty($item['children'])) { ?>
                                                        <ul>
                                                            <?= NewMenuom::widget([
                                                                'chpu' =>Yii::$app->params['seourls'],
                                                                'property' => [
                                                                    'target' => $item['id'],
                                                                    'allow' => $item['children'],
                                                                    'type' => 'top-menu'
                                                                ]
                                                            ]); ?>
                                                        </ul>
                                                    <?php } ?>
                                                </li>
                                            <?php } ?>
                                        </ul>
                                    </div>
                                    <div class="nav-block nav-block-right std grid12-4">
                                        <a href="#"><img src="/images/new/menu_furniture_2.png" alt="furniture"></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </li>
                    <li class="mega-menu">
                        <a class="level-top" href="/catalog/bolshie-razmery"><span>Большие размеры</span></a>
                        <div class="level0-wrapper dropdown-6col">
                            <div class="container">
                                <div class="level0-wrapper2">
                                    <div class="nav-block">
                                        <div class="row" style="width: 100%;">
                                            <div class="col-xs-6">
                                                <a href="/catalog/bolshie-razmery/zhenskaya"><img style="width: 100%;" src="/images/new/menu_furniture_2.png" alt="furniture"></a>
                                            </div>
                                            <div class="col-xs-6">
                                                <a href="/catalog/bolshie-razmery/muzhskaya"><img style="width: 100%;" src="/images/new/menu_furniture_2.png" alt="furniture"></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </li>
                    <li class="mega-menu">
                        <a class="level-top" href="/catalog/obuv"><span>Обувь</span></a>
                        <div class="level0-wrapper dropdown-6col">
                            <div class="container">
                                <div class="level0-wrapper2">
                                    <div class="col-1">
                                        <div class="nav-block nav-block-center">
                                            <ul class="level0">
                                                <?php foreach($menu['obuv'] as $item){ ?>
                                                    <li>
                                                        <?php if(!empty($item['name'])) { ?>
                                                            <a href="<?=$item['url']?>"><span><?=$item['name']?></span></a>
                                                        <?php } ?>
                                                        <?php if(!empty($item['children'])) { ?>
                                                            <ul>
                                                                <?= NewMenuom::widget([
                                                                    'chpu' =>Yii::$app->params['seourls'],
                                                                    'property' => [
                                                                        'target' => $item['id'],
                                                                        'allow' => $item['children'],
                                                                        'type' => 'top-menu'
                                                                    ]
                                                                ]); ?>
                                                            </ul>
                                                        <?php } ?>
                                                    </li>
                                                <?php } ?>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="col-2">
                                        <div class="menu_image"><a href="#" title=""><img src="/images/new/menu_image.jpg" alt="menu_image"></a></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </li>
                    <li class="mega-menu">
                        <a href="/catalog/sumki" class="level-top"><span>Сумки</span></a>
                        <div class="level0-wrapper dropdown-6col">
                            <div class="container">
                                <div class="level0-wrapper2">
                                    <div class="nav-add">
                                        <?php foreach($menu['sumki'] as $item){ ?>
                                            <div class="push_item" style="margin-bottom: 10px;">
                                                <div class="push_img">
                                                    <a href="<?=$item['url']?>">
                                                        <img alt="<?=$item['label']?>" src="/images/new/menu_man_sunglass.png">
                                                    </a>
                                                </div>
                                            </div>
                                        <?php } ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </li>
                    <li class="mega-menu">
                        <a href="/catalog/aksessuary" class="level-top"><span>Аксессуары</span></a>
                        <div class="level0-wrapper dropdown-6col">
                            <div class="container">
                                <div class="level0-wrapper2">
                                    <div class="nav-block nav-block-center grid5">
                                        <ul class="level0">
                                            <?php foreach($menu['aksessuary'] as $item){ ?>
                                                <li>
                                                    <?php if(!empty($item['name'])) { ?>
                                                        <a href="<?=$item['url']?>"><span><?=$item['name']?></span></a>
                                                    <?php } ?>
                                                    <?php if(!empty($item['children'])) { ?>
                                                        <ul>
                                                            <?= NewMenuom::widget([
                                                                'chpu' =>Yii::$app->params['seourls'],
                                                                'property' => [
                                                                    'target' => $item['id'],
                                                                    'allow' => $item['children'],
                                                                    'type' => 'top-menu'
                                                                ]
                                                            ]); ?>
                                                        </ul>
                                                    <?php } ?>
                                                </li>
                                            <?php } ?>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </li>
                    <li class="mega-menu">
                        <a class="level-top" href="#"><span>Разное</span></a>
                        <div class="level0-wrapper dropdown-6col">
                            <div class="container">
                                <div class="level0-wrapper2">
                                    <div class="nav-block nav-block-center grid12-8 itemgrid itemgrid-4col">
                                        <ul class="level0">
                                            <?php foreach($menu[0] as $item){ ?>
                                                <li>
                                                    <?php if(!empty($item['name'])) { ?>
                                                        <a href="<?=$item['url']?>"><span><?=$item['name']?></span></a>
                                                    <?php } ?>
                                                    <?php if(!empty($item['children'])) { ?>
                                                        <ul class="<?=empty($item['name'])?'bold-ul':'';?>">
                                                            <?= NewMenuom::widget([
                                                                'chpu' =>Yii::$app->params['seourls'],
                                                                'property' => [
                                                                    'target' => $item['id'],
                                                                    'allow' => $item['children'],
                                                                    'type' => 'top-menu'
                                                                ]
                                                            ]); ?>
                                                        </ul>
                                                    <?php } ?>
                                                </li>
                                            <?php } ?>
                                        </ul>
                                    </div>
                                    <div class="nav-block nav-block-right std grid12-4">
                                        <a href="#"><img src="/images/new/menu_furniture_2.png" alt="furniture"></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </li>
                    <li class="nav-custom-link mega-menu">
                        <a class="level-top" href="#"><span>Акции</span></a>
                        <div class="level0-wrapper custom-menu">
                            <div class="header-nav-dropdown-wrapper clearer">
                                <?php foreach($menu['stock'] as $item){ ?>
                                    <div class="grid12-3">
                                        <h4 class="heading"><?=$item['label']?></h4>
                                        <a href="<?=$item['url']?>">
                                            <img style="width: 100%;" src="<?=$item['img']?>" alt="<?=$item['label']?>">
                                        </a>
                                    </div>
                                <?php } ?>
                                <br>
                            </div>
                        </div>
                    </li>
                </ul>
                <!-- Search-col -->
                <div class="search-box pull-right">
                    <?php
                    if (Yii::$app->controller->action->id == 'discont' ||
                        Yii::$app->controller->action->id == 'dayproduct' ||
                        Yii::$app->controller->action->id == 'productsmonth' ||
                        Yii::$app->controller->action->id == 'productscloth') {
                    ?>
                        <?php ActiveForm::begin(['action'=>'/'.Yii::$app->controller->action->id,'method'=>'get'])?>
                            <input class="search" autocomplete="off" type="text" placeholder="Введите артикул или название" maxlength="70" name="searchword" id="search">
                            <button type="submit" class="search-btn-bg"><span class="glyphicon glyphicon-search"></span>&nbsp;</button>
                            <button type="button" class="search-btn-bg hide search-button-toggle" data-toggle="tooltip" data-placement="top" title="Общий поиск"><span class="glyphicon glyphicon-globe"></span>&nbsp;</button>
                            <button type="button" class="search-btn-bg search-button-toggle" data-category="<?=Yii::$app->controller->action->id?>" data-toggle="tooltip" data-placement="top" title="Поиск внутри текущей категории"><span class="glyphicon glyphicon-screenshot"></span>&nbsp;</button>
                        <?php ActiveForm::end();?>
                    <?php } else { ?>
                        <?php ActiveForm::begin(['action'=>'/catalog/','method'=>'get'])?>
                        <input class="search" autocomplete="off" type="text" placeholder="Введите артикул или название" maxlength="70" name="searchword" id="search">
                        <button type="submit" class="search-btn-bg"><span class="glyphicon glyphicon-search"></span>&nbsp;</button>
                        <?php ActiveForm::end();?>
                    <?php } ?>
                </div>
                <!-- End Search-col -->

            </div>
        </div>
    </div>
</nav>
<!-- end nav -->