<?php
namespace common\models;

use common\models\User;
use common\models\Partners;
use common\models\Customers;
use common\models\PartnersUsersInfo;
use yii\base\Exception;
use yii\db\ActiveRecord;
use yii\web\IdentityInterface;
use yii\base\Model;
use Yii;

/**
 * Signup form
 */


class SignupFormOM extends Model
{
    public $emails;
    public $password;
    public $passwordcheck;
    public $id_partners;
    public $role;
   // public $captcha;
    public $name;
    public $secondname;
    public $lastname;
    public $adress;
    public $city;
    public $state;
    public $country;
    public $postcode;
    public $telephone;
    public $user_id;
    public $pasportser;
    public $pasportnum;
    public $pasportdate;
    public $pasportwhere;
    public $fax;
    public $spam;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
           ['emails','email'],
//            ['email','required', 'message' => 'Это обязательное поле.'],


            ['spam', 'boolean'],

            ['lastname','required', 'message' => 'Это обязательное поле.'],
            ['lastname','string', 'min'=>2, 'message' => 'Минимальная длина 2 символа'],

            ['name','required', 'message' => 'Это обязательное поле.'],
            ['name','string','min'=>2, 'message' => 'Минимальная длина 2 символа'],

            ['pasportdate','date', 'message' => 'Дата'],

            ['adress','required', 'message' => 'Это обязательное поле.'],
          //  ['adress','ValidateAdress'],
            ['adress','filter', 'filter' => 'trim'],

            ['postcode','required', 'message' => 'Это обязательное поле.'],
            ['postcode','string','message' => 'Строка'],
            ['postcode','filter', 'filter' => 'trim'],

            ['city','required', 'message' => 'Это обязательное поле.'],
            ['city','string','min'=>3, 'message' => 'Минимальная длина 3 символов'],

            ['country','required', 'message' => 'Это обязательное поле.'],

            ['state','required', 'message' => 'Это обязательное поле.'],

            ['telephone','required', 'message' => 'Это обязательное поле.'],
            ['telephone','string', 'min' => 3, 'tooShort' => 'Минимальная длина 3 символа'],

            ['password','required', 'message' => 'Это обязательное поле.'],
            ['password','string','min'=>5, 'message' => 'Минимальная длина 5 символов'],


            ['passwordcheck','required', 'message' => 'Это обязательное поле.'],
            ['passwordcheck','string','min'=>5, 'message' => 'Минимальная длина 5 символов'],
            ['passwordcheck','compare','compareAttribute'=>'password', 'message' => 'Пароли не совпадают'],
            ['fax','validateUserEmail'],
            ['fax','required', 'message' => '234234'],



       //     ['captcha', 'captcha', 'captchaAction' => BASEURL . '/captcha'],


        ];
    }

    public function validateUserEmail()
    {
        $userCustomer = new Customers();
        $partners = new Partners();
        $id_partners = $partners->GetId($_SERVER['HTTP_HOST']);
        $check_email = $userCustomer->find()->where(['customers_email_address' => $this->emails])->asArray()->one();
        $userCustomer = new User();
        $check_part_email = $userCustomer->find()->where(['email' => $this->emails, 'id_partners'=>$id_partners])->asArray()->one();
        if(!$check_email && !$check_part_email){
            return true;
        }else {
            $this->addError('emails', 'Почтовый адрес уже используется в системе');
        }
    }

//        $userCustomer = new Customers();
//        $partners = new Partners();
//        $id_partners = $partners->GetId($_SERVER['HTTP_HOST']);
//        $check_email = $userCustomer->find()->where(['customers_email_address' => 'partnerom'.$id_partners.'@@@'.$this->email])->asArray()->one();
//        $userCustomer = new User();
//        $check_part_email = $userCustomer->find()->where(['email' => $this->email, 'id_partners'=>$id_partners])->asArray()->one();
//        if(!$check_email && !$check_part_email){
//            return true;
//        }else {
//            $this->addError('email', 'Почтовый адрес уже используется в системе');
//        }
//    public function validateuserumail()
//    {
//        $id_partners = Yii::$app->params['constantapp']['APP_ID'];
//        $check_email = Customers::find()->where(['customers_email_address' => $this->logemail])->asArray()->one();
//        $check_part_email =  User::find()->where(['email' => $this->logemail, 'id_partners'=>$id_partners])->asArray()->one();
//       if($check_email ||  $check_part_email) {
//           $this->addError('logemail', 'rt');
//       }
//    }

