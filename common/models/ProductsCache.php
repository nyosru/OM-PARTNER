<?php
namespace common\models;

use common\patch\ActiveRecordExt;
use Yii;

/**
 * This is the model class for table "products_cache".
 *
 * @property string $products_id
 * @property string $products_cache_text
 * @property string $cache_time
 *
 * @property Products $products
 */
class ProductsCache extends ActiveRecordExt
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'products_cache';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['products_cache_text'], 'string'],
            [['cache_time'], 'safe']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'products_id' => 'Products ID',
            'products_cache_text' => 'Products Cache Text',
            'cache_time' => 'Cache Time',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProducts()
    {
        return $this->hasOne(PartnersProducts::className(), ['products_id' => 'products_id']);
    }
}