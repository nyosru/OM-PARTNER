<?php

namespace common\models;

use common\patch\ActiveRecordExt;
use Yii;

/**
 * This is the model class for table "address_book".
 *
 * @property integer $address_book_id
 * @property integer $customers_id
 * @property string $entry_gender
 * @property string $entry_company
 * @property string $entry_firstname
 * @property string $entry_lastname
 * @property string $otchestvo
 * @property string $birth_day
 * @property string $pasport_seria
 * @property string $pasport_nomer
 * @property string $pasport_kem_vidan
 * @property string $pasport_kogda_vidan
 * @property string $entry_street_address
 * @property string $entry_suburb
 * @property string $entry_postcode
 * @property string $entry_city
 * @property string $entry_state
 * @property integer $entry_country_id
 * @property integer $entry_zone_id
 */
class AddressBook extends ActiveRecordExt
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'address_book';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['customers_id', 'entry_zone_id'], 'integer'],
            [['entry_gender', 'entry_firstname', 'entry_lastname', 'entry_street_address', 'entry_postcode', 'entry_city'], 'required'],
            [['birth_day', 'pasport_kogda_vidan'], 'safe'],
            [['pasport_kem_vidan'], 'string'],
            [['entry_gender'], 'string', 'max' => 1],
            [['entry_company', 'entry_firstname', 'entry_lastname', 'entry_suburb', 'entry_city', 'entry_state','entry_country_id'], 'string', 'max' => 255],
            [['otchestvo'], 'string', 'max' => 128],
            [['pasport_seria', 'entry_postcode'], 'string', 'max' => 10],
            [['pasport_nomer'], 'string', 'max' => 20],
            [['entry_street_address'], 'string', 'max' => 64]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'address_book_id' => 'Address Book ID',
            'customers_id' => 'Customers ID',
            'entry_gender' => 'Entry Gender',
            'entry_company' => 'Entry Company',
            'entry_firstname' => 'Имя',
            'entry_lastname' => 'Фамилия',
            'otchestvo' => 'Отчество',
            'birth_day' => 'Дата рождения (в формате ГГГГ-ММ-ДД)',
            'pasport_seria' => 'Серия',
            'pasport_nomer' => 'Номер',
            'pasport_kem_vidan' => 'Кем выдан',
            'pasport_kogda_vidan' => 'Когда выдан',
            'entry_street_address' => 'Адрес',
            'entry_suburb' => 'Entry Suburb',
            'entry_postcode' => 'Почтовый индекс',
            'entry_city' => 'Город',
            'entry_state' => 'Entry State',
            'entry_country_id' => 'Страна',
            'entry_zone_id' => 'Регион',
        ];

    }
}
