<?php
namespace common\models;

use common\models\PartnersContracts;
use common\models\Zones;
use common\patch\ActiveRecordExt;
use common\models\Bank;
use common\models\ExZones;
use common\models\SpsrZones;
use Yii;

/**
 * This is the model class for table "partners_companies".
 *
 * @property integer $partner_id
 * @property integer $admin_id
 * @property string $fname
 * @property string $lname
 * @property string $oname
 * @property string $inn
 * @property string $ogrn
 * @property string $faksimilia_file
 * @property string $name_r
 * @property string $name_d
 * @property string $name_k
 * @property string $organization_name
 * @property string $full_name_genitive
 * @property string $address
 * @property string $pasport_s
 * @property string $pasport_n
 * @property string $pasport_who
 * @property string $pasport_date
 * @property string $telephone
 * @property string $email
 * @property integer $active
 * @property integer $min_raiting
 * @property integer $support_black_list
 * @property integer $default_region
 * @property integer $num_of_region
 * @property string $active_after
 * @property string $name
 * @property Bank $bank
 * @property integer $active_bank_id
 *
 * @property SpsrZones $spsrZone
 * @property int $offerNumber
 */
class PartnersCompanies extends ActiveRecordExt
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'partners_companies';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['admin_id', 'active_after'], 'required'],
            [['admin_id', 'active', 'min_raiting', 'support_black_list', 'default_region', 'num_of_region', 'active_bank_id'], 'integer'],
            [['pasport_who'], 'string'],
            [['pasport_date', 'active_after'], 'safe'],
            [['fname', 'lname', 'oname', 'inn', 'ogrn', 'name_r', 'name_d', 'name_k', 'organization_name', 'full_name_genitive', 'address', 'telephone', 'email'], 'string', 'max' => 255],
            [['faksimilia_file'], 'string', 'max' => 50],
            [['pasport_s'], 'string', 'max' => 8],
            [['pasport_n'], 'string', 'max' => 18],
            [['telephone'], 'unique']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'partner_id' => 'Partner ID',
            'admin_id' => 'Admin ID',
            'fname' => 'Fname',
            'lname' => 'Lname',
            'oname' => 'Oname',
            'inn' => 'Inn',
            'ogrn' => 'Ogrn',
            'faksimilia_file' => 'Faksimilia File',
            'name_r' => 'Name R',
            'name_d' => 'Name D',
            'name_k' => 'Name K',
            'organization_name' => 'Organization Name',
            'full_name_genitive' => 'Полное именование в родительном падеже',
            'address' => 'Address',
            'pasport_s' => 'Pasport S',
            'pasport_n' => 'Pasport N',
            'pasport_who' => 'Pasport Who',
            'pasport_date' => 'Pasport Date',
            'telephone' => 'Telephone',
            'email' => 'Email',
            'active' => 'Active',
            'min_raiting' => 'Min Raiting',
            'support_black_list' => 'Support Black List',
            'default_region' => 'Default Region',
            'num_of_region' => 'Num Of Region',
            'active_after' => 'Active After',
            'active_bank_id' => 'Active Bank ID',
        ];
    }

    // RELATIONS BEGIN /////////////////////////////////////////////////////////////////////////////////////////////////
    public function getPartnersToRegions()
    {
        return $this->hasMany(PartnersToRegion::class, ['partner_id' => 'partner_id']);
    }

    public function getDefaultRegion()
    {
        return $this->hasOne(Zones::class, ['zone_id' => 'default_region']);
    }

    public function getSpsrZone()
    {
        return $this->hasOne(SpsrZones::class, ['zone_id' => 'zone_id'])->via('defaultRegion');
    }

    /**
     * @return Bank
     */
    public function getBankInfo()
    {
        return $this->bank;
    }

    public function getBank()
    {
        return $this->hasOne(Bank::class, ['bank_id' => 'active_bank_id']);
    }

    /**
     * Номер оферты. В данный момент соответствует номеру региона.
     * @return int
     */
    public function getOfferNumber()
    {
        return $this->spsrZone->id;
    }

    /**
     * Литера-идентификатор. Соответствует номеру региона.
     * @return string
     */
    public function getIdentifier()
    {
        return (string)$this->spsrZone->id;
    }

    /**
     * @return string фамилия и инициалы, в просторечии ФИО
     */
    public function getName()
    {
        $f = $this->lname;
        $i = mb_substr($this->fname, 0, 1, 'UTF-8');
        $o = mb_substr($this->oname, 0, 1, 'UTF-8');
        return "$f $i.$o.";
    }

    /**
     * @return string полные фамилия, имя и отчество
     */
    public function getFullName()
    {
        $f = $this->lname;
        $i = $this->fname;
        $o = $this->oname;
        return "$f $i $o";
    }

    public function getBanks()
    {
        return $this->hasMany(Bank::class, ['owner_id' => 'partner_id']);
    }

    public function getContracts()
    {
        return $this->hasMany(PartnersContracts::class, ['partner_id' => 'partner_id']);
    }

    /**
     * Получаем инфу о регионах, которые обслуживает партнер, и поставщиках для каждого региона
     * @return ExZones[]
     */
    public function getRegs()
    {
        $links = $this->partnersToRegions;
        /** @var ExZones[] $regions */
        $regions = [];
        /** @var PartnersToRegion $link */
        foreach ($links as $link) {
            if (!$regions[$link->region_id]) {
                $regions[$link->region_id] = $link->region;
            }
            $regions[$link->region_id]->addAdmin($link->adminCompany);
        }
        return $regions;
    }

    // RELATIONS END ///////////////////////////////////////////////////////////////////////////////////////////////////
    public function extraFields()
    {
        return [
            'defaultRegion', // получение региона по умолчанию (+ номера этого региона)
            'admin', // получаем инфу о админе
            'regs' => 'regs', // получаем инфу о регионах, которые обслуживает партнер, и поставщиках для каждого региона
            'bankInfo', // получение активного банковского счета
            'banks', // получение всех банковских счетов партнера
            'contracts', // получение всех контрактов партнера
        ];
    }

}