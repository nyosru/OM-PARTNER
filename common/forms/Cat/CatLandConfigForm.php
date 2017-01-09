<?php

namespace common\forms\Cat;

use Yii;
use yii\base\Model;


class CatLandConfigForm extends Model
{
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
                ],
                'string'
            ],

        ];
    }

    public function storeOrUpdateConfig($config_name)
    {
        if (!$this->validate()) {
            return false;
        }

        $json_config = [
          "header_tpl" => $this->header_tpl,
          "header_config" => [
              "header_title" => $this->header_title
          ],
          "content_tpl" => $this->header_tpl,
          "content_config" => [
            "content_list_products" => $this->content_list_products,
            "special_offer"=> $this->special_offer,
          ],
          "footer_tpl" => $this->footer_tpl,
        ];

        if(file_put_contents(Yii::getAlias('@frontend') .'/runtime/cat/'.$config_name, json_encode($json_config))) {
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
          "header_tpl" => $this->header_tpl,
          "header_config" => [
              "header_title" => $this->header_title
          ],
          "content_tpl" => $this->header_tpl,
          "content_config" => [
            "content_list_products" => $this->content_list_products,
            "special_offer"=> $this->special_offer,
          ],
          "footer_tpl" => $this->footer_tpl,
        ];

        if(file_put_contents(Yii::getAlias('@frontend') .'/runtime/cat/preview_config.json', json_encode($json_config))) {
            return true;
        }
        return true;
    }

}