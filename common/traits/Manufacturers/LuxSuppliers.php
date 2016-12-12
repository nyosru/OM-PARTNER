<?php
namespace common\traits\Manufacturers;

use common\models\ManufacturerOption;

trait LuxSuppliers
{
    public function LuxSuppliers()
    {


        $key = 'luxsuppliers';
        if(($suppliers = \Yii::$app->cache->get($key)) == FALSE){
            $suppliers = ManufacturerOption::find()->select('manufacturer_id')->where(['option_name'=>'IS_LUX'])->joinWith('manufacturerOptionValues')->createCommand()->queryAll(7);
            \Yii::$app->cache->set($key, $suppliers, 600);
        }
        return $suppliers;
    }
}