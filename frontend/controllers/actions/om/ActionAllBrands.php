<?php
namespace frontend\controllers\actions\om;

use common\models\PartnersPage;
use common\models\Specifications;
use yii\bootstrap\Tabs;
use Faker\Provider\zh_TW\DateTime;
use Yii;
use common\models\PartnersConfig;

trait ActionAllBrands
{
    public function actionAllbrands()
    {
       $brands =  Specifications::find()->select('specification_values_description.specification_values_id, specification_values_description.specification_value')->joinWith('specificationValuesDescription')->where(['specification_values.specifications_id'=>'77'])->asArray()->all();
       // $brands = \yii\helpers\ArrayHelper::index($brands, 'specification_value');
       // ksort($brands,SORT_NATURAL);
        return $this->render('allbrands', ['brands'=>$brands]);
    }
}