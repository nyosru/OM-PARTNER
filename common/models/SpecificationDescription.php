<?php

namespace common\models;

use common\patch\ActiveRecordExt;
use Yii;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "specification_description".
 *
 * @property integer $specification_description_id
 * @property string $specifications_id
 * @property integer $language_id
 * @property string $specification_name
 * @property string $specification_description
 * @property string $specification_prefix
 * @property string $specification_suffix
 *
 * @property Specifications $specifications
 */
class SpecificationDescription extends ActiveRecordExt
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'specification_description';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['specifications_id', 'language_id'], 'integer'],
            [['language_id', 'specification_description'], 'required'],
            [['specification_name'], 'string', 'max' => 255],
            [['specification_description', 'specification_prefix', 'specification_suffix'], 'string', 'max' => 128],
            [['specification_name'], 'unique']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'specification_description_id' => 'Specification Description ID',
            'specifications_id' => 'Specifications ID',
            'language_id' => 'Language ID',
            'specification_name' => 'Specification Name',
            'specification_description' => 'Specification Description',
            'specification_prefix' => 'Specification Prefix',
            'specification_suffix' => 'Specification Suffix',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSpecifications()
    {
        return $this->hasOne(Specifications::className(), ['specifications_id' => 'specifications_id']);
    }
}
