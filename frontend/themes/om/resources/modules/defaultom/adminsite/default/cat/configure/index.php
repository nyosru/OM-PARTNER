<div class="row-e">
    <div class="col-1-2">
        <div class="header center">
            <h3 class="">Настройки лендинга</h3>
        </div>
        <div style="max-width: 600px; margin: 0 auto;">
            <?php

            use yii\helpers\Html;
            use yii\widgets\ActiveForm;

            $banners_tpl = [
                [
                    'name'            => 'Главный',
                    'id'              => 'main',
                    'max_count_photo' => 6,
                ],
                [

                    'name'            => 'Дисконтный',
                    'id'              => 'discont',
                    'max_count_photo' => 4,
                ],
            ];

            $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data'], 'method' => 'post', 'id' => 'save_land_config', 'action' => 'update-config']);


            echo $form->field($model, 'config_name')
                ->label('Название конфигурационного файла (без точек и запятых)')
            ;

            echo $form->field($model, 'header_tpl')
                ->label('Шапка')
                ->dropdownList([
                    'default' => 'Стандартный',
                ], ['prompt' => 'Выберите вид'])
            ;

            $banners_tpl_for_dropdown = [];
            foreach ($banners_tpl as $key => $item) {
                $banners_tpl_for_dropdown[$item['id']] = $item['name'];
            }
            echo $form->field($model, 'banners_tpl')
                ->label('Баннер')
                ->dropdownList(
                    $banners_tpl_for_dropdown,
                    ['prompt' => 'Выберите тип баннера', 'id' => 'banners_select']
                )
            ;

            ?>

            <div id="banners_tpl_photo_block" class="photo_block"></div>

            <?php

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
                ->label('Отобранные товары для контейнера (через запятую "," введите id товаров)')
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
                    <?= Html::input('hidden', 'preview_toggle', '0') ?>
                    <?= Html::input('hidden', 'c', Yii::$app->getRequest()->getQueryParam('c')) ?>
                    <?= Html::submitButton("Предпросмотр",
                        ['class' => 'btn btn-primary', 'onClick' => "$(\"[name='preview_toggle']\").val('1')"]) ?>
                    <?= Html::a("Сбросить",
                        [Yii::$app->urlManager->createUrl(['adminsite/configure']), 'c' => Yii::$app->getRequest()
                            ->getQueryParam('c')], ['class' => 'btn btn-primary']) ?>
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


<?php

$banners_tpl_json = json_encode($banners_tpl);
$script = <<<JS

      var banners_tpl_json = $banners_tpl_json;
      console.log(banners_tpl_json);
      function find(arr, key, value) {
        var res = null;
        for (var i = 0; i < arr.length; i++) {
            if (arr[i][key] == value) {
                return res = i;
            }
        }
        return res;
      }

      function renderImages(count) {
          $("#banners_tpl_photo_block").imageUpload("upload-one-cat-photo", {
              uploadButtonText: "Загрузить",
              previewImageSize: 200,
              maxImageCount: count,
              img_tpl: '\
                    <div class="row-e img-dropBox-container">\
                        <div class="col-1 input_field">\
                            <input type="file" name="file" class="file-field"/>\
                        </div>\
                        <div class="col-4-10 u_img_block"><img/></div>\
                            <div class="col-6-10 u_img_about">\
                                <label for="img_description">Описание</label>\
                                <input class="form-control" type="text" name="img_description">\
                                <label for="img_url">Ссылка при клике на картинку</label>\
                                <input class="form-control" type="text" name="img_url">\
                            </div>\
                    </div>\
              ',
              onSuccess: function (response) {
                  var images_cfg = $("<input type='hidden' name='images_cfg'/>");
                  $('.u_img_about').each(function (i_block){
                      var desc = $(this).children("[name='img_description']").val();
                      var url = $(this).children("[name='img_url']").val();
                      
                  });
              }
          });
      }
    
      $('#banners_select').on('change', function () {
          var i = find(banners_tpl_json, 'id', $(this).val());
          if(i != null) {
              var img_count = banners_tpl_json[i]['max_count_photo'];
              renderImages(img_count);
          } else {
              renderImages(0);
          }
      });

    
	
JS;

$this->registerJs($script, yii\web\View::POS_READY);

?>