<?php
namespace frontend\controllers\actions\om;

use common\models\Featured;
use common\models\PartnersPage;
use yii\bootstrap\Tabs;
use Faker\Provider\zh_TW\DateTime;
use Yii;
use common\models\PartnersConfig;

trait ActionDiscont
{
    public function actionDiscont()
    {

        $catpath = ['num'=>['0' => 0], 'name'=>['0' =>'Каталог']];
        $man_time = $this->manufacturers_diapazon_id();
        $this->layout = 'main';
        $now = date('Y-m-d H:i:s');
        $featured = Featured::find()->JoinWith('products')->JoinWith('productsDescription')->JoinWith('productsAttributes')->JoinWith('productsAttributesDescr')->where('products_price > 0 and products_status = 1  and products_date_added < :now and products_last_modified < :now' ,[':now'=>$now])->groupBy(['products.`products_id`'])->asArray()->all();
        return $this->render('discont',['products'=> $featured, 'man_time' => $man_time, 'catpath'=>$catpath]);

    }
}