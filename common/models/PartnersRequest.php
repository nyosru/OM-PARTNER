<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "partners_request".
 *
 * @property integer $id
 * @property integer $partners_id
 * @property string $post
 * @property string $date_add
 * @property string $date_modify
 * @property integer $status
 * @property resource $comments
 * @property integer $supervisor
 */
class PartnersRequest extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'partners_request';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['partners_id', 'post', 'date_add', 'date_modify', 'status'], 'required'],
            [['partners_id', 'status', 'supervisor'], 'integer'],
            [['post', 'comments'], 'string'],
            [['date_add', 'date_modify'], 'safe']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'partners_id' => 'Partners ID',
            'post' => 'Post',
            'date_add' => 'Date Add',
            'date_modify' => 'Date Modify',
            'status' => 'Status',
            'comments' => 'Comments',
            'supervisor' => 'Supervisor',
        ];
    }
}
