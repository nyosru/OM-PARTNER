<?php

namespace common\forms\Cat;

use Yii;
use yii\base\Model;


class CatLandConfigForm extends Model
{

    public $config_name;

    public $header_tpl;
    public $header_title;
    public $banners_tpl;
    public $images_cfg;

    public $content_tpl;
    public $content_list_products;
    public $special_offer;

    public $footer_tpl;

    protected $path_save_pictures = '@webroot/images/cat/';
    protected $valid_formats = ["jpg", "png", "gif", "jpeg"];

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
                    'banners_tpl',
                    'images_cfg',
                ],
                'string',
            ],
            [['config_name',], 'match', 'pattern' => '/^[a-z]|[а-я]\w*$/i', 'message' => 'В названии должны быть только буквы'],
            [['config_name'], 'required', 'message' => 'Обязательное поле'],
        ];
    }

    public function getPathSavePictures()
    {
        return $this->path_save_pictures;
    }

    public function storeOrUpdateConfig($config_name)
    {
        if (!$this->validate()) {
            return false;
        }

        $json_config = [
            "header_tpl"     => $this->header_tpl,
            "header_config"  => [
                "header_title"  => $this->header_title,
                "banner_config" => [
                    'template' => $this->banners_tpl,
                    'images'   => json_decode($this->images_cfg),
                ],
            ],
            "content_tpl"    => $this->header_tpl,
            "content_config" => [
                "content_list_products" => $this->content_list_products,
                "special_offer"         => $this->special_offer,
            ],
            "footer_tpl"     => $this->footer_tpl,
        ];

        if (!empty($config_name) && $config_name != $this->config_name) {
            unlink(\Yii::getAlias('@runtime') . '/cat/' . $config_name);
        }

        $config_file_extension = '.json';

        $file_special_offers = file_get_contents(Yii::getAlias('@frontend') . '/runtime/cat/store/special_offer' . $config_file_extension);
        $file_special_offers = (array)json_decode($file_special_offers, true);

        if (!in_array($this->special_offer, $file_special_offers)) {
            $file_special_offers[] = $this->special_offer;
        }

        if(!file_exists(Yii::getAlias('@frontend') . '/runtime/cat/store/special_offer'.$config_file_extension)) {
            if (!mkdir(Yii::getAlias('@frontend') . '/runtime/cat/store', 0777, true)) {
                Yii::$app->session->setFlash('error', 'Ошибка, данные не сохранены');

                return false;
            }
        }

        if (!file_put_contents(Yii::getAlias('@frontend') . '/runtime/cat/store/special_offer' . $config_file_extension,
            json_encode($file_special_offers))
        ) {
            Yii::$app->session->setFlash('error', 'Ошибка, данные не сохранены');

            return false;
        }

        if (file_put_contents(Yii::getAlias('@frontend') . '/runtime/cat/' . $this->config_name . $config_file_extension,
            json_encode($json_config))
        ) {
            Yii::$app->session->setFlash('success', 'Удача! Данные сохранены');

            return true;
        }

        Yii::$app->session->setFlash('error', 'Ошибка, данные не сохранены');

        return false;
    }

    public function storeOrUpdatePreviewConfig($config_name)
    {
        if (!$this->validate()) {
            return false;
        }

        $json_config = [
            "header_tpl"     => $this->header_tpl,
            "header_config"  => [
                "header_title"  => $this->header_title,
                "banner_config" => [
                    'template' => $this->banners_tpl,
                    'images'   => json_decode($this->images_cfg),
                ],
            ],
            "content_tpl"    => $this->header_tpl,
            "content_config" => [
                "content_list_products" => $this->content_list_products,
                "special_offer"         => $this->special_offer,
            ],
            "footer_tpl"     => $this->footer_tpl,
        ];


        if (Yii::$app->cache->set('preview_config'. $this->config_name, json_encode($json_config), 604800)) {
            return true;
        } else {
            Yii::$app->session->setFlash('error', 'Произошла ошибка');
            return false;
        }
    }

    public function saveImages($files = [])
    {

        if (count($files) == 0) {
            return false;
        }

        $url_files = [];
        $path = Yii::getAlias($this->path_save_pictures);
        foreach ($files as $file) {

            if (!strlen($file->name)) {
                //'Неправильный формат файла..'
                return false;
                continue;
            }

            list($type_info, $type_ext) = explode('/', $file->type);

            if ($type_info != 'image' && !in_array($type_ext, $this->valid_formats)) {
                //'Неправильный формат файла..'
                return false;
                continue;
            }

            if ($file->size > (4 * 1024 * 1024)) {
                //'Максимальный размер файла 4 MB'
                return false;
                continue;
            }

            list($name, $name_ext) = explode('.', $file->name);
            $actual_image_name = md5($name) . "." . $type_ext;

            $tmp = $file->tempName;

            if (!is_file($tmp)) {
                // 'Отсутствует файл, сбой загрузки'
                return false;
                continue;
            }

            if (mkdir($path, 0777, true)) {
                return false;
                continue;
            }

            if (!move_uploaded_file($tmp, $path . $actual_image_name)) {
                // 'Ошибка сохранения'
                return false;
                continue;
            }


            $url_files[] = $actual_image_name;
        }

        return $url_files;
    }

}