<?php
namespace common\traits;

use common\models\Manufacturers;

trait GetSuppliers
{
    public function oksuppliers()
    {

        $key = 'oksuppliers';
        if(($suppliers = \Yii::$app->cache->get($key)) == FALSE){
            $suppliers = Manufacturers::find()->select('manufacturers_id')->where(['express'=>1])->createCommand()->queryAll(7);
            \Yii::$app->cache->set($key, $suppliers, 600);
        }
        return $suppliers;

    }
}