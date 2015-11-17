<?php

/* @var $this yii\web\View */
?>
<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\bootstrap\Tabs;
use yii\bootstrap\Carousel;
use yii\bootstrap\Alert;
use yii\helpers\BaseHtml;
use dosamigos\ckeditor\CKEditor;
$this->title = 'Админка';

?>

            <?php
            $form = ActiveForm::begin(['id' => 'partners-settings', 'action'=>'/admin/default/savesettings']);
            $path = Yii::getAlias('@app') . '/themes/';
            $templatedir = opendir($path);
            $count = 0;
            $file = readdir($templatedir);
            while ($file = readdir($templatedir)) {
                if (is_dir($path . $file) && $file !== '.' && file_exists($path . $file . '/template.xml')) {
                    $xmlinfo = simplexml_load_file($path . $file . '/template.xml');
                    $identifycate = (string)$xmlinfo->identifycate;
                    $output[$identifycate] = '<div class="template-case">';
                    $output[$identifycate] .= '<div class="template-name">' . $xmlinfo->name.'<br/>';
                    $output[$identifycate] .= $xmlinfo->autor . '</div>';
                    if (isset($xmlinfo->images->image) && count($xmlinfo->images->image) > 0) {
                        $images = [];
                        $i = 0;
                        foreach ($xmlinfo->images->image as $value) {
                            $images['items'][$i]['content'] = '<img src="/admin/default/templateimage?template=' . (string)$file . '&src=' . (string)$value->file . '"></img>';
                            $images['items'][$i]['caption'] = '<div>'.(string)$value->name.'</div>';
                            $images['items'][$i]['options'] = ['style' => 'color:black;'];
                            $i++;
                        }
                        $images['options'] = ['style' => 'color:black;', 'class' => 'template-carousel'];
                        $images['showIndicators'] = false;
                        $output[$identifycate] .= Carousel::widget($images);
                    }
                    $output[$identifycate] .= '</div>';
                    $count++;
                }
            }
            $l1 = '<div style="margin: 10px; height: 100%;">';
            $l1 .= $form->field($model, 'template')->label('Шаблон')->radioList($output);
            $l1 .= '<div class="col-md-12">';

            $l1 .= $form->field($model, 'logotype[value]')->label('Логотип', ['data-toggle' => 'tooltip', 'data-placement' => 'left', 'title' => 'xtuj yb,eln'])->input('text')->widget(CKEditor::className(), [
                'options' => ['rows' => 1],
                'preset' => 'logo',
            ]);
            $l1 .= $form->field($model, 'logotype[active]', ['options' => ['style' => 'top: -10px; right: 10px; position: absolute;']])->checkbox()->label('');
            $l1 .= '</div>';
            $l1 .= '<div class="col-md-12">';

            $l1 .= $form->field($model, 'slogan[value]')->label('Слоган')->input('text')->widget(CKEditor::className(), [
                'options' => ['rows' => 1],
                'preset' => 'logo',
            ]);
            $l1 .= $form->field($model, 'slogan[active]', ['options' => ['style' => 'top: -10px; right: 10px; position: absolute;']])->checkbox()->label('');
            $l1 .= '</div>';
            $l1 .= '<div class="col-md-12">';
            $l1 .= $form->field($model, 'newsonindex[value]')->label('Новости на главной (Укажите количество)')->input('text');
            $l1 .= $form->field($model, 'newsonindex[active]', ['options' => ['style' => 'top: -10px; right: 10px; position: absolute;']])->checkbox()->label('');
            $l1 .= '</div>';
            $l1 .= '<div class="col-md-12">';
            $l1 .= $form->field($model, 'commentsonindex[value]')->label('Комментарии на главной (Укажите количество)')->input('text');
            $l1 .= $form->field($model, 'commentsonindex[active]', ['options' => ['style' => 'top: -10px; right: 10px; position: absolute;']])->checkbox()->label('');
            $l1 .= '</div>';
            $l1 .= '</div>';
            $l2  = '<div style="margin: 10px; height: 100%;">';
            $l2 .= '<div class="col-md-3">';
            $l2 .= $form->field($model, 'mailcounter[value]')->label('Mail (id счетчика)');
            $l2 .= $form->field($model, 'mailcounter[active]', ['options'=>['style' => 'top: -10px; right: 10px; position: absolute;']])->checkbox()->label('');
            $l2 .= '</div>';
            $l2 .= '<div class="col-md-3">';
            $l2 .= $form->field($model, 'yandexcounter[value]')->label('Yandex (id счетчика)');
            $l2 .= $form->field($model, 'yandexcounter[active]',['options'=>['style' => 'top: -10px; right: 10px; position: absolute;']])->checkbox()->label('');
            $l2  .= '</div>';
            $l2  .= '</div>';
            $l3  = '<div style="margin: 10px; height: 100%;">';
            $l3 .= '<div class="col-md-6">';
            $l3 .= $form->field($model, 'discount[value]')->label('Наценка(в % на все товары магазина)');
            $l3 .= $form->field($model, 'discount[active]', ['options'=>['style' => 'top: -10px; right: 10px; position: absolute;']])->checkbox()->label('');
            $l3  .= '</div>';
            $l3 .= '<div class="col-md-6">';
            $l3 .= $form->field($model, 'minimalordertotalprice[value]')->label('Минимальная сумма заказа, Руб.');
            $l3 .= $form->field($model, 'minimalordertotalprice[active]', ['options'=>['style' => 'top: -10px; right: 10px; position: absolute;']])->checkbox()->label('');
            $l3  .= '</div>';
            $l3 .= '<div class="col-md-12">';
            $l3 .= '<label class="control-label">Скидка по сумме заказа</label>';

            $l3_1 = '<div class="col-md-12">';
            $l3_1 .= $form->field($model, 'discounttotalorderprice[value][0][active]', ['options' => ['style' => 'position: absolute;  top: 20px; z-index: 99;']])->checkbox()->label('');
            $l3_1 .= $form->field($model, 'discounttotalorderprice[value][0][value]', ['options' => ['class' => 'col-md-2']])->label('Скидка, %');
            $l3_1 .= $form->field($model, 'discounttotalorderprice[value][0][in]', ['options' => ['class' => 'col-md-5']])->label('От, Руб.');
            $l3_1 .= $form->field($model, 'discounttotalorderprice[value][0][out]', ['options' => ['class' => 'col-md-5']])->label('До, Руб.');
            $l3_1 .= '</div>';
            $u = 1;
            for ($i = 1; $i <= count($model->discounttotalorderprice['value']); $i++) {
                if ((isset($model->discounttotalorderprice['value'][$i]['value']) && $model->discounttotalorderprice['value'][$i]['value'] !== '') || $i = count($model->discounttotalorderprice['value'])) {
                    $l3_1 .= '<div class="col-md-12">';
                    $l3_1 .= $form->field($model, 'discounttotalorderprice[value][' . ($u) . '][active]', ['options' => ['style' => 'position: absolute;  z-index: 99;']])->checkbox()->label('');
                    $l3_1 .= $form->field($model, 'discounttotalorderprice[value][' . ($u) . '][value]', ['options' => ['class' => 'col-md-2', 'style' => 'margin:0px']])->label('', ['style' => 'display:block']);
                    $l3_1 .= $form->field($model, 'discounttotalorderprice[value][' . ($u) . '][in]', ['options' => ['class' => 'col-md-5', 'style' => 'margin:0px']])->label('', ['style' => 'display:block']);
                    $l3_1 .= $form->field($model, 'discounttotalorderprice[value][' . ($u) . '][out]', ['options' => ['class' => 'col-md-5', 'style' => 'margin:0px']])->label('', ['style' => 'display:block']);
                    $l3_1 .= '</div>';
                    $u++;
                }
            }

            $l3 .= $l3_1;
            //  $l3 .= $form->field($model, 'discounttotalorderprice[value]', ['options'=>['style' => 'top: -10px; right: 10px; position: absolute;']])->checkbox()->label('');
            $l3 .= $form->field($model, 'discounttotalorderprice[active]', ['options' => ['style' => 'top: -10px; right: 10px; position: absolute;']])->checkbox()->label('');
            $l3 .= '</div>';
            $l3 .= '</div>';
            $l4  = '<div style="margin: 10px; height: 100%;">';
            $l4 .= '<div class="col-md-12" style="background: rgb(230, 228, 228) none repeat scroll 0% 0%; border-radius: 5px; padding: 10px 0px; margin: 10px 0px;">';
            $l4 .= '<div class="col-md-3">';
            $l4 .= $form->field($model, 'contacts[adress][value]')->label('Адрес<br/><br/>')->textInput(['value'=> $contacts['adress']['value']]);
            $l4 .= $form->field($model, 'contacts[adress][active]', ['options'=>['style' => 'top: -10px; right: 10px; position: absolute;']])->checkbox()->label('');
            $l4 .= '</div>';
            $l4 .= '<div class="col-md-3">';
            $l4 .= $form->field($model, 'contacts[telephone][value]', ['options'=>['class' => '']])->label('Телефон (Можно указать несколько через запятую)');
            $l4 .= $form->field($model, 'contacts[telephone][active]', ['options'=>['style' => 'top: -10px; right: 10px; position: absolute;']])->checkbox()->label('');
            $l4 .= '</div>';
            $l4 .= '<div class="col-md-3">';
            $l4 .= $form->field($model, 'contacts[fax][value]', ['options'=>['class' => '']])->label('Факс (Можно указать несколько через запятую)');
            $l4 .= $form->field($model, 'contacts[fax][active]', ['options'=>['style' => 'top: -10px; right: 10px; position: absolute;']])->checkbox()->label('');
            $l4 .= '</div>';
            $l4 .= '<div class="col-md-3">';
            $l4 .= $form->field($model, 'contacts[email][value]', ['options'=>['class' => '']])->label('E-mail (Можно указать несколько через запятую)');
            $l4 .= $form->field($model, 'contacts[email][active]', ['options'=>['style' => 'top: -10px; right: 10px; position: absolute;']])->checkbox()->label('');
            $l4 .= '</div>';
            $l4 .= '</div>';
            $l4 .= '<div class="col-md-12" style="background: rgb(230, 228, 228) none repeat scroll 0% 0%;font-size:12px; border-radius: 5px; padding: 10px 0px; margin: 10px 0px;">';
            $l4 .= $form->field($model, 'contacts[graf_work][activated]', ['options'=>['style' => 'margin: 0px 15px;']])->checkbox()->label('График работы (не активно)');
            $l4 .= '<div class="col-md-2 graf-day">';
            $hours = [0,1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23,24];
            $minuts = [00,10,20,30,40,50];
            $l4 .= $form->field($model, 'contacts[graf_work][mon][active]', ['options'=>['class' => '']])->checkbox()->label('Понедельник');
            $l4 .= $form->field($model, 'contacts[graf_work][mon][w][in]', ['options'=>['class' => 'col-md-3 prop', 'style' => 'padding-right: 5px; padding-left: 5px;']])->dropDownList($hours, ['prompt'=>'Ч'])->label('C');
            $l4 .= $form->field($model, 'contacts[graf_work][mon][wm][in]', ['options'=>['class' => 'col-md-3 prop', 'style' => 'padding-right: 5px; padding-left: 5px;']])->dropDownList($minuts, ['prompt'=>'М'])->label('_');
            $l4 .= $form->field($model, 'contacts[graf_work][mon][w][out]', ['options'=>['class' => 'col-md-3 prop', 'style' => 'padding-right: 5px; padding-left: 5px;']])->dropDownList($hours, ['prompt'=>'Ч'])->label('До');
            $l4 .= $form->field($model, 'contacts[graf_work][mon][wm][out]', ['options'=>['class' => 'col-md-3 prop', 'style' => 'padding-right: 5px; padding-left: 5px;']])->dropDownList($minuts, ['prompt'=>'М'])->label('_');
            $l4 .= $form->field($model, 'contacts[graf_work][mon][o][active]',['options'=>['class' => 'col-md-12']])->checkbox()->label('Обед');
            $l4 .= $form->field($model, 'contacts[graf_work][mon][o][in]', ['options'=>['class' => 'col-md-3 prop', 'style' => 'padding-right: 5px; padding-left: 5px;']])->dropDownList($hours, ['prompt'=>'Ч'])->label('C');
            $l4 .= $form->field($model, 'contacts[graf_work][mon][om][in]', ['options'=>['class' => 'col-md-3 prop', 'style' => 'padding-right: 5px; padding-left: 5px;']])->dropDownList($minuts, ['prompt'=>'М'])->label('_');
            $l4 .= $form->field($model, 'contacts[graf_work][mon][o][out]', ['options'=>['class' => 'col-md-3 prop', 'style' => 'padding-right: 5px; padding-left: 5px;']])->dropDownList($hours, ['prompt'=>'Ч'])->label('До');
            $l4 .= $form->field($model, 'contacts[graf_work][mon][om][out]', ['options'=>['class' => 'col-md-3 prop', 'style' => 'padding-right: 5px; padding-left: 5px;']])->dropDownList($minuts, ['prompt'=>'М'])->label('_');
            $l4 .= '</div>';
            $l4 .= '<div class="col-md-2 graf-day">';
            $l4 .= $form->field($model, 'contacts[graf_work][tue][active]', ['options'=>['class' => '']])->checkbox()->label('Вторник');
            $l4 .= $form->field($model, 'contacts[graf_work][tue][w][in]', ['options'=>['class' => 'col-md-3 prop', 'style' => 'padding-right: 5px; padding-left: 5px;']])->dropDownList($hours, ['prompt'=>'Ч'])->label('C');
            $l4 .= $form->field($model, 'contacts[graf_work][tue][wm][in]', ['options'=>['class' => 'col-md-3 prop', 'style' => 'padding-right: 5px; padding-left: 5px;']])->dropDownList($minuts, ['prompt'=>'М'])->label('_');
            $l4 .= $form->field($model, 'contacts[graf_work][tue][w][out]', ['options'=>['class' => 'col-md-3 prop', 'style' => 'padding-right: 5px; padding-left: 5px;']])->dropDownList($hours, ['prompt'=>'Ч'])->label('До');
            $l4 .= $form->field($model, 'contacts[graf_work][tue][wm][out]', ['options'=>['class' => 'col-md-3 prop', 'style' => 'padding-right: 5px; padding-left: 5px;']])->dropDownList($minuts, ['prompt'=>'М'])->label('_');
            $l4 .= $form->field($model, 'contacts[graf_work][tue][o][active]',['options'=>['class' => 'col-md-12']])->checkbox()->label('Обед');
            $l4 .= $form->field($model, 'contacts[graf_work][tue][o][in]', ['options'=>['class' => 'col-md-3 prop', 'style' => 'padding-right: 5px; padding-left: 5px;']])->dropDownList($hours, ['prompt'=>'Ч'])->label('C');
            $l4 .= $form->field($model, 'contacts[graf_work][tue][om][in]', ['options'=>['class' => 'col-md-3 prop', 'style' => 'padding-right: 5px; padding-left: 5px;']])->dropDownList($minuts, ['prompt'=>'М'])->label('_');
            $l4 .= $form->field($model, 'contacts[graf_work][tue][o][out]', ['options'=>['class' => 'col-md-3 prop', 'style' => 'padding-right: 5px; padding-left: 5px;']])->dropDownList($hours, ['prompt'=>'Ч'])->label('До');
            $l4 .= $form->field($model, 'contacts[graf_work][tue][om][out]', ['options'=>['class' => 'col-md-3 prop', 'style' => 'padding-right: 5px; padding-left: 5px;']])->dropDownList($minuts, ['prompt'=>'М'])->label('_');
            $l4 .= '</div>';
            $l4 .= '<div class="col-md-2 graf-day">';
            $l4 .= $form->field($model, 'contacts[graf_work][wed][active]', ['options'=>['class' => '']])->checkbox()->label('Среда');
            $l4 .= $form->field($model, 'contacts[graf_work][wed][w][in]', ['options'=>['class' => 'col-md-3 prop', 'style' => 'padding-right: 5px; padding-left: 5px;']])->dropDownList($hours, ['prompt'=>'Ч'])->label('C');
            $l4 .= $form->field($model, 'contacts[graf_work][wed][wm][in]', ['options'=>['class' => 'col-md-3 prop', 'style' => 'padding-right: 5px; padding-left: 5px;']])->dropDownList($minuts, ['prompt'=>'М'])->label('_');
            $l4 .= $form->field($model, 'contacts[graf_work][wed][w][out]', ['options'=>['class' => 'col-md-3 prop', 'style' => 'padding-right: 5px; padding-left: 5px;']])->dropDownList($hours, ['prompt'=>'Ч'])->label('До');
            $l4 .= $form->field($model, 'contacts[graf_work][wed][wm][out]', ['options'=>['class' => 'col-md-3 prop', 'style' => 'padding-right: 5px; padding-left: 5px;']])->dropDownList($minuts, ['prompt'=>'М'])->label('_');
            $l4 .= $form->field($model, 'contacts[graf_work][wed][o][active]',['options'=>['class' => 'col-md-12']])->checkbox()->label('Обед');
            $l4 .= $form->field($model, 'contacts[graf_work][wed][o][in]', ['options'=>['class' => 'col-md-3 prop', 'style' => 'padding-right: 5px; padding-left: 5px;']])->dropDownList($hours, ['prompt'=>'Ч'])->label('C');
            $l4 .= $form->field($model, 'contacts[graf_work][wed][om][in]', ['options'=>['class' => 'col-md-3 prop', 'style' => 'padding-right: 5px; padding-left: 5px;']])->dropDownList($minuts, ['prompt'=>'М'])->label('_');
            $l4 .= $form->field($model, 'contacts[graf_work][wed][o][out]', ['options'=>['class' => 'col-md-3 prop', 'style' => 'padding-right: 5px; padding-left: 5px;']])->dropDownList($hours, ['prompt'=>'Ч'])->label('До');
            $l4 .= $form->field($model, 'contacts[graf_work][wed][om][out]', ['options'=>['class' => 'col-md-3 prop', 'style' => 'padding-right: 5px; padding-left: 5px;']])->dropDownList($minuts, ['prompt'=>'М'])->label('_');
            $l4 .= '</div>';
            $l4 .= '<div class="col-md-2 graf-day">';
            $l4 .= $form->field($model, 'contacts[graf_work][thu][active]', ['options'=>['class' => '']])->checkbox()->label('Четверг');
            $l4 .= $form->field($model, 'contacts[graf_work][thu][w][in]', ['options'=>['class' => 'col-md-3 prop', 'style' => 'padding-right: 5px; padding-left: 5px;']])->dropDownList($hours, ['prompt'=>'Ч'])->label('C');
            $l4 .= $form->field($model, 'contacts[graf_work][thu][wm][in]', ['options'=>['class' => 'col-md-3 prop', 'style' => 'padding-right: 5px; padding-left: 5px;']])->dropDownList($minuts, ['prompt'=>'М'])->label('_');
            $l4 .= $form->field($model, 'contacts[graf_work][thu][w][out]', ['options'=>['class' => 'col-md-3 prop', 'style' => 'padding-right: 5px; padding-left: 5px;']])->dropDownList($hours, ['prompt'=>'Ч'])->label('До');
            $l4 .= $form->field($model, 'contacts[graf_work][thu][wm][out]', ['options'=>['class' => 'col-md-3 prop', 'style' => 'padding-right: 5px; padding-left: 5px;']])->dropDownList($minuts, ['prompt'=>'М'])->label('_');
            $l4 .= $form->field($model, 'contacts[graf_work][thu][o][active]',['options'=>['class' => 'col-md-12']])->checkbox()->label('Обед');
            $l4 .= $form->field($model, 'contacts[graf_work][thu][o][in]', ['options'=>['class' => 'col-md-3 prop', 'style' => 'padding-right: 5px; padding-left: 5px;']])->dropDownList($hours, ['prompt'=>'Ч'])->label('C');
            $l4 .= $form->field($model, 'contacts[graf_work][thu][om][in]', ['options'=>['class' => 'col-md-3 prop', 'style' => 'padding-right: 5px; padding-left: 5px;']])->dropDownList($minuts, ['prompt'=>'М'])->label('_');
            $l4 .= $form->field($model, 'contacts[graf_work][thu][o][out]', ['options'=>['class' => 'col-md-3 prop', 'style' => 'padding-right: 5px; padding-left: 5px;']])->dropDownList($hours, ['prompt'=>'Ч'])->label('До');
            $l4 .= $form->field($model, 'contacts[graf_work][thu][om][out]', ['options'=>['class' => 'col-md-3 prop', 'style' => 'padding-right: 5px; padding-left: 5px;']])->dropDownList($minuts, ['prompt'=>'М'])->label('_');
            $l4 .= '</div>';
            $l4 .= '<div class="col-md-2 graf-day">';
            $l4 .= $form->field($model, 'contacts[graf_work][fri][active]', ['options'=>['class' => '']])->checkbox()->label('Пятница');
            $l4 .= $form->field($model, 'contacts[graf_work][fri][w][in]', ['options'=>['class' => 'col-md-3 prop', 'style' => 'padding-right: 5px; padding-left: 5px;']])->dropDownList($hours, ['prompt'=>'Ч'])->label('C');
            $l4 .= $form->field($model, 'contacts[graf_work][fri][wm][in]', ['options'=>['class' => 'col-md-3 prop', 'style' => 'padding-right: 5px; padding-left: 5px;']])->dropDownList($minuts, ['prompt'=>'М'])->label('_');
            $l4 .= $form->field($model, 'contacts[graf_work][fri][w][out]', ['options'=>['class' => 'col-md-3 prop', 'style' => 'padding-right: 5px; padding-left: 5px;']])->dropDownList($hours, ['prompt'=>'Ч'])->label('До');
            $l4 .= $form->field($model, 'contacts[graf_work][fri][wm][out]', ['options'=>['class' => 'col-md-3 prop', 'style' => 'padding-right: 5px; padding-left: 5px;']])->dropDownList($minuts, ['prompt'=>'М'])->label('_');
            $l4 .= $form->field($model, 'contacts[graf_work][fri][o][active]',['options'=>['class' => 'col-md-12']])->checkbox()->label('Обед');
            $l4 .= $form->field($model, 'contacts[graf_work][fri][o][in]', ['options'=>['class' => 'col-md-3 prop', 'style' => 'padding-right: 5px; padding-left: 5px;']])->dropDownList($hours, ['prompt'=>'Ч'])->label('C');
            $l4 .= $form->field($model, 'contacts[graf_work][fri][om][in]', ['options'=>['class' => 'col-md-3 prop', 'style' => 'padding-right: 5px; padding-left: 5px;']])->dropDownList($minuts, ['prompt'=>'М'])->label('_');
            $l4 .= $form->field($model, 'contacts[graf_work][fri][o][out]', ['options'=>['class' => 'col-md-3 prop', 'style' => 'padding-right: 5px; padding-left: 5px;']])->dropDownList($hours, ['prompt'=>'Ч'])->label('До');
            $l4 .= $form->field($model, 'contacts[graf_work][fri][om][out]', ['options'=>['class' => 'col-md-3 prop', 'style' => 'padding-right: 5px; padding-left: 5px;']])->dropDownList($minuts, ['prompt'=>'М'])->label('_');
            $l4 .= '</div>';
            $l4 .= '<div class="col-md-2 graf-day">';
            $l4 .= $form->field($model, 'contacts[graf_work][sat][active]', ['options'=>['class' => '']])->checkbox()->label('Суббота');
            $l4 .= $form->field($model, 'contacts[graf_work][sat][w][in]', ['options'=>['class' => 'col-md-3 prop', 'style' => 'padding-right: 5px; padding-left: 5px;']])->dropDownList($hours, ['prompt'=>'Ч'])->label('C');
            $l4 .= $form->field($model, 'contacts[graf_work][sat][wm][in]', ['options'=>['class' => 'col-md-3 prop', 'style' => 'padding-right: 5px; padding-left: 5px;']])->dropDownList($minuts, ['prompt'=>'М'])->label('_');
            $l4 .= $form->field($model, 'contacts[graf_work][sat][w][out]', ['options'=>['class' => 'col-md-3 prop', 'style' => 'padding-right: 5px; padding-left: 5px;']])->dropDownList($hours, ['prompt'=>'Ч'])->label('До');
            $l4 .= $form->field($model, 'contacts[graf_work][sat][wm][out]', ['options'=>['class' => 'col-md-3 prop', 'style' => 'padding-right: 5px; padding-left: 5px;']])->dropDownList($minuts, ['prompt'=>'М'])->label('_');
            $l4 .= $form->field($model, 'contacts[graf_work][sat][o][active]',['options'=>['class' => 'col-md-12']])->checkbox()->label('Обед');
            $l4 .= $form->field($model, 'contacts[graf_work][sat][o][in]', ['options'=>['class' => 'col-md-3 prop', 'style' => 'padding-right: 5px; padding-left: 5px;']])->dropDownList($hours, ['prompt'=>'Ч'])->label('C');
            $l4 .= $form->field($model, 'contacts[graf_work][sat][om][in]', ['options'=>['class' => 'col-md-3 prop', 'style' => 'padding-right: 5px; padding-left: 5px;']])->dropDownList($minuts, ['prompt'=>'М'])->label('_');
            $l4 .= $form->field($model, 'contacts[graf_work][sat][o][out]', ['options'=>['class' => 'col-md-3 prop', 'style' => 'padding-right: 5px; padding-left: 5px;']])->dropDownList($hours, ['prompt'=>'Ч'])->label('До');
            $l4 .= $form->field($model, 'contacts[graf_work][sat][om][out]', ['options'=>['class' => 'col-md-3 prop', 'style' => 'padding-right: 5px; padding-left: 5px;']])->dropDownList($minuts, ['prompt'=>'М'])->label('_');
            $l4 .= '</div>';
            $l4 .= '<div class="col-md-2 graf-day">';
            $l4 .= $form->field($model, 'contacts[graf_work][sun][active]', ['options'=>['class' => '']])->checkbox()->label('Воскресение');
            $l4 .= $form->field($model, 'contacts[graf_work][sun][w][in]', ['options'=>['class' => 'col-md-3 prop', 'style' => 'padding-right: 5px; padding-left: 5px;']])->dropDownList($hours, ['prompt'=>'Ч'])->label('C');
            $l4 .= $form->field($model, 'contacts[graf_work][sun][wm][in]', ['options'=>['class' => 'col-md-3 prop', 'style' => 'padding-right: 5px; padding-left: 5px;']])->dropDownList($minuts, ['prompt'=>'М'])->label('_');
            $l4 .= $form->field($model, 'contacts[graf_work][sun][w][out]', ['options'=>['class' => 'col-md-3 prop', 'style' => 'padding-right: 5px; padding-left: 5px;']])->dropDownList($hours, ['prompt'=>'Ч'])->label('До');
            $l4 .= $form->field($model, 'contacts[graf_work][sun][wm][out]', ['options'=>['class' => 'col-md-3 prop', 'style' => 'padding-right: 5px; padding-left: 5px;']])->dropDownList($minuts, ['prompt'=>'М'])->label('_');
            $l4 .= $form->field($model, 'contacts[graf_work][sun][o][active]',['options'=>['class' => 'col-md-12']])->checkbox()->label('Обед');
            $l4 .= $form->field($model, 'contacts[graf_work][sun][o][in]', ['options'=>['class' => 'col-md-3 prop', 'style' => 'padding-right: 5px; padding-left: 5px;']])->dropDownList($hours, ['prompt'=>'Ч'])->label('C');
            $l4 .= $form->field($model, 'contacts[graf_work][sun][om][in]', ['options'=>['class' => 'col-md-3 prop', 'style' => 'padding-right: 5px; padding-left: 5px;']])->dropDownList($minuts, ['prompt'=>'М'])->label('_');
            $l4 .= $form->field($model, 'contacts[graf_work][sun][o][out]', ['options'=>['class' => 'col-md-3 prop', 'style' => 'padding-right: 5px; padding-left: 5px;']])->dropDownList($hours, ['prompt'=>'Ч'])->label('До');
            $l4 .= $form->field($model, 'contacts[graf_work][sun][om][out]', ['options'=>['class' => 'col-md-3 prop', 'style' => 'padding-right: 5px; padding-left: 5px;']])->dropDownList($minuts, ['prompt'=>'М'])->label('_');
            $l4 .= '</div>';
            $l4 .= '</div>';

            $l4 .= '<div class="col-md-12" style="background: rgb(230, 228, 228) none repeat scroll 0% 0%; border-radius: 5px; padding: 10px 0px; margin: 10px 0px;">';
            $l4 .= '<div class="col-md-12">';
            $l4 .= $form->field($model, 'yandexmap[value]')->label('Yandex карта(SID)', ['options'=>['class' => 'col-md-3']]);
            $l4 .= $form->field($model, 'yandexmap[active]', ['options'=>['style' => 'top: -10px; right: 10px; position: absolute;']])->checkbox()->label('');
            $l4 .= '</div>';
            $l4 .= '<div class="col-md-12">';
            $l4 .= $form->field($model, 'googlemap[value]')->label('Google карта(MID)', ['options'=>['class' => 'col-md-3']]);
            $l4 .= $form->field($model, 'googlemap[active]', ['options'=>['style' => 'top: -10px; right: 10px; position: absolute;']])->checkbox()->label('');
            $l4  .= '</div>';
            $l4  .= '</div>';
            $l4  .= '</div>';


            ?>
            <? echo Tabs::widget([
                'items' => [
                    [
                        'label' => 'Общие',
                        'content' => $l1,
                        'active' => true
                    ],
                    [
                        'label' => 'Счетчики',
                        'content' => $l2,

                    ],
                    [
                        'label' => 'Ценовая политика',
                        'content' => $l3,

                    ],
                    [
                        'label' => 'Контакты',
                        'content' => $l4,

                    ],
                ]]); ?>

            <div class="form-group col-md-12">
                <?= Html::submitButton('Сохранить', ['class' => 'btn btn-primary', 'name' => 'partners-settings-button']) ?>
            </div>
            <?php ActiveForm::end(); ?>

