<?php

namespace common\models;

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
class Manufacturers extends \yii\db\ActiveRecord
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
            [['customer_id', 'parent_id', 'admin_group_id', 'admin_id', 'daysPromotion', 'payment_delay', 'repayment_period'], 'integer'],
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
            'manufacturers_id' => 'Manufacturers ID',
            'manufacturers_image' => 'Manufacturers Image',
            'date_added' => 'Date Added',
            'last_modified' => 'Last Modified',
            'customer_id' => 'Customer ID',
            'parent_id' => 'Parent ID',
            'subCreater' => 'Sub Creater',
            'view_in_html' => 'View In Html',
            'red_products' => 'Red Products',
            'person_act' => 'Person Act',
            'mark_no_delete' => 'Mark No Delete',
            'admin_group_id' => 'Admin Group ID',
            'print_checks' => 'Print Checks',
            'admin_id' => 'Admin ID',
            'print_multyCheck' => 'Print Multy Check',
            'daysPromotion' => 'Days Promotion',
            'products_control' => 'Products Control',
            'hide_products' => 'Hide Products',
            'transfering' => 'Transfering',
            'payment_delay' => 'Payment Delay',
            'repayment_period' => 'Repayment Period',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
}
