<?php

namespace common\models;

use Yii;
use yii\db\ActiveRecord;


class ManufacturersInfoList extends ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'manufacturers_info_list';
    }

    public function rules()
    {
        return [
            [['manufacturers_id', 'ur_name'], 'required'],
            [['manufacturers_opf'], 'default', 'value' => 1],
            [['nds_proc'], 'default', 'value' => 0],
            [['manufacturers_id', 'manufacturers_opf', 'nds_proc', 'start_report'], 'integer'],
            [['ur_name', 'post_region', 'post_city', 'post_street', 'bank_name', 'bank_rs_old', 'glav_buh', 'otv_lic_fio', 'otv_lic2_fio', 'set_default'], 'string'],
            [['dog_date'], 'safe'],
            [['post_code'], 'string', 'max' => 8],
            [['man_phone', 'bank_bik', 'bank_ks', 'bank_rs', 'ur_okpo'], 'string', 'max' => 20],
            [['otv_lic_dolj', 'otv_lic2_dolj'], 'string', 'max' => 60],
            [['dog_num'], 'string', 'max' => 40]
        ];
    }

    public function attributeLabels()
    {
        return [
            'manufacturers_info_list_id' => 'Manufacturers Info List ID',
            'manufacturers_id' => 'Manufacturers ID',
            'manufacturers_opf' => 'Manufacturers Opf',
            'ur_name' => 'Ur Name',
            'post_code' => 'Post Code',
            'post_region' => 'Post Region',
            'post_city' => 'Post City',
            'post_street' => 'Post Street',
            'man_phone' => 'Man Phone',
            'bank_name' => 'Bank Name',
            'bank_bik' => 'Bank Bik',
            'bank_ks' => 'Bank Ks',
            'bank_rs' => 'Bank Rs',
            'bank_rs_old' => 'Bank Rs Old',
            'ur_okpo' => 'Ur Okpo',
            'glav_buh' => 'Glav Buh',
            'otv_lic_dolj' => 'Otv Lic Dolj',
            'otv_lic_fio' => 'Otv Lic Fio',
            'otv_lic2_dolj' => 'Otv Lic2 Dolj',
            'otv_lic2_fio' => 'Otv Lic2 Fio',
            'dog_num' => 'Dog Num',
            'dog_date' => 'Dog Date',
            'nds_proc' => 'Nds Proc',
            'start_report' => 'Start Report',
            'set_default' => 'Set Default',
        ];
    }
}
