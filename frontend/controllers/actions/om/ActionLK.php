<?php
namespace frontend\controllers\actions\om;

use common\models\Customers;
use common\models\OrdersProducts;
use common\models\PartnersProducts;
use common\models\PartnersUsersInfo;
use common\models\Profile;
use common\models\User;
use common\models\Orders;
use frontend\widgets\ProductCard;
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
                $savelk=false;
                if(Yii::$app->request->post()){
                    $customer=new Profile();
                    $customer->load(Yii::$app->request->post());
                    switch (Yii::$app->request->post()['save_lk']) {
                        case 'user':
                            if($customer->saveUserInfo()){
                                $savelk=true;
                            };
                            break;
                        case 'customer':
                            if($customer->saveCustomer()){
                                $savelk=true;
                            }
                            unset($customer);
                            $customer=new Profile();
                            break;
                        case 'deliv':
                            if($customer->saveDeliv()){
                                $savelk=true;
                            }
                            unset($customer);
                            $customer=new Profile();
                            break;
                        case 'address':
                            if($customer->saveUserDelivery()){
                                $savelk=true;
                            }
                            unset($customer);
                            $customer=new Profile();
                            break;
                        case 'add_address':
                            if($customer->addUserDelivery()){
                                $savelk=true;
                            }
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
                            if($customer->delUserDeliveryAddress($addr_id)){
                                $savelk=true;
                            }
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
                            if($customer->defaultUserDeliveryAddress($addr_id)){
                                $savelk=true;
                            }
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
                            if($customer->defaultUserPayAddress($addr_id)){
                                $savelk=true;
                            }
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
                return $this->render('lkuserinfo',['cust'=>$customer,'savelk'=>$savelk]);
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
                        case '4':
                            $statinfilter = [2];
                            $model = $model->andWhere(['orders_status'=>$statinfilter]);
                            break;
                        case '5':
                            $statinfilter = [1];
                            $model = $model->andWhere(['orders_status'=>$statinfilter]);
                            break;
                        case '6':
                            $statinfilter = [4];
                            $model = $model->andWhere(['orders_status'=>$statinfilter]);
                            break;
                        case '7':
                            $statinfilter = [11];
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
            case 'savecomments':

                break;

            case 'orderedproducts':
                $list=array();
                $hide_man = $this->hide_manufacturers_for_partners();
                foreach ($hide_man as $value) {
                    $list[] = $value['manufacturers_id'];
                }

                $hide_man = implode(',', $list);
                $orderedproducts=new yii\data\ActiveDataProvider([
                    'query'=>OrdersProducts::find()->select('products.products_id')->joinWith('products')->joinWith('order')->where(['customers_id'=> $cust['customers']['customers_id']])->andWhere('products.manufacturers_id NOT IN (' . $hide_man . ') and products.products_status=1  and products.products_quantity > 0 and products.products_price>0')->groupBy('`products_id` DESC' ),
                    'pagination'=>[
                        'defaultPageSize' => 60,
                        'pageSizeLimit'=>[0,60]
                    ],
                ]);
                $pagination=$orderedproducts->getPagination();
                $orprod=[];
                $gmorprod=$orderedproducts->getModels();
                foreach ($gmorprod as $key=>$value){
                        if(!in_array($value['products_id'], $orprod)) {
                            $orprod[] = $value['products_id'];
                    }
                }
//
                $orprodstring = implode(',',$orprod);
//                echo '<pre>';
//                print_r($pagination);
//                echo '</pre>';
//                die();
                $opprovider = new yii\data\ActiveDataProvider([
                    'query'=> PartnersProducts::find()->joinWith('productsDescription')->joinWith('productsAttributes')->joinWith('productsAttributesDescr')->where('products.products_id IN ('.$orprodstring.')')->distinct(),
                    'pagination'=>[
                        'defaultPageSize' => 60,
                        'pageSizeLimit'=>[0,60]
                    ],
                ]);


//                echo '<pre>';
//                print_r($opprovider->getModels());
//                echo '</pre>';
//                die();
//
                $orderedproducts=$opprovider->getModels();
                $catpath = ['num'=>['0' => 0], 'name'=>['0' =>'Каталог']];
                $man_time = $this->manufacturers_diapazon_id();

                return $this->render('lkorderedproducts',['orderedproducts' => $orderedproducts,'pagination'=>$pagination, 'catpath'=>$catpath, 'man_time'=>$man_time]);
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
                $totalorder = Orders::find()->where('customers_id = :customer and orders_status = :status',[':customer'=> $cust['customers']['customers_id'], ':status'=>5])->joinWith('products')->joinWith('productsSP')->groupBy('orders.`orders_id` DESC' )->count();

                $totalproducts  = Orders::find()->where('customers_id = :customer and orders_status = :status',[':customer'=> $cust['customers']['customers_id'], ':status'=>5])->select('SUM(`orders_products`.`products_quantity`) as totalprod, SUM(orders_products_sp.`products_quantity`) as total, SUM(`orders_products`.`products_quantity`*`orders_products`.`products_price`) as total_prod_price, SUM(`orders_products_sp`.`products_quantity`*`orders_products`.`products_price`) as total_prod_price_sp')->joinWith('products')->joinWith('productsSP')->asArray()->all();

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