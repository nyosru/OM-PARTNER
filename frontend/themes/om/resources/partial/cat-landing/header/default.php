<div class="header-top-row">
    <div class="col-1">
        <div class="header-top-row__info" style="">
            <div class="header-top-row__info__date-period">
                <span>Пн - Пт 9:00 - 19:00</span>
            </div>
            <div class="header-top-row__info__phone-number">
                <span>8 800-123-45-67</span>
            </div>
            <div class="header-top-row__info__lk">
                <span class="header-top-row__info__lk__btn btn_arrow-down"><a href="<?= BASEURL ?>">Личный кабинет</a></span>
            </div>
        </div>
    </div>
</div>

<div class="o-container col-95">

    <div class="header-actions-bar">
        <div class="col-3-10" style="background: black">
            <div class="header-actions-bar__logo">
                <div class="header-actions-bar__logo__img">
                    <img src="" alt="">
                </div>
            </div>
        </div>
        <div class="col-4-10">
            <form action="<?= BASEURL ?>/catalog" style="width: 100%; height: 100%">

                <div class="header-actions-bar__search">
                    <input name="cat" value="0"
                           style="color: rgb(119, 119, 119); height: 40px; float: left; width: 65%;" type="hidden">
                    <input name="count" value="60"
                           style="color: rgb(119, 119, 119); height: 40px; float: left; width: 65%;" type="hidden">
                    <input name="searchword" class="header-actions-bar__shopping-basket__input"
                           placeholder="Введите артикул или название" type="text">
                    <div class="header-actions-bar__shopping-basket__submit">
                        <span>Найти</span>
                    </div>
                </div>
            </form>
        </div>
        <div class="col-3-10">
            <div class="header-actions-bar__shopping-basket">
                <div class="top-link-cont" style="padding: 12px 9px; float: right; text-align: right;">
                    <div style="background: rgb(255, 191, 8) none repeat scroll 0% 0%; font-size: 12px; float: right; position: relative; right: 35px;"
                         class="cart-count badge">5
                    </div>
                    <a rel="nofollow" class="top-link" href="/glavnaya/cart"><i class="fa fa-shopping-cart"
                                                                                style="font-size: 28px; color: rgb(0, 165, 161);"></i></a>
                </div>
            </div>
        </div>
    </div>

    <div class="header-nav-bar">
            <div class="header-nav-bar__list">
                <div class="header-nav-bar__list_b list_disc">
                    <a class="header-nav-bar__list_a list_a list_a-new" href="#">Новинки</a></div>
                <div class="header-nav-bar__list_b list_disc">
                    <a class="header-nav-bar__list_a list_a" href="#">Женщинам</a></div>
                <div class="header-nav-bar__list_b list_disc">
                    <a class="header-nav-bar__list_a list_a" href="#">Мужчинам</a></div>
                <div class="header-nav-bar__list_b list_disc">
                    <a class="header-nav-bar__list_a list_a" href="#">Детям</a></div>
                <div class="header-nav-bar__list_b list_disc">
                    <a class="header-nav-bar__list_a list_a" href="#">Обувь</a></div>
                <div class="header-nav-bar__list_b list_disc">
                    <a class="header-nav-bar__list_a list_a" href="#">Сумки</a></div>
                <div class="header-nav-bar__list_b list_disc">
                    <a class="header-nav-bar__list_a list_a" href="#">Аксессуары</a></div>
                <div class="header-nav-bar__list_b list_disc">
                    <a class="header-nav-bar__list_a list_a" href="#">Бижутерия и украшения</a></div>
                <div class="header-nav-bar__list_b list_disc">
                    <a class="header-nav-bar__list_a list_a" href="#">Дом и дача</a></div>
                <div class="header-nav-bar__list_b list_disc">
                    <a class="header-nav-bar__list_a list_a" href="#">Красота и здоровье</a></div>
                <div class="header-nav-bar__list_b list_disc">
                    <a class="header-nav-bar__list_a list_a" href="#">Игрушки</a></div>
                <div class="header-nav-bar__list_b list_disc">
                    <a class="header-nav-bar__list_a list_a" href="#">Спорт и туризм</a></div>
                <div class="header-nav-bar__list_b list_disc">
                    <a class="header-nav-bar__list_a list_a" href="#">Хобби и увлечения</a></div>
                <div class="header-nav-bar__list_b list_disc">
                    <a class="header-nav-bar__list_a list_a" href="#">Книги</a></div>
                <div class="header-nav-bar__list_b list_disc">
                    <a class="header-nav-bar__list_a list_a" href="#">Офис ишкола</a></div>
                <div class="header-nav-bar__list_b list_disc">
                    <a class="header-nav-bar__list_a list_a" href="#">Электроника</a></div>
                <div class="header-nav-bar__list_b list_disc">
                    <a class="header-nav-bar__list_a list_a" href="#">Автотовары</a></div>
                <div class="header-nav-bar__list_b list_disc">
                    <a class="header-nav-bar__list_a list_a" href="#">Спецодежда</a></div>
                <div class="header-nav-bar__list_b list_disc">
                    <a class="header-nav-bar__list_a list_a" href="#">Зоотовары</a></div>
                <div class="header-nav-bar__list_b list_disc">
                    <a class="header-nav-bar__list_a list_a" href="#">Бренды</a></div>
                <div class="header-nav-bar__list_b list_disc">
                    <a class="header-nav-bar__list_a list_a list_a-discount" href="#">Распродажа</a></div>
            </div>
    </div>

<!-- banner -->
<?= \frontend\widgets\MainBanner::widget($banner_config); ?>
<div class="clearfix"></div>
<!-- end banner -->

<div class="col-1 special_header_c-h2"><?= ($header_title) ?: 'Специальное предложение' ?></div>
<div class="clearfix"></div>

</div>
<div class="clearfix"></div>
