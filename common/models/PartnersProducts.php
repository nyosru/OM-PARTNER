<?php

namespace common\models;

use app\api\core\productsdescription\ProductsDescription;
use common\patch\ActiveRecordExt;
use Yii;
use common\models\PartnersProductsAttributes;
use common\models\PartnersProductsOptionVal;
use common\models\PartnersProductsDescription;
/**
 * This is the model class for table "products".
 *
 * @property string $products_id
 * @property integer $products_quantity
 * @property integer $products_model
 * @property string $products_image
// * @property string $products_image_med
// * @property string $products_image_lrg
// * @property string $products_image_sm_1
// * @property string $products_image_xl_1
// * @property string $products_image_sm_2
// * @property string $products_image_xl_2
// * @property string $products_image_sm_3
// * @property string $products_image_xl_3
// * @property string $products_image_sm_4
// * @property string $products_image_xl_4
// * @property string $products_image_sm_5
// * @property string $products_image_xl_5
// * @property string $products_image_sm_6
// * @property string $products_image_xl_6
 * @property string $products_price
// * @property string $products_old_price
 * @property string $products_date_added
// * @property string $products_date_view
 * @property string $products_last_modified
// * @property string $products_date_available
// * @property string $products_weight
 * @property integer $products_status
// * @property integer $products_to_xml
// * @property integer $products_tax_class_id
 * @property string $manufacturers_id
 * @property integer $products_ordered
 * @property integer $products_quantity_order_min
 * @property integer $products_quantity_order_units
// * @property integer $products_sort_order
 * @property string $price_coll
 * @property string $removable
// * @property string $raschet_pribil
 */
class PartnersProducts extends ActiveRecordExt
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'products';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['products_id'], 'required'],
            [['products_id', 'products_quantity', 'products_model', 'products_status', 'products_to_xml', 'products_tax_class_id', 'manufacturers_id', 'products_ordered', 'products_quantity_order_min', 'products_quantity_order_units', 'products_sort_order'], 'integer'],
            [['products_price', 'products_old_price', 'products_weight', 'price_coll'], 'number'],
            [['products_date_added', 'products_date_view', 'products_last_modified', 'products_date_available'], 'safe'],
            [['removable', 'raschet_pribil'], 'string'],
            [['products_image', 'products_image_med', 'products_image_lrg', 'products_image_sm_1', 'products_image_xl_1', 'products_image_sm_2', 'products_image_xl_2', 'products_image_sm_3', 'products_image_xl_3', 'products_image_sm_4', 'products_image_xl_4', 'products_image_sm_5', 'products_image_xl_5', 'products_image_sm_6', 'products_image_xl_6'], 'string', 'max' => 64]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'products_id' => 'Products ID',
            'products_quantity' => 'Products Quantity',
            'products_model' => 'Products Model',
            'products_image' => 'Products Image',
            'products_image_med' => 'Products Image Med',
            'products_image_lrg' => 'Products Image Lrg',
            'products_image_sm_1' => 'Products Image Sm 1',
            'products_image_xl_1' => 'Products Image Xl 1',
            'products_image_sm_2' => 'Products Image Sm 2',
            'products_image_xl_2' => 'Products Image Xl 2',
            'products_image_sm_3' => 'Products Image Sm 3',
            'products_image_xl_3' => 'Products Image Xl 3',
            'products_image_sm_4' => 'Products Image Sm 4',
            'products_image_xl_4' => 'Products Image Xl 4',
            'products_image_sm_5' => 'Products Image Sm 5',
            'products_image_xl_5' => 'Products Image Xl 5',
            'products_image_sm_6' => 'Products Image Sm 6',
            'products_image_xl_6' => 'Products Image Xl 6',
            'products_price' => 'Products Price',
            'products_old_price' => 'Products Old Price',
            'products_date_added' => 'Products Date Added',
            'products_date_view' => 'Products Date View',
            'products_last_modified' => 'Products Last Modified',
            'products_date_available' => 'Products Date Available',
            'products_weight' => 'Products Weight',
            'products_status' => 'Products Status',
            'products_to_xml' => 'Products To Xml',
            'products_tax_class_id' => 'Products Tax Class ID',
            'manufacturers_id' => 'Manufacturers ID',
            'products_ordered' => 'Products Ordered',
            'products_quantity_order_min' => 'Products Quantity Order Min',
            'products_quantity_order_units' => 'Products Quantity Order Units',
            'products_sort_order' => 'Products Sort Order',
            'price_coll' => 'Price Coll',
            'removable' => 'Removable',
            'raschet_pribil' => 'Raschet Pribil',
        ];
    }

    public function getProductsDescription()
    {
        return $this->hasOne(PartnersProductsDescription::className(), ['products_id' => 'products_id']);
    }
    public function getCategories()
    {
        return $this->hasOne(PartnersProductsToCategories::className(), ['products_id' => 'products_id']);
    }
    public function getProductsAttributes()
    {
        return $this->hasMany(PartnersProductsAttributes::className(), ['products_id' => 'products_id']);
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
