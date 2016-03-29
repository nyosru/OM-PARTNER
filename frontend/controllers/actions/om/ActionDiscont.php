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

        $this->layout = 'main';
        $featured = Featured::find()->JoinWith('products')->JoinWith('productsDescription')->JoinWith('productsAttributes')->JoinWith('productsAttributesDescr')->groupBy(['products.`products_id` DESC'])->asArray()->all();
        return $this->render('discont',['products'=> $featured]);

    }
}