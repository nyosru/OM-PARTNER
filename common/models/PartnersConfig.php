<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 16.09.2015
 * Time: 10:11
 */


namespace common\models;

use common\patch\ActiveRecordExt;
use Yii;

/**
 * This is the model class for table "partners".
 *
 * @property integer $id
 * @property string $name
 * @property string $domain
 * @property string $template
 * @property resource $allow_cat
 * @property resource $allow_prod
 */
class PartnersConfig extends ActiveRecordExt
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'partners_config';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id'], 'integer'],
            [['type'], 'string', 'max' => 100],
            [['value'], 'string'],
            [['partners_id', 'active'], 'integer']
        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => 'id',
            'type' => 'type',
            'value' => 'value',
            'partners_id' => 'partners_id',
            'active' => 'active',
        ];

    }

}