<?php
namespace common\models;

use common\models\User;
use common\models\Partners;
use common\models\Customers;
use common\models\PartnersUsersInfo;
use common\traits\Categories\RestrictedCatalog;
use common\traits\Hide_manufacturers_for_partners;
use common\traits\Products\NewProducts;
use common\traits\Trim_Tags;
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
    use Trim_Tags, NewProducts, Hide_manufacturers_for_partners, RestrictedCatalog;
    public $emails;
    public $password;
    public $passwordcheck;
    public $id_partners;
    public $role;
    // public $captcha;
    public $name;
    public $secondname;
    public $lastname;

    public $adress_street;
    public $adress_house;
    public $adress_bildings;
    public $adress_appartment;

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
            ['emails', 'email'],
            ['emails', 'required', 'message' => 'Это обязательное поле.'],


            ['spam', 'boolean'],

            ['lastname', 'required', 'message' => 'Это обязательное поле.'],
            ['lastname', 'string', 'min' => 2, 'message' => 'Минимальная длина 2 символа'],

            ['name', 'required', 'message' => 'Это обязательное поле.'],
            ['name', 'string', 'min' => 2, 'message' => 'Минимальная длина 2 символа'],

            ['pasportdate', 'safe', 'message' => 'Дата'],

            ['adress_street', 'required', 'message' => 'Это обязательное поле.'],
            ['adress_street', 'string'],
            ['adress_street', 'filter', 'filter' => 'trim'],

            ['adress_house', 'required', 'message' => 'Это обязательное поле.'],
            ['adress_house', 'string'],
            ['adress_house', 'filter', 'filter' => 'trim'],


            ['adress_bildings', 'string'],
            ['adress_bildings', 'filter', 'filter' => 'trim'],


            ['adress_appartment', 'string'],
            ['adress_appartment', 'filter', 'filter' => 'trim'],

            ['postcode', 'required', 'message' => 'Это обязательное поле.'],
            ['postcode', 'string', 'message' => 'Строка'],
            ['postcode', 'filter', 'filter' => 'trim'],

            ['city', 'required', 'message' => 'Это обязательное поле.'],
            ['city', 'string', 'min' => 3, 'message' => 'Минимальная длина 3 символов'],

            ['country', 'required', 'message' => 'Это обязательное поле.'],

            ['state', 'required', 'message' => 'Это обязательное поле.'],

            ['telephone', 'required', 'message' => 'Это обязательное поле.'],
            ['telephone', 'string', 'min' => 3, 'tooShort' => 'Минимальная длина 3 символа'],

            ['password', 'required', 'message' => 'Это обязательное поле.'],
            ['password', 'string', 'min' => 5, 'message' => 'Минимальная длина 5 символов'],
            ['secondname', 'string'],
            ['fax', 'string'],
            ['pasportser', 'string'],
            ['pasportnum', 'string'],
            ['pasportwhere', 'string'],

            ['passwordcheck', 'required', 'message' => 'Это обязательное поле.'],
            ['passwordcheck', 'string', 'min' => 5, 'message' => 'Минимальная длина 5 символов'],
            ['passwordcheck', 'compare', 'compareAttribute' => 'password', 'message' => 'Пароли не совпадают'],


            //     ['captcha', 'captcha', 'captchaAction' => BASEURL . '/captcha'],


        ];
    }

    public function validcountryregion()
    {
        $entrycountry = Countries::find()->select('countries_id as id')->where(['countries_name' => $this->country])->asArray()->one();
        $entryzones = Zones::find()->select('zone_id as id')->where(['zone_name' => $this->state])->asArray()->one();
        if (!$entrycountry || !$entryzones) {
            $this->addError('country', 'Необходимо выбрать из списка');
            $this->addError('state', 'Необходимо выбрать из списка');
        } else {
            return true;
        }
    }

    public function validuser()
    {
        $userCustomer = new Customers();
        $partners = new Partners();
        $id_partners = $partners->GetId($_SERVER['HTTP_HOST']);
        $check_email = $userCustomer->find()->where(['customers_email_address' => $this->emails])->asArray()->one();
        $userCustomer = new User();
        $check_part_email = $userCustomer->find()->where(['email' => $this->emails, 'id_partners' => $id_partners])->asArray()->one();
        if (!$check_email && !$check_part_email) {
            return true;
        } else {
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


    public function signup()
    {
        // $transaction = Yii::$app->db->beginTransaction();
        // try {
        $adress = $this->trim_tags_text($this->adress_street) . ' ' . $this->trim_tags_text($this->adress_house) . ' ' . $this->trim_tags_text($this->adress_bildings) . ' ' . $this->trim_tags_text($this->adress_appartment);
        $country = new Countries();
        $zones = new Zones();
        $user = new User();
        $partners = new Partners();
        $userOM = new AddressBook();
        $userCustomer = new Customers();
        $entrycountry = $country->find()->select('countries_id as id')->where(['countries_name' => $this->country])->asArray()->one();
        $entryzones = $zones->find()->select('zone_id as id')->where(['zone_name' => $this->state])->asArray()->one();

        $id_partners = $partners->GetId($_SERVER['HTTP_HOST']);
        $user->username = $this->trim_tags_text($this->emails);
        $user->email = $this->trim_tags_text($this->emails);
        $user->setPassword($this->password);
        $user->generateAuthKey();
        $user->id_partners = $id_partners;
        $user->role = 'register';
        if ($user->save()) {
            $auth = Yii::$app->authManager;
            $auth->assign($auth->getRole('register'), $user->getId());


            // return $user;
        }
        if (!$this->pasportdate) {
            $this->pasportdate = '1970-01-01';
        }
        $userOM->entry_firstname = $this->trim_tags_text($this->name);
        $userOM->entry_lastname = $this->trim_tags_text($this->lastname);
        $userOM->entry_city = $this->trim_tags_text($this->city);
        $userOM->entry_street_address = $adress;
        $userOM->otchestvo = $this->trim_tags_text($this->secondname);
        $userOM->pasport_seria = $this->trim_tags_text($this->pasportser);
        $userOM->pasport_nomer = $this->trim_tags_text($this->pasportnum);
        $userOM->pasport_kem_vidan = $this->trim_tags_text($this->pasportwhere);
        $userOM->pasport_kogda_vidan = date('Y-m-d', strtotime($this->pasportdate));
        $userOM->entry_postcode = $this->trim_tags_text($this->postcode);
        $userOM->entry_gender = 'M';
        $userOM->entry_country_id = $entrycountry['id'];
        $userOM->entry_zone_id = $entryzones['id'];
        if ($userOM->save()) {
            $userCustomer->customers_fax = $this->trim_tags_text($this->fax);
            $userCustomer->customers_firstname = $this->name;
            $userCustomer->customers_lastname = $this->lastname;
            $userCustomer->otchestvo = $this->secondname;
            $userCustomer->customers_email_address = $this->emails;
            $userCustomer->customers_default_address_id = $userOM->address_book_id;

            $userCustomer->customers_telephone = $this->telephone;
            $userCustomer->customers_password = $userCustomer->encrypt_password($this->password);
            $userCustomer->customers_newsletter = '1';
            $userCustomer->customers_selected_template = '';
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
                    if (!$this->secondname) {
                        $this->secondname = "NULL";
                    }
                    $newuserpartnerscastid->id = $user->getId();
                    $newuserpartnerscastid->secondname = $this->secondname;
                    $newuserpartnerscastid->lastname = $this->lastname;
                    $newuserpartnerscastid->adress = $adress;
                    $newuserpartnerscastid->city = $this->city;
                    $newuserpartnerscastid->country = $this->country;
                    $newuserpartnerscastid->state = $this->state;
                    $newuserpartnerscastid->postcode = $this->postcode;
                    $newuserpartnerscastid->telephone = $this->telephone;
                    $newuserpartnerscastid->pasportser = $this->pasportser;
                    $newuserpartnerscastid->pasportnum = $this->pasportnum;
                    if ($this->pasportdate) {
                        $newuserpartnerscastid->pasportdate = date('Y-m-d H:i:s', strtotime($this->pasportdate));
                    } else {
                        $newuserpartnerscastid->pasportdate = date('Y-m-d H:i:s');
                    }

                    $newuserpartnerscastid->pasportwhere = $this->pasportwhere;
                    $newuserpartnerscastid->customers_id = $userCustomer->customers_id;
                    Yii::$app->mailer->htmlLayout = 'layouts-om/html';
                    if ($newuserpartnerscastid->save()) {
                        Yii::$app->params['params']['products_mail'] =  $this->NewProducts(6,'mail_new-34', 7200);
                        Yii::$app->mailer->compose('sign-up-om', ['name'=>$this->name,'id'=>$userCustomer->customers_id,'username' => $user->username, 'password' => $this->password])
                            ->setFrom('odezhdamaster@gmail.com')
                            ->setTo($user->email)
                            ->setSubject('Регистрация на сайте ' . $_SERVER['HTTP_HOST'])
                            ->send();
                        return $user;
                    } else {
                    }
                } else {
                }
            } else {
            }
        } else {
        }
        //      $transaction->commit();
        // } catch (\yii\db\Exception $e) {
//
        //     $transaction->rollBack();
//
        //     die();

        // }
    }


}
