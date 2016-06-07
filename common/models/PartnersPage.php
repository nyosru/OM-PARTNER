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
 * @property string $type
 * @property string $tags
 * @property string $content
 * @property integer $partners_id
 * @property integer $active
 * @property integer $viewed
 * @property datetime $date_modify
 * @property datetime $date_add
 */
class PartnersPage extends ActiveRecordExt
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'partners_page';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id'], 'integer'],
            [['type'], 'string', 'max' => 100],
            [['tags', 'content', 'name'], 'string'],
            [['partners_id', 'active', 'viewed'], 'integer'],
            [['date_modify', 'date_add'], 'safe']
        ];
    }


}