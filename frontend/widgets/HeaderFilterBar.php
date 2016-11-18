<?php

namespace frontend\widgets;

use yii\data\ActiveDataProvider;

class HeaderFilterBar extends \yii\bootstrap\Widget
{
    /**
     * @var string $tpl
     */
    public $tpl;
    /**
     * @var array $dataArr
     * [
     * 'attribute' => 'label',
     * 'attribute' => 'label'
     * ]
     */
    public $data_arr;
    /**
     * @var $dataProvider ActiveDataProvider
     */
    public $data_provider;
    /**
     * @var string $urlParam
     */
    public $url_param;

    public function init()
    {
        parent::init();
        if ($this->tpl === null) {
            $this->tpl = 'header_filter_bar';
        }
    }

    public function run()
    {
        return $this->render('header_filter_bar/' . $this->tpl, [
            'data_arr' => $this->data_arr,
            'data_provider' => $this->data_provider,
            'url_param' => $this->url_param,
        ]);
    }
}