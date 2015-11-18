<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "admin_companies".
 *
 * @property string $companies_id
 * @property string $name
 * @property string $name_kem
 * @property string $name_kogo
 * @property string $name_full
 * @property string $inn
 * @property string $kpp
 * @property string $ogrn
 * @property string $okpo
 * @property string $rs
 * @property string $bank_name
 * @property string $bik
 * @property string $ks
 * @property string $address
 * @property string $yur_address
 * @property string $fakt_address
 * @property string $telephone
 * @property string $fax
 * @property string $email
 * @property string $director
 * @property string $pasport_seria
 * @property string $pasport_nomer
 * @property string $pasport_kem
 * @property string $pasport_kogda
 * @property string $accountant
 * @property string $default_provider
 * @property string $faksimilia_file
 * @property integer $faksimilia_width
 */
class AdminCompanies extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'admin_companies';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['companies_id'], 'required'],
            [['companies_id', 'faksimilia_width'], 'integer'],
            [['pasport_kem'], 'string'],
            [['pasport_kogda'], 'safe'],
            [['name', 'inn', 'kpp', 'ogrn', 'okpo', 'rs', 'bank_name', 'bik', 'ks', 'address', 'yur_address', 'fakt_address', 'telephone', 'fax', 'email', 'director', 'accountant'], 'string', 'max' => 255],
            [['name_kem', 'name_kogo', 'name_full'], 'string', 'max' => 200],
            [['pasport_seria'], 'string', 'max' => 8],
            [['pasport_nomer'], 'string', 'max' => 18],
            [['default_provider'], 'string', 'max' => 1],
            [['faksimilia_file'], 'string', 'max' => 20]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'companies_id' => 'Companies ID',
            'name' => 'Name',
            'name_kem' => 'Name Kem',
            'name_kogo' => 'Name Kogo',
            'name_full' => 'Name Full',
            'inn' => 'Inn',
            'kpp' => 'Kpp',
            'ogrn' => 'Ogrn',
            'okpo' => 'Okpo',
            'rs' => 'Rs',
            'bank_name' => 'Bank Name',
            'bik' => 'Bik',
            'ks' => 'Ks',
            'address' => 'Address',
            'yur_address' => 'Yur Address',
            'fakt_address' => 'Fakt Address',
            'telephone' => 'Telephone',
            'fax' => 'Fax',
            'email' => 'Email',
            'director' => 'Director',
            'pasport_seria' => 'Pasport Seria',
            'pasport_nomer' => 'Pasport Nomer',
            'pasport_kem' => 'Pasport Kem',
            'pasport_kogda' => 'Pasport Kogda',
            'accountant' => 'Accountant',
            'default_provider' => 'Default Provider',
            'faksimilia_file' => 'Faksimilia File',
            'faksimilia_width' => 'Faksimilia Width',
        ];
    }
}
