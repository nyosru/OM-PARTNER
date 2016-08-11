<?php
namespace frontend\models;

use common\models\User;
use yii\base\Model;

/**
 * Password reset request form
 */
class PasswordResetRequestForm extends Model
{
    public $email;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            ['email', 'filter', 'filter' => 'trim'],
            ['email', 'required'],
            ['email', 'email'],
            ['email', 'exist',
                'targetClass' => '\common\models\User',
                'filter' => ['status' => User::STATUS_ACTIVE,
                             'id_partners' =>  \Yii::$app->params['constantapp']['APP_ID']],
                'message' => 'There is no user with such email.'
            ],
        ];
    }

    /**
     * Sends an email with a link, for resetting the password.
     *
     * @return boolean whether the email was send
     */
    public function sendEmail()
    {
        /* @var $user User */
        $user = User::findOne([
            'status' => User::STATUS_ACTIVE,
            'email' => $this->email,
            'id_partners' =>  \Yii::$app->params['constantapp']['APP_ID']
        ]);

        if ($user) {
            if (!User::isPasswordResetTokenValid($user->password_reset_token)) {
                $user->generatePasswordResetToken();
            }

            if ($user->save()) {
                \Yii::$app->params['params']['utm'] =  [
                    'source'=>'email',
                    'medium'=>'password-reset',
                    'campaign'=>'new-om',
                    'content'=>'password-reset'
                ];
                \Yii::$app->mailer->htmlLayout = 'layouts-om/html';
                return \Yii::$app->mailer->compose(['html' => 'passwordResetToken-html'], ['user' => $user])
                    ->setFrom('odezhdamaster@gmail.com')
                    ->setTo($this->email)
                    ->setSubject('Сброс пароля')
                    ->send();
            }
        }

        return false;
    }
}
