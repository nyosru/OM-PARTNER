<?php

/* @var $this \yii\web\View */
/* @var $data_provider \yii\data\ActiveDataProvider */
/* @var array $data_arr */
/* @var string $url_param */

$this->registerCssFile('@web/css/dropdown-nav.css');
$this->registerJsFile('@web/js/dropdown-nav.js');
?>

<div class="header-container">
    <div class="full-content-block gray-back-block nav-bar">
        <a class="nav-buttons" href="<?= \yii\helpers\Url::current(['status' => '']) ?>">Все клиенты</a>
        <a class="nav-buttons" style="border-bottom: 2px solid #009f9c;"
           href="<?= \yii\helpers\Url::current(['status' => '1']) ?>">Новые</a>
        <a class="nav-buttons" style="border-bottom: 2px solid #d8d8d8;"
           href="<?= \yii\helpers\Url::current(['status' => '2']) ?>">Постоянные</a>
        <a class="nav-buttons" style="border-bottom: 2px solid #9c27b0;"
           href="<?= \yii\helpers\Url::current(['status' => '3']) ?>">Вип клиенты</a>
    </div>
    <form style="height: 60px;background: #FFF">
        <div class="search-bar col-md-4">
            <input class="search-console" value="<?= Yii::$app->request->getQueryParam('search') ?>"
                   name="search"
                   placeholder="Поиск по клиентам">
            <?php
            echo \yii\helpers\Html:: hiddenInput(Yii::$app->getRequest()->csrfParam,
                Yii::$app->getRequest()->getCsrfToken(), []);
            ?>
        </div>
        <div class="col-md-8">
            <div class="row ">
                <div class="filter_nav">
                    <div class="filter-order_by">
                        <nav class="dropdown-nav">
                            <?php
                            $sort_attribute_order = $data_provider->getSort()->getAttributeOrders();
                            ?>
                            <span>Сортировать по: </span><a class="dropdown-toggle" href="#" title="">
                                <?php
                                $i = 0;
                                foreach ($data_arr as $key => $sort) :
                                    if (in_array($key, array_keys($sort_attribute_order))) {
                                        $header_search = $sort;
                                    }
                                    if (isset($header_search)) {
                                        echo $header_search;
                                        echo ($sort_attribute_order[$key] === 3) ? ' &#8595' : ' &#8593';
                                        break;
                                    }
                                    if ($i == count($data_arr) - 1) {
                                        echo 'выбрать';
                                    }
                                    $i++;
                                endforeach; ?>
                            </a>
                            <ul class="dropdown">
                                <?php foreach ($data_arr as $key => $sort) : ?>
                                <li><a href="
                <?= \yii\helpers\Url::current([$url_param => ($sort_attribute_order[$key] == 3) ? $key : '-'.$key]) ?>
                "><?= $sort ?> <?= isset($sort_attribute_order[$key]) ? ($sort_attribute_order[$key] == 3) ? '&#8593' : '&#8595' : ''; ?></a>
                                </li>
                                <li>
                                    <?php endforeach; ?>
                            </ul>
                        </nav>
                    </div>
                </div>
                <div class="filter_date">
                    <?= \kartik\date\DatePicker::widget([
                        'language'      => 'ru',
                        'layout'        => '<div class="date-filter">
                            <div class="filter-time-field">Дата с: </div>
                            {input1}
                            <div class="filter-time-field">Дата по:</div>
                            {input2}
                            </div>',
                        'name'          => 'ds',
                        'name2'         => 'de',
                        'value'         => (Yii::$app->request->get('ds')) ?: null,
                        'value2'        => (Yii::$app->request->get('de')) ?: null, //(new \DateTime(date(Yii::$app->request->getQueryParam('de'))))->format('Y-m-d'),
                        'type'          => \kartik\date\DatePicker::TYPE_RANGE,
                        'options'       => [
                            'style' => "height: 20px;width: 100px;border-radius: 4px;border: 1px solid #CCC;display: inline-block;float: left;",
                        ],
                        'options2'      => [
                            'style' => "height: 20px;width: 100px;border-radius: 4px;border: 1px solid #CCC;display: inline-block;float: left;",
                        ],
                        'pluginOptions' => [
                            'autoclose' => true,
                            'format'    => 'yyyy-mm-dd',
                        ],
                    ]); ?>
                </div>
            </div>
        </div>


        <?= \yii\helpers\Html::submitButton('Submit', [
            'class' => 'btn btn-primary',
            'style' => 'display:none',
        ]); ?>
    </form>

</div>