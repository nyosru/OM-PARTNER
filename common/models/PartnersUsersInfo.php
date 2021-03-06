<?php

namespace common\models;

use common\patch\ActiveRecordExt;
use Yii;

/**
 * This is the model class for table "partners_users_info".
 *
 * @property integer $id
 * @property string $name
 * @property string $secondname
 * @property string $lastname
 * @property string $adress
 * @property string $city
 * @property string $state
 * @property string $country
 * @property string $postcode
 * @property string $telephone
 * @property string $pasportser
 * @property string $pasportnum
 * @property string $pasportdate
 * @property string $pasportwhere
 * @property integer $customers_id
 */
class PartnersUsersInfo extends ActiveRecordExt
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'partners_users_info';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'name', 'secondname', 'lastname', 'adress', 'city', 'state', 'country', 'postcode', 'telephone', 'pasportser', 'pasportnum', 'pasportwhere', 'pasportdate'], 'required', 'message'=>'должно быть заполненно'],
            [['id', 'customers_id', 'status'], 'integer'],
            [['pasportdate'], 'safe'],
            [['name', 'secondname', 'lastname', 'state', 'country', 'postcode', 'telephone', 'pasportnum', 'pasportser', 'pasportwhere'], 'string', 'max' => 45],
            [['adress'], 'string', 'max' => 100],
            [['city'], 'string', 'max' => 75]
        ];
    }


    public function scenarios()
    {
        return [
            'update_customers' => ['customers_id'],
            'update_passport' => ['pasportser', 'pasportnum', 'pasportdate', 'pasportwhere'],
            'default' => ['id', 'name', 'secondname', 'lastname', 'country', 'state', 'city', 'adress', 'postcode', 'telephone', 'customers_id'],
            'flat1_flat1' => ['id', 'name', 'secondname', 'lastname', 'country', 'state', 'city', 'adress', 'postcode', 'telephone', 'pasportser', 'pasportnum', 'pasportdate', 'pasportwhere'],
            'flat2_flat2' => ['id', 'name', 'secondname', 'lastname', 'country', 'state', 'city', 'adress', 'postcode', 'telephone'],
            '1' => ['id', 'name', 'secondname', 'lastname', 'country', 'state', 'city', 'adress', 'postcode', 'telephone', 'pasportser', 'pasportnum', 'pasportdate', 'pasportwhere'],
            '0' => ['id', 'name', 'secondname', 'lastname', 'country', 'state', 'city', 'adress', 'postcode', 'telephone'],
            'flat3_flat3' => ['id', 'name', 'secondname', 'lastname', 'country', 'state', 'city', 'adress', 'postcode', 'telephone'],
            'flat7_flat7' => ['id', 'name', 'secondname', 'lastname', 'country', 'state', 'city', 'adress', 'postcode', 'telephone'],
            'commentsuserinfo' => ['id', 'name', 'lastname'],
            'saveuser' => ['id', 'name', 'secondname', 'lastname', 'country', 'state', 'city', 'adress','telephone'],

        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Имя',
            'secondname' => 'Отчество',
            'lastname' => 'Фамилия',
            'adress' => 'Адрес',
            'city' => 'Город',
            'state' => 'Область',
            'country' => 'Страна',
            'postcode' => 'Почтовый индекс',
            'telephone' => 'Телефон',
            'pasportser' => 'Серия',
            'pasportnum' => 'Номер',
            'pasportdate' => 'Дата выдачи',
            'pasportwhere' => 'Кем выдан',
            'customers_id' => 'Customers ID',
        ];
    }

    public function getCustomers()
    {
        return $this->hasOne(Customers::className(), ['customers_id' => 'customers_id']);
    }

}
