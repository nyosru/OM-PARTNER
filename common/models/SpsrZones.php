<?php
namespace common\models;

use common\patch\ActiveRecordExt;
use Yii;
/**
 * This is the model class for table "spsr_zones".
 *
 * @property integer $id
 * @property integer $zone_id
 * @property integer $spsr_zone_id
 *
 * @property Countries $country
 * @property Categories $categories
 */
class SpsrZones extends ActiveRecordExt
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'spsr_zones';
    }
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'zone_id', 'spsr_zone_id'], 'integer', 'max' => 11],
            [['zone_id', 'spsr_zone_id'], 'required'],
        ];
    }
    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'zone_id' => 'Zone ID',
            'spsr_zone_id' => 'Spsr Zone ID',
        ];
    }
    public function getZones(){
        return $this->hasOne(Zones::class, ['zone_id' => 'zone_id']);
    }
}