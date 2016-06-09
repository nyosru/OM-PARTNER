<?php
/**
 * Created by PhpStorm.
 * User: dmitriy
 * Date: 04.04.16
 * Time: 13:16
 */
namespace common\models;

use common\models\Orders;
use Yii;
use yii\base\Model;
use common\models\User;
use common\models\Customers;

/**
 * Claim form
 */
class ContactForm extends Model
{

    public $email;
    public $name;
    public $subject;
    public $body;
    public $to;


    public function rules()
    {
        return [
            [['email'], 'email', 'message' => 'Введите правильный электронный адрес'],
            [['subject', 'body', 'to', 'name', 'email'], 'required', 'message' => 'Обязательное поле'],
            [['subject', 'body', 'name', 'to'], 'string'],


        ];
    }

    public function sendEmail()
    {

        return Yii::$app->mailer->compose()
            ->setTo($this->to)
            ->setFrom([$this->email => $this->name])
            ->setSubject($this->subject)
            ->setTextBody($this->body)->send();
    }


}