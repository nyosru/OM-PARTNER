<?php

namespace frontend\models;

use Yii;
use yii\base\Model;

/**
 * ContactForm is the model behind the contact form.
 */
class MailToUserForm extends Model
{
    public $name;
    public $email;
    public $subject;
    public $body;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            // name, email, subject and body are required
            [['name', 'email', 'subject', 'body'], 'required'],
            // email has to be a valid email address
            ['email', 'email'],

            ['email', 'required', 'message' => 'Нет почтового адреса'],
            ['subject', 'required', 'message' => 'Необходимо заполнить'],
            ['body', 'required', 'message' => 'Необходимо заполнить'],
        ];
    }


    /**
     * Sends an email to the specified email address using the information collected by this model.
     *
     * @param  string $email the target email address
     * @return boolean whether the email was sent
     */
    public function sendEmail()
    {
        return Yii::$app->mailer->compose(['html' => 'mail-to-user'], ['letter' => $this->body])
            ->setTo($this->email)
            ->setFrom($this->name)
            ->setSubject($this->subject)
            ->setTextBody($this->body)
            ->send();
    }
}
