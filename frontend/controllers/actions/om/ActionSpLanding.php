<?php
namespace frontend\controllers\actions\om;

use common\models\PartnersCatDescription;
use common\models\ProductsSpecifications;
use frontend\models\InviteSPForm;
use frontend\widgets\Timer;
use Yii;
use common\models\PartnersProducts;
use common\models\PartnersProductsToCategories;
use yii\helpers\ArrayHelper;

trait ActionSpLanding
{
    public function actionSpLanding()
    {

        $this->layout = 'lp';
        $images = [
            [
                'image'=>'http://odezhda-master.ru/images/apix/products/e67477f1ffca4bb49174f30058ffbf30.JPG',
                'price'=>'98'
            ],
            [
                'image'=>'http://odezhda-master.ru/images/apix/products/2016/12/20/6d2574f1d31743c6b51de22ca08e3a48.jpg',
                'price'=>'112'
            ],
            [
                'image'=>'http://odezhda-master.ru/images/apix/products/0862f33539d847e5a7c5aef3f053dacf.jpg',
                'price'=>'112'
            ],
            [
                'image'=>'http://odezhda-master.ru/images/apix/products/10e3ea05c57e424a9987b9dac9f9ca87.JPG',
                'price'=>'98'
            ],
            [
                'image'=>'http://odezhda-master.ru/images/apix/products/d947ad909f5642a392de77cb98ffd2fa.JPG',
                'price'=>'126'
            ],
            [
                'image'=>'http://odezhda-master.ru/images/apix/products/257e8185dc3f43d0b1eb128d15a32499.JPG',
                'price'=>'126',

            ],
            [
                'image'=>'http://odezhda-master.ru/images/apix/products/4cdac517f3294556b4dba5d7977dad80.jpg',
                'price'=>'126'
            ],
            [
                'image'=>'http://odezhda-master.ru/images/apix/products/2017/01/10/94142207f54f432b8573b707ec53185f.jpg',
                'price'=>'140'
            ],
            [
                'image'=>'http://odezhda-master.ru/images/apix/products/2016/12/12/6d80b9143d3a44b388005eab3a4f5d71.jpg',
                'price'=>'140'
            ],
            [
                'image'=>'http://odezhda-master.ru/images/apix/products/535fd0c0f0554a6ead72cd17ac56df7a.JPG',
                'price'=>'154'
            ],
            [
                'image'=>'http://odezhda-master.ru/images/apix/products/d5d9c381a4a7498d850a646d5407e6a5.JPG',
                'price'=>'154'
            ],
            [
                'image'=>'http://odezhda-master.ru/images/apix/products/874ae0e7e8a746bbb4556da94ffe7a4b.JPG',
                'price'=>'154'
            ],
            [
                'image'=>'http://odezhda-master.ru/images/apix/products/555c3886968f45c68011dc4311e5bde5.JPG',
                'price'=>'168'
            ],
            [
                'image'=>'http://odezhda-master.ru/images/apix/products/05c1d806765141938ce4421aacb3a979.JPG',
                'price'=>'195'
            ],
            [
                'image'=>'http://odezhda-master.ru/images/apix/products/a2dc76a841244e6cadd03c33281ab51b.JPG',
                'price'=>'112'
            ],
            [
                'image'=>'http://odezhda-master.ru/images/apix/products/fd96817d06c74021947585be8a66e294.JPG',
                'price'=>'182'
            ],
            [
                'image'=>'http://odezhda-master.ru/images/apix/products/4c5e9ca896bd4cbaadf6b75e9e016bc1.JPG',
                'price'=>'280'
            ],
            [
                'image'=>'http://odezhda-master.ru/images/apix/products/2016/12/15/eb546d2b6b6e4e34aab68069e10ce1aa.jpg',
                'price'=>'322'
            ]
        ];
        $key_cache = 'fththfth45345345';
        $keys = Yii::$app->cache->buildKey($key_cache);
        if(($price_max = Yii::$app->cache->get($keys)) == FALSE) {
            $cat_arr = [1720, 1835, 1729, 1742, 1776, 1762, 1993, 835, 1275, 1983];
            $hide_man = $this->hide_manufacturers_for_partners();
            foreach ($hide_man as $value) {
                $list[] = $value['manufacturers_id'];
            }
            $hide_man = implode(',', $list);
            foreach ($cat_arr as $key => $value) {
                // Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
                $price_max[$value] = PartnersProductsToCategories::find()->select('MIN(`products_price`) as price, products.products_id as id')->JoinWith('products')->where('categories_id = ' . $value . ' and products.manufacturers_id NOT IN (' . $hide_man . ')   and products.products_quantity > 0  and products.products_price != 0     and products_status=1 and  death_reason = "" ')->asArray()->one();
                //  $price_max[$value]['prices'] = PartnersProductsToCategories::find()->select('`products_price` as price')->JoinWith('products')->where('categories_id IN (' . $cat . ') and products.manufacturers_id NOT IN (' . $hide_man . ')   and products.products_quantity > 0  and products.products_price != 0     and products_status=1 and  death_reason = "" ')->asArray()->all();
                $price_max[$value]['cat'] = $value;
                $price_max[$value] = array_merge($price_max[$value], PartnersCatDescription::find()->select('categories_name as name')->where('categories_id = ' . $value)->asArray()->one());
                $price_max[$value]['price'] = (int)$price_max[$value]['price'];
                unset($price_max[$value]['products']);
            }
            Yii::$app->cache->set($key_cache, $price_max, 86400);
        }

        $model = new InviteSPForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->InviteSp()) {
                Yii::$app->params['params']['products_mail'] = $this->NewProducts(6, 'mail_new-34', 7200);
                Yii::$app->params['params']['utm'] = [
                    'source'   => 'newom',
                    'medium'   => 'email',
                    'campaign' => 'om',
                    'content'  => 'invite-sp',
                ];
                Yii::$app->mailer->htmlLayout = 'layouts-om/html';
                Yii::$app->mailer->compose('invite-sp')
                    ->setFrom('odezhdamaster@gmail.com')
                    ->setTo($model->email)
                    ->setSubject('Приглашение в сервис  ' . $_SERVER['HTTP_HOST'])
                    ->send()
                ;
                \Yii::$app->getSession()->setFlash('success', 'Успешно отправлено');

                return $this->redirect(['sp-landing', '#' => 'inviteForm']);
            }
        }
        if ($model->errors) {
            foreach ($model->errors as $err) {
                \Yii::$app->getSession()->setFlash('error', $err);
            }

            return $this->redirect(['sp-landing', 'model' => $model, '#' => 'inviteForm']);
        }

        return $this->render('sp', ['model' => $model, 'price'=>$price_max, 'images'=>$images]);
    }

}