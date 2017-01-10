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

                $form = ActiveForm::begin(['method' => 'post', 'id' => 'save_land_config', 'action' => 'update-config']);

                echo $form->field($model, 'config_name')
                    ->label('Название конфигурационного файла (без точек и запятых)')
                ;

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

                <br>
                <div class="form-group">
                    <div style="float: left;">
                        <?= Html::submitButton('Сохранить настройку', ['class' => 'btn btn-primary']) ?>
                    </div>
                    <div style="float: right;">
                        <?= Html::input('hidden', 'preview_toggle' , '0') ?>
                        <?= Html::input('hidden', 'c' , Yii::$app->getRequest()->getQueryParam('c')) ?>
                        <?= Html::submitButton("Предпросмотр", ['class' => 'btn btn-primary', 'onClick' => "$(\"[name='preview_toggle']\").val('1')"]) ?>
                        <?= Html::a("Сбросить", [Yii::$app->urlManager->createUrl(['cat/index']), 'c' => Yii::$app->getRequest()->getQueryParam('c')], ['class' => 'btn btn-primary']) ?>
                    </div>
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
                    <?= \frontend\widgets\CatLandGenerator::widget($land_config) ?>
                </div>
            </div>
        </div>
    </div>
</div>
