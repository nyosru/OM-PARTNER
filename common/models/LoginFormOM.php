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
    public $captcha;
    public $errors =[
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
            ['password','required' , 'message' => 'Поле не может быть пустым'],
            ['captcha', 'required', 'message' => 'Поле не может быть пустым'],
            ['rememberMe', 'boolean'],
            ['captcha', 'captcha', 'captchaAction' => BASEURL . '/captcha', 'message' => 'Введенные символы не соответствуют'],
            ['password', 'validatePassword', 'message' => 'Не правильный пароль или логин'],
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

    /**
     * Logs in a user using the provided username and password.
     *
     * @return boolean whether the user is logged in successfully
     */
    public function login()
    {

        if ($this->validate()) {
//            if (!$this->getUser()) {
//                echo '<pre>';
//                print_r($this->getUserOM());
//                echo '</pre>';
//                die();
                $newpartuser = new User();
                $newpartuserinfo = new PartnersUsersInfo();
//                $newpartuser->email = '';
//                $newpartuser->password = '';
//                $newpartuser->password_hash = '';
//                $newpartuser->status = '';
//                $newpartuser->created_at = '';
//                $newpartuser->updated_at = '';
//                $newpartuser->username = '';
//                $newpartuserinfo->country = '';
//                $newpartuserinfo->state = '';
//                $newpartuserinfo->city = '';
//                $newpartuserinfo->adress = '';
//                $newpartuserinfo->postcode = '';
//                $newpartuserinfo->telephone = '';
//                $newpartuserinfo->name = '';
//                $newpartuserinfo->lastname = '';
//                $newpartuserinfo->secondname = '';
//                $newpartuserinfo->customers_id = '';
//                $newpartuserinfo->pasportdate = '';
//                $newpartuserinfo->pasportnum = '';
//                $newpartuserinfo->pasportser = '';
//                $newpartuserinfo->pasportwhere = '';
//                $this->_user[] = '';
//                $this->_user[] = '';
//                $this->_user[] = '';
//                $this->_user[] = '';
//                $this->_user[] = '';
//                $this->_user[] = '';
//                $this->_user[] = '';
//                $this->_user[] = '';
//                $this->_user[] = '';
//                $this->_user[] = '';
//                $this->_user[] = '';
//                $this->_user[] = '';
//                $this->_user[] = '';
//                $this->_user[] = '';
 //           }
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
