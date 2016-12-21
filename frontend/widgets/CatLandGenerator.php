<?php

namespace frontend\widgets;

class CatLandGenerator extends \yii\bootstrap\Widget
{
    /**
     * @var string
     */
    public $header_tpl = '';
    /**
     * @var array
     * [
     *      'special_header' => 'Some text'
     * ]
     */
    public $header_config = [];

    /**
     * @var string
     */
    public $content_tpl = '';
    /**
     * @var array
     * [
     *      'products' => [(int)article, (int)article, (int)article]
     * ]
     */
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
        return $this->render('@partial/cat-landing/header/' . $this->header_tpl);
    }

    /**
     * @return string
     */
    public function renderContent()
    {
        return $this->render('@partial/cat-landing/content/' . $this->content_tpl);
    }

    /**
     * @return string
     */
    public function renderFooter()
    {
        return $this->render('@partial/cat-landing/footer/' . $this->footer_tpl);
    }
}