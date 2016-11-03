<?php
namespace common\traits\Manufacturers;

use common\models\ManufacturerOption;

trait LuxSuppliers
{
    public function LuxSuppliers()
    {
        $suppliers = ManufacturerOption::find()->select('manufacturer_id')->where(['option_name'=>'IS_LUX'])->joinWith('manufacturerOptionValues')->createCommand()->queryAll(7);
        return $suppliers;
    }
}