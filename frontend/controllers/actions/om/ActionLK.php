<?php
namespace frontend\controllers\actions\om;

use common\models\Customers;
use common\models\PartnersUsersInfo;
use common\models\Profile;
use common\models\User;
use common\models\Orders;
use yii;


trait ActionLK
{
    public function actionLk()
    {

        if(Yii::$app->user->isGuest || ($cust=User::find()->where(['partners_users.id'=>Yii::$app->user->getId(), 'partners_users.id_partners'=>Yii::$app->params['constantapp']['APP_ID']])->joinWith('userinfo')->joinWith('customers')->joinWith('addressBook')->one()) == FALSE || !isset($cust['customers']['customers_id'])){
            return $this->redirect(Yii::$app->request->referrer);
        }

        $this->layout = 'lk';
        $model = \common\models\Orders::find()->where(['customers_id'=> $cust['customers']['customers_id']])->joinWith('products')->joinWith('productsAttr')->joinWith('productsSP')->groupBy('orders.`orders_id` DESC' );
        $sort = new yii\data\Sort([
            'attributes' => [
                'orders_id'=>[
                    'asc' => ['orders_id' => SORT_ASC],
                    'desc' => ['orders_id' => SORT_DESC],
                    'default' => SORT_DESC,

                ],
            ],
        ]);

        switch (Yii::$app->request->getQueryParam('view')) {

            case 'userinfo':
                if(Yii::$app->request->post()){
                    $customer=new Profile();
                    $customer->load(Yii::$app->request->post());
                    switch (Yii::$app->request->post()['save_lk']) {
                        case 'user':
                            $customer->saveUserInfo();
                            break;
                        case 'customer':
                            $customer->saveCustomer();
                            unset($customer);
                            $customer=new Profile();
                            break;
                        case 'deliv':
                            $customer->saveDeliv();
                            unset($customer);
                            $customer=new Profile();
                            break;
                        case 'address':
                            $customer->saveUserDelivery();
                            unset($customer);
                            $customer=new Profile();
                            break;
                        case 'add_address':
                            $customer->addUserDelivery();
                            unset($customer);
                            $customer=new Profile();
                            break;
                        case 'addr_del':

                            $addr_id='';
                            foreach(Yii::$app->request->post()['Profile']['delivery'] as $key=>$value){
                                if(isset($value['address_book_id'])){
                                    $addr_id=$value['address_book_id'];
                                    break;
                                }
                            };
                            $customer->delUserDeliveryAddress($addr_id);
                            unset($customer);
                            $customer=new Profile();
                            break;
//                        case 'addr_default':
//                            $addr_id='';
//                            foreach(Yii::$app->request->post()['Profile']['delivery'] as $key=>$value){
//                                if(isset($value['address_book_id'])){
//                                    $addr_id=$value['address_book_id'];
//                                    break;
//                                }
//                            };
//                            $customer->defaultUserAddress($addr_id);
//                            unset($customer);
//                            $customer=new Profile();
//                            break;
                        case 'addr_default':
                            $addr_id='';
                            foreach(Yii::$app->request->post()['Profile']['delivery'] as $key=>$value){
                                if(isset($value['address_book_id'])){
                                    $addr_id=$value['address_book_id'];
                                    break;
                                }
                            };
                            $customer->defaultUserDeliveryAddress($addr_id);
                            unset($customer);
                            $customer=new Profile();
                            break;
                        case 'add_pay':
                            $addr_id='';
                            foreach(Yii::$app->request->post()['Profile']['delivery'] as $key=>$value){
                                if(isset($value['address_book_id'])){
                                    $addr_id=$value['address_book_id'];
                                    break;
                                }
                            };
                            $customer->defaultUserPayAddress($addr_id);
                            unset($customer);
                            $customer=new Profile();
                            break;
                        default:
                            echo 'Произошла ошибка';die();
                            break;
                    }
                }else{
                    $customer=new Profile();
                }
                $customer->loadUserProfile();
                $this->layout = 'lk';
                return $this->render('lkuserinfo',['cust'=>$customer]);
            break;


            case 'myorder':
                $sort_order = [0 => 'Все',1 => 'Текущие', 2 => 'Не оплачено', 3 => 'Завершенные'];
                $search = (int)Yii::$app->request->getQueryParam('filter');
                if($search){
                    switch($search){
                        case '0':
                            $model =  $model->andWhere(['!=','orders_status', '0']);
                            break;
                        case '1':
                            $statinfilter = [1,2,3,4,5,11];
                            $model = $model->andWhere(['orders_status'=>$statinfilter]);
                            break;
                        case '2':
                            $statinfilter = [1,2];
                            $model = $model->andWhere(['orders_status'=>$statinfilter]);
                            break;
                        case '3':
                            $statinfilter = [5,6,33];
                            $model = $model->andWhere(['orders_status'=>$statinfilter]);
                            break;
                        default:
                            $model = $model->andWhere(['!=','orders_status', '0']);
                            break;
                    }

                }
                $id = (int)Yii::$app->request->getQueryParam('id');
                if($id){


                    $model =  $model->andWhere(['orders.orders_id'=>$id]);


                }
                $di = Yii::$app->request->getQueryParam('di');
                if($di){
                    $model =  $model->andWhere(['>','orders.date_purchased',date('Y-m-d 00:00:00',strtotime($di))]);
                }
                $do = Yii::$app->request->getQueryParam('do');
                if($do){
                    $model =  $model->andWhere(['<=','orders.date_purchased',date('Y-m-d 23:59:59',strtotime($do))]);
                }
                $orders = new yii\data\ActiveDataProvider([
                    'query' => $model,
                    'sort' => $sort,
                    'pagination' => [
                        'params'=> array_merge($_GET, ['view' => 'myorder']),
                        'defaultPageSize' => 20,
                    ]

                ]);
                return $this->render('lkmyorder',['cust'=>$cust, 'orders'=>$orders, 'sort_order'=>$sort_order]);
                break;
            default:
                $orders = new yii\data\ActiveDataProvider([
                    'query' => $model,
                    'sort' => $sort,
                    'pagination' => [
                        'params'=> array_merge($_GET, ['view' => 'myorder']),
                        'defaultPageSize' => 1,
                    ]
                ]);
                $countpay = Orders::find()->where(['customers_id'=> $cust['customers']['customers_id']])->joinWith('products')->joinWith('productsAttr')->joinWith('productsSP')->groupBy('orders.`orders_id` DESC' )->andWhere(['orders.orders_status'=>'2'])->count();
                $countcheck = Orders::find()->where(['customers_id'=> $cust['customers']['customers_id']])->joinWith('products')->joinWith('productsAttr')->joinWith('productsSP')->groupBy('orders.`orders_id` DESC' )->andWhere(['orders.orders_status'=>'1'])->count();
                $countdelivery = Orders::find()->where(['customers_id'=> $cust['customers']['customers_id']])->joinWith('products')->joinWith('productsAttr')->joinWith('productsSP')->groupBy('orders.`orders_id` DESC' )->andWhere(['orders.orders_status'=>'4'])->count();
                $countsborka = Orders::find()->where(['customers_id'=> $cust['customers']['customers_id']])->joinWith('products')->joinWith('productsAttr')->joinWith('productsSP')->groupBy('orders.`orders_id` DESC' )->andWhere(['orders.orders_status'=>'11'])->count();
                $totalorder = Orders::find()->where(['customers_id'=> $cust['customers']['customers_id']])->joinWith('products')->joinWith('productsSP')->groupBy('orders.`orders_id` DESC' )->count();

                $totalproducts  = Orders::find()->where(['customers_id'=> $cust['customers']['customers_id']])->select('SUM(`orders_products`.`products_quantity`) as totalprod, SUM(orders_products_sp.`products_quantity`) as total, SUM(`orders_products`.`products_quantity`*`orders_products`.`products_price`) as total_prod_price, SUM(`orders_products_sp`.`products_quantity`*`orders_products`.`products_price`) as total_prod_price_sp')->joinWith('products')->joinWith('productsSP')->asArray()->all();
//                $totalproducts = Orders::find()->where('customers_id=:cust',[':cust'=> $cust['customers']['customers_id']])->joinWith('products')->joinWith('productsSP')->asArray()->all();
//                $total = 0;
//                $totalprice = 0;
             //   var_dump($totalproducts);
                $totalprice = (float)$totalproducts[0]['total_prod_price']+(float)$totalproducts[0]['total_prod_price_sp'];
                $totalproducts = $totalproducts[0]['totalprod']+$totalproducts[0]['total'];

//echo  $totalproducts[0]['total_prod_price_sp'];
               // die();
//                foreach($totalproducts as $totval) {
//                    foreach ($totval as $value) {
//                        $total += $value['products_quantity'];
//                        $totalprice += $value['products_quantity']*$value['products_price'];
//                    }
//                    foreach ($totval as $value) {
//                        $total += $value['products_quantity'];
//                        $totalprice += $value['products_quantity']*$value['products_price'];
//                    }
//                }
//                $totalproducts = $total;
                $totalcancel = \common\models\Orders::find()->where(['customers_id'=> $cust['customers']['customers_id']])->joinWith('products')->joinWith('productsAttr')->joinWith('productsSP')->groupBy('orders.`orders_id` DESC' )->andWhere(['orders.orders_status'=>'6'])->count();

                return $this->render('lk',['cust'=>$cust, 'orders'=>$orders, 'dataset'=>['countpay'=>$countpay, 'countcheck'=>$countcheck,'countsborka'=>$countsborka, 'countdelivery'=>$countdelivery,'totalorder'=>$totalorder, 'totalproducts'=>$totalproducts, 'totalprice'=>$totalprice, 'totalcancel'=>$totalcancel]]);
        }
    }
}