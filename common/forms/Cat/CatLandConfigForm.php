<?php

namespace common\forms\Cat;

use Yii;
use yii\base\Model;


class CatLandConfigForm extends Model
{
    public $header_tpl;
    public $content_tpl;
    public $footer_tpl;

    public function rules()
    {
        return [
            [['header_tpl', 'content_tpl', 'footer_tpl'], 'string'],
        ];
    }

    public function storeOrUpdateConfig()
    {
        if (!$this->validate()) {
            return false;
        }

        return false;
    }

}