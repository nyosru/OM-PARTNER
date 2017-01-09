<?php

namespace common\forms\Cat;

use Yii;
use yii\base\Model;


class CatLandConfigForm extends Model
{

    public $config_name;

    public $header_tpl;
    public $header_title;

    public $content_tpl;
    public $content_list_products;
    public $special_offer;

    public $footer_tpl;

    public function rules()
    {
        return [
            [
                [
                    'header_tpl',
                    'header_title',
                    'content_tpl',
                    'content_list_products',
                    'special_offer',
                    'footer_tpl',
                    'config_name',
                ],
                'string',
            ],
            [['config_name',], 'match', 'pattern' => '/^[a-z]|[а-я]\w*$/i', 'message' => 'В названии должны быть только буквы'],
            [['config_name'], 'required', 'message' => 'Обязательное поле'],
        ];
    }

    public function storeOrUpdateConfig($config_name)
    {
        if (!$this->validate()) {
            return false;
        }

        $json_config = [
            "header_tpl"     => $this->header_tpl,
            "header_config"  => [
                "header_title" => $this->header_title,
            ],
            "content_tpl"    => $this->header_tpl,
            "content_config" => [
                "content_list_products" => $this->content_list_products,
                "special_offer"         => $this->special_offer,
            ],
            "footer_tpl"     => $this->footer_tpl,
        ];

        if($config_name != $this->config_name) {
            unlink(\Yii::getAlias('@runtime') . '/cat/'.$config_name);
        }

        $config_file_extension = '.json';
        if (file_put_contents(Yii::getAlias('@frontend') . '/runtime/cat/' . $this->config_name . $config_file_extension,
            json_encode($json_config))) {
            return true;
        }

        return true;
    }

    public function storeOrUpdatePreviewConfig()
    {
        if (!$this->validate()) {
            return false;
        }

        $json_config = [
            "header_tpl"     => $this->header_tpl,
            "header_config"  => [
                "header_title" => $this->header_title,
            ],
            "content_tpl"    => $this->header_tpl,
            "content_config" => [
                "content_list_products" => $this->content_list_products,
                "special_offer"         => $this->special_offer,
            ],
            "footer_tpl"     => $this->footer_tpl,
        ];

        if (file_put_contents(Yii::getAlias('@frontend') . '/runtime/cat/preview_config.json',
            json_encode($json_config))) {
            return true;
        }

        return true;
    }

}