//    public function ValidateAdress()
//    {
//        if($this->adress['street']){
//
//        }else{
//            $this->addError('adress[street]', 'Это обязательное поле');
//        }
//        if($this->adress['house']){
//
//        }else{
//            $this->addError('adress[house]', 'Это обязательное поле');
//        }
//        if($this->adress['bilding']){
//
//        }else{
//            $this->addError('adress[bilding]', 'Это обязательное поле');
//        }
//        if($this->adress['apartment']){
//
//        }else{
//            $this->addError('adress[apartment]', 'Это обязательное поле');
//        }
//
//    }
    public function signup()
    {
      //  $transaction = Yii::$app->db->beginTransaction();
       // try {
            $country = new Countries();
            $zones = new Zones();
            $user = new User();
            $partners = new Partners();
            $userOM = new AddressBook();
            $userCustomer = new Customers();
            $entrycountry = $country->find()->select('countries_id as id')->where(['countries_name' => $this->country])->asArray()->one();
            $entryzones = $zones->find()->select('zone_id as id')->where(['zone_name' => $this->state])->asArray()->one();
            $this->adress = implode(' ',$this->adress);
            $id_partners = $partners->GetId($_SERVER['HTTP_HOST']);
            $user->username = $this->emails;
            $user->email = $this->emails;
            $user->setPassword($this->password);
            $user->generateAuthKey();
            $user->id_partners = $id_partners;
            $user->role = 'register';

            if ($user->save()) {
                $auth = Yii::$app->authManager;
                $auth->assign($auth->getRole('register'), $user->getId());
               // Yii::$app->mailer->compose(['html' => 'sign-up'], ['username' => $user->username, 'password' => $this->password, 'sait'=>$_SERVER[HTTP_HOST]])
               //     ->setFrom('support@'.$_SERVER[HTTP_HOST])
                //    ->setTo($user->email)
               //     ->setSubject('Регистрация на сайте '.$_SERVER[HTTP_HOST])
               //     ->send();

               // return $user;
            }
        if(!$this->pasportdate){
            $this->pasportdate = '00-00-0000';
        }
        $userOM->entry_firstname = $this->name;
        $userOM->entry_lastname = $this->lastname;
        $userOM->entry_city =  $this->city;
        $userOM->entry_street_address =  $this->adress;
        $userOM->otchestvo =  $this->secondname;
        $userOM->pasport_seria =  $this->pasportser;
        $userOM->pasport_nomer =  $this->pasportnum;
        $userOM->pasport_kem_vidan =  $this->pasportwhere;
        $userOM->pasport_kogda_vidan =  date('yyyy-mm-dd', strtotime($this->pasportdate));
        $userOM->entry_postcode =  $this->postcode;
        $userOM->entry_gender = 'M';
        $userOM->entry_country_id =  $entrycountry['id'];
        $userOM->entry_zone_id = $entryzones['id'];
        if ($userOM->save()) {
            $userCustomer->customers_firstname = $this->name;
            $userCustomer->customers_lastname =  $this->lastname;
            $userCustomer->otchestvo =  $this->secondname;
            $userCustomer->customers_email_address =  $this->emails;
            $userCustomer->customers_default_address_id = $userOM->address_book_id;
            $userCustomer->customers_selected_template = '1';
            $userCustomer->customers_telephone =  $this->telephone;
            $userCustomer->customers_password = $userCustomer->encrypt_password($this->password);
            $userCustomer->customers_newsletter = '1';
            $userCustomer->delivery_adress_id = $userOM->address_book_id;
            $userCustomer->pay_adress_id = $userOM->address_book_id;
            if ($userCustomer->save()) {
                $customer_id = $userCustomer->customers_id;
                $userOM->customers_id = $customer_id;
                $userOM->update();
                if ($customer_id % 2 == 0) {
                    $userCustomer->default_provider = 1;
                    $userCustomer->update();
                } else {
                    $userCustomer->default_provider = 2;
                    $userCustomer->update();
                }
                $userCustomerInfo = new CustomersInfo();
                $userCustomerInfo->customers_info_id = $customer_id;
                $userCustomerInfo->customers_info_date_account_created = date("Y-m-d H:i:s");

                if ($userCustomerInfo->save()) {
                    $newuserpartnerscastid = new PartnersUsersInfo();
                    $newuserpartnerscastid->scenario = '0';
                    $newuserpartnerscastid->name = $this->name;
                    if(!$this->secondname){
                        $this->secondname = "%20";
                    }
                    $newuserpartnerscastid->id = $user->getId();
                    $newuserpartnerscastid->secondname = $this->secondname;
                    $newuserpartnerscastid->lastname = $this->lastname;
                    $newuserpartnerscastid->adress = $this->adress;
                    $newuserpartnerscastid->city = $this->city;
                    $newuserpartnerscastid->country = $this->country;
                    $newuserpartnerscastid->state = $this->state;
                    $newuserpartnerscastid->postcode = $this->postcode;
                    $newuserpartnerscastid->telephone = $this->telephone;
                    $newuserpartnerscastid->pasportser = $this->pasportser;
                    $newuserpartnerscastid->pasportnum = $this->pasportnum;
                    $newuserpartnerscastid->pasportdate = date('yyyy-mm-dd H:i:s', strtotime($this->pasportdate));;
                    $newuserpartnerscastid->pasportwhere = $this->pasportwhere;
                    $newuserpartnerscastid->customers_id = $userCustomer->customers_id;
                    if( $newuserpartnerscastid->save()){
                        return $user;
                    };

                    ;
                } else {
                    return false;
                }
            } else {

                return false;
            }
        } else {
            return false;
        }

      //  } catch (Exception $e) {
      //      $transaction->rollBack();
        //    Yii::$app->params['log'][] = $e->getMessage();
       //     die();
     //   }
    }


}
