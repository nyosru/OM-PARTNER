<?php
namespace common\models;

use yii;
use yii\base\Model;

class Profile extends Model{
    public $id;
    public $name;
    public $secondname;
    public $lastname;
    public $email;
    public $country;
    public $state;
    public $postcode;
    public $city;
    public $address;
    public $phone;
    public $customers_fax;
    public $delivery;
    public $partner;
    public $pasportser;
    public $pasportnum;
    public $pasportwhere;
    public $pasportdate;
    public $customers_firstname;
    public $customers_lastname;
    public $otchestvo;
    public $customers_email_address;
    public $customers_telephone;
    public $delivery_adress_id;


    
    public function rules()
    {
        return [
            ['name','required', 'message' => 'Это обязательное поле.'],
            ['name','string','min'=>2, 'message' => 'Минимальная длина 2 символа'],

            ['lastname','required', 'message' => 'Это обязательное поле.'],
            ['lastname','string', 'min'=>2, 'message' => 'Минимальная длина 2 символа'],
            
            ['secondname','string','min'=>2, 'message' => 'Минимальная длина 2 символа'],

            ['id', 'integer'],

            [['email','customers_email_address'], 'email'],
            [['email','customers_email_address'], 'ValidateUseremail'],
            [['email','customers_email_address'], 'filter', 'filter' => 'trim'],
            [['email','customers_email_address'], 'required', 'message' => 'Это обязательное поле'],
            [['email','customers_email_address'], 'string', 'message' => 'Минимум 6 символов','min'=>6],
            
            ['country','required', 'message' => 'Это обязательное поле.'],
            
            ['state','required', 'message' => 'Это обязательное поле.'],

            ['postcode','required', 'message' => 'Это обязательное поле.'],
            ['postcode','string','message' => 'Строка'],
            ['postcode','filter', 'filter' => 'trim'],

            ['address','string','message' => 'Строка'],
            ['customers_firstname','string','message' => 'Строка'],
            ['customers_lastname','string','message' => 'Строка'],
            ['otchestvo','string','message' => 'Строка'],

            ['delivery','safe'],
            ['delivery','safe'],

            ['delivery_adress_id','integer'],

            ['pasportser','string','max'=>4,'tooLong' => 'Максимум 4 символа'],
            ['pasportnum','string','max'=>8,'tooLong' => 'Максимум 8 символов'],
            ['pasportwhere','string','message' => 'Строка'],
            ['pasportdate','date','message' => 'Дата'],

            ['city','required', 'message' => 'Это обязательное поле.'],
            ['city','string','min'=>2, 'message' => 'Минимальная длина 2 символа'],

            [['phone','customers_telephone'],'string','max'=>18, 'message'=> 'Максимальная длина 18 знаков'],

            ['customers_fax','string', 'max'=>18, 'message'=>'Максимальная длина 18 знаков'],

        ];
    }
    
