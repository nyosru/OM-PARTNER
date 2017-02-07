<?php

namespace common\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "coupons".
 *
 * @property integer $coupon_id
 * @property string $coupon_type
 * @property string $coupon_code
 * @property string $coupon_amount
 * @property string $coupon_minimum_order
 * @property string $coupon_start_date
 * @property string $coupon_expire_date
 * @property integer $uses_per_coupon
 * @property integer $uses_per_user
 * @property string $restrict_to_products
 * @property string $restrict_to_categories
 * @property string $restrict_to_customers
 * @property string $coupon_active
 * @property string $date_created
 * @property string $date_modified
 * @property boolean $newcomers_only
 */
class Coupons extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'coupons';
    }

    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'timestamp' => [
                'class' => TimestampBehavior::className(),
                'attributes' => [
                    ActiveRecord::EVENT_BEFORE_INSERT => 'date_created',
                    ActiveRecord::EVENT_BEFORE_UPDATE => 'date_modified',
                ],
                'value' => function() {
                    return date("Y-m-d H:i:s");
                },
            ],
        ];
    }
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['coupon_code','coupon_amount','coupon_minimum_order','coupon_start_date', 'coupon_expire_date','uses_per_coupon','uses_per_user'], 'required'],
            [['coupon_amount', 'coupon_minimum_order'], 'number'],
            [['coupon_start_date', 'coupon_expire_date', 'date_created', 'date_modified'], 'safe'],
            [['uses_per_coupon', 'uses_per_user'], 'integer'],
            [['restrict_to_customers'], 'string'],
            [['coupon_type', 'coupon_active'], 'string', 'max' => 1],
            [['coupon_code'],'unique'],
            [['newcomers_only'], 'boolean'],
            [['coupon_code', 'restrict_to_products', 'restrict_to_categories'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'coupon_id' => 'ID',
            'coupon_type' => 'Тип купона',
            'coupon_code' => 'Код купона',
            'coupon_amount' => 'Номинал купона',
            'coupon_minimum_order' => 'Минимальная сумма',
            'coupon_start_date' => 'Дата активации',
            'coupon_expire_date' => 'Дата дезактивации',
            'uses_per_coupon' => 'Количество купонов',
            'uses_per_user' => 'Количество купонов на пользователя',
            'restrict_to_products' => 'Продукты',
            'restrict_to_categories' => 'Категории',
            'restrict_to_customers' => 'Пользователи',
            'coupon_active' => 'Активен',
            'date_created' => 'Дата создания',
            'date_modified' => 'Дата изменения',
            'newcomers_only' => 'Флаг. Только для новых клиентов'
        ];
    }
}
