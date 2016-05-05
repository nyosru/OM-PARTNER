<?php
namespace common\models;
use common\patch\ActiveRecordExt;
use Yii;
/**
 * This is the model class for table "admin_companies_bank".
 *
 * @property string $admin_companies_bank_id
 * @property string $admin_companies_id
 * @property string $rs
 * @property string $ks
 * @property string $bik
 * @property string $adress
 * @property string $default_b
 * @property string $bank_active
 * @property int $ratio
 */
class AdminCompaniesBank extends ActiveRecordExt
{
    const STATUS_INACTIVE = '0';
    const STATUS_ACTIVE = '1';
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'admin_companies_bank';
    }
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['admin_companies_id', 'rs', 'ks', 'bik'], 'required'],
            [['admin_companies_id', 'ratio'], 'integer'],
            [['adress', 'default_b', 'bank_active', 'short_name'], 'string'],
            [['rs', 'ks'], 'string', 'max' => 40],
            [['bik'], 'string', 'max' => 20],
            [['short_name'], 'string', 'max' => 8]
        ];
    }
    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'admin_companies_bank_id' => 'Admin Companies Bank ID',
            'admin_companies_id' => 'Admin Companies ID',
            'rs' => 'Rs',
            'ks' => 'Ks',
            'bik' => 'Bik',
            'adress' => 'Adress',
            'default_b' => 'Default B',
        ];
    }
   

}