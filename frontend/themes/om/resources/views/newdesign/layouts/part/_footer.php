<?php
use yii\bootstrap\Nav;
$links = [
    [
        'name' => 'О магазине',
        'ul' => [
            [
                'label' => 'О нас',
                'url' => '#',
            ],[
                'label' => 'Как сделать заказ',
                'url' => '#',
            ],[
                'label' => 'Процесс сборки заказа',
                'url' => '#',
            ],[
                'label' => 'Оплата',
                'url' => '#',
            ],[
                'label' => 'Доставка',
                'url' => '#',
            ],[
                'label' => 'Гарантии, обмен, возврат',
                'url' => '#',
            ],[
                'label' => 'Расписание работы магазина',
                'url' => '#',
            ],[
                'label' => 'Пиктограммы на карточках товаров',
                'url' => '#',
            ],[
                'label' => 'Контакты',
                'url' => '#',
            ],
        ],
    ],[
        'name' => 'Информация',
        'ul' => [
            [
                'label' => 'Отзывы',
                'url' => '#',
            ],[
                'label' => 'Организаторам совместных покупок',
                'url' => '#',
            ],[
                'label' => 'Скачать прайс-лист',
                'url' => '#',
            ],[
                'label' => 'Размерная сетка',
                'url' => '#',
            ],[
                'label' => 'Наши модели',
                'url' => '#',
            ],[
                'label' => 'Частые вопросы',
                'url' => '#',
            ],[
                'label' => 'Заявка на сотрудничество',
                'url' => '#',
            ],
        ],
    ],[
        'name' => 'Разделы сайта',
        'ul' => [
            [
                'label' => 'Распродажа',
                'url' => '#',
            ],[
                'label' => 'Новинки дня',
                'url' => '#',
            ],[
                'label' => 'Все новинки',
                'url' => '#',
            ],[
                'label' => 'Все скидки',
                'url' => '#',
            ],[
                'label' => 'Бренды',
                'url' => '#',
            ],[
                'label' => 'Все категории',
                'url' => '#',
            ],
        ],
    ],
];
?>
<!-- Footer -->
<footer>
    <div class="footer-inner">
        <div class="container">
            <div class="row">
                <div class="col-sm-12 col-xs-12 col-lg-8">
                    <?php foreach($links as $link){ ?>
                        <div class="footer-column pull-left">
                            <h4><?=$link['name']?></h4>
                            <ul class="links">
                            <?php foreach($link['ul'] as $li) {?>
                                <li><a href="<?=$li['url']?>" title="<?=$li['label']?>"><?=$li['label']?></a></li>
                            <?php } ?>
                            </ul>
                        </div>
                    <?php } ?>
                </div>
                <div class="col-xs-12 col-lg-4">
                    <div class="footer-column-last">
                        <div class="newsletter-wrap">
                            <h4>Sign up for emails</h4>
                            <form id="newsletter-validate-detail" method="post" action="#">
                                <div id="container_form_news">
                                    <div id="container_form_news2">
                                        <input type="text" class="input-text required-entry validate-email" value="Enter your email address" onFocus=" this.value='' " title="Sign up for our newsletter" id="newsletter" name="email">
                                        <button class="button subscribe" title="Subscribe" type="submit"><span>Subscribe</span></button>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="social">
                            <h4>Подпишитесь на нас</h4>
                            <ul class="link">
                                <li class="vk pull-left"><a href="#"></a></li>
                                <li class="ok pull-left"><a href="#"></a></li>
                                <li class="fb pull-left"><a href="#"></a></li>
                                <li class="in pull-left"><a href="#"></a></li>
                            </ul>
                        </div>
                        <div class="payment-accept">
                            <div><img src="/images/new/payment-1.png" alt="payment1"> <img src="/images/new/payment-2.png" alt="payment2"> <img src="/images/new/payment-3.png" alt="payment3"> <img src="/images/new/payment-4.png" alt="payment4"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="footer-middle">
        <div class="container">
            <div class="row">
                <div><img src="/images/logo/logo-om-new.png" alt=""></div>
                <address>
                    <i class="icon-location-arrow"></i> 123 Main Street, Anytown, CA 12345  USA <i class="icon-mobile-phone"></i><span> +(408) 394-7557</span> <i class="icon-envelope"></i><span> abc@magikcommerce.com</span>
                </address>
            </div>
        </div>
    </div>
</footer>
<!-- End Footer -->