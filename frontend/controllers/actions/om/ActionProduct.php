<?php
namespace frontend\controllers\actions\om;

use common\models\PartnersCatDescription;
use common\models\ProductImage;
use common\models\ProductsSpecifications;
use php_rutils\RUtils;
use Yii;
use common\models\PartnersProducts;
use common\models\PartnersProductsToCategories;
use yii\helpers\ArrayHelper;
use yii\helpers\FileHelper;
use yii\web\HttpException;

trait ActionProduct
{
    public function actionProduct()
    {
        Yii::$app->params['paramset']['relproducts']['active'] = 1;
        Yii::$app->params['paramset']['relproducts']['value'] = 10;
        $relProd = [];

        if (Yii::$app->request->isGet && (($id = (integer)Yii::$app->request->getQueryParam('model')) == TRUE)) {
            $param = 'products_model';
        }elseif(Yii::$app->request->isGet && (($id = (integer)Yii::$app->request->getQueryParam('id')) == TRUE)) {
            $param = 'products_id';
        }elseif(Yii::$app->request->isPost && ($id = (integer)Yii::$app->request->post('id')) == TRUE){
            $param = 'products_id';
        }elseif(Yii::$app->request->isPost && ($id = (integer)Yii::$app->request->post('model')) == TRUE){
            $param = 'products_model';
        }else if(isset(\Yii::$app->params['chpu']['productid'])){
            $check = str_replace('-','/',Yii::$app->params['chpu']['productid']);
            if(file_exists(Yii::getAlias('@app/runtime/productcache/'.$check))){
                $id = end(explode('/', $check));
                $param = 'products_id';
            }else{
                throw new HttpException(404 ,'Not found');
            }
        }else{
            throw new HttpException(404 ,'Not found');
        }

        if ($id > 0 ){
            $x = PartnersProducts::find()
                ->where([$param => trim($id)]);
            $data = end($this->aggregateProductsData($x, 'productn', 86400));
            $prodimages = array_values($data['subImage']);
            $spec = PartnersProductsToCategories::find()
                ->where(['products_to_categories.products_id' => $id])
                ->joinWith('productsSpecification')
                ->joinWith('specificationValuesDescription')
                ->joinWith('specificationDescription')
                ->asArray()->groupBy('products_specifications.products_id')->asArray()->one();
            if ($spec) {
                $spec['specificationDescription'] = ArrayHelper::index($spec['specificationDescription'], 'specifications_id');
                $spec['specificationValuesDescription'] = ArrayHelper::index($spec['specificationValuesDescription'], 'specification_values_id');
            }
            $catpath = $data['catpath'];
            $relProduct = $this->RelatedProducts( $data['categories_id'], 45, 'rejjhkml',3200);
            if (Yii::$app->request->isPost) {
                $data['productsAttributesDescr'] = ArrayHelper::index($data['productsAttributesDescr'], 'products_options_values_name');
                $data['productsAttributes'] = ArrayHelper::index($data['productsAttributes'], 'options_values_id');
                Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
                return ['product' => $data, 'spec' => $spec,'catpath' => $catpath, 'images'=>$prodimages];
            } elseif (Yii::$app->request->isGet) {
                $man_time = $this->manufacturers_diapazon_id();
                return $this->render('product', ['product' => $data, 'catpath' => $catpath, 'spec' => $spec,  'images'=>$prodimages, 'relprod' => $relProduct, 'man_time' => $man_time]);
            } else {
                return $this->redirect('/');
            }
        }else{
            return $this->redirect('/');
        }
    }

}