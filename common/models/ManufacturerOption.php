<?php

namespace common\models;


use common\patch\ActiveRecordExt;


/**
 * This is the model class for table "manufacturer_option".
 *
 * @property integer $option_id
 * @property string $option_name
 * @property string $option_description
 *
 * @property ManufacturerOptionValue[] $manufacturerOptionValues
 * @property Manufacturers[] $manufacturers
 */
class ManufacturerOption extends ActiveRecordExt
{

    const OPT_DJAMSHUT = 1;
    const OPT_WARNING = 2;
    const OPT_CASHLESS_AS_CASH = 11;
    //Поставщики г. Иваново
    const OPTION_CITY_IVANOVO = 'CITY_IVANOVO';
    //Возврат товаров
    const OPTION_RETURN_GOODS = 'IS_RETURNABLE';
    //Поставщики, чьи товары заблокированы для сканировщиков. Их обрабатывает группа пересорта
    const OPTION_IS_RESORT_ONLY = 'IS_RESORT_ONLY';
    //Построение статистики по закупкам/продажам
    const OPTION_BUILD_STATISTICS = 'IS_FAVORITE_IN_CABINET';
    //Поставщики 3 склада. Их товары заблокированы для сканировщиков.
    const OPTION_IS_OM_3STORAGE_BLOCKING = 'IS_OM_3STORAGE_BLOCKING';
    //Товары этих поставщиков заблокированы для сканировщиков.
    //Опция нужна для тех, кого надо запретить, но он не попал ни в какие другие опции для запрета
    const OPTION_IS_UNDERGROUND = 'IS_UNDERGROUND';
    //Поставщики-исключения, на которых, несмотря на их безнальность, генерируются акты, а не накладные
    const OPTION_CASHLESS_AS_CASH_FOR_DOCUMENTS = 'CASHLESS_AS_CASH_FOR_DOCUMENTS';
    //Запрет на изменение количества товаров
    const BAN_CHANGE_PRODUCT_QUANTITY = 'BAN_CHANGE_PRODUCT_QUANTITY';
    //Поставщики, чьи товары помечены иконкой Люкс (брендовый поставщики)
    const OPTION_IS_LUX = 'IS_LUX';

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'manufacturer_option';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['option_name'], 'required'],
            [['option_name'], 'unique'],
            [['option_name', 'option_description'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'option_id' => 'ID опции',
            'option_name' => 'Имя опции (константа)',
            'option_description' => 'Описание опции'
        ];
    }

    /**
     * @return ActiveQuery
     */
    public function getManufacturerOptionValues()
    {
        return $this->hasMany(ManufacturerOptionValue::className(), ['option_id' => 'option_id']);
    }

    /**
     * @return ActiveQuery
     */
    public function getManufacturers()
    {
        return $this->hasMany(Manufacturers::className(), ['manufacturers_id' => 'manufacturer_id'])->via('manufacturerOptionValues');
    }

    public static function getOptionID($optionID)
    {
        $manOption = self::find()
            ->where('option_id=:optionID XOR option_name=:optionID', [':optionID' => $optionID])
            ->one();
        if ($manOption) {
            return $manOption->option_id;
        }
        return $optionID;
    }
}