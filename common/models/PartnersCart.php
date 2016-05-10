<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "partners_cart".
 *
 * @property integer $id
 * @property integer $partners_id
 * @property integer $user_id
 * @property string $cart_body
 * @property string $comment
 * @property integer $sharing
 * @property string $date_added
 * @property string $date_modified
 */
class PartnersCart extends \yii\db\ActiveRecord
{

    public static function tableName()
    {
        return 'partners_cart';
    }


    public function rules()
    {
        return [
            [['partners_id', 'user_id', 'cart_body', 'date_added', 'date_modified'], 'required'],
            [['partners_id', 'user_id', 'sharing'], 'integer'],
            [['cart_body'], 'string'],
            [['date_added', 'date_modified'], 'safe'],
            [['comment'], 'string', 'max' => 350],
        ];
    }


    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'partners_id' => 'Partners ID',
            'user_id' => 'User ID',
            'cart_body' => 'Cart Body',
            'comment' => 'Comment',
            'sharing' => 'Sharing',
            'date_added' => 'Date Added',
            'date_modified' => 'Date Modified',
        ];
    }
}