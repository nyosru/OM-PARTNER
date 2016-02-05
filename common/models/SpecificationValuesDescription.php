<?php

namespace common\models;

use Yii;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "specification_values_description".
 *
 * @property string $specification_values_description_id
 * @property string $specification_values_id
 * @property integer $language_id
 * @property string $specification_value
 */
class SpecificationValuesDescription extends ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'specification_values_description';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['specification_values_id', 'language_id'], 'integer'],
            [['specification_value'], 'required'],
            [['specification_value'], 'string', 'max' => 128]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'specification_values_description_id' => 'Specification Values Description ID',
            'specification_values_id' => 'Specification Values ID',
            'language_id' => 'Language ID',
            'specification_value' => 'Specification Value',
        ];
    }
}
