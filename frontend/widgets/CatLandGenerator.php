<?php

namespace frontend\widgets;

use common\models\PartnersProducts;

class CatLandGenerator extends \yii\bootstrap\Widget
{
    /**
     * @var string
     */
    public $header_tpl = '';
    public $header_config = [];

    /**
     * @var string
     */
    public $content_tpl = '';
    public $content_config = [];

    /**
     * @var string
     */
    public $footer_tpl = '';


    public function init()
    {
        parent::init();
        $default_tpl_file = 'default';

        if (empty($this->header_tpl) || $this->header_tpl === null) {
            $this->header_tpl = $default_tpl_file;
        }
        if (empty($this->content_tpl) || $this->content_tpl === null) {
            $this->content_tpl = $default_tpl_file;
        }
        if (empty($this->footer_tpl) || $this->footer_tpl === null) {
            $this->footer_tpl = $default_tpl_file;
        }
    }

    public function run()
    {
        echo $this->renderHeader();

        echo $this->renderContent();

        echo $this->renderFooter();
    }

    /**
     * @return string
     */
    public function renderHeader()
    {
        return $this->render('@partial/cat-landing/header/' . $this->header_tpl, [
            'header_config' => ($this->header_config['header_title']) ? $this->header_config['header_title'] : 'Тут должен быть заголовок',
        ]);
    }

    /**
     * @return string
     */
    public function renderContent()
    {
        $id_data = explode(',', $this->content_config['content_list_products']);
        $content_list_products = PartnersProducts::find()->where(['products_id' => $id_data])->asArray()->all();

        return $this->render('@partial/cat-landing/content/' . $this->content_tpl, [
            'content_list_products' => $content_list_products,
            'special_offer'         => ($this->content_config['special_offer']) ? $this->content_config['special_offer'] : 'Тут должен быть заголовок',
        ]);
    }

    /**
     * @return string
     */
    public function renderFooter()
    {
        return $this->render('@partial/cat-landing/footer/' . $this->footer_tpl);
    }
}