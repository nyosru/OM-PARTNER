<?php

namespace common\models;

use common\patch\ActiveRecordExt;
use Yii;

/**
 * This is the model class for table "partners_news".
 *
 * @property integer $id
 * @property integer $partners_id
 * @property string $name
 * @property string $post
 * @property string $tegs
 * @property string $date_added
 * @property string $date_modified
 * @property integer $status
 * @property string $image
 */
class PartnersNews extends ActiveRecordExt
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'partners_news';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['partners_id', 'name', 'post', 'date_added', 'date_modified', 'status','image'], 'required'],
            [['partners_id', 'status'], 'integer'],
            [['name', 'post', 'tegs','image'], 'string'],
            [['date_added', 'date_modified'], 'safe']
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
            'name' => 'Name',
            'post' => 'Post',
            'tegs' => 'Tegs',
            'date_added' => 'Date Added',
            'date_modified' => 'Date Modified',
            'status' => 'Status',
            'image' => 'Image',
        ];
    }
}
