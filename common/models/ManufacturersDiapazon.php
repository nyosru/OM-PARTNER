<?php

namespace common\models;

use common\patch\ActiveRecordExt;
use Yii;

class ManufacturersDiapazon extends ActiveRecordExt
{
    public static function tableName()
    {
        return 'manufacturers_diapazon';
    }

    public static function primaryKey()
    {
        return ['manufacturers_id', 'week_day'];
    }

    public function rules()
    {
        return [
            [['manufacturers_id', 'week_day'], 'required'],
            [['manufacturers_id'], 'integer'],
            [['week_day'], 'in', 'range' => [0, 1, 2, 3, 4, 5, 6]],
            [['start_time', 'stop_time'], 'integer', 'min' => 0, 'max' => 86400],
        ];
    }

    public function attributeLabels()
    {
        return [
            'manufacturers_id' => 'ID поставщика',
            'week_day' => 'День недели (пн: 0, вс: 6)',
            'start_time' => 'Время начала (в сек.)',
            'stop_time' => 'Время окончания (в сек.)',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getManufacturers()
    {
        return $this->hasOne(Manufacturers::class, ['manufacturers_id' => 'manufacturers_id']);
    }
}