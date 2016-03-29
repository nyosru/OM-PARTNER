<?php
/**
 * Created by PhpStorm.
 * User: dmitriy
 * Date: 28.03.16
 * Time: 17:45
 */
namespace common\models;
use common\patch\ActiveRecordExt;
use Yii;
/**
 * This is the model class for table "featured".
 *
 * @property integer               $featured_id
 * @property integer               $products_id
 * @property string                $featured_date_added
 * @property string                $featured_last_modified
 * @property string                $expires_date
 * @property string                $date_status_change
 * @property integer               $status
 * @property double                $discount
 *
 */
class Featured extends ActiveRecordExt
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'featured';
    }
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['featured_date_added', 'featured_last_modified', 'date_status_change'], 'date'],
            [['expires_date'], 'date'],
            [['products_id', 'status'], 'integer'],
            [['discount'], 'number'],
            [['products_id', 'discount'], 'required']
        ];
    }
    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'featured_id'            => 'Featured ID',
            'products_id'            => 'Products ID',
            'featured_date_added'    => 'Featured Date Added',
            'featured_last_modified' => 'Featured Last Modified',
            'expires_date'           => 'Expires Date',
            'date_status_change'     => 'Date Status Change',
            'status'                 => 'Status',
            'discount'               => 'Discount',
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
    public function getSpecificationValuesDescription()
    {
        return $this->hasMany(SpecificationValuesDescription::className(), ['specification_values_id' => 'specification_values_id'])->via('productsSpecification');
    }
    public function getProductsSpecification()
    {
        return $this->hasMany(ProductsSpecifications::className(), ['products_id' => 'products_id']);
    }
    public function  getSpecificationDescription()
    {
        return $this->hasMany(SpecificationDescription::className(), ['specifications_id' => 'specifications_id'])->via('productsSpecification');
    }
}