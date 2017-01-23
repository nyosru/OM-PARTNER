<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;

?>
    <div class="row-e">
        <div class="col-1">
            <?= Html::a('<i class="fa fa-arrow-left" aria-hidden="true"></i> Назад', 'config-list', []) ?>
        </div>
        <div class="col-1-2">
            <div class="header center">
                <h3 class="">Настройки лендинга</h3>
            </div>
            <div style="max-width: 600px; margin: 0 auto;">
                <?php
                $banners_tpl = [
                    [
                        'name'            => 'Главный',
                        'id'              => 'main',
                        'max_count_photo' => 6,
                        'positions'       => [
                            'medium1',
                            'small1',
                            'large',
                            'medium2',
                            'small2',
                            'long',
                        ],
                    ],
                    [

                        'name'            => 'Дисконтный',
                        'id'              => 'discont',
                        'max_count_photo' => 4,
                        'positions'       => [
                            'discont1',
                            'discont2',
                            'discont3',
                            'discont4',
                        ],
                    ],
                ];

                $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data'], 'method' => 'post', 'id' => 'save_land_config', 'action' => 'update-config']);

                echo $form->field($model, 'images_cfg')
                    ->hiddenInput(['id' => 'images_cfg'])
                    ->label(false)
                ;

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
                        ['prompt' => 'Стандартный (определен программой)', 'id' => 'banners_select']
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

                echo '<div class="form-group">';
                echo Html::button('Добавить имеющиеся описания',
                    ['class' => "btn btn-primary btn-md open-modal-images-list", 'data-toggle' => "modal", 'data-target' => "#special_offers"]);
                echo '</div>';

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

    <div id="banner-gallery" class="modal fade">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title">Галерея изображений для баннера</h4>
                </div>
                <div class="modal-body"
                     style="overflow-y: auto; max-height: 600px;flex-wrap: wrap;display: flex;flex-direction: row; justify-content:center;">

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Закрыть</button>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /#banner-gallery modal -->


    <div id="special_offers" class="modal fade">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title">Галерея изображений для баннера</h4>
                </div>
                <div class="modal-body"
                     style="overflow-y: auto; max-height: 600px;flex-wrap: wrap;display: flex;flex-direction: row; justify-content:center;">
                    <?php foreach ($special_offer as $item) : ?>
                        <div class="modal_special_offer" style="border: 1px solid #f0f0f0; margin-top: 10px; padding: 25px; cursor: pointer;">
                            <?=$item?>
                        </div>
                    <?php endforeach; ?>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Закрыть</button>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
<?php

$banners_tpl_json = json_encode($banners_tpl);
$path = Yii::getAlias('@web/images/cat/');
$script = <<<JS
      var banners_tpl_json = $banners_tpl_json;
      function find(arr, key, value) {
        var res = null;
        for (var i = 0; i < arr.length; i++) {
            if (arr[i][key] == value) {
                return res = i;
            }
        }
        return res;
      }
      
      var data_img_exist = false;
      var last_clicked_btn = {};
      $(document).on('click', '.open-modal-images-list', function() {
          last_clicked_btn = this;
          if(data_img_exist) {
              return true;
          }
          $.ajax({
            type: "GET",
            url: "list-uploaded-images",
            dataType: "json",
            success: function (data) {
                data_img_exist = true;
                $('#banner-gallery').find('.modal-body').renderImgInBlock(data);
            }
          });
      });
      
      $.fn.renderImgInBlock = function(data_img) {
        for (var key in data_img) {
            $('<div class="banner-gallery__img"><img src="'+data_img[key]+'" alt="" width="220"></div>').appendTo(this)
        }
      };
      
      $(document).on('click', '.modal_special_offer', function() {
          $(this).renderSpecialOffer();
          $('#special_offers').modal('hide') 
      });
      $.fn.renderSpecialOffer = function() {
        var redactor_editor_field = $('.field-catlandconfigform-special_offer').find('.redactor-editor');
        redactor_editor_field.html($(this.html()));
      };
      $(document).on('click', '.banner-gallery__img', function() {
          var src = $(this).find('img').attr('src');
          var li = $(last_clicked_btn).closest('li');
          li.find('img').attr({'src' : src, 'width': 200});
          $('#banner-gallery').modal('hide') 
      });
      
      function renderImages(positions) {
          $("#banners_tpl_photo_block").imageUpload("upload-one-cat-photo", {
              uploadButtonText: "Загрузить новые",
              previewImageSize: 200,
              positions: positions,
              uploadStatusBarClass: '.progress-bar',
              img_tpl: '\
                    <div class="row-e img-dropBox-container">\
                        <div class="col-1 input_field">\
                            <input type="file" name="file" class="file-field"/>\
                            <button type="button" class="btn btn-primary btn-md open-modal-images-list" data-toggle="modal" data-target="#banner-gallery">\
                                    Выбрать из уже загруженых\
                                  </button>\
                        </div>\
                        <div class="col-4-10 u_img_block"><img/></div>\
                            <div class="col-6-10 u_img_about">\
                                <label for="img_description">Описание</label>\
                                <input class="form-control" type="text" name="img_description">\
                                <label for="img_url">Ссылка при клике на картинку</label>\
                                <input class="form-control" type="text" name="img_url">\
                            </div>\
                            <div class="clearfix"/>\
                            <div class="col-4-10 progress" style="background:#EDECEC">\
                                <div class="progress-bar progress-bar-striped active" role="progressbar"\
                                    aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width:0%">\
                                </div>\
                            </div>\
                    </div>\
              ',
              success: function (data) {
                  

                  var images_cfg = $("#images_cfg");
                  images_cfg.val('');

                  var data_img = [];
                  for(var img_data_key in data) {
                              var li = $("[position='"+data[img_data_key][0]+"']");
                              var desc = li.find("[name='img_description']").val();
                              var url = li.find("[name='img_url']").val();
                              var img_pos = data[img_data_key][0];
                              var img_name = data[img_data_key][1];
                              var img_obj = new Object({
                                  'position' : img_pos, 
                                  'img' : img_name, 
                                  'desc': desc, 
                                  'url': url
                              });
                              data_img.push(img_obj);
                  }
                  images_cfg.val(JSON.stringify(data_img));
              }
          });
      }
          
      var i = find(banners_tpl_json, 'id', $('#banners_select').val());
      if(i != null) {
          renderImages(banners_tpl_json[i]['positions']);
          var data_img = JSON.parse($('#images_cfg').val());
           for(i = 0; i < data_img.length; i++) {
               $('#img-list').find('li').each(function (i_block){
                   if(i_block == i) {
                       $(this).find("[name='img_description']").val(data_img[i]['desc']);
                       $(this).find("[name='img_url']").val(data_img[i]['url']);
                       var img = $(this).find("img").attr({'src': '/images/cat/' + data_img[i]['img'], 'width': 200});
                   }
               });
           }
      } 
      
      $('#banners_select').on('change', function () {
          var i = find(banners_tpl_json, 'id', $(this).val());
          if(i != null) {
              renderImages(banners_tpl_json[i]['positions']);
          } else {
              renderImages(0);
          }
      });
    
	
JS;

$this->registerJs($script, yii\web\View::POS_READY);

?>