<?php
namespace common\models;


use common\patch\ActiveRecordExt;

class PartnersUserInfoForm extends ActiveRecordExt
{
    public static function tableName()
    {
        return 'partners_users_info';
    }

    public function attributeLabels()
    {
        return [
            'id'           => 'ID',
            'adress'       => 'Адресс',
            'city'         => 'Город',
            'state'        => 'Регион',
            'country'      => 'Страна',
            'postcode'     => 'Почтовый индекс',
            'telephone'    => 'Телефон',
            'pasportser'   => 'Серия паспорта',
            'pasportnum'   => 'Номер паспорта',
            'pasportwhere' => 'Кем выдан',
            'pasportdate'  => 'Когда выдан',
        ];
    }

    public function rules()
    {
        return [
            [['state', 'country', 'postcode', 'telephone', 'pasportnum', 'pasportser', 'pasportwhere'], 'string', 'max' => 45],
            [['id'], 'integer'],
            [['pasportdate'], 'safe'],
            [['id'], 'safe'],
            [['adress'], 'string', 'max' => 100],
            [['city'], 'string', 'max' => 75],
        ];
    }

}