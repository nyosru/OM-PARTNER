<?php
namespace frontend\models;

use common\models\User;
use common\models\Partners;
use common\models\Customers;
use common\models\PartnersUsersInfo;
use yii\web\IdentityInterface;
use yii\base\Model;
use Yii;

/**
 * Signup form
 */


class SignupForm extends Model
{
    public $email;
    public $password;
    public $id_partners;
    public $role;
    public $captcha;
//    public $name;
//    public $secondname;
//    public $lastname;
//    public $adress;
//    public $city;
//    public $state;
//    public $country;
//    public $postcode;
//    public $telephone;
//    public $user_id;
//    public $pasportser;
//    public $pasportnum;
//    public $pasportdate;
//    public $pasportwhere;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            ['email', 'filter', 'filter' => 'trim'],
            ['email', 'required', 'message' => 'Это обязательное поле.'],
            ['email', 'email'],
            ['captcha', 'captcha', 'captchaAction' => BASEURL . '/captcha'],
            ['email', 'validateUserEmail'],
            ['password', 'required', 'message' => 'Это обязательное поле.'],
            ['password', 'string', 'min' => 8, 'message' => 'Минимум 8 знаков'],
        ];
    }

    /**
     * Signs user up.
     *
     * @return User|null the saved model or null if saving fails
     */
    public function signup()
    {
        if ($this->validate()) {
            $user = new User();
            $partners = new Partners();
            $id_partners = $partners->GetId($_SERVER[HTTP_HOST]);
            $user->username = $this->email;
            $user->email = $this->email;
            $user->setPassword($this->password);
            $user->generateAuthKey();
            $user->id_partners = $id_partners;
            $user->role = 'register';
            if ($user->save()) {
              $auth = Yii::$app->authManager;
              $auth->assign($auth->getRole('register'), $user->getId());
                Yii::$app->mailer->compose(['html' => 'sign-up'], ['username' => $user->username, 'password' => $this->password, 'sait'=>$_SERVER[HTTP_HOST]])
                    ->setFrom('support@'.$_SERVER[HTTP_HOST])
                    ->setTo($user->email)
                    ->setSubject('Регистрация на сайте '.$_SERVER[HTTP_HOST])
                    ->send();
                return $user;
            }
        }
    }
    public function validateUserEmail()
    {
        $userCustomer = new Customers();
        $partners = new Partners();
        $id_partners = $partners->GetId($_SERVER['HTTP_HOST']);
        $check_email = $userCustomer->find()->where(['customers_email_address' => 'partnerom'.$id_partners.'@@@'.$this->email])->asArray()->one();
        $userCustomer = new User();
        $check_part_email = $userCustomer->find()->where(['email' => $this->email, 'id_partners'=>$id_partners])->asArray()->one();
        if(!$check_email && !$check_part_email){
            return true;
        }else {
            $this->addError('email', 'Почтовый адрес уже используется в системе');
        }
    }

}
