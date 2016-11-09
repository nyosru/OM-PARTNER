<?php

namespace common\models;


use common\patch\ActiveRecordExt;


/**
 * This is the model class for table "manufacturer_option_value".
 *
 * @property integer $manufacturer_id
 * @property integer $option_id
 * @property string $option_data
 *
 * @property Manufacturers $manufacturer
 * @property ManufacturerOption $option
 */
class ManufacturerOptionValue extends ActiveRecordExt
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'manufacturer_option_value';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['manufacturer_id', 'option_id', 'option_data'], 'required'],
            [['manufacturer_id', 'option_id'], 'integer'],
            [['option_data'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'manufacturer_id' => 'Manufacturer ID',
            'option_id' => 'Option ID',
            'option_data' => 'Option Data',
        ];
    }

    public function fields()
    {
        return array_merge(parent::fields(), [
            'option_name' => function(){
                return $this->option->option_name;
            },
            'option_description' => function(){
                return $this->option->option_description;
            },
        ]);
    }

    /**
     * @return ActiveQuery
     */
    public function getManufacturer()
    {
        return $this->hasOne(Manufacturers::className(), ['manufacturers_id' => 'manufacturer_id']);
    }

    /**
     * @return ActiveQuery
     */
    public function getOption()
    {
        return $this->hasOne(ManufacturerOption::className(), ['option_id' => 'option_id']);
    }
}