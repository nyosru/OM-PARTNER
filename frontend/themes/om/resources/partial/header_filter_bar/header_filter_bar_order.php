<?php

/* @var $this \yii\web\View */
/* @var $data_provider \yii\data\ActiveDataProvider */
/* @var array $sortStatusData */
/* @var array $sortOrderByData */

?>

<div class="header-container">
    <div class="full-content-block gray-back-block nav-bar">
        <?php foreach ($sortStatusData as $url_param_key => $data_param_key) : ?>
            <?php foreach ($data_param_key as $value => $data) : ?>
                <a class="nav-buttons" style="<?= ($data['options']['style']) ?: '' ?>"
                   href="<?= \yii\helpers\Url::current([$url_param_key => $value]) ?>"><?= $data[0] ?></a>
            <?php endforeach; ?>
        <?php endforeach; ?>
    </div>
    <form style="height: 60px;background: #FFF">
        <div class="">
            <div class="search-bar col-md-3">
                <input class="search-console" value="<?= Yii::$app->request->getQueryParam('search') ?>"
                       name="search"
                       placeholder="Поиск">
                <?php
                echo \yii\helpers\Html:: hiddenInput(Yii::$app->getRequest()->csrfParam,
                    Yii::$app->getRequest()->getCsrfToken(), []);
                ?>
            </div>
            <div class="col-md-7">
                <div class="filter_nav">
                    <div class="filter-order_by">
                        <nav class="dropdown-nav">
                            <?php
                            $sort_attribute_order = $dataProvider->getSort()->getAttributeOrders();
                            ?>
                            <span>Сортировать по: </span><a class="dropdown-toggle" href="#" title="">

                                <?php foreach ($sortOrderByData as $url_param_key => $data_param_key) : ?>
                                    <?php $i = 0;
                                    foreach ($data_param_key as $value => $data) : ?>

                                        <?php
                                        if (in_array($value, array_keys($sort_attribute_order))) {
                                            $header_search = $data[0];
                                        }
                                        if (isset($header_search)) {
                                            echo $header_search;
                                            echo ($sort_attribute_order[$value] === 3) ? ' &#8595' : ' &#8593';
                                            break;
                                        }
                                        // end
                                        if ($i == count($data_param_key) - 1) {
                                            echo 'выбрать';
                                        }

                                        ?>
                                        <?php $i++; endforeach;
                                    $i = 0; ?>
                                <?php endforeach; ?>

                            </a>
                            <ul class="dropdown">
                                <?php foreach ($sortOrderByData as $url_param_key => $data_param_key) : ?>
                                    <?php foreach ($data_param_key as $value => $data) : ?>
                                        <li><a href="
                <?= \yii\helpers\Url::current([$url_param_key => ($sort_attribute_order[$value] == 3) ? $value : '-' . $value]) ?>
                "><?= $data[0] ?> <?= isset($sort_attribute_order[$value]) ? ($sort_attribute_order[$value] == 3) ? '&#8593' : '&#8595' : ''; ?></a>
                                        </li>
                                    <?php endforeach; ?>
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
                        'value2'        => (Yii::$app->request->get('de')) ?: (new \DateTime(date(Yii::$app->request->getQueryParam('de'))))->format('Y-m-d'),
                        'type'          => \kartik\date\DatePicker::TYPE_RANGE,
                        'options'       => [
                            'style' => "height: 20px;width: 100px;border-radius: 4px;border: 1px solid #CCC;display: inline-block;float: left;",
                        ],
                        'options2'      => [
                            'style' => "height: 20px;width: 100px;border-radius: 4px;border: 1px solid #CCC;display: inline-block;float: left;",
                        ],
                        'pluginOptions' => [
//                            'autoclose' => true,
                            'format'    => 'yyyy-mm-dd',

                        ],
                        'pluginEvents' => [
                            "hide" => "function(e) {  console.log(e); }",
                        ],

                    ]); ?>
                </div>
            </div>
            <div class="col-md-2">
                <div class="filters_btns">
                    <?= \yii\helpers\Html::hiddenInput('status', Yii::$app->request->getQueryParam('status')); ?>
                    <?= \yii\helpers\Html::submitButton('Применить', [
                        'class' => 'filters',
                        'style' => '',
                    ]); ?>
                    <div class="filters" style="margin-left: 10px;">
                        <a href="<?= strstr(\yii\helpers\Url::current(), '?', true) ?>" style="float: right" class="">Сбросить</a>
                    </div>

                </div>
            </div>
        </div>


    </form>

</div>