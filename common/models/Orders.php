<?php

namespace common\models;

use common\patch\ActiveRecordExt;
use Yii;

/**
 * This is the model class for table "orders".
 *
 * @property string $orders_id
 * @property string $ur_or_fiz
 * @property integer $customers_id
 * @property integer $customers_groups_id
 * @property string $customers_name
 * @property string $customers_company
 * @property string $customers_street_address
 * @property string $customers_suburb
 * @property string $customers_city
 * @property string $customers_postcode
 * @property string $customers_state
 * @property string $customers_country
 * @property string $customers_telephone
 * @property string $customers_email_address
 * @property integer $customers_address_format_id
 * @property integer $delivery_adress_id
 * @property string $delivery_name
 * @property string $delivery_lastname
 * @property string $delivery_otchestvo
 * @property string $delivery_pasport_seria
 * @property string $delivery_pasport_nomer
 * @property string $delivery_pasport_kem_vidan
 * @property string $delivery_pasport_kogda_vidan
 * @property string $delivery_company
 * @property string $delivery_street_address
 * @property string $delivery_suburb
 * @property string $delivery_city
 * @property string $delivery_postcode
 * @property string $delivery_state
 * @property string $delivery_country
 * @property integer $delivery_address_format_id
 * @property string $billing_name
 * @property string $billing_company
 * @property string $billing_street_address
 * @property string $billing_suburb
 * @property string $billing_city
 * @property string $billing_postcode
 * @property string $billing_state
 * @property string $billing_country
 * @property integer $billing_address_format_id
 * @property string $payment_method
 * @property string $payment_info
 * @property string $cc_type
 * @property string $cc_owner
 * @property string $cc_number
 * @property string $cc_expires
 * @property string $last_modified
 * @property string $date_purchased
 * @property string $date_akt
 * @property integer $buh_orders_id
 * @property integer $nomer_akt
 * @property integer $orders_status
 * @property integer $orders_storage
 * @property integer $seats_count
 * @property string $orders_date_finished
 * @property string $currency
 * @property string $currency_value
 * @property string $customers_referer_url
 * @property string $customers_fax
 * @property string $shipping_module
 * @property string $referer
 * @property string $print_torg
 * @property integer $default_provider
 * @property integer $seller_id
 * @property string $orders_discont
 * @property string $orders_discont_comment
 */
