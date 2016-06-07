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
        $cat = [327,1354];
        $nocat = implode(',',$cat);
        $featured = Featured::find()->JoinWith('products')->JoinWith('categories')->JoinWith('productsDescription')->JoinWith('productsAttributes')->JoinWith('productsAttributesDescr')->where('categories_id NOT IN ('.$nocat.') and products_price > 0 and products_status = 1  and products_date_added < :now and products_last_modified < :now' ,[':now'=>$now])->groupBy(['products.`products_id`'])->asArray()->all();
        return $this->render('discont',['products'=> $featured, 'man_time' => $man_time, 'catpath'=>$catpath]);

    }
}