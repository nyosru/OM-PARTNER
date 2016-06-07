<?php
namespace common\models;

use common\patch\ActiveRecordExt;
use Yii;

/**
 * Договор между регионалом и ИП (на закупку)
 *
 * @property string $provider_id - ИП
 * @property string $partner_id - регионал
 * @property string $contract_prefix - префикс номера договора, будет подставляться в номера накладных
 * @property string $contract_number - номер договора
 * @property string $contract_date - дата заключения договора
 *
 * @ingroup partners
 */
class PartnersContracts extends ActiveRecordExt
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'partners_contracts';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['provider_id', 'partner_id'], 'required'],//не сделано уникальным ключом т.к. договор, по идее, имеет ограниченный срок действия и должен создаваться новый по истечении
            [['provider_id', 'partner_id'], 'integer'],
            [['contract_date'], 'safe'],
            [['contract_prefix', 'contract_number'], 'string', 'max' => 12]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'provider_id' => 'Provider ID',
            'partner_id' => 'Partner ID',
            'contract_prefix' => 'Contract Prefix',
            'contract_number' => 'Contract Number',
            'contract_date' => 'Contract Date',
        ];
    }
}