class Orders extends ActiveRecordExt
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'orders';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['customers_id', 'customers_groups_id', 'customers_address_format_id', 'delivery_adress_id', 'delivery_address_format_id', 'billing_address_format_id', 'buh_orders_id', 'nomer_akt', 'orders_status', 'orders_storage', 'seats_count', 'default_provider', 'seller_id', 'site_side_email_flag'], 'integer'],
            [['customers_name', 'customers_street_address', 'customers_city', 'customers_postcode', 'customers_country', 'customers_telephone', 'customers_email_address', 'delivery_name', 'delivery_street_address', 'delivery_city', 'delivery_postcode', 'delivery_country', 'billing_name', 'billing_street_address', 'billing_city', 'billing_postcode', 'billing_country', 'payment_method'], 'required'],
            [['delivery_pasport_kem_vidan', 'payment_info'], 'string'],
            [['delivery_pasport_kogda_vidan', 'last_modified', 'date_purchased', 'date_akt', 'orders_date_finished'], 'safe'],
            [['currency_value', 'orders_discont'], 'number'],
            [['ur_or_fiz', 'print_torg'], 'string', 'max' => 1],
            [['customers_name', 'customers_street_address', 'delivery_name', 'delivery_street_address', 'billing_name', 'billing_street_address', 'cc_owner'], 'string', 'max' => 64],
            [['customers_company', 'customers_suburb', 'customers_city', 'customers_state', 'customers_country', 'customers_telephone', 'delivery_lastname', 'delivery_company', 'delivery_suburb', 'delivery_city', 'delivery_state', 'delivery_country', 'billing_company', 'billing_suburb', 'billing_city', 'billing_state', 'billing_country', 'payment_method', 'cc_number', 'customers_referer_url', 'customers_fax', 'shipping_module'], 'string', 'max' => 255],
            [['customers_postcode', 'delivery_pasport_seria', 'delivery_postcode', 'billing_postcode'], 'string', 'max' => 10],
            [['customers_email_address'], 'string', 'max' => 96],
            [['delivery_otchestvo'], 'string', 'max' => 128],
            [['delivery_pasport_nomer', 'cc_type'], 'string', 'max' => 20],
            [['cc_expires'], 'string', 'max' => 4],
            [['currency'], 'string', 'max' => 3],
            [['referer'], 'string', 'max' => 200],
            [['orders_discont_comment'], 'string', 'max' => 256]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'orders_id' => 'Orders ID',
            'ur_or_fiz' => 'Ur Or Fiz',
            'customers_id' => 'Customers ID',
            'customers_groups_id' => 'Customers Groups ID',
            'customers_name' => 'Customers Name',
            'customers_company' => 'Customers Company',
            'customers_street_address' => 'Customers Street Address',
            'customers_suburb' => 'Customers Suburb',
            'customers_city' => 'Customers City',
            'customers_postcode' => 'Customers Postcode',
            'customers_state' => 'Customers State',
            'customers_country' => 'Customers Country',
            'customers_telephone' => 'Customers Telephone',
            'customers_email_address' => 'Customers Email Address',
            'customers_address_format_id' => 'Customers Address Format ID',
            'delivery_adress_id' => 'Delivery Adress ID',
            'delivery_name' => 'Delivery Name',
            'delivery_lastname' => 'Delivery Lastname',
            'delivery_otchestvo' => 'Delivery Otchestvo',
            'delivery_pasport_seria' => 'Delivery Pasport Seria',
            'delivery_pasport_nomer' => 'Delivery Pasport Nomer',
            'delivery_pasport_kem_vidan' => 'Delivery Pasport Kem Vidan',
            'delivery_pasport_kogda_vidan' => 'Delivery Pasport Kogda Vidan',
            'delivery_company' => 'Delivery Company',
            'delivery_street_address' => 'Delivery Street Address',
            'delivery_suburb' => 'Delivery Suburb',
            'delivery_city' => 'Delivery City',
            'delivery_postcode' => 'Delivery Postcode',
            'delivery_state' => 'Delivery State',
            'delivery_country' => 'Delivery Country',
            'delivery_address_format_id' => 'Delivery Address Format ID',
            'billing_name' => 'Billing Name',
            'billing_company' => 'Billing Company',
            'billing_street_address' => 'Billing Street Address',
            'billing_suburb' => 'Billing Suburb',
            'billing_city' => 'Billing City',
            'billing_postcode' => 'Billing Postcode',
            'billing_state' => 'Billing State',
            'billing_country' => 'Billing Country',
            'billing_address_format_id' => 'Billing Address Format ID',
            'payment_method' => 'Payment Method',
            'payment_info' => 'Payment Info',
            'cc_type' => 'Cc Type',
            'cc_owner' => 'Cc Owner',
            'cc_number' => 'Cc Number',
            'cc_expires' => 'Cc Expires',
            'last_modified' => 'Last Modified',
            'date_purchased' => 'Date Purchased',
            'date_akt' => 'Date Akt',
            'buh_orders_id' => 'Buh Orders ID',
            'nomer_akt' => 'Nomer Akt',
            'orders_status' => 'Orders Status',
            'orders_storage' => 'Orders Storage',
            'seats_count' => 'Seats Count',
            'orders_date_finished' => 'Orders Date Finished',
            'currency' => 'Currency',
            'currency_value' => 'Currency Value',
            'customers_referer_url' => 'Customers Referer Url',
            'customers_fax' => 'Customers Fax',
            'shipping_module' => 'Shipping Module',
            'referer' => 'Referer',
            'print_torg' => 'Print Torg',
            'default_provider' => 'Default Provider',
            'seller_id' => 'Seller ID',
            'orders_discont' => 'Orders Discont',
            'orders_discont_comment' => 'Orders Discont Comment',
            'site_side_email_flag' => 'site_side_email_flag'
        ];
    }

    public function getProducts()
    {
        return $this->hasMany(OrdersProducts::className(), ['orders_id' => 'orders_id']);
    }
    public function getProduct()
    {
        return $this->hasOne(PartnersProducts::className(), ['products_id' => 'products_id'])->via('products');
    }
    public function getProductsDescription()
    {
        return $this->hasOne(PartnersProductsDescription::className(), ['products_id' => 'products_id'])->via('products');
    }
    public function getProductsAttributes()
    {
        return $this->hasMany(PartnersProductsAttributes::className(), ['products_id' => 'products_id'])->via('products');
    }

    public function getProductsAttributesDescr()
    {
        return $this->hasMany(PartnersProductsOptionVal::className(), ['products_options_values_id' => 'options_values_id'])->via('productsAttributes');
    }
    public function getProductsAttr()
    {
        return $this->hasMany(OrdersProductsAttributes::className(), ['orders_products_id' => 'orders_products_id'])->via('products');
    }
    public function getProductsSP()
    {
        return $this->hasMany(PartnersOrdersProductsSp::className(), ['orders_products_id' => 'orders_products_id'])->via('products');
    }

    public function NumOrder()
    {
        $literaltyear = date('y',strtotime($this->date_purchased));
        $literalchar = ['1'=>'A','2'=>'Б'];
        $literalchar = $literalchar[$this->default_provider];
        $literalnum = $this->buh_orders_id;
        return $literaltyear.$literalchar.'-'.$literalnum;
    }
}
