<?php
namespace common\models;

use Yii;
use yii\base\Model;
use common\models\User;
/**
 * Login form
 */
class LoginForm extends Model
{
    public $username;
    public $password;
    public $rememberMe = true;
    private $_user = false;
    public $captcha;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            // username and password are both required
            [['username', 'password', 'captcha'], 'required'],
            // rememberMe must be a boolean value
            ['rememberMe', 'boolean'],
            ['captcha', 'captcha', 'captchaAction' => BASEURL . '/captcha'],
            // password is validated by validatePassword()
            ['password', 'validatePassword'],

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
        $user = $this->getUser();
        if (!$user) {
            $this->addError('password', 'Нет такого пользователя');
        } elseif (!$user->validatePassword($this->password)) {
            $this->addError('password', 'Не соответствует пара логин- пароль');
        } else {
            $run = new Partners();
            $check = $run->GetId($_SERVER['HTTP_HOST']);
            if ((intval($user->id_partners) != intval($check) && intval($user->id_partners) != 0) || !$user->validatePassword($this->password)) {
                $this->addError('password', 'Не соответствует пара логин - пароль.');
            } elseif (($user->id_partners) == NULL) {
                return true;
            }else{
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
    public function getUser()
    {
        if ($this->_user === false) {
            $userq = new User();
            $run = new Partners();
            if ($_SERVER['HTTP_HOST'] == 'http://globaladmin.egorov.odezhda-master.ru' || $_SERVER['HTTP_HOST'] == 'http://globaladmin.partnerom.odezhda-master.ru') {
                $check = 'NULL';
            }else{
                $check = $run->GetId($_SERVER['HTTP_HOST']);
            }
            $this->_user = $userq->find()->where(['username' => $this->username, 'id_partners' => $check])->one();

        }
        $user = $this->_user;
        return $user;
    }
}
