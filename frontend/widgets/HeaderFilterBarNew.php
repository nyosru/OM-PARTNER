<?php

namespace frontend\widgets;

use yii\data\ActiveDataProvider;

class HeaderFilterBarNew extends \yii\bootstrap\Widget
{
    /**
     * @var string $tpl
     */
    public $tpl;
    /**
     * @var string $sortStatusData
     *    [
     *    'url_param_key' => [
     *      'value' => ['label'],
     *      'value' => ['label' , 'options' => ['style' => 'prams...']]
     *    ],
     */
    public $sortStatusData;
    /**
     * @var string $sortOrderByData
     *    [
     *    'url_param_key' => [
     *      'value' => ['label'],
     *      'value' => ['label'],
     *    ],
     */
    public $sortOrderByData;
    /**
     * @var $dataProvider ActiveDataProvider
     */
    public $dataProvider;
    /**
     * @var string $urlParam
    */

    public function init()
    {
        parent::init();
        if ($this->tpl === null) {
            $this->tpl = 'header_filter_bar_order';
        }
    }

    public function run()
    {
        return $this->render('@partial/header_filter_bar/' . $this->tpl, [
            'sortOrderByData' => $this->sortOrderByData,
            'sortStatusData' => $this->sortStatusData,
            'dataProvider' => $this->dataProvider,
        ]);
    }
}