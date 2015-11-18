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
            ['captcha', 'captcha'],
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
        if (!$user || !$user->validatePassword($this->password)) {
            $this->addError('password', 'Не соответствует пара логин- пароль');
        }else{
            $run = new Partners();
            $check = $run->GetId($_SERVER['HTTP_HOST']);
            if(intval($user->id_partners) != intval($check) && intval($user->id_partners) != 0 || !$user->validatePassword($this->password)){
                $this->addError('password', 'Не соответствует пара логин - пароль.');
            }elseif(intval($user->id_partners) == 0){
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
            return Yii::$app->user->login($this->getUser(), $this->rememberMe ? 3600 * 24 * 30 : 0);
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
            if($_SERVER['HTTP_HOST'] == 'globaladmin.egorov.odezhda-master.ru' || $_SERVER['HTTP_HOST'] == 'globaladmin.partnerom.odezhda-master.ru'){
                $check = 0;
            }else{
                $check = $run->GetId($_SERVER['HTTP_HOST']);
            }
            $this->_user =  $userq->find()->where(['username' =>$this->username, 'id_partners'=> $check])->all();

        }
        $user = $this->_user;
        return $user[0];
    }
}
