<?php
/**
 * Created by PhpStorm.
 * User: dmitriy
 * Date: 06.04.16
 * Time: 15:02
 */

namespace common\models;

use common\patch\ActiveRecordExt;
use Yii;

/**
 * Конфигурация системы. Кое-где всё ещё используется, поэтому обращаться осторожно.
 *
 * @property integer $configuration_id
 * @property string $configuration_title
 * @property string $configuration_key
 * @property string $configuration_value
 * @property string $configuration_description
 * @property integer $configuration_group_id
 * @property integer $sort_order
 * @property string $last_modified
 * @property string $date_added
 * @property string $use_function
 * @property string $set_function
 */
class Configuration extends ActiveRecordExt
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['configuration_key'], 'required'],
            [['configuration_value'], 'string'],
            [['configuration_group_id', 'sort_order'], 'integer'],
            [['last_modified', 'date_added'], 'safe'],
            [['configuration_title', 'configuration_description', 'use_function', 'set_function'], 'string', 'max' => 255],
            [['configuration_key'], 'string', 'max' => 64]
        ];
    }
    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'configuration_id' => 'Configuration ID',
            'configuration_title' => 'Configuration Title',
            'configuration_key' => 'Configuration Key',
            'configuration_value' => 'Configuration Value',
            'configuration_description' => 'Configuration Description',
            'configuration_group_id' => 'Configuration Group ID',
            'sort_order' => 'Sort Order',
            'last_modified' => 'Last Modified',
            'date_added' => 'Date Added',
            'use_function' => 'Use Function',
            'set_function' => 'Set Function',
        ];
    }

}