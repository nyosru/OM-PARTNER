<?php

namespace common\models;

use common\patch\ActiveRecordExt;
use Yii;

/**
 * This is the model class for table "partners_domain".
 *
 * @property integer $id
 * @property integer $partner_id
 * @property string $version
 * @property string $domain
 * @property string $template
 */
class PartnersDomain extends ActiveRecordExt
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'partners_domain';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['partner_id','status'], 'integer'],
            [['partner_id'], 'required'],
            [['domain'], 'string', 'max' => 145],
            [['version', 'template'], 'string', 'max' => 45],
        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'partner_id' => 'ID партнера',
            'domain' => 'Домен',
            'template' => 'Шаблон',
            'version' => 'Версия',
            'status' => 'Активность',
        ];

    }

}