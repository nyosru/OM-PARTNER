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
            <div style="max-width: 300px; margin: 0 auto;">
<!--                --><?//= $this->render('forms/config');?>
                <?php

                use yii\helpers\Html;
                use yii\widgets\ActiveForm;

                $form = ActiveForm::begin();
                $model = new \common\forms\Cat\CatLandConfigForm();

                echo $form->field($model, 'header_tpl')
                    ->label('Шапка')
                    ->dropdownList([
                        'default' => 'Стандартный',
                        ''        => 'ТЕСТ!',
                    ], ['prompt' => 'Выберите вид'])
                ;

                echo $form->field($model, 'content_tpl')
                    ->label('Контейнер')
                    ->dropdownList([
                        'default' => 'Стандартный',
                        ''        => 'ТЕСТ!',
                    ], ['prompt' => 'Выберите вид'])
                ;

                echo $form->field($model, 'footer_tpl')
                    ->label('Подвал')
                    ->dropdownList([
                        'default' => 'Стандартный',
                        ''        => 'ТЕСТ!',
                    ], ['prompt' => 'Выберите вид'])
                ;
                ?>

                <div class="form-group">
                    <?= Html::button('Предварительный просмотр', ['class' => 'btn btn-primary']) ?>
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
                    <?= \frontend\widgets\CatLandGenerator::widget() ?>
                </div>
            </div>
        </div>
    </div>
</div>
