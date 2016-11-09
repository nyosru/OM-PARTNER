<?php

namespace common\models;

use common\patch\ActiveRecordExt;
use Yii;

/**
 * This is the model class for table "manufacturers".
 *
 * @property string $manufacturers_id
 * @property string $manufacturers_image
 * @property string $date_added
 * @property string $last_modified
 * @property integer $customer_id
 * @property string $parent_id
 * @property string $subCreater
 * @property string $view_in_html
 * @property string $red_products
 * @property string $person_act
 * @property string $mark_no_delete
 * @property string $admin_group_id
 * @property string $print_checks
 * @property string $admin_id
 * @property string $print_multyCheck
 * @property integer $daysPromotion
 * @property string $products_control
 * @property string $hide_products
 * @property string $transfering
 * @property integer $payment_delay
 * @property integer $repayment_period
 *
 * @property ManufacturersInfo $manufacturersInfo
 * @property ManufacturersInfoList[] $manufacturersInfoLists
 * @property Products[] $products
 * @property Customers $customer
 * @property int $productsCount
 * @property int $activeProductsCount
 */
class Manufacturers extends ActiveRecordExt
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'manufacturers';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['date_added', 'last_modified'], 'safe'],
            [['customer_id', 'parent_id', 'admin_group_id', 'admin_id', 'daysPromotion', 'payment_delay', 'repayment_period', 'individual_margin', 'express', 'admin_company_id' ], 'integer'],
            [['subCreater', 'view_in_html', 'red_products', 'person_act', 'mark_no_delete', 'print_checks', 'print_multyCheck', 'products_control', 'hide_products', 'transfering'], 'string'],
            [['manufacturers_image'], 'string', 'max' => 64]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'manufacturers_id'    => 'Номер поставщика',
            'manufacturers_image' => 'Картинка',
            'date_added'          => 'Дата добавления',
            'last_modified'       => 'Дата последнего изменения',
            'customer_id'         => 'Номер покупателя',
            'parent_id'           => 'Номер предка',
            'subCreater'          => 'Субпроизводитель',
            'view_in_html'        => 'Показывать в HTML отчете',
            'red_products'        => 'Разрешить редактировать товары',
            'person_act'          => 'Отдельный документооборот',
            'mark_no_delete'      => 'Разрешить неудаляемые товары',
            'admin_group_id'      => 'Номер группы администраторов',
            'print_checks'        => 'Разрешить печатать чеки',
            'admin_id'            => 'Номер администратора',
            'print_multyCheck'    => 'Разрешить все чеки за один раз',
            'daysPromotion'       => 'Поднимать товар каждые: *** дней (0 - запрет)',
            'products_control'    => 'Разрешить контроль заказов',
            'hide_products'       => 'Скрыть производителя и все его товары',
            'transfering'         => 'Участие в переводах',
            'payment_delay'       => 'Отсрочка платежа',
            'repayment_period'    => 'Срок возврата',
            'individual_margin'   => 'Индивидуальная наценка',
            'express'             => 'Экспресс',
            'admin_company_id'    => 'Номер закреплённого ИП',
        ];
    }

    public function getManufacturersTimeOrder()
    {
        return $this->hasMany(ManufacturersDiapazon::class, ['manufacturers_id' => 'manufacturers_id']);
    }

    public function getManufacturersInfo()
    {
        return $this->hasMany(ManufacturersInfoList::class, ['manufacturers_id' => 'manufacturers_id']);
    }
}
