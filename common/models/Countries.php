<?php

namespace common\models;

use common\patch\ActiveRecordExt;
use Yii;

/**
 * This is the model class for table "countries".
 *
 * @property integer $countries_id
 * @property string $countries_name
 * @property string $countries_iso_code_2
 * @property string $countries_iso_code_3
 * @property integer $address_format_id
 */
class Countries extends ActiveRecordExt
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'countries';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['countries_id', 'countries_name', 'countries_iso_code_2', 'countries_iso_code_3'], 'required'],
            [['countries_id', 'address_format_id'], 'integer'],
            [['countries_name'], 'string', 'max' => 64],
            [['countries_iso_code_2'], 'string', 'max' => 2],
            [['countries_iso_code_3'], 'string', 'max' => 3]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'countries_id' => 'Countries ID',
            'countries_name' => 'Countries Name',
            'countries_iso_code_2' => 'Countries Iso Code 2',
            'countries_iso_code_3' => 'Countries Iso Code 3',
            'address_format_id' => 'Address Format ID',
        ];
    }

    public function getZones()
    {
        return $this->hasMany(Countries::className(), ['countries_id' => 'zone_country_id']);
    }
}


