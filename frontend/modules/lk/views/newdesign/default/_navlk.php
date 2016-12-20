<?php
use yii\bootstrap\Nav;
$items = [
    [
        'label' => 'Мои корзины',
        'url' => '/viewcart',
    ], [
        'label' => 'Мои заказы',
        'url' => '/lk/myorder',
    ], [
        'label' => 'Мои данные',
        'url' => '/lk/userinfo',
    ], [
        'label' => 'Связь с администрацией',
        'url' => '/contactform',
    ], [
        'label' => 'Продолжить покупки',
        'url' => '/',
    ],
];
?>
<aside class="col-sm-3">
    <div class="block block-account">
        <div class="block-title">
            <?= $user['userinfo']['lastname']; ?> <?= $user['userinfo']['name']; ?>
            (id: <?= $user['userinfo']['customers_id']; ?>)<br>
            <sub><?= $user['email']; ?></sub>
        </div>
        <div class="block-content">
            <?=Nav::widget(['items'=>$items,'options'=>['class'=>false]]);?>
        </div>
    </div>
</aside>