<?php
namespace frontend\modules\lk\controllers\actions;

use common\models\Customers;
use common\models\OrdersProducts;
use common\models\OrdersProductsPriten;
use common\models\PartnersProducts;
use common\models\PartnersUsersInfo;
use common\models\Profile;
use common\models\Referrals;
use common\models\User;
use common\models\Orders;
use frontend\widgets\ProductCard;
use yii;


trait ActionMenu
{
    public function actionMenu()
    {
        $lksp = '';
        if(Referrals::find()->where(['user_id'=>Yii::$app->user->getId()])->exists()){
            $lksp = '
             <ul id="accordion" class="accordion">
                            <li class="">
                                <div id="profile-orders" class="link profile-orders">
                                    <a href="/sp/">
                                        Кабинет реферала
                                    </a>
                                </div>
                            </li>
                        </ul>
        ';
        }

        return '
        <ul id="accordion" class="accordion">
                            <li class="">
                                <div id="profile-orders" class="link profile-orders">
                                    <a href="'.yii\helpers\Url::to(['viewcart']).'">
                                        Мои корзины
                                    </a>
                                </div>
                            </li>
                        </ul>
                        <ul id="accordion" class="accordion">
                            <li class="">
                                <div id="profile-orders" class="link profile-orders">
                                    <a href="'.yii\helpers\Url::to(['myorder']).'">
                                        Мои заказы
                                    </a>
                                </div>
                            </li>
                        </ul>
                        <ul id="accordion" class="accordion">
                            <li class="">
                                <div id="profile-orders" class="link profile-orders">
                                    <a href="'.yii\helpers\Url::to(['orderedproducts']).'">
                                        Мои товары
                                    </a>
                                </div>
                            </li>
                        </ul>
                        <ul id="accordion" class="accordion">
                            <li class="">
                                <div id="profile-orders" class="link profile-orders">
                                    <a href="'.yii\helpers\Url::to(['claims']).'">
                                        Мои претензии
                                    </a>
                                </div>
                            </li>
                        </ul>
                        <ul id="accordion" class="accordion">
                            <li class="">
                                <div id="profile-orders" class="link profile-orders">
                                    <a href="'.yii\helpers\Url::to(['userinfo']).'">
                                        Мои данные
                                    </a>
                                </div>
                            </li>
                        </ul>
                        '.$lksp.'
                        <ul id="accordion" class="accordion">
                            <li class="">
                                <div id="profile-orders" class="link profile-orders">
                                    <a href="'. BASEURL .'/contactform">
                                        Связь с администрацией
                                    </a>
                                </div>
                            </li>
                        </ul>
                        <ul id="accordion" class="accordion">
                            <li class="">
                                <div id="profile-call" class="link">Продолжить покупки</div>
                            </li>
                        </ul>
        ';
    }
}