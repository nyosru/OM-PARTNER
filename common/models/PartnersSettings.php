<?php
namespace common\models;

use Yii;
use yii\base\Model;
/**
 * Login form
 */
class PartnersSettings extends Model
{
    public $mail_counter_id;
    public $mail_counter_activated;
    public $yandex_counter_id;
    public $yandex_counter_activated;
    public $template;
    public $minimal_order_total_price;
    public $discount;
    public $yandex_map;
    public $google_map;
    public $contacts;


    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['mail_counter_activated, yandex_counter_activated'], 'boolean'],
            [['mail_counter_id, ', 'yandex_counter_id' ], 'integer'],
            [['template'], 'string']
        ];
    }
    public function SaveSettings()
    {
        return true;
    }


}
