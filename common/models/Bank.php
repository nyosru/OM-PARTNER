<?php
namespace common\models;
use common\models\PartnersCompanies;

use common\patch\ActiveRecordExt;
use Yii;
/**
 * This is the model class for table "bank".
 *
 * @property string $bank_id
 * @property string $bank_bik
 * @property string $bank_rs
 * @property string $bank_ks
 * @property string $bank_name
 * @property string $bank_address
 * @property string $bank_kpp
 * @property string $bank_okpo
 */
class Bank extends ActiveRecordExt
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'bank';
    }
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['bank_address'], 'string'],
            [['bank_bik'], 'string', 'max' => 20],
            [['bank_rs', 'bank_ks'], 'string', 'max' => 40],
            [['bank_name'], 'string', 'max' => 70],
            [['bank_kpp', 'bank_okpo'], 'string', 'max' => 60],
            [['owner_id'], 'string', 'max' => 11],
            [['is_deleted'], 'string', 'max' => 1],
        ];
    }
    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'bank_id' => 'Bank ID',
            'bank_bik' => 'Bank Bik',
            'bank_rs' => 'Bank Rs',
            'bank_ks' => 'Bank Ks',
            'bank_name' => 'Bank Name',
            'bank_address' => 'Bank Address',
            'bank_kpp' => 'Bank Kpp',
            'bank_okpo' => 'Bank Okpo',
            'owner_id' => 'Owner ID',
            'is_deleted' => 'Is Deleted',
        ];
    }
    public function getOwner()
    {
        return $this->hasOne(PartnersCompanies::class, ['partner_id' => 'owner_id']);
    }
    public function extraFields()
    {
        return [
            'owner', // получение владельца банковского счета
        ];
    }
    /**
     * @inheritdoc
     */
    protected function deleteInternal()
    {
        if (!$this->beforeDelete()) {
            return false;
        }
        $this->is_deleted = 1;
        $result = $this->save(false);
        if (!$this->afterDelete()) {
            return false;
        }
        return $result;
    }
    /**
     * @return bool
     */
    public function afterDelete()
    {
        if ($this->owner_id != null) {
            $partner = PartnersCompanies::findOne($this->owner_id); // ищем партнера, которому принадлежит счет
            /**
             * @var PartnersCompanies $partner
             */
            if ($partner && ($partner->active_bank_id === (int)$this->bank_id)) { // если партнер найден и счет является активным
                $partner->active_bank_id = null; // то сбрасываем значение активного счета у партнера (делаем равным null)
                return $partner->save();
            }
            return true;
        }
        return true;
    }
}