<?php
namespace common\models;

use common\patch\ActiveRecordExt;
use Yii;
use yii\db\ActiveQuery;
use yii\web\BadRequestHttpException;
/**
 * This is the model class for table "orders_reports_orders_files".
 *
 * @property string $orders_reports_orders_files_id
 * @property string $orders_reports_id
 * @property string $orders_id
 * @property string $groups_id
 * @property string $files_name
 * @property string $filex_servername
 * @property string $files_time
 */
class OrdersReportsOrdersFiles extends ActiveRecordExt
{

    public static function tableName()
    {
        return 'orders_reports_orders_files';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['orders_reports_orders_files_id', 'orders_reports_id', 'orders_id', 'groups_id'], 'integer'],
            ['groups_id', 'integer'],
            ['orders_reports_id', 'integer'],
            [['files_time'], 'required'],
            [['files_name', 'filex_servername'], 'string', 'max' => 60]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'orders_reports_orders_files_id' => 'Orders Reports Orders Files ID',
            'orders_reports_id' => 'Orders Reports ID',
            'orders_id' => 'Orders ID',
            'groups_id' => 'Groups ID',
            'files_name' => 'Files Name',
            'filex_servername' => 'Filex Servername',
            'files_time' => 'Files Time',
        ];
    }
    // RELATIONS BEGIN /////////////////////////////////////////////////////////////////////////////////////////////////
    // RELATIONS END ///////////////////////////////////////////////////////////////////////////////////////////////////
}