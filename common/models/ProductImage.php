<?php
namespace common\models;
use common\patch\ActiveRecordExt;

/**
 * This is the model class for table "product_image".
 *
 * @property integer     $product_image_id
 * @property integer     $product_id
 * @property string      $image_file
 */
class ProductImage extends ActiveRecordExt
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'product_image';
    }
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['product_id'], 'required'],
            [['product_id'], 'integer'],
            [['!image_file'], 'string', 'max' => 255],
            [['imageFormName'], 'string', 'max' => 255],
        ];
    }
    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'product_image_id' => 'Product Image ID',
            'product_id'       => 'Product ID',
            'image_file'       => 'Image File',
        ];
    }


    public function getProduct()
    {
        return $this->hasOne(PartnersProducts::class, ['products_id' => 'product_id']);
    }
    
}