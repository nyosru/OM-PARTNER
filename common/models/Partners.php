<?php

namespace common\models;

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

            [['allow_cat', 'allow_prod'], 'string'],
            [['name', 'domain', 'template'], 'string', 'max' => 45],
            [['customers_id'],'integer']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'domain' => 'Domain',
            'template' => 'Template',
            'allow_cat' => 'Allow Cat',
            'allow_prod' => 'Allow Prod',
            'customers_id' => 'Customer id'
        ];
    }
    public function GetId($server)
    {
        $var = $this->find()->where(['domain' => $server])->asArray()->One();
        return $var['id'];
    }


    public function GetPartnerIdByUserName($username)
    {
        $var = $this->find()->where(['username' => $username])->asArray()->One();
        return $var['id_partners'];
    }



    public function GetAllowCat($id)
    {
        $var = $this->find()->where(['id' => $id])->asArray()->One();
        $var = explode(',', $var['allow_cat']);
        return $var;
    }

    public function GetNamePartner($id)
    {
        $var = $this->find()->where(['id' => $id])->asArray()->One();
        return $var['name'];
    }
    public function GetTemplate($id)
    {
        $var = $this->find()->where(['id' => $id])->asArray()->One();
        return $var['template'];
    }


}

