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
class Test extends ActiveRecordExt
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'test';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'tt'], 'required'],

        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'Countries ID',
            'tt' => 'Countries ID',
        ];
    }

}


