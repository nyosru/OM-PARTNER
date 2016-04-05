<?php
namespace common\models;

use common\patch\ActiveRecordExt;
use Yii;

class FiguresDays extends ActiveRecordExt{

    public static function tableName()
    {
        return 'partners_figures_days';
    }
    
    public function rules()
    {
        return [
            [['description','image','tags'], 'string' ],
            [['description','image','tags','date_added'], 'required']
        ];
    }
    public function getProducts(){
        return $this->hasMany(FiguresDaysProduct::className(),['group_id'=>'id']);
    }

    public function  getInfo(){
        return $this->hasMany(PartnersProducts::className(),['products_id'=>'product_id'])->via('products');
    }
    public function getProductsDescription()
    {
        return $this->hasMany(PartnersProductsDescription::className(), ['products_id' => 'product_id'])->via('products');
    }
    public function getProductsAttributes()
    {
        return $this->hasMany(PartnersProductsAttributes::className(), ['products_id' => 'product_id'])->via('products');
    }

    public function getProductsAttributesDescr()
    {
        return $this->hasMany(PartnersProductsOptionVal::className(), ['products_options_values_id' => 'options_values_id'])->via('productsAttributes');
    }
}