<div class="row">
    <div class="col-1">
        <div class="header_bar" style="height: 55px;border-bottom: 1px solid rgb(204, 204, 204);">
            <div class="header_bar_img">
                <img src="/images/logo/OM_code.png">
            </div>
        </div>
    </div>
</div>
<div class="container_95">
    <div class="row">
        <div class="col-1-2">
            <div class="header center">
                <h3 class="">Настройки лендинга</h3>
            </div>
            <div style="max-width: 600px; margin: 0 auto;">
                <?php

                use yii\helpers\Html;
                use yii\widgets\ActiveForm;

                $form = ActiveForm::begin(['method'=> 'post', 'id' => 'save_land_config', 'action' => 'preview-land']);

                echo $form->field($model, 'header_tpl')
                    ->label('Шапка')
                    ->dropdownList([
                        'default' => 'Стандартный',
                    ], ['prompt' => 'Выберите вид'])
                ;

                echo $form->field($model, 'header_title')
                    ->label('Заголовок')
                ;

                echo $form->field($model, 'content_tpl')
                    ->label('Контейнер')
                    ->dropdownList([
                        'default' => 'Стандартный',
                    ], ['prompt' => 'Выберите вид'])
                ;
                echo $form->field($model, 'content_list_products')
                    ->label('Отоборанные товары для контейнера (через запятую "," введите id товаров)')
                ;

                echo $form->field($model, 'special_offer')->label('Специальное предложение')->input('text')
                    ->widget('\vova07\imperavi\Widget', [
                        'settings' => [
                            'verifiedTags' => ['div', 'a', 'img', 'b', 'strong', 'sub', 'sup', 'i', 'em', 'u', 'small', 'strike', 'del', 'cite', 'ul', 'ol', 'li'],
                            'lang'         => 'ru',
                            'minHeight'    => 200,
                            'plugins'      => ['fontsize', 'fontcolor', 'table']]])
                ;

                echo $form->field($model, 'footer_tpl')
                    ->label('Подвал')
                    ->dropdownList([
                        'default' => 'Стандартный',
                    ], ['prompt' => 'Выберите вид'])
                ;
                ?>

                <div class="form-group">
                    <?= Html::button('Предварительный просмотр', ['class' => 'btn btn-primary', 'name' => 'cat-lend-config']) ?>
                </div>
                <div class="form-group">
                    <?= Html::submitButton('Отправить', ['class' => 'btn btn-primary']) ?>
                </div>

                <?php ActiveForm::end(); ?>
            </div>
        </div>
        <div class="col-1-2 ">
            <div class="preview_window_box">
                <div class="header center">
                    <h3 class="">Окно предпросмотра рекламной страницы</h3>
                </div>
                <div class="wrapper preview_zoom preview_window">
                    <?php
                    \yii\widgets\Pjax::begin([
                        'id'              => 'cat-lend-config',
                        'enablePushState' => false,
                    ]);
                    ?>

                    <?= \frontend\widgets\CatLandGenerator::widget($land_config) ?>

                    <?php
                    \yii\widgets\Pjax::end();
                    ?>
                </div>
            </div>
        </div>
    </div>
</div>
