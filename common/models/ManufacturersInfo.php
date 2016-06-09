<?php
namespace common\models;

use common\patch\ActiveRecordExt;
use Yii;

/**
 * This is the model class for table "manufacturers_info".
 *
 * @property string $manufacturers_id
 * @property string $languages_id
 * @property string $manufacturers_name
 * @property string $manufacturers_description
 * @property string $manufacturers_meta_title
 * @property string $manufacturers_meta_keywords
 * @property string $manufacturers_meta_description
 * @property string $manufacturers_url
 * @property integer $url_clicked
 * @property string $date_last_click
 *
 * @property Manufacturers $manufacturers
 * @property ManufacturersInfoList $manufacturersInfoListDefault
 */
class ManufacturersInfo extends ActiveRecordExt
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'manufacturers_info';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            ['languages_id', 'default', 'value' => 1],
            [['manufacturers_id', 'languages_id', 'manufacturers_name'], 'required'],
            [['manufacturers_id', 'languages_id', 'url_clicked'], 'integer'],
            [['manufacturers_description', 'manufacturers_meta_title', 'manufacturers_meta_keywords', 'manufacturers_meta_description'], 'string'],
            [['manufacturers_name', 'manufacturers_url'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'manufacturers_id' => 'Manufacturers ID',
            'languages_id' => 'Languages ID',
            'manufacturers_name' => 'Manufacturers Name',
            'manufacturers_description' => 'Manufacturers Description',
            'manufacturers_meta_title' => 'Manufacturers Meta Title',
            'manufacturers_meta_keywords' => 'Manufacturers Meta Keywords',
            'manufacturers_meta_description' => 'Manufacturers Meta Description',
            'manufacturers_url' => 'Manufacturers Url',
            'url_clicked' => 'Url Clicked',
            'date_last_click' => 'Date Last Click',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getManufacturers()
    {
        return $this->hasOne(Manufacturers::className(), ['manufacturers_id' => 'manufacturers_id']);
    }

    public function getManufacturersInfoLists()
    {
        return $this->hasMany(ManufacturersInfoList::className(), ['manufacturers_id' => 'manufacturers_id']);
    }

    public function getManufacturersInfoListDefault()
    {
        return $this->hasOne(ManufacturersInfoList::className(), ['manufacturers_id' => 'manufacturers_id'])
            ->where(['set_default' => '1']);
    }

    public function getDefault()
    {
        $result = $this->manufacturersInfoListDefault;
        if (!empty($result)) {
            $result = $result->toArray([], ['man2provPrifixes']);
        }
        return $result;
    }

}