    public function ValidateUseremail()
    {
        $userCustomer = new Customers();
        $partners = new Partners();
        $id_partners = $partners->GetId($_SERVER['HTTP_HOST']);
        $check_email = $userCustomer->find()->where(['customers_email_address' => $this->email])->asArray()->one();
        $userCustomer = new User();
        $check_part_email = $userCustomer->find()->where(['email' => $this->email, 'id_partners'=>$id_partners])->asArray()->one();
        if(!$check_email && !$check_part_email){
            return true;
        }else {
            $this->addError('email', 'Почтовый адрес уже используется в системе');
        }
    }
    public function saveUserInfo(){
        $user=User::find()->where(['id'=>Yii::$app->user->getId()])->one();
        $userinfo=PartnersUsersInfo::find()->where(['id'=>Yii::$app->user->getId()])->one();
        $user->username=$this->email;
        $user->email=$this->email;
        if($user->save()) {
            $userinfo->name = $this->name;
            $userinfo->secondname = $this->secondname;
            $userinfo->lastname = $this->lastname;
            $userinfo->telephone = $this->phone;
            $userinfo->adress = $this->address;
            $userinfo->city = $this->city;
            $userinfo->state = $this->state;
            $userinfo->country = $this->country;
            $userinfo->postcode = $this->postcode;
            $userinfo->pasportser = $this->pasportser;
            $userinfo->pasportnum = $this->pasportnum;
            $userinfo->pasportdate = $this->pasportdate;
            $userinfo->pasportwhere = $this->pasportwhere;
            $userinfo->save();
        }
    }
    public function saveCustomer(){
        $userinfo=PartnersUsersInfo::find()->where(['id'=>Yii::$app->user->getId()])->one();
        $customer=Customers::find()->where(['customers_id'=>$userinfo->customers_id])->one();
        $customer->customers_firstname=$this->customers_firstname;
        $customer->customers_lastname=$this->customers_lastname;
        $customer->otchestvo=$this->otchestvo;
        $customer->customers_email_address=$this->customers_email_address;
        $customer->customers_telephone=$this->customers_telephone;
        $customer->customers_fax=$this->customers_fax;
        $customer->save();
    }
    public function saveUserDelivery(){
        $country = new Countries();
        $zones = new Zones();
        $userinfo=PartnersUsersInfo::find()->where(['id'=>Yii::$app->user->getId()])->one();
        $add=AddressBook::find()->where(['customers_id'=>$userinfo->customers_id])->all();
        foreach ($add as $key=>$value){
            $entrycountry = $country->find()->select('countries_id as id')->where(['countries_name' => $this->delivery[$key]['country']])->asArray()->one();
            $entryzones = $zones->find()->select('zone_id as id')->where(['zone_name' => $this->delivery[$key]['state']])->asArray()->one();
            $value->entry_firstname=$this->delivery[$key]['name'];
            $value->entry_lastname=$this->delivery[$key]['lastname'];
            $value->otchestvo=$this->delivery[$key]['secondname'];
            $value->entry_gender = 'M';
            $value->birth_day=$this->delivery[$key]['birthday'];
            $value->pasport_seria=$this->delivery[$key]['passportser'];
            $value->pasport_nomer=$this->delivery[$key]['passportnum'];
            $value->pasport_kem_vidan=$this->delivery[$key]['passportwho'];
            $value->pasport_kogda_vidan=$this->delivery[$key]['passportdate'];
            $value->entry_country_id=$entrycountry['id'];
            $value->entry_zone_id=$entryzones['id'];
            $value->entry_city=$this->delivery[$key]['city'];
            $value->entry_postcode=$this->delivery[$key]['postcode'];
            $value->entry_street_address=$this->delivery[$key]['address'];
            $value->update();
        }
    }
    public function addUserDelivery(){
        $country = new Countries();
        $zones = new Zones();
        $add=new AddressBook();
        $userinfo=PartnersUsersInfo::find()->where(['id'=>Yii::$app->user->getId()])->one();

        $entrycountry = $country->find()->select('countries_id as id')->where(['countries_name' => $this->delivery['add']['country']])->asArray()->one();
        $entryzones = $zones->find()->select('zone_id as id')->where(['zone_name' => $this->delivery['add']['state']])->asArray()->one();
        $add->entry_firstname=$this->delivery['add']['name'];
        $add->entry_lastname=$this->delivery['add']['lastname'];
        $add->otchestvo=$this->delivery['add']['secondname'];
        $add->entry_gender = 'M';
        $add->birth_day=$this->delivery['add']['birthday'];
        $add->pasport_seria=$this->delivery['add']['passportser'];
        $add->pasport_nomer=$this->delivery['add']['passportnum'];
        $add->pasport_kem_vidan=$this->delivery['add']['passportwho'];
        $add->pasport_kogda_vidan=$this->delivery['add']['passportdate'];
        $add->entry_country_id=$entrycountry['id'];
        $add->entry_zone_id=$entryzones['id'];
        $add->entry_city=$this->delivery['add']['city'];
        $add->entry_postcode=$this->delivery['add']['postcode'];
        $add->entry_street_address=$this->delivery['add']['address'];
        $add->customers_id=$userinfo->customers_id;
        $add->save();
    }
    public function loadUserProfile(){
        $country = new Countries();
        $zones = new Zones();
        $user=User::find()->where(['id'=>Yii::$app->user->identity->getId()])->one();
        $userinfo = PartnersUsersInfo::find()->where(['id'=>Yii::$app->user->identity->getId()])->one();
        $customer=Customers::find()->where(['customers_id'=>$userinfo->customers_id])->one();
        $add=AddressBook::find()->where(['customers_id'=>$userinfo->customers_id])->all();
        $this->id = Yii::$app->user->getId();

        // из user
        $this->email=$user->username;
        $this->partner=$user->id_partners;

        // из userinfo
        $this->name=$userinfo->name;
        $this->secondname=$userinfo->secondname;
        $this->lastname=$userinfo->lastname;
        $this->address=$userinfo->adress;
        $this->city=$userinfo->city;
        $this->state=$userinfo->state;
        $this->country=$userinfo->country;
        $this->postcode=$userinfo->postcode;
        $this->phone=$userinfo->telephone;
        $this->pasportser=$userinfo->pasportser;
        $this->pasportnum=$userinfo->pasportnum;
        $this->pasportdate=$userinfo->pasportdate;
        $this->pasportwhere=$userinfo->pasportwhere;

        // из customers
        $this->customers_firstname=$customer->customers_firstname;
        $this->customers_lastname=$customer->customers_lastname;
        $this->otchestvo=$customer->otchestvo;
        $this->customers_email_address=$customer->customers_email_address;
        $this->delivery_adress_id=$customer->delivery_adress_id;
        $this->customers_telephone=$customer->customers_telephone;
        $this->customers_fax=$customer->customers_fax;

        // из addressbook
        foreach($add as $key=>$value){
            $entrycountry = $country->find()->select('countries_name as name')->where(['countries_id' => $value->entry_country_id])->asArray()->one();
            $entryzones = $zones->find()->select('zone_name as name')->where(['zone_id' => $value->entry_zone_id])->asArray()->one();
            $this->delivery[$key]['name']=$value->entry_firstname;
            $this->delivery[$key]['lastname']=$value->entry_lastname;
            $this->delivery[$key]['secondname']=$value->otchestvo;
            $this->delivery[$key]['birthday']=$value->birth_day;
            $this->delivery[$key]['passportser']=$value->pasport_seria;
            $this->delivery[$key]['passportnum']=$value->pasport_nomer;
            $this->delivery[$key]['passportwho']=$value->pasport_kem_vidan;
            $this->delivery[$key]['passportdate']=$value->pasport_kogda_vidan;
//            $this->delivery[$key]['entrycountry']=$value->entry_country_id;
            $this->delivery[$key]['country']=$entrycountry['name'];
//            $this->delivery[$key]['entryzones']=$value->entry_zone_id;
            $this->delivery[$key]['state']=$entryzones['name'];
            $this->delivery[$key]['city']=$value->entry_city;
            $this->delivery[$key]['postcode']=$value->entry_postcode;
            $this->delivery[$key]['address']=$value->entry_street_address;
            $this->delivery[$key]['address_book_id']=$value->address_book_id;
        }

    }
}