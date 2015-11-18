<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "orders_total".
 *
 * @property string $orders_total_id
 * @property string $orders_id
 * @property string $title
 * @property string $text
 * @property string $value
 * @property string $class
 * @property integer $sort_order
 * @property string $comment
 */
class OrdersTotal extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'orders_total';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title', 'text', 'class'], 'required'],
            [['orders_total_id', 'orders_id', 'sort_order'], 'integer'],
            [['value'], 'number'],
            [['comment'], 'string'],
            [['title', 'text', 'class'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'orders_total_id' => 'Orders Total ID',
            'orders_id' => 'Orders ID',
            'title' => 'Title',
            'text' => 'Text',
            'value' => 'Value',
            'class' => 'Class',
            'sort_order' => 'Sort Order',
            'comment' => 'Comment',
        ];
    }
}
