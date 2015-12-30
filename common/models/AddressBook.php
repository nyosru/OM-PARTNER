<?php

namespace common\models;

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
class AddressBook extends \yii\db\ActiveRecord
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
            [['customers_id', 'entry_country_id', 'entry_zone_id'], 'integer'],
            [['entry_gender', 'entry_firstname', 'entry_lastname', 'entry_street_address', 'entry_postcode', 'entry_city'], 'required'],
            [['birth_day', 'pasport_kogda_vidan'], 'safe'],
            [['pasport_kem_vidan'], 'string'],
            [['entry_gender'], 'string', 'max' => 1],
            [['entry_company', 'entry_firstname', 'entry_lastname', 'entry_suburb', 'entry_city', 'entry_state'], 'string', 'max' => 255],
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
            'entry_firstname' => 'Entry Firstname',
            'entry_lastname' => 'Entry Lastname',
            'otchestvo' => 'Otchestvo',
            'birth_day' => 'Birth Day',
            'pasport_seria' => 'Pasport Seria',
            'pasport_nomer' => 'Pasport Nomer',
            'pasport_kem_vidan' => 'Pasport Kem Vidan',
            'pasport_kogda_vidan' => 'Pasport Kogda Vidan',
            'entry_street_address' => 'Entry Street Address',
            'entry_suburb' => 'Entry Suburb',
            'entry_postcode' => 'Entry Postcode',
            'entry_city' => 'Entry City',
            'entry_state' => 'Entry State',
            'entry_country_id' => 'Entry Country ID',
            'entry_zone_id' => 'Entry Zone ID',
        ];

    }
}
