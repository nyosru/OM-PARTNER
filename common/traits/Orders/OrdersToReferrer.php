<?php
namespace common\traits\Orders;

use common\models\AdminCompaniesBank;
use common\models\AdminCompaniesBankToOrders;
use common\models\Configuration;
use common\models\Countries;
use common\models\Featured;
use common\models\LastPartnersIds;
use common\models\Orders;
use common\models\OrdersProducts;
use common\models\OrdersProductsAttributes;
use common\models\OrdersStatusHistory;
use common\models\OrdersToPartners;
use common\models\OrdersTotal;
use common\models\PartnersOrders;
use common\models\PartnersProducts;
use common\models\PartnersProductsAttributes;
use common\models\PartnersProductsToCategories;
use common\models\PartnersToRegion;
use common\models\PartnersUsersInfo;
use common\models\SelerAnket;
use common\models\SpsrZones;
use common\models\User;
use common\models\Zones;
use yii\helpers\ArrayHelper;
use Yii;


trait OrdersToReferrer
{
    public function OrdersToReferrer()
    {

        if(($userinfo = PartnersUsersInfo::find()->where(['id'=>Yii::$app->getUser()->id])->asArray()->one()) == FALSE){
           Yii::$app->session->setFlash('error', 'Заполните профиль');
           $this->redirect(Yii::$app->request->referrer);
        }
        date_default_timezone_set('Europe/Moscow');
        if (Yii::$app->user->isGuest || ($user = User::find()->where(['partners_users.id' => Yii::$app->user->getId(), 'partners_users.id_partners' => Yii::$app->params['constantapp']['APP_ID']])->joinWith('userinfo')->asArray()->one()) == FALSE) {
            return $this->redirect(Yii::$app->request->referrer);
        }
        $product_in_order = Yii::$app->request->post('product');
        $comments = Yii::$app->request->post('comments');
        Yii::$app->response->format = \yii\web\Response::FORMAT_HTML;
        $quant = [];
        foreach ($product_in_order as $prodkey => $prodvalue) {
            if ($prodvalue)
                foreach ($prodvalue as $k => $v) {
                    $quant[$prodkey] += $v;
                }
            $queryproduct[] = $prodkey;
        }
        if ($queryproduct) {
            $proddata = PartnersProducts::find()->where(['products.`products_id`' => $queryproduct])->JoinWith('productsDescription')->JoinWith('productsAttributes')->JoinWith('productsAttributesDescr')->andWhere('products_status = 1 and products.products_quantity > 0 and  products.products_price != 0 ')->asArray()->all();
        } else {
            return $this->redirect(Yii::$app->request->referrer);
        }
        $validprice = 0;
        foreach ($proddata as $keyrequest => $valuerequest) {
            $validprice += ((float)$valuerequest['products_price'] * (int)$quant[$valuerequest['products_id']]);
            $origprod[$valuerequest['products_id']] = $valuerequest;
        }
        $express_man = $this->oksuppliers();
        $reindexprod = ArrayHelper::index($proddata, 'products_id');
        $express_key = TRUE;
        $partnerorder = [];
        foreach ($product_in_order as $keyin_order => $valuein_order) {
            if (array_key_exists($keyin_order, $origprod)) {
                $reindexattrdescr = ArrayHelper::index($reindexprod[$keyin_order]['productsAttributesDescr'], 'products_options_values_id');
                if ($express_key && !in_array($reindexprod[$keyin_order]['manufacturers_id'], $express_man)) {
                    $express_key = FALSE;
                }
                foreach ($valuein_order as $keyinattr_order => $valueinattr_order) {
                    $ordersprod['first_quant'] = intval($valueinattr_order);
                    $ordersprod['products_quantity'] = intval($valueinattr_order);
                    $ordersprod['products_id'] = intval($keyin_order);
                    $ordersprod['products_model'] = $reindexprod[$keyin_order]['products_model'];
                    $ordersprod['products_name'] = $reindexprod[$keyin_order]['productsDescription']['products_name'];
                    $ordersprod['final_price'] = $reindexprod[$keyin_order]['products_price'];
                    $ordersprod['products_price'] = $reindexprod[$keyin_order]['products_price'];
                    $ordersprod['price_coll'] = $reindexprod[$keyin_order]['price_coll'];
                    $ordersprod['products_tax'] = $reindexprod[$keyin_order]['products_tax'];
                    $ordersprod['products_status'] = 0;
                    $ordersprod['checks'] = 0;
                    if ($comments[$keyin_order][$reindexattrdescr[$keyinattr_order]['products_options_values_id']]) {
                        $ordersprod['comment'] = $this->trim_tags_text($comments[$keyin_order][$reindexattrdescr[$keyinattr_order]['products_options_values_id']]);
                    } elseif ($comments[$keyin_order]['all']) {
                        $ordersprod['comment'] = $this->trim_tags_text($comments[$keyin_order]['all']);
                    } else {
                        $ordersprod['comment'] = NULL;
                    }
                    $ordersprodattr['orders_products_id'] = $ordersprod->orders_products_id;
                    $ordersprodattr['products_options'] = 'Размер';
                    $ordersprodattr['products_options_values'] = $reindexattrdescr[$keyinattr_order]['products_options_values_name'];
                    $ordersprodattr['options_values_price'] = '0.0000';
                    $ordersprodattr['vid'] = $reindexattrdescr[$keyinattr_order]['products_options_values_id'];
                    $ordersprodattr['oid'] = '1';
                    $ordersprodattr['sub_vid'] = 0;


                    $partnerorderone = [
                        'products_id' => $keyin_order,
                        'products_model' => $reindexprod[$keyin_order]['products_model'],
                        'attribute' =>  $reindexattrdescr[$keyinattr_order]['products_options_values_id'],
                        'price' =>  $reindexprod[$keyin_order]['products_price'],
                        'count'=>$valueinattr_order,
                        'image' =>  $reindexprod[$keyin_order]['products_image'],
                        'attrname' =>  $reindexattrdescr[$keyinattr_order]['products_options_values_name'],
                        'name' =>  $reindexprod[$keyin_order]['productsDescription']['products_name'],
                        'comment'=> [
                            'comment'=>$ordersprod['comment']
                        ]
                    ];

                    $partnerorder['products'][] = array_values($partnerorderone);
                    $validproduct[] = [$partnerorderone, $ordersprodattr];
                    $validprice += ((float)$valuerequest['products_price'] * (int)$quant[$valuerequest['products_id']]);
                    $origprod[$valuerequest['products_id']] = $valuerequest;
                }

            }
        }
        $minprice = 0;
        if ($validprice <= $minprice) {
            return $this->render('cartresult', [
                'result' => [
                    'code' => 0,
                    'text' => 'Cумма заказа ' . $minprice . ' рублей',
                    'data' => [
                        'paramorder' => [
                        ],
                        'origprod' => $origprod,
                        'timeproduct' => '',
                        'totalpricesaveproduct' => $validprice
                    ]
                ]
            ]);
        }
        $nowdate = date('Y-m-d H:i:s');
        $neworderpartner = new PartnersOrders();
        $neworderpartner->partners_id = $user['id_partners'];
        $neworderpartner->user_id = $user['id'];
        $neworderpartner->order = serialize($partnerorder);
        $neworderpartner->status = 1;
        $neworderpartner->delivery = serialize($user['userinfo']);
        $neworderpartner->orders_id = NULL;
        $neworderpartner->update_date = $nowdate;
        $neworderpartner->create_date = $nowdate;
        $neworderpartner->type = 2;
        if ($neworderpartner->save()) {
            $numberorders = $neworderpartner->id;
        } else {
            return $this->render('cartresult', [
                'result' => [
                    'code' => 0,
                    'text' => 'Ошибка оформления заказа код 104',
                    'data' => [
                        'paramorder' => [
                        ],
                        'origprod' => $origprod,
                        'timeproduct' => '',
                        'totalpricesaveproduct' => $validprice
                    ]
                ]
            ]);
        }

        Yii::$app->mailer->htmlLayout = 'layouts-om/html';
        Yii::$app->params['params']['utm'] = [
            'source' => 'email',
            'medium' => 'save-orders',
            'campaign' => 'new-om',
            'content' => 'save-orders'
        ];

        Yii::$app->mailer->compose(['html' => 'orderom-save'], [
            'result' => [
                'code' => 200,
                'text' => '<div style="font-size: xx-large; padding-left: 10px;">Ваш заказ ' . $numberorders . ' в магазине Одежда-Мастер оформлен</div>',
                'data' => [
                    'paramorder' => [
                        'delivery' => 'Партнерская доставка',
                        'number' =>  $numberorders ,
                        'date' => $nowdate,
                        'wrap' => '',
                        'name' => $user['userinfo']['lastname']. ' '.$user['userinfo']['name']. ' '.$user['userinfo']['secondname'] ,
                        'telephone' => $user['userinfo']['telephone'],
                        'email' => $user['email'],
                    ],
                    'saveproduct' => $validproduct,
                    'origprod' => $origprod,
                    'timeproduct' => '',
                    'totalpricesaveproduct' => $validprice
                ]
            ]
        ])
            ->setFrom('odezhdamaster@gmail.com')
            ->setTo($user['email'])
            ->setSubject('Новый заказ"')
            ->send();
        Yii::$app->mailer->compose(['html' => 'orderom-save'], [
            'result' => [
                'code' => 200,
                'text' => '<div style="font-size: xx-large; padding-left: 10px;">Ваш заказ ' . $numberorders . ' в магазине Одежда-Мастер оформлен</div>',
                'data' => [
                    'paramorder' => [
                        'delivery' => 'Партнерская доставка',
                        'number' =>  $numberorders ,
                        'date' => $nowdate,
                        'wrap' => '',
                        'name' => $user['userinfo']['lastname']. ' '.$user['userinfo']['name']. ' '.$user['userinfo']['secondname'] ,
                        'telephone' => $user['userinfo']['telephone'],
                        'email' => $user['email'],
                    ],
                    'saveproduct' => $validproduct,
                    'origprod' => $origprod,
                    'timeproduct' => '',
                    'totalpricesaveproduct' => $validprice
                ]
            ]
        ])
            ->setFrom('odezhdamaster@gmail.com')
            ->setTo('desure85@gmail.com')
            ->setSubject('Новый заказ"')
            ->send();
        Yii::$app->session->set('order-succes', [
            'result' => [
                'code' => 200,
                'text' => 'Спасибо, Ваш заказ оформлен',
                'data' => [
                    'paramorder' => [
                        'delivery' => 'Партнерская доставка',
                        'number' =>  $numberorders ,
                        'date' => $nowdate,
                        'wrap' => '',
                        'name' => $user['userinfo']['lastname']. ' '.$user['userinfo']['name']. ' '.$user['userinfo']['secondname'] ,
                        'telephone' => $user['userinfo']['telephone'],
                        'email' => $user['email'],
                    ],
                    'saveproduct' => $validproduct,
                    'origprod' => $origprod,
                    'timeproduct' => '',
                    'totalpricesaveproduct' => $validprice
                ]
            ]
        ]);
        return header('location: ' . BASEURL . '/cartresult');

    }
}