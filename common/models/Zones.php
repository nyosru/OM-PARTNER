<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "zones".
 *
 * @property integer $zone_id
 * @property integer $zone_country_id
 * @property string $zone_code
 * @property string $zone_name
 */
class Zones extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'zones';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['zone_id', 'zone_code', 'zone_name'], 'required'],
            [['zone_id', 'zone_country_id'], 'integer'],
            [['zone_code', 'zone_name'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'zone_id' => 'Zone ID',
            'zone_country_id' => 'Zone Country ID',
            'zone_code' => 'Zone Code',
            'zone_name' => 'Zone Name',
        ];
    }
}
