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
        $featured = Featured::find()->JoinWith('products')->JoinWith('productsDescription')->JoinWith('productsAttributes')->JoinWith('productsAttributesDescr')->groupBy(['products.`products_id`'])->asArray()->all();
        return $this->render('discont',['products'=> $featured, 'man_time' => $man_time, 'catpath'=>$catpath]);

    }
}