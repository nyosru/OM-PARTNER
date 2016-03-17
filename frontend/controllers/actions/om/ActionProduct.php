<?php
namespace frontend\controllers\actions\om;

use common\models\PartnersCatDescription;
use common\models\ProductsSpecifications;
use Yii;
use common\models\PartnersProducts;
use common\models\PartnersProductsToCategories;
use yii\helpers\ArrayHelper;

trait ActionProduct
{
    public function actionProduct()
    {
        Yii::$app->params['paramset']['relproducts']['active']=1;
        Yii::$app->params['paramset']['relproducts']['value']=10;
        $relProd=[];

        // Если запрос пришел через GET
        if(Yii::$app->request->isGet){
            $id = (integer)Yii::$app->request->getQueryParam('id');
            $spec=PartnersProductsToCategories::find()
                ->where(['products_to_categories.products_id'=>$id])
                ->joinWith('productsSpecification')
                ->joinWith('specificationValuesDescription')
                ->joinWith('specificationDescription')
                ->asArray()->groupBy('products_specifications.products_id')->all();
            if ($id > 0) {
                $x = PartnersProducts::find()->select('`products_last_modified` as last_modified, products_date_added as add_date')->where(['products_id' => trim($id)])->asArray()->all();
                $x=end($x);
                if(!$x['last_modified']){
                    $x['last_modified'] = $x['add_date'] ;
                }
                if ($x['last_modified']) {
                    $keyprod = Yii::$app->cache->buildKey('product-' . $id);
                    $data = Yii::$app->cache->get($keyprod);
                    if (!$data || ($x['last_modified'] != $data['last'])) {
                        $data = PartnersProductsToCategories::find()->JoinWith('products')->where('products.`products_id` =:id', [':id' => $id])->JoinWith('productsDescription')->JoinWith('productsAttributes')->groupBy(['products.`products_id` DESC'])->JoinWith('productsAttributesDescr')->asArray()->all();
                        $data = end($data);
                        Yii::$app->cache->set($keyprod, ['data' => $data, 'last' => $x['last_modified']]);
                    } else {
                        $data = $data['data'];
                    }
                    if (isset(Yii::$app->params['partnersset']['discount']['value']) && Yii::$app->params['partnersset']['discount']['active'] == 1) {

                        $data['products']['products_price'] = intval($data['products']['products_price']) + (intval($data['products']['products_price']) / 100 * intval(Yii::$app->params['partnersset']['discount']['value']));

                    }

                    if($data['categories_id'] == 0){
                        $catpath = ['num'=>['0' => 0], 'name'=>['0' =>'Каталог']];
                    }else{
                        $catpath = $this->Catpath($data['categories_id'],'namenum');
                    }
                    if(!$catpath['num']) {
                        $catpath = $data['categories_id'];
                    }else{
                        $catpath = $catpath['num'];
                    }

                    $list = array();
                    $hide_man = $this->hide_manufacturers_for_partners();
                    foreach ($hide_man as $value) {
                        $list[] = $value['manufacturers_id'];
                    }

                    $hide_man = implode(',', $list);
                    $relProd=PartnersProductsToCategories::find()->where(['products_to_categories.categories_id'=>$catpath])->joinWith('products')->andWhere('products.manufacturers_id NOT IN (' . $hide_man . ') and products_status=1  and products.products_quantity > 0')->limit(100)->asArray()->all();

                    if($relProd) {
                        $relnum = array_rand($relProd, min(3,count($relProd)));

//                             echo'<pre>';
//                    print_r($relnum);
//                    echo'</pre>';
//                        die();
                        $relProd1 = array();
                        if(is_array($relnum)) {
                            foreach ($relnum as $item) {
                                $relProd1[] = $relProd[$item]['products_id'];
                            }
                            $relstring = implode(',', $relProd1);
                        }else{
                            $relstring = $relProd[$relnum]['products_id'];
                        }
                        $relProduct = PartnersProductsToCategories::find()->joinWith('products')->joinWith('productsDescription')->where('products.manufacturers_id NOT IN (' . $hide_man . ') and products_status=1  and products.products_quantity > 0 AND products_to_categories.products_id IN (' . $relstring . ')')->asArray()->all();
                        $relProd = [];
                        foreach ($relProduct as $key => $value) {
                            $relProd[$key]['products_name'] = $value['productsDescription']['products_name'];
                            $relProd[$key]['products_price'] = $value['products']['products_price'];
                            $relProd[$key]['products_image'] = $value['products']['products_image'];
                            $relProd[$key]['products_id'] = $value['products_id'];
                        }
                    }

                    return $this->render('product', ['product' => $data, 'catpath'=>$catpath, 'spec'=>$spec, 'relprod'=>$relProd]);
                } else {
                    return $this->redirect('/');
                }
            } else {
                return $this->redirect('/');
            }
        }

        // если запрос пришел через POST
        else{
            $id = (integer)Yii::$app->request->post('id');
            $spec=PartnersProductsToCategories::find()
                ->where(['products_to_categories.products_id'=>$id])
                ->joinWith('productsSpecification')
                ->joinWith('specificationValuesDescription')
                ->joinWith('specificationDescription')
                ->asArray()->groupBy('products_specifications.products_id')->all();
            if ($id > 0) {
                $x = PartnersProducts::find()->select('`products_last_modified` as last_modified, products_date_added as add_date')->where(['products_id' => trim($id)])->asArray()->One();
                if(!$x['last_modified']){
                    $x['last_modified'] = $x['add_date'] ;
                }
                $keyprod = Yii::$app->cache->buildKey('product-' . $id);
                $data = Yii::$app->cache->get($keyprod);
                if (!$data || ($x['last_modified'] != $data['last'])) {
                    $data = PartnersProductsToCategories::find()->JoinWith('products')->where('products.`products_id` =:id', [':id' => $id])->JoinWith('productsDescription')->JoinWith('productsAttributes')->groupBy(['products.`products_id` DESC'])->JoinWith('productsAttributesDescr')->asArray()->one();
                    Yii::$app->cache->set($keyprod, ['data' => $data, 'last' => $x['last_modified']]);
                } else {
                    $data = $data['data'];
                }
                if (isset(Yii::$app->params['partnersset']['discount']['value']) && Yii::$app->params['partnersset']['discount']['active'] == 1) {

                    $data['products']['products_price'] = intval($data['products']['products_price']) + (intval($data['products']['products_price']) / 100 * intval(Yii::$app->params['partnersset']['discount']['value']));

                }
                // $catpath = json_decode(file_get_contents('http://' . $_SERVER['HTTP_HOST'] . BASEURL . '/catpath?cat=' . $data['categories_id'] . '&action=namenum'));
                $list = array();
                $hide_man = $this->hide_manufacturers_for_partners();
                foreach ($hide_man as $value) {
                    $list[] = $value['manufacturers_id'];
                }
                $hide_man = implode(',', $list);
                $data['productsAttributesDescr'] = ArrayHelper::index($data['productsAttributesDescr'], 'products_options_values_name');
                $data['productsAttributes'] = ArrayHelper::index($data['productsAttributes'], 'options_values_id');
                Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;

//                echo '<pre>';
//                print_r($data['productsAttributesDescr']);
//                echo '</pre>';
//                die();
                return ['product' => $data,  'spec'=>$spec];

            } else {
                return $this->redirect('/');
            }
        }
    }
}