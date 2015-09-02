<?php

namespace common\models;

use Yii;
use common\models\PartnersProducts;
/**
 * This is the model class for table "products_to_categories".
 *
 * @property string $products_id
 * @property string $categories_id
 * @property string $old_categories_id
 */
class PartnersProductsToCategories extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'products_to_categories';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['products_id'], 'required'],
            [['products_id', 'categories_id', 'old_categories_id'], 'integer']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'products_id' => 'Products ID',
            'categories_id' => 'Categories ID',
            'old_categories_id' => 'Old Categories ID',
        ];
    }

    public function getProducts()
    {
        return $this->hasOne(PartnersProducts::className(), ['products_id' => 'products_id']);
    }



    public function getProductsDescription()
    {
        return $this->hasOne(PartnersProductsDescription::className(), ['products_id' => 'products_id'])->via('products');
    }
    public function getProductsAttributes()
    {
        return $this->hasMany(PartnersProductsAttributes::className(), ['products_id' => 'products_id'])->via('products');
    }

    public function getProductsAttributesDescr()
    {
        return $this->hasMany(PartnersProductsOptionVal::className(), ['products_options_values_id' => 'options_values_id'])->via('productsAttributes');
    }
    public function getproductlist($cat)
    {

        $var = $this->find()->select('products_id')->where(['categories_id' => $cat])->asArray()->All();
        return $var;
    }


}
