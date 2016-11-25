<?php
use yii\bootstrap\Nav;

?>
<aside class="main-sidebar">

    <section class="sidebar">

        <!-- Sidebar user panel -->
        <!-- search form -->
        <form action="#" method="get" class="sidebar-form">
            <div class="input-group">
                <input type="text" name="q" class="form-control" placeholder="Поиск..."/>
              <span class="input-group-btn">
                <button type='submit' name='search' id='search-btn' class="btn btn-flat"><i class="fa fa-search"></i>
                </button>
              </span>
            </div>
        </form>
        <!-- /.search form -->

        <?=
        Nav::widget(
            [
                'encodeLabels' => false,
                'options' => ['class' => 'sidebar-menu'],
                'items' => [
                    '<li class="header">МЕНЮ</li>',
                    ['label' => '<i class="fa fa-dashboard"></i><span>Главная</span>', 'url' => ['/']],
                    ['label' => '<i class="fa fa-user"></i><span>Партнеры</span>', 'url' => ['/partners/default']],
                    ['label' => '<i class="fa fa-money"></i><span>Заказы</span>', 'url' => ['/orders/default']],
                    ['label' => '<i class="fa fa-male"></i><span>Пользователи</span>', 'url' => ['/users/default']],
                    ['label' => '<i class="fa fa-calendar"></i><span>Календарь</span>', 'url' => ['/calendar/default']],
                    ['label' => '<i class="fa fa-bar-chart"></i><span>Статистика</span>', 'url' => ['/statistics/default']],
                    ['label' => '<i class="fa fa-pencil"></i><span>Шаблоны</span>', 'url' => ['/template/default']],
                    ['label' => '<i class="fa fa-gears"></i><span>Настройки</span>', 'url' => ['/settings/default']],
                ],
            ]
        );
        ?>
    </section>

</aside>
