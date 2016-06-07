<?php
namespace common\models;

use Yii;
use common\patch\ActiveRecordExt;

/**
 * This is the model class for table "seler_anket".
 *
 * @property integer $seler_anket_id
 * @property string $seler_ur
 * @property string $seler_inn
 * @property string $seler_fname
 * @property string $seler_sname
 * @property string $seler_mname
 * @property string $seler_birdh
 * @property string $seler_pasport_seria
 * @property string $seler_pasport_nomer
 * @property string $seler_pasport_kemvidan
 * @property string $seler_pasport_kagdavidan
 * @property string $seler_pasport_okonchanie
 * @property string $seler_adres_reg
 * @property string $seler_phone
 * @property string $seler_mail
 * @property string $seler_comment
 * @property string $seler_fio_kem
 * @property integer $active_seller
 * @property string $name
 */
class SelerAnket extends ActiveRecordExt
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'seler_anket';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['seler_birdh', 'seler_pasport_kagdavidan', 'seler_pasport_okonchanie'], 'safe'],
            [['seler_pasport_kemvidan', 'seler_adres_reg', 'seler_comment'], 'string'],
            [['seler_anket_id', 'active_seller'], 'integer'],
            [['seler_ur'], 'string', 'max' => 255],
            [['seler_inn'], 'string', 'max' => 24],
            [['seler_fname', 'seler_sname', 'seler_mname'], 'string', 'max' => 60],
            [['seler_pasport_seria'], 'string', 'max' => 8],
            [['seler_pasport_nomer', 'seler_phone', 'seler_mail'], 'string', 'max' => 20],
            [['seler_fio_kem'], 'string', 'max' => 200]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'seler_anket_id' => 'Seler Anket ID',
            'seler_ur' => 'Seler Ur',
            'seler_inn' => 'Seler Inn',
            'seler_fname' => 'Seler Fname',
            'seler_sname' => 'Seler Sname',
            'seler_mname' => 'Seler Mname',
            'seler_birdh' => 'Seler Birdh',
            'seler_pasport_seria' => 'Seler Pasport Seria',
            'seler_pasport_nomer' => 'Seler Pasport Nomer',
            'seler_pasport_kemvidan' => 'Seler Pasport Kemvidan',
            'seler_pasport_kagdavidan' => 'Seler Pasport Kagdavidan',
            'seler_pasport_okonchanie' => 'Seler Pasport Okonchanie',
            'seler_adres_reg' => 'Seler Adres Reg',
            'seler_phone' => 'Seler Phone',
            'seler_mail' => 'Seler Mail',
            'seler_comment' => 'Seler Comment',
            'seler_fio_kem' => 'Seler Fio Kem',
            'active_seller' => 'Active Seller',
        ];
    }

    /**
     * @return string фамилия и инициалы, в просторечии ФИО
     */
    public function getName()
    {
        $f = $this->seler_sname;
        $i = mb_substr($this->seler_fname, 0, 1, 'UTF-8');
        $o = mb_substr($this->seler_mname, 0, 1, 'UTF-8');
        return "$f $i.$o.";
    }

    /**
     * @return string полные фамилия, имя и отчество
     */
    public function getFullName()
    {
        $f = $this->seler_sname;
        $i = $this->seler_fname;
        $o = $this->seler_mname;
        return "$f $i $o";
    }

    /**
     * Все активные чурки
     * @return SelerAnket[]
     */
    public static function findAllActive()
    {
        return self::findAll([
            'active_seller' => 1
        ]);
    }
}