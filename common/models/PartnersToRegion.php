<?php
namespace common\models;


use common\models\AdminCompanies;
use common\models\PartnersCompanies;
use common\patch\ActiveRecordExt;
use Yii;
use yii\db\ActiveQuery;
/**
 * This is the model class for table "partners_to_region".
 *
 * @property integer $partner_id
 * @property integer $region_id
 * @property integer $parent_companies_id
 * @property AdminCompanies $adminCompany
 * @property ExZones $region
 *
 */
class PartnersToRegion extends ActiveRecordExt
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'partners_to_region';
    }
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['partner_id', 'region_id', 'parent_companies_id'], 'required'],
            [['partner_id', 'region_id', 'parent_companies_id'], 'integer']
        ];
    }
    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'partner_id' => 'Partner ID',
            'region_id' => 'Region ID',
            'parent_companies_id' => 'Parent Companies ID',
        ];
    }
    // RELATIONS BEGIN /////////////////////////////////////////////////////////////////////////////////////////////////
    /**
     * @return ActiveQuery
     */
    public function getAdminCompany()
    {
        return $this->hasOne(AdminCompanies::class, ['companies_id' => 'parent_companies_id']);
    }
    public function getPartnersCompanies()
    {
        return $this->hasOne(PartnersCompanies::class, ['partner_id' => 'partner_id']);
    }
    /**
     * @return ActiveQuery
     */
   
    // RELATIONS END ///////////////////////////////////////////////////////////////////////////////////////////////////
}