<?php
namespace common\models;

use common\patch\ActiveRecordExt;
use Yii;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "tax_rates".
 *
 * @property integer $tax_rates_id
 * @property integer $tax_zone_id
 * @property integer $tax_class_id
 * @property integer $tax_priority
 * @property string $tax_rate
 * @property string $tax_description
 * @property string $last_modified
 * @property string $date_added
 *
 */
class TaxRates extends ActiveRecordExt
{

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tax_rates';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['tax_description', 'tax_zone_id', 'tax_class_id'], 'required'],
            [['tax_zone_id', 'tax_class_id', 'tax_priority'], 'integer'],
            ['tax_zone_id', 'exist', 'targetAttribute' => 'geo_zone_id'],
            ['tax_class_id', 'exist', 'targetAttribute' => 'tax_class_id'],
            [['tax_rate'], 'number'],
            [['last_modified', 'date_added'], 'default'],
            [['tax_description'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'tax_rates_id' => 'Tax Rates ID',
            'tax_zone_id' => 'Tax Zone ID',
            'tax_class_id' => 'Tax Class ID',
            'tax_priority' => 'Tax Priority',
            'tax_rate' => 'Tax Rate',
            'tax_description' => 'Tax Description',
            'last_modified' => 'Last Modified',
            'date_added' => 'Date Added',
        ];
    }

}