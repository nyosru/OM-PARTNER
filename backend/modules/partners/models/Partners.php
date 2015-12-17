<?php

namespace backend\modules\partners\models;

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
class Partners extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'partners';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'domain', 'template'], 'required'],
            [['allow_cat', 'allow_prod'], 'string'],
            [['name', 'domain', 'template'], 'string', 'max' => 45],
            [['domain'], 'unique'],
            [['customer_id'],'integer']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Фирма',
            'domain' => 'Домен',
            'template' => 'Шаблон сайта',
            'allow_cat' => 'Доступные каталоги',
            'allow_prod' => 'Доступные продукты',
            'customer_id' => 'Customer id'
        ];
    }

}
