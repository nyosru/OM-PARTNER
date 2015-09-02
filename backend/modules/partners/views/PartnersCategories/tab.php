<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\bootstrap\Modal;
use yii\widgets\Pjax;
use yii\bootstrap\Button;
use yii\bootstrap\Dropdown;
$this -> title = 'Партнеры';
$this -> registerCssFile('/css/partners.css');
?>
<?php Pjax::begin() ?>
    <div class="container" id="partners-head">
        <div class="container" id="partners-left-head-back"><div id='partners-left-head'><div><?
                    echo Html::input('text', 'username', $user -> name, ['class' => $username, 'placeholder' => 'Имя партнера', 'id' => 'partners-input-search-comp']);
                    echo Button::widget(['label' => '>', 'options' => ['class' => 'btn-xs btn-info', 'id' => 'partners-input-search-comp-button'], 'tagName' => 'div']);
                    ?></div><div id="partners-left-head-two-row"><?
                    echo Button::widget(['label' => '10', 'id' => 'c10', 'options' => ['class' => 'btn-xs btn-info',  'href' => '/partners/?count=1'], 'tagName' => 'a']);
                    echo Button::widget(['label' => '20', 'id' => 'c20', 'options' => ['class' => 'btn-xs btn-info',  'href' => '/partners/?count=2'], 'tagName' => 'a']);
                    echo Button::widget(['label' => '30', 'id' => 'c30', 'options' => ['class' => 'btn-xs btn-info',  'href' => '/partners/?count=3'], 'tagName' => 'a']);
                    ?><span><?
                        echo Button::widget(['label' => '<<', 'id' => 'cfirst', 'options' => ['class' => 'btn-xs btn-info', 'href' => '/partners/?step=first'], 'tagName' => 'a']);
                        echo Button::widget(['label' => '<', 'id' => 'cback', 'options' => ['class' => 'btn-xs btn-info',  'href' => '/partners/?step=1'], 'tagName' => 'a']);
                        echo Button::widget(['label' => '>', 'id' => 'cforvard', 'options' => ['class' => 'btn-xs btn-info',  'href' => '/partners/?step=1'], 'tagName' => 'a']);
                        echo Button::widget(['label' => '>>', 'id' => 'clast', 'options' => ['class' => 'btn-xs btn-info',  'href' => '/partners/?step=back'], 'tagName' => 'a']);
                        ?></span><?
                    Modal::begin(['header' => '<h4>Добавить партнера</h4>', 'toggleButton' => ['label' => 'Добавить', 'tag' => 'button', 'class' => 'btn btn-xs btn-info', 'id' => 'partners-add-comp']]);
                    $form = ActiveForm::begin(['action' => '/partners/default/save']);
                    echo $form -> field($model, 'name');
                    echo $form -> field($model, 'domain');
                    echo $form -> field($model, 'template');
                    echo Html::submitButton(Yii::t('app', 'Отправить'), ['class' => 'btn btn-primary', 'id' => 'act']);
                    ActiveForm::end();
                    Modal::end();
                    ?></div></div></div>
        <div class="container-fluid" id="partners-right-head-back">
            <div id="partners-main-right">
                <div> <?
                    echo Html::input('text', 'username', $user -> name, ['class' => $username,'id'=>'shearprod', 'placeholder' => 'Поиск']);
                    echo Button::widget(['label' => 'К', 'id' => 'ccatsearch', 'options' => ['class' => 'btn-xs btn-info'], 'tagName' => 'div']);
                    echo Button::widget(['label' => 'Т', 'id' => 'cprodsearch', 'options' => ['class' => 'btn-xs btn-info'], 'tagName' => 'div']);
                    echo Button::widget(['label' => 'А', 'id' => 'carticlsearch', 'options' => ['class' => 'btn-xs btn-info'], 'tagName' => 'div']);
                    echo Button::widget(['label' => 'Категории', 'id' => 'ccategories', 'options' => ['class' => 'btn-xs btn-info'], 'tagName' => 'div']);
                    echo Button::widget(['label' => 'Товары', 'id' => 'cproduct', 'options' => ['class' => 'btn-xs btn-info'], 'tagName' => 'div']);
                    ?></div><div id="partners-left-head-two-row"><?
                    Modal::begin(['header' => '<h4>Редатировать партнера</h4>', 'toggleButton' => ['label' => 'Редактировать партнера', 'tag' => 'button', 'class' => 'btn btn-xs btn-info', 'id' => 'partners-update-comp', ]]);
                    $form = ActiveForm::begin(['action' => '/partners/default/update']);
                    echo $form -> field($model, 'name');
                    echo $form -> field($model, 'domain');
                    echo $form -> field($model, 'template');
                    echo Html::submitButton(Yii::t('app', 'Отправить'), ['class' => 'btn btn-primary', 'id' => 'act']);
                    ActiveForm::end();
                    Modal::end();
                    echo Button::widget(['label' => 'Удалить партнера', 'options' => ['class' => 'btn-xs btn-danger'], 'tagName' => 'div', 'id' => 'partners-delete-comp']);
                    ?>
                </div> </div></div></div>
    <div class="container" id="partners-main">
        <div class="container" id="partners-main-left-back">
            <div id="partners-main-left">

                <div id="partners-main-left-cont">
                    <?
                    foreach ($data as $key => $value) {
                        echo html::beginTag('a', ['href' => "#" . $value['id']]);
                        echo Html::beginTag('div', ['class' => 'partners-comp-main']);
                        foreach ($value as $key => $value) {
                            if ($props[$key] == 'ID') {
                                echo Html::BeginTag('div', ['class' => 'partners-comp-id']) . $value . Html::EndTag('div');
                            } elseif ($props[$key] == 'Фирма') {
                                echo Html::BeginTag('div', ['class' => 'partners-comp-name']) . $value . Html::EndTag('div');
                            } elseif ($props[$key] == 'Домен') {
                                echo Html::BeginTag('div', ['class' => 'partners-comp-domain']) . $value . Html::EndTag('div');
                            }
                        }
                        echo Html::EndTag('div');
                        echo Html::EndTag('a');
                    }
                    ?>
                </div>

            </div>
        </div>
        <div class="container-fluid" id="partners-main-right-back">
            <div id="partners-main-right"></div></div>
    </div>
<? ?>
<? $this -> registerJsFile('js/script.js', ['depends' => [\yii\web\JqueryAsset::className()]]); ?>
<?php Pjax::end(); ?>