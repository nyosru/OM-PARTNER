<?php
namespace common\models;

use yii;
use yii\base\Model;

class Profile extends Model{
    public $id = '0';
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
    public $fax;
    public $delivery;
    
    
    public function rules()
    {
        return [
            ['name','required', 'message' => 'Это обязательное поле.'],
            ['name','string','min'=>2, 'message' => 'Минимальная длина 2 символа'],

            ['lastname','required', 'message' => 'Это обязательное поле.'],
            ['lastname','string', 'min'=>2, 'message' => 'Минимальная длина 2 символа'],
            
            ['secondname','string','min'=>2, 'message' => 'Минимальная длина 2 символа'],
            [['id','delivery'], 'safe'],
            ['email', 'email'],
            ['email', 'filter', 'filter' => 'trim'],
            ['email', 'required', 'message' => 'Это обязательное поле'],
            ['email', 'string', 'message' => 'Минимум 6 символов','min'=>6],
            
            ['country','required', 'message' => 'Это обязательное поле.'],
            
            ['state','required', 'message' => 'Это обязательное поле.'],

            ['postcode','required', 'message' => 'Это обязательное поле.'],
            ['postcode','string','message' => 'Строка'],
            ['postcode','filter', 'filter' => 'trim'],

            ['city','required', 'message' => 'Это обязательное поле.'],
            ['city','string','min'=>2, 'message' => 'Минимальная длина 2 символа'],

            ['phone','string','max'=>18, 'message'=> 'Максимальная длина 18 знаков'],

            ['fax','string', 'max'=>18, 'message'=>'Максимальная длина 18 знаков'],

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
    public function saveUserProfile(){



        $country = new Countries();
        $zones = new Zones();
        $user=User::find()->where(['id'=>Yii::$app->user->getId()])->one();
        $userinfo=PartnersUsersInfo::find()->where(['id'=>Yii::$app->user->getId()])->one();
        $customer=Customers::find()->where(['customers_id'=>$userinfo->customers_id])->one();
        $add=AddressBook::find()->where(['customers_id'=>$userinfo->customers_id])->all();

        $user->username=$this->email;
        $user->email=$this->email;
        if($user->save()){
            $userinfo->name=$this->name;
            $userinfo->secondname=$this->secondname;
            $userinfo->lastname=$this->lastname;
            $userinfo->telephone=$this->phone;

            if($userinfo->save()){

                $customer->customers_firstname=$this->name;
                $customer->customers_lastname=$this->lastname;
                $customer->otchestvo=$this->secondname;
                $customer->customers_email_address=$this->email;
                $customer->customers_telephone=$this->phone;
                $customer->customers_fax=$this->fax;

                if($customer->save()){
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
            }
        }
    }
    public function loadUserProfile(){
        $country = new Countries();
        $zones = new Zones();
        $user=User::find()->where(['id'=>Yii::$app->user->identity->getId()])->one();
        $userinfo = PartnersUsersInfo::find()->where(['id'=>Yii::$app->user->identity->getId()])->one();
        $customer=Customers::find()->where(['customers_id'=>$userinfo->customers_id])->one();
        $add=AddressBook::find()->where(['customers_id'=>$userinfo->customers_id])->all();
        $this->id = Yii::$app->user->getId();
        $this->name=$userinfo->name;
        $this->secondname=$userinfo->secondname;
        $this->lastname=$userinfo->lastname;
        $this->email=$user->username;
        $this->phone=$userinfo->telephone;
        $this->fax=$customer->customers_fax;
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
        }

    }
}