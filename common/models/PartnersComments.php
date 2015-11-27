<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "partners_comments".
 *
 * @property integer $id
 * @property integer $partners_id
 * @property integer $user_id
 * @property integer $category
 * @property string $post
 * @property string $date_added
 * @property string $date_modified
 * @property integer $status
 */
class PartnersComments extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'partners_comments';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['partners_id', 'user_id', 'category', 'post', 'date_added', 'date_modified', 'status'], 'required'],
            [['partners_id', 'user_id', 'category', 'status'], 'integer'],
            [['post'], 'string'],
            [['date_added', 'date_modified', 'relate_id'], 'safe']
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
            'user_id' => 'User ID',
            'category' => 'Category',
            'relate_id' => 'Relate',
            'post' => 'Post',
            'date_added' => 'Date Added',
            'date_modified' => 'Date Modified',
            'status' => 'Status',
        ];
    }

    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }
}
