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
//echo '<pre>';
//print_r($model);
//echo '</pre>';
$form = ActiveForm::begin(['id' => 'partners-settings', 'action' => '/admin/default/savesettings']);
$path = Yii::getAlias('@app') . '/themes/';
$templatedir = opendir($path);
$count = 0;
$file = readdir($templatedir);
while ($file = readdir($templatedir)) {
    if (is_dir($path . $file) && $file !== '.' && file_exists($path . $file . '/template.xml')) {
        $xmlinfo = simplexml_load_file($path . $file . '/template.xml');
        $identifycate = (string)$xmlinfo->identifycate;
        $output[$identifycate] = '<div class="template-case">';
        $output[$identifycate] .= '<div class="template-name">' . $xmlinfo->name . '<br/>';
        $output[$identifycate] .= $xmlinfo->autor . '</div>';
        if (isset($xmlinfo->images->image) && count($xmlinfo->images->image) > 0) {
            $images = [];
            $i = 0;
            foreach ($xmlinfo->images->image as $value) {
                $images['items'][$i]['content'] = '<img src="/admin/default/templateimage?template=' . (string)$file . '&src=' . (string)$value->file . '"></img>';
                $images['items'][$i]['caption'] = '<div>' . (string)$value->name . '</div>';
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
//--------------------------------------------------------------------------------------------------------------------//
//                                                    Вкладка 1. Общие                                                //
//                                                                                                                    //
//--------------------------------------------------------------------------------------------------------------------//

$l1 = '<div style="height: 100%;">';
$l1 .= '<div class="box" style="background: snow">';
$l1 .= '<div class="box-body">';
$l1 .= $form->field($model, 'template', ['options' => ['class' => ''], 'labelOptions' => ['class' => 'box-header with-border']])->label('Шаблон' . \frontend\widgets\Hint::widget(['hint' => 'template']))->radioList($output);
$l1 .= '</div>';
$l1 .= '</div>';
$l1 .= '<div class="box" style="background: snow">';
$l1 .= '<div class="box-body">';
$l1 .= $form->field($model, 'logotype[value]', ['options' => ['class' => ''], 'labelOptions' => ['class' => 'box-header with-border']])->label('Логотип' . \frontend\widgets\Hint::widget(['hint' => 'logo']))->input('text')->widget(CKEditor::className(), [
    'options' => ['rows' => 1],
    'preset' => 'logo',
]);
$l1 .= $form->field($model, 'logotype[active]', ['options' => ['style' => 'position: absolute; right: 20px; z-index: 10; top: 0px;']])->checkbox()->label('');
$l1 .= '</div>';
$l1 .= '</div>';
$l1 .= '<div class="box" style="background: snow">';
$l1 .= '<div class="box-body">';
$l1 .= $form->field($model, 'slogan[value]', ['options' => ['class' => ''], 'labelOptions' => ['class' => 'box-header with-border']])->label('Слоган' . \frontend\widgets\Hint::widget(['hint' => 'slog']))->input('text')->widget(CKEditor::className(), [
    'options' => ['rows' => 1],
    'preset' => 'logo',
]);
$l1 .= $form->field($model, 'slogan[active]', ['options' => ['style' => 'position: absolute; right: 20px; z-index: 10; top: 0px;']])->checkbox()->label('');
$l1 .= '</div>';
$l1 .= '</div>';
$l1 .= '<div class="box" style="background: snow">';
$l1 .= '<div class="box-body">';
$l1 .= $form->field($model, 'newsonindex[value]', ['options' => ['class' => ''], 'labelOptions' => ['class' => 'box-header with-border']])->label('Новости на главной' . \frontend\widgets\Hint::widget(['hint' => 'newsmainpage']))->input('text');
$l1 .= $form->field($model, 'newsonindex[active]', ['options' => ['style' => 'position: absolute; right: 20px; z-index: 10; top: 0px;']])->checkbox()->label('');
$l1 .= '</div>';
$l1 .= '</div>';
$l1 .= '<div class="box" style="background: snow">';
$l1 .= '<div class="box-body">';
$l1 .= $form->field($model, 'commentsonindex[value]', ['options' => ['class' => ''], 'labelOptions' => ['class' => 'box-header with-border']])->label('Комментарии на главной' . \frontend\widgets\Hint::widget(['hint' => 'commentsmainpage']))->input('text');
$l1 .= $form->field($model, 'commentsonindex[active]', ['options' => ['style' => 'position: absolute; right: 20px; z-index: 10; top: 0px;']])->checkbox()->label('');
$l1 .= '</div>';
$l1 .= '</div>';
$l1 .= '</div>';

//--------------------------------------------------------------------------------------------------------------------//
//                                               Вкладка 2. Счетчики, СЕО                                             //
//                                                                                                                    //
//--------------------------------------------------------------------------------------------------------------------//

$l2 = '<div style=" height: 100%;">';
$l2 .= '<div class="box" style="background: snow">';
$l2 .= '<label class="box-header with-border">Счетчики</label>';
$l2 .= '<div class="box-body">';
$l2 .= '<div class="col-md-6">';
$l2 .= $form->field($model, 'mailcounter[value]')->label('Mail (id счетчика)' . \frontend\widgets\Hint::widget(['hint' => 'mailruid']));
$l2 .= $form->field($model, 'mailcounter[active]', ['options' => ['style' => 'top: -10px; right: 10px; position: absolute;']])->checkbox()->label('');
$l2 .= '</div>';
$l2 .= '<div class="col-md-6">';
$l2 .= $form->field($model, 'yandexcounter[value]')->label('Yandex (id счетчика)' . \frontend\widgets\Hint::widget(['hint' => 'yandexid']));
$l2 .= $form->field($model, 'yandexcounter[active]', ['options' => ['style' => 'top: -10px; right: 10px; position: absolute;']])->checkbox()->label('');
$l2 .= '</div>';
$l2 .= '</div>';
$l2 .= '</div>';
$l2 .= '</div>';
//--------------------------------------------------------------------------------------------------------------------//
//                                             Вкладка 3. Ценовая политика                                            //
//                                                                                                                    //
//--------------------------------------------------------------------------------------------------------------------//

$l3 = '<div style=" height: 100%;">';
$l3 .= '<div class="box"  style="background: snow">';
$l3 .= '<div class="box-body">';
$l3 .= $form->field($model, 'discount[value]', ['options' => ['class' => ''], 'labelOptions' => ['class' => 'box-header with-border']])->label('Наценка(в % на все товары магазина,все скидки высчитаваются из финальной стоимости товара!!!)' . \frontend\widgets\Hint::widget(['hint' => 'margin']));
$l3 .= $form->field($model, 'discount[active]', ['options' => ['style' => 'top: 0px; right: 10px; position: absolute;']])->checkbox()->label('');
$l3 .= '</div>';
$l3 .= '</div>';
$l3 .= '<div class="box"  style="background: snow">';
$l3 .= '<div class="box-body">';
$l3 .= $form->field($model, 'minimalordertotalprice[value]', ['options' => ['class' => ''], 'labelOptions' => ['class' => 'box-header with-border']])->label('Минимальная сумма заказа, Руб.' . \frontend\widgets\Hint::widget(['hint' => 'minsumm']));
$l3 .= $form->field($model, 'minimalordertotalprice[active]', ['options' => ['style' => 'top: 0px; right: 10px; position: absolute;']])->checkbox()->label('');
$l3 .= '</div>';
$l3 .= '</div>';
$l3 .= '<div class="box"  style="background: snow">';
$l3 .= '<div class="box-body">';
$l3 .= '<label class="box-header with-border">' .
    'Скидка по сумме заказа' .
    '</label>';
//++gen3_1_1/
$l3_1 = '<div class="col-md-12" style="margin: 0px 15px;">';
$l3_1 .= $form->field($model, 'discounttotalorderprice[value][0][active]', ['options' => ['style' => 'position: absolute;top: 25px; z-index: 99;height: 34px;padding: 0px 20px 0px 10px;margin: 0px -15px;', 'class' => 'input-group-addon']])->checkbox()->label('');
$l3_1 .= $form->field($model, 'discounttotalorderprice[value][0][value]', ['options' => ['class' => 'col-md-2']])->label('Скидка, %');
$l3_1 .= $form->field($model, 'discounttotalorderprice[value][0][in]', ['options' => ['class' => 'col-md-5']])->label('От, Руб.' . \frontend\widgets\Hint::widget(['hint' => 'include']));
$l3_1 .= $form->field($model, 'discounttotalorderprice[value][0][out]', ['options' => ['class' => 'col-md-5']])->label('До, Руб.' . \frontend\widgets\Hint::widget(['hint' => 'noinclude']));
$l3_1 .= '</div>';
$u = 1;
for ($i = 1; $i <= count($model->discounttotalorderprice['value']); $i++) {
    if ((isset($model->discounttotalorderprice['value'][$i]['value']) && $model->discounttotalorderprice['value'][$i]['value'] !== '') || $i = count($model->discounttotalorderprice['value'])) {
        $l3_1 .= '<div class="col-md-12" style="margin: 0px 15px;">';
        $l3_1 .= $form->field($model, 'discounttotalorderprice[value][' . ($u) . '][active]', ['options' => ['style' => 'position: absolute;top: 5px; z-index: 99;height: 34px;padding: 0px 20px 0px 10px;margin: 0px -15px;', 'class' => 'input-group-addon']])->checkbox()->label('');
        $l3_1 .= $form->field($model, 'discounttotalorderprice[value][' . ($u) . '][value]', ['options' => ['class' => 'col-md-2', 'style' => 'margin:0px']])->label('', ['style' => 'display:block']);
        $l3_1 .= $form->field($model, 'discounttotalorderprice[value][' . ($u) . '][in]', ['options' => ['class' => 'col-md-5', 'style' => 'margin:0px']])->label('', ['style' => 'display:block']);
        $l3_1 .= $form->field($model, 'discounttotalorderprice[value][' . ($u) . '][out]', ['options' => ['class' => 'col-md-5', 'style' => 'margin:0px']])->label('', ['style' => 'display:block']);
        $l3_1 .= '</div>';
        $u++;
    }
}
//--gen3_1_1/


$l3 .= $l3_1;
$l3 .= $form->field($model, 'discounttotalorderprice[active]', ['options' => ['style' => 'top: 0px; right: 10px; position: absolute;']])->checkbox()->label('');
$l3 .= '</div>';
$l3 .= '</div>';
$l3 .= '<div class="box"  style="background: snow">';
$l3 .= '<div class="box-body">';
$l3 .= '<label class="box-header with-borderl">' .
    'Накопительная скидка' .
    '</label>';
//++gen3_1_2/
$l3_1 = '<div class="col-md-12"  style="margin: 0px 15px;">';
$l3_1 .= $form->field($model, 'discounttotalorder[value][0][active]', ['options' => ['style' => 'position: absolute;top: 25px; z-index: 99;height: 34px;padding: 0px 20px 0px 10px;margin: 0px -15px;', 'class' => 'input-group-addon']])->checkbox()->label('');
$l3_1 .= $form->field($model, 'discounttotalorder[value][0][value]', ['options' => ['class' => 'col-md-2']])->label('Скидка, %');
$l3_1 .= $form->field($model, 'discounttotalorder[value][0][in]', ['options' => ['class' => 'col-md-5']])->label('От, Руб.' . \frontend\widgets\Hint::widget(['hint' => 'include']));
$l3_1 .= $form->field($model, 'discounttotalorder[value][0][out]', ['options' => ['class' => 'col-md-5']])->label('До, Руб.' . \frontend\widgets\Hint::widget(['hint' => 'noinclude']));
$l3_1 .= '</div>';
$u = 1;
for ($i = 1; $i <= count($model->discounttotalorder['value']); $i++) {
    if ((isset($model->discounttotalorder['value'][$i]['value']) && $model->discounttotalorder['value'][$i]['value'] !== '') || $i = count($model->discounttotalorder['value'])) {
        $l3_1 .= '<div class="col-md-12"  style="margin: 0px 15px;">';
        $l3_1 .= $form->field($model, 'discounttotalorder[value][' . ($u) . '][active]', ['options' => ['style' => 'position: absolute;top: 5px; z-index: 99;height: 34px;padding: 0px 20px 0px 10px;margin: 0px -15px;', 'class' => 'input-group-addon']])->checkbox()->label('');
        $l3_1 .= $form->field($model, 'discounttotalorder[value][' . ($u) . '][value]', ['options' => ['class' => 'col-md-2', 'style' => 'margin:0px']])->label('', ['style' => 'display:block']);
        $l3_1 .= $form->field($model, 'discounttotalorder[value][' . ($u) . '][in]', ['options' => ['class' => 'col-md-5', 'style' => 'margin:0px']])->label('', ['style' => 'display:block']);
        $l3_1 .= $form->field($model, 'discounttotalorder[value][' . ($u) . '][out]', ['options' => ['class' => 'col-md-5', 'style' => 'margin:0px']])->label('', ['style' => 'display:block']);
        $l3_1 .= '</div>';
        $u++;
    }
}
//--gen3_1_2/
$l3 .= $l3_1;
$l3 .= $form->field($model, 'discounttotalorder[active]', ['options' => ['style' => 'top: 0px; right: 10px; position: absolute;']])->checkbox()->label('');
$l3 .= '</div>';
$l3 .= '</div>';
$l3 .= '<div class="box" style="background: snow">';
$l3 .= '<div class="box-body">';
$l3 .= '<label  class="box-header with-borderl">' .
    'Группы скидок для пользователей' . \frontend\widgets\Hint::widget(['hint' => 'discountgroups']) .
    '</label>';
//++gen3_1_2/
$l3_1 = '<div class="col-md-12"  style="margin: 0px 15px;">';
$l3_1 .= $form->field($model, 'discountgroup[value][0][active]', ['options' => ['style' => 'position: absolute;top: 25px; z-index: 99;height: 34px;padding: 0px 20px 0px 10px;margin: 0px -15px;', 'class' => 'input-group-addon']])->checkbox()->label('');
$l3_1 .= $form->field($model, 'discountgroup[value][0][value]', ['options' => ['class' => 'col-md-2']])->label('Скидка, %');
$l3_1 .= $form->field($model, 'discountgroup[value][0][name]', ['options' => ['class' => 'col-md-10', 'style' => 'margin:0px']])->label('Имя группы', ['style' => 'display:block']);
$l3_1 .= '</div>';
$u = 1;
for ($i = 1; $i <= count($model->discountgroup['value']); $i++) {
    if ((isset($model->discountgroup['value'][$i]['value']) && $model->discountgroup['value'][$i]['value'] !== '') || $i = count($model->discountgroup['value'])) {
        $l3_1 .= '<div class="col-md-12"  style="margin: 0px 15px;">';
        $l3_1 .= $form->field($model, 'discountgroup[value][' . ($u) . '][active]', ['options' => ['style' => 'position: absolute;top: 5px; z-index: 99;height: 34px;padding: 0px 20px 0px 10px;margin: 0px -15px;', 'class' => 'input-group-addon']])->checkbox()->label('');
        $l3_1 .= $form->field($model, 'discountgroup[value][' . ($u) . '][value]', ['options' => ['class' => 'col-md-2', 'style' => 'margin:0px']])->label('', ['style' => 'display:block']);
        $l3_1 .= $form->field($model, 'discountgroup[value][' . ($u) . '][name]', ['options' => ['class' => 'col-md-10', 'style' => 'margin:0px']])->label('', ['style' => 'display:block']);
        $l3_1 .= '</div>';
        $u++;
    }
}
//--gen3_1_2/
$l3 .= $l3_1;
$l3 .= $form->field($model, 'discountgroup[active]', ['options' => ['style' => 'top: 0px; right: 10px; position: absolute;']])->checkbox()->label('');
$l3 .= '</div>';
$l3 .= '</div>';
$l3 .= '</div>';

//--------------------------------------------------------------------------------------------------------------------//
//                                                 Вкладка 4. Контакты                                                //
//                                                                                                                    //
//--------------------------------------------------------------------------------------------------------------------//

$l4 = '<div style=" height: 100%;">';
$l4 .= '<div class="box" style="background: snow;">';
$l4 .= '<div class="box-body">';
$l4 .= '<label class="box-header with-border">';
$l4 .= 'Общие';
$l4 .= '</label>';
$l4 .= '<div class="col-md-6">';
$l4 .= $form->field($model, 'contacts[adress][value]', ['options' => ['class' => 'form-group']])->label('Адрес' . \frontend\widgets\Hint::widget(['hint' => 'address']));
$l4 .= $form->field($model, 'contacts[adress][active]', ['options' => ['style' => 'top: -10px; right: 10px; position: absolute;']])->checkbox()->label('');
$l4 .= '</div>';
$l4 .= '<div class="col-md-6">';
$l4 .= $form->field($model, 'contacts[telephone][value]', ['options' => ['class' => 'form-group']])->label('Телефон' . \frontend\widgets\Hint::widget(['hint' => 'phone']));
$l4 .= $form->field($model, 'contacts[telephone][active]', ['options' => ['style' => 'top: -10px; right: 10px; position: absolute;']])->checkbox()->label('');
$l4 .= '</div>';
$l4 .= '<div class="col-md-6">';
$l4 .= $form->field($model, 'contacts[fax][value]', ['options' => ['class' => 'form-group']])->label('Факс' . \frontend\widgets\Hint::widget(['hint' => 'fax']));
$l4 .= $form->field($model, 'contacts[fax][active]', ['options' => ['style' => 'top: -10px; right: 10px; position: absolute;']])->checkbox()->label('');
$l4 .= '</div>';
$l4 .= '<div class="col-md-6">';
$l4 .= $form->field($model, 'contacts[email][value]', ['options' => ['class' => 'form-group']])->label('E-mail' . \frontend\widgets\Hint::widget(['hint' => 'email']));
$l4 .= $form->field($model, 'contacts[email][active]', ['options' => ['style' => 'top: -10px; right: 10px; position: absolute;']])->checkbox()->label('');
$l4 .= '</div>';
$l4 .= '</div>';
$l4 .= '</div>';
$l4 .= '<div class="box" style="background: snow;">';
$l4 .= '<div class="box-body">';
$l4 .= '<label class="box-header with-border">';
$l4 .= 'График работы';
$l4 .= '</label>';
$l4 .= $form->field($model, 'contacts[graf_work][activated]', ['options' => ['style' => 'top: 0px; right: 10px; position: absolute;']])->checkbox()->label(false);
$l4 .= '<div class="callout col-md-3">';
$hours = ['00' => '00', '01' => '01', '02' => '02', '03' => '03', '04' => '04', '05' => '05', '06' => '06', '07' => '07', '08' => '08', '09' => '09', '10' => '10', '11' => '11', '12' => '12', '13' => '13', '14' => '14', '15' => '15', '16' => '16', '17' => '17', '18' => '18', '19' => '19', '20' => '20', '21' => '21', '22' => '22', '23' => '23', '24' => '24'];
$minuts = ['00' => '00', '10' => '10', '20' => '20', '30' => '30', '40' => '40', '50' => '50'];
$l4 .= $form->field($model, 'contacts[graf_work][mon][active]', ['options' => ['class' => '']])->checkbox()->label('Понедельник');
$l4 .= $form->field($model, 'contacts[graf_work][mon][w][in]', ['options' => ['class' => 'col-md-3 prop', 'style' => 'padding-right: 5px; padding-left: 5px;']])->dropDownList($hours, ['prompt' => 'Ч'])->label('C');
$l4 .= $form->field($model, 'contacts[graf_work][mon][wm][in]', ['options' => ['class' => 'col-md-3 prop', 'style' => 'padding-right: 5px; padding-left: 5px;']])->dropDownList($minuts, ['prompt' => 'М'])->label('_');
$l4 .= $form->field($model, 'contacts[graf_work][mon][w][out]', ['options' => ['class' => 'col-md-3 prop', 'style' => 'padding-right: 5px; padding-left: 5px;']])->dropDownList($hours, ['prompt' => 'Ч'])->label('До');
$l4 .= $form->field($model, 'contacts[graf_work][mon][wm][out]', ['options' => ['class' => 'col-md-3 prop', 'style' => 'padding-right: 5px; padding-left: 5px;']])->dropDownList($minuts, ['prompt' => 'М'])->label('_');
$l4 .= $form->field($model, 'contacts[graf_work][mon][o][active]', ['options' => ['class' => 'col-md-12']])->checkbox()->label('Обед');
$l4 .= $form->field($model, 'contacts[graf_work][mon][o][in]', ['options' => ['class' => 'col-md-3 prop', 'style' => 'padding-right: 5px; padding-left: 5px;']])->dropDownList($hours, ['prompt' => 'Ч'])->label('C');
$l4 .= $form->field($model, 'contacts[graf_work][mon][om][in]', ['options' => ['class' => 'col-md-3 prop', 'style' => 'padding-right: 5px; padding-left: 5px;']])->dropDownList($minuts, ['prompt' => 'М'])->label('_');
$l4 .= $form->field($model, 'contacts[graf_work][mon][o][out]', ['options' => ['class' => 'col-md-3 prop', 'style' => 'padding-right: 5px; padding-left: 5px;']])->dropDownList($hours, ['prompt' => 'Ч'])->label('До');
$l4 .= $form->field($model, 'contacts[graf_work][mon][om][out]', ['options' => ['class' => 'col-md-3 prop', 'style' => 'padding-right: 5px; padding-left: 5px;']])->dropDownList($minuts, ['prompt' => 'М'])->label('_');
$l4 .= '</div>';
$l4 .= '<div class="callout col-md-3">';
$l4 .= $form->field($model, 'contacts[graf_work][tue][active]', ['options' => ['class' => '']])->checkbox()->label('Вторник');
$l4 .= $form->field($model, 'contacts[graf_work][tue][w][in]', ['options' => ['class' => 'col-md-3 prop', 'style' => 'padding-right: 5px; padding-left: 5px;']])->dropDownList($hours, ['prompt' => 'Ч'])->label('C');
$l4 .= $form->field($model, 'contacts[graf_work][tue][wm][in]', ['options' => ['class' => 'col-md-3 prop', 'style' => 'padding-right: 5px; padding-left: 5px;']])->dropDownList($minuts, ['prompt' => 'М'])->label('_');
$l4 .= $form->field($model, 'contacts[graf_work][tue][w][out]', ['options' => ['class' => 'col-md-3 prop', 'style' => 'padding-right: 5px; padding-left: 5px;']])->dropDownList($hours, ['prompt' => 'Ч'])->label('До');
$l4 .= $form->field($model, 'contacts[graf_work][tue][wm][out]', ['options' => ['class' => 'col-md-3 prop', 'style' => 'padding-right: 5px; padding-left: 5px;']])->dropDownList($minuts, ['prompt' => 'М'])->label('_');
$l4 .= $form->field($model, 'contacts[graf_work][tue][o][active]', ['options' => ['class' => 'col-md-12']])->checkbox()->label('Обед');
$l4 .= $form->field($model, 'contacts[graf_work][tue][o][in]', ['options' => ['class' => 'col-md-3 prop', 'style' => 'padding-right: 5px; padding-left: 5px;']])->dropDownList($hours, ['prompt' => 'Ч'])->label('C');
$l4 .= $form->field($model, 'contacts[graf_work][tue][om][in]', ['options' => ['class' => 'col-md-3 prop', 'style' => 'padding-right: 5px; padding-left: 5px;']])->dropDownList($minuts, ['prompt' => 'М'])->label('_');
$l4 .= $form->field($model, 'contacts[graf_work][tue][o][out]', ['options' => ['class' => 'col-md-3 prop', 'style' => 'padding-right: 5px; padding-left: 5px;']])->dropDownList($hours, ['prompt' => 'Ч'])->label('До');
$l4 .= $form->field($model, 'contacts[graf_work][tue][om][out]', ['options' => ['class' => 'col-md-3 prop', 'style' => 'padding-right: 5px; padding-left: 5px;']])->dropDownList($minuts, ['prompt' => 'М'])->label('_');
$l4 .= '</div>';
$l4 .= '<div class="callout col-md-3">';
$l4 .= $form->field($model, 'contacts[graf_work][wed][active]', ['options' => ['class' => '']])->checkbox()->label('Среда');
$l4 .= $form->field($model, 'contacts[graf_work][wed][w][in]', ['options' => ['class' => 'col-md-3 prop', 'style' => 'padding-right: 5px; padding-left: 5px;']])->dropDownList($hours, ['prompt' => 'Ч'])->label('C');
$l4 .= $form->field($model, 'contacts[graf_work][wed][wm][in]', ['options' => ['class' => 'col-md-3 prop', 'style' => 'padding-right: 5px; padding-left: 5px;']])->dropDownList($minuts, ['prompt' => 'М'])->label('_');
$l4 .= $form->field($model, 'contacts[graf_work][wed][w][out]', ['options' => ['class' => 'col-md-3 prop', 'style' => 'padding-right: 5px; padding-left: 5px;']])->dropDownList($hours, ['prompt' => 'Ч'])->label('До');
$l4 .= $form->field($model, 'contacts[graf_work][wed][wm][out]', ['options' => ['class' => 'col-md-3 prop', 'style' => 'padding-right: 5px; padding-left: 5px;']])->dropDownList($minuts, ['prompt' => 'М'])->label('_');
$l4 .= $form->field($model, 'contacts[graf_work][wed][o][active]', ['options' => ['class' => 'col-md-12']])->checkbox()->label('Обед');
$l4 .= $form->field($model, 'contacts[graf_work][wed][o][in]', ['options' => ['class' => 'col-md-3 prop', 'style' => 'padding-right: 5px; padding-left: 5px;']])->dropDownList($hours, ['prompt' => 'Ч'])->label('C');
$l4 .= $form->field($model, 'contacts[graf_work][wed][om][in]', ['options' => ['class' => 'col-md-3 prop', 'style' => 'padding-right: 5px; padding-left: 5px;']])->dropDownList($minuts, ['prompt' => 'М'])->label('_');
$l4 .= $form->field($model, 'contacts[graf_work][wed][o][out]', ['options' => ['class' => 'col-md-3 prop', 'style' => 'padding-right: 5px; padding-left: 5px;']])->dropDownList($hours, ['prompt' => 'Ч'])->label('До');
$l4 .= $form->field($model, 'contacts[graf_work][wed][om][out]', ['options' => ['class' => 'col-md-3 prop', 'style' => 'padding-right: 5px; padding-left: 5px;']])->dropDownList($minuts, ['prompt' => 'М'])->label('_');
$l4 .= '</div>';
$l4 .= '<div class="callout col-md-3">';
$l4 .= $form->field($model, 'contacts[graf_work][thu][active]', ['options' => ['class' => '']])->checkbox()->label('Четверг');
$l4 .= $form->field($model, 'contacts[graf_work][thu][w][in]', ['options' => ['class' => 'col-md-3 prop', 'style' => 'padding-right: 5px; padding-left: 5px;']])->dropDownList($hours, ['prompt' => 'Ч'])->label('C');
$l4 .= $form->field($model, 'contacts[graf_work][thu][wm][in]', ['options' => ['class' => 'col-md-3 prop', 'style' => 'padding-right: 5px; padding-left: 5px;']])->dropDownList($minuts, ['prompt' => 'М'])->label('_');
$l4 .= $form->field($model, 'contacts[graf_work][thu][w][out]', ['options' => ['class' => 'col-md-3 prop', 'style' => 'padding-right: 5px; padding-left: 5px;']])->dropDownList($hours, ['prompt' => 'Ч'])->label('До');
$l4 .= $form->field($model, 'contacts[graf_work][thu][wm][out]', ['options' => ['class' => 'col-md-3 prop', 'style' => 'padding-right: 5px; padding-left: 5px;']])->dropDownList($minuts, ['prompt' => 'М'])->label('_');
$l4 .= $form->field($model, 'contacts[graf_work][thu][o][active]', ['options' => ['class' => 'col-md-12']])->checkbox()->label('Обед');
$l4 .= $form->field($model, 'contacts[graf_work][thu][o][in]', ['options' => ['class' => 'col-md-3 prop', 'style' => 'padding-right: 5px; padding-left: 5px;']])->dropDownList($hours, ['prompt' => 'Ч'])->label('C');
$l4 .= $form->field($model, 'contacts[graf_work][thu][om][in]', ['options' => ['class' => 'col-md-3 prop', 'style' => 'padding-right: 5px; padding-left: 5px;']])->dropDownList($minuts, ['prompt' => 'М'])->label('_');
$l4 .= $form->field($model, 'contacts[graf_work][thu][o][out]', ['options' => ['class' => 'col-md-3 prop', 'style' => 'padding-right: 5px; padding-left: 5px;']])->dropDownList($hours, ['prompt' => 'Ч'])->label('До');
$l4 .= $form->field($model, 'contacts[graf_work][thu][om][out]', ['options' => ['class' => 'col-md-3 prop', 'style' => 'padding-right: 5px; padding-left: 5px;']])->dropDownList($minuts, ['prompt' => 'М'])->label('_');
$l4 .= '</div>';
$l4 .= '<div class="callout col-md-4">';
$l4 .= $form->field($model, 'contacts[graf_work][fri][active]', ['options' => ['class' => '']])->checkbox()->label('Пятница');
$l4 .= $form->field($model, 'contacts[graf_work][fri][w][in]', ['options' => ['class' => 'col-md-3 prop', 'style' => 'padding-right: 5px; padding-left: 5px;']])->dropDownList($hours, ['prompt' => 'Ч'])->label('C');
$l4 .= $form->field($model, 'contacts[graf_work][fri][wm][in]', ['options' => ['class' => 'col-md-3 prop', 'style' => 'padding-right: 5px; padding-left: 5px;']])->dropDownList($minuts, ['prompt' => 'М'])->label('_');
$l4 .= $form->field($model, 'contacts[graf_work][fri][w][out]', ['options' => ['class' => 'col-md-3 prop', 'style' => 'padding-right: 5px; padding-left: 5px;']])->dropDownList($hours, ['prompt' => 'Ч'])->label('До');
$l4 .= $form->field($model, 'contacts[graf_work][fri][wm][out]', ['options' => ['class' => 'col-md-3 prop', 'style' => 'padding-right: 5px; padding-left: 5px;']])->dropDownList($minuts, ['prompt' => 'М'])->label('_');
$l4 .= $form->field($model, 'contacts[graf_work][fri][o][active]', ['options' => ['class' => 'col-md-12']])->checkbox()->label('Обед');
$l4 .= $form->field($model, 'contacts[graf_work][fri][o][in]', ['options' => ['class' => 'col-md-3 prop', 'style' => 'padding-right: 5px; padding-left: 5px;']])->dropDownList($hours, ['prompt' => 'Ч'])->label('C');
$l4 .= $form->field($model, 'contacts[graf_work][fri][om][in]', ['options' => ['class' => 'col-md-3 prop', 'style' => 'padding-right: 5px; padding-left: 5px;']])->dropDownList($minuts, ['prompt' => 'М'])->label('_');
$l4 .= $form->field($model, 'contacts[graf_work][fri][o][out]', ['options' => ['class' => 'col-md-3 prop', 'style' => 'padding-right: 5px; padding-left: 5px;']])->dropDownList($hours, ['prompt' => 'Ч'])->label('До');
$l4 .= $form->field($model, 'contacts[graf_work][fri][om][out]', ['options' => ['class' => 'col-md-3 prop', 'style' => 'padding-right: 5px; padding-left: 5px;']])->dropDownList($minuts, ['prompt' => 'М'])->label('_');
$l4 .= '</div>';
$l4 .= '<div class="callout col-md-4">';
$l4 .= $form->field($model, 'contacts[graf_work][sat][active]', ['options' => ['class' => '']])->checkbox()->label('Суббота');
$l4 .= $form->field($model, 'contacts[graf_work][sat][w][in]', ['options' => ['class' => 'col-md-3 prop', 'style' => 'padding-right: 5px; padding-left: 5px;']])->dropDownList($hours, ['prompt' => 'Ч'])->label('C');
$l4 .= $form->field($model, 'contacts[graf_work][sat][wm][in]', ['options' => ['class' => 'col-md-3 prop', 'style' => 'padding-right: 5px; padding-left: 5px;']])->dropDownList($minuts, ['prompt' => 'М'])->label('_');
$l4 .= $form->field($model, 'contacts[graf_work][sat][w][out]', ['options' => ['class' => 'col-md-3 prop', 'style' => 'padding-right: 5px; padding-left: 5px;']])->dropDownList($hours, ['prompt' => 'Ч'])->label('До');
$l4 .= $form->field($model, 'contacts[graf_work][sat][wm][out]', ['options' => ['class' => 'col-md-3 prop', 'style' => 'padding-right: 5px; padding-left: 5px;']])->dropDownList($minuts, ['prompt' => 'М'])->label('_');
$l4 .= $form->field($model, 'contacts[graf_work][sat][o][active]', ['options' => ['class' => 'col-md-12']])->checkbox()->label('Обед');
$l4 .= $form->field($model, 'contacts[graf_work][sat][o][in]', ['options' => ['class' => 'col-md-3 prop', 'style' => 'padding-right: 5px; padding-left: 5px;']])->dropDownList($hours, ['prompt' => 'Ч'])->label('C');
$l4 .= $form->field($model, 'contacts[graf_work][sat][om][in]', ['options' => ['class' => 'col-md-3 prop', 'style' => 'padding-right: 5px; padding-left: 5px;']])->dropDownList($minuts, ['prompt' => 'М'])->label('_');
$l4 .= $form->field($model, 'contacts[graf_work][sat][o][out]', ['options' => ['class' => 'col-md-3 prop', 'style' => 'padding-right: 5px; padding-left: 5px;']])->dropDownList($hours, ['prompt' => 'Ч'])->label('До');
$l4 .= $form->field($model, 'contacts[graf_work][sat][om][out]', ['options' => ['class' => 'col-md-3 prop', 'style' => 'padding-right: 5px; padding-left: 5px;']])->dropDownList($minuts, ['prompt' => 'М'])->label('_');
$l4 .= '</div>';
$l4 .= '<div class="callout col-md-4">';
$l4 .= $form->field($model, 'contacts[graf_work][sun][active]', ['options' => ['class' => '']])->checkbox()->label('Воскресение');
$l4 .= $form->field($model, 'contacts[graf_work][sun][w][in]', ['options' => ['class' => 'col-md-3 prop', 'style' => 'padding-right: 5px; padding-left: 5px;']])->dropDownList($hours, ['prompt' => 'Ч'])->label('C');
$l4 .= $form->field($model, 'contacts[graf_work][sun][wm][in]', ['options' => ['class' => 'col-md-3 prop', 'style' => 'padding-right: 5px; padding-left: 5px;']])->dropDownList($minuts, ['prompt' => 'М'])->label('_');
$l4 .= $form->field($model, 'contacts[graf_work][sun][w][out]', ['options' => ['class' => 'col-md-3 prop', 'style' => 'padding-right: 5px; padding-left: 5px;']])->dropDownList($hours, ['prompt' => 'Ч'])->label('До');
$l4 .= $form->field($model, 'contacts[graf_work][sun][wm][out]', ['options' => ['class' => 'col-md-3 prop', 'style' => 'padding-right: 5px; padding-left: 5px;']])->dropDownList($minuts, ['prompt' => 'М'])->label('_');
$l4 .= $form->field($model, 'contacts[graf_work][sun][o][active]', ['options' => ['class' => 'col-md-12']])->checkbox()->label('Обед');
$l4 .= $form->field($model, 'contacts[graf_work][sun][o][in]', ['options' => ['class' => 'col-md-3 prop', 'style' => 'padding-right: 5px; padding-left: 5px;']])->dropDownList($hours, ['prompt' => 'Ч'])->label('C');
$l4 .= $form->field($model, 'contacts[graf_work][sun][om][in]', ['options' => ['class' => 'col-md-3 prop', 'style' => 'padding-right: 5px; padding-left: 5px;']])->dropDownList($minuts, ['prompt' => 'М'])->label('_');
$l4 .= $form->field($model, 'contacts[graf_work][sun][o][out]', ['options' => ['class' => 'col-md-3 prop', 'style' => 'padding-right: 5px; padding-left: 5px;']])->dropDownList($hours, ['prompt' => 'Ч'])->label('До');
$l4 .= $form->field($model, 'contacts[graf_work][sun][om][out]', ['options' => ['class' => 'col-md-3 prop', 'style' => 'padding-right: 5px; padding-left: 5px;']])->dropDownList($minuts, ['prompt' => 'М'])->label('_');
$l4 .= '</div>';
$l4 .= '</div>';
$l4 .= '</div>';

$l4 .= '<div class="box" style="background: snow;">';
$l4 .= '<div class="box-body">';
$l4 .= '<label class="box-header with-border">';
$l4 .= 'Карты';
$l4 .= '</label>';
$l4 .= '<div class="col-md-12">';
$l4 .= $form->field($model, 'yandexmap[value]')->label('Yandex(SID)' . \frontend\widgets\Hint::widget(['hint' => 'yandexmap']), ['options' => ['class' => 'col-md-3']]);
$l4 .= $form->field($model, 'yandexmap[active]', ['options' => ['style' => 'top: -10px; right: 10px; position: absolute;']])->checkbox()->label('');
$l4 .= '</div>';
$l4 .= '<div class="col-md-12">';
$l4 .= $form->field($model, 'googlemap[value]')->label('Google(MID)' . \frontend\widgets\Hint::widget(['hint' => 'googlemap']), ['options' => ['class' => 'col-md-3']]);
$l4 .= $form->field($model, 'googlemap[active]', ['options' => ['style' => 'top: -10px; right: 10px; position: absolute;']])->checkbox()->label('');
$l4 .= '</div>';
$l4 .= '</div>';
$l4 .= '</div>';
$l4 .= '</div>';

//--------------------------------------------------------------------------------------------------------------------//
//                                        Вкладка 5. Транспортные компании                                            //
//                                                                                                                    //
//--------------------------------------------------------------------------------------------------------------------//

$l5 = '<div style=" height: 100%;">';
$l5 .= '<div class="box"  style="background: snow;">';
$l5 .= '<div class="box-body">';
$l5 .= '<label class="box-header with-border">' .
    'Транспортные компании' .
    '</label>';
$l5_1 = '<div class="col-md-12" style="margin: 0px 15px;">';
$l5_1 .= $form->field($model, 'transport[value][0][active]', ['options' => ['style' => 'position: absolute;top: 25px; z-index: 99;height: 34px;padding: 0px 20px 0px 10px;margin: 0px -15px;', 'class' => 'input-group-addon']])->checkbox()->label('');
$l5_1 .= $form->field($model, 'transport[value][0][value]', ['options' => ['class' => 'col-md-9']])->label('Название');
$l5_1 .= $form->field($model, 'transport[value][0][wantpasport]', ['options' => ['class' => 'col-md-3', 'style' => 'position: absolute;  top: 20px; right:0px; z-index: 99;']])->label('Нужен паспорт')->checkbox();
$l5_1 .= '</div>';

//++gen5_1//
$u = 1;
for ($i = 1; $i <= count($model->transport['value']); $i++) {
    if ((isset($model->transport['value'][$i]['value']) && $model->transport['value'][$i]['value'] !== '') || $i = count($model->transport['value'])) {
        $l5_1 .= '<div class="col-md-12" style="margin: 0px 15px;">';
        $l5_1 .= $form->field($model, 'transport[value][' . ($u) . '][active]', ['options' => ['style' => 'position: absolute;top: 5px; z-index: 99;height: 34px;padding: 0px 20px 0px 10px;margin: 0px -15px;', 'class' => 'input-group-addon']])->checkbox()->label('');
        $l5_1 .= $form->field($model, 'transport[value][' . ($u) . '][value]', ['options' => ['class' => 'col-md-9', 'style' => 'margin:0px']])->label('', ['style' => 'display:block']);
        $l5_1 .= $form->field($model, 'transport[value][' . ($u) . '][wantpasport]', ['options' => ['class' => 'col-md-3', 'style' => 'position: absolute;  top: 0px; right:0px; z-index: 99;']])->checkbox()->label('Нужен паспорт', ['style' => 'display:block']);
        $l5_1 .= '</div>';
        $u++;
    }
}
//--gen5_1//

$l5 .= $l5_1;
$l5 .= $form->field($model, 'transport[active]', ['options' => ['style' => 'top: 0px; right: 10px; position: absolute;']])->checkbox()->label('');
$l5 .= '</div>';
$l5 .= '</div>';
$l5 .= '</div>';
//--------------------------------------------------------------------------------------------------------------------//
//                                           Вкладка 6. Платежные системы                                             //
//                                                                                                                    //
//--------------------------------------------------------------------------------------------------------------------//

$l6 = '<div style="height: 100%;">';
$l6 .= '<div class="box"    style="background: snow;">';
$l6 .= '<div class="box-body">';
$l6 .= '<label class="box-header with-border">' .
    'Физические платежи (реквизиты для выставления счетов)' .
    '</label>';
$l6 .= '<div id="paysystem" style="margin: 10px; height: 100%;">';
$l6 .= '<div class="">';
$l6 .= '<div class="callout col-md-12">';
$l6 .= '<label class="box-header with-border">' .
    'Яндекс деньги' .
    $form->field($model, 'paysystem[value][yamoney][active]', ['options' => ['style' => 'position: absolute; z-index: 99; top: 0px; right: 0px;']])->checkbox()->label('');
$l6 .= '</label>';
$l6 .= $form->field($model, 'paysystem[value][yamoney][value]', ['options' => ['class' => 'col-md-12']])->textInput(['placeholder' => 'Номер кошелька Яндекс.Денег'])->label(false);
$l6 .= $form->field($model, 'paysystem[value][yamoney][name]', ['options' => ['class' => 'col-md-12']])->hiddenInput()->label(false);
$l6 .= '</div>';
$l6 .= '<div class="callout col-md-12">';
$l6 .= '<label class="box-header with-border">' .
    'Webmoney' .
    $form->field($model, 'paysystem[value][webmoney][active]', ['options' => ['style' => 'position: absolute; z-index: 99; top: 0px; right: 0px;']])->checkbox()->label('');
$l6 .= '</label>';
$l6 .= $form->field($model, 'paysystem[value][webmoney][value]', ['options' => ['class' => 'col-md-12']])->textInput(['placeholder' => 'Номер рублевого кошелька WebMoney'])->label(false);
$l6 .= $form->field($model, 'paysystem[value][webmoney][name]', ['options' => ['class' => 'col-md-12']])->hiddenInput()->label(false);
$l6 .= '</div>';
$l6 .= '<div class="callout col-md-12">';
$l6 .= '<label class="box-header with-border">' .
    'Qiwi' .
    $form->field($model, 'paysystem[value][qiwi][active]', ['options' => ['style' => 'position: absolute; z-index: 99; top: 0px; right: 0px;']])->checkbox()->label('');
$l6 .= '</label>';
$l6 .= $form->field($model, 'paysystem[value][qiwi][value]', ['options' => ['class' => 'col-md-12']])->textInput(['placeholder' => 'Qiwi'])->label(false);
$l6 .= $form->field($model, 'paysystem[value][qiwi][name]', ['options' => ['class' => 'col-md-12']])->hiddenInput()->label(false);
$l6 .= '</div>';
$l6 .= '<div class="callout col-md-12">';
$l6 .= '<label class="box-header with-border">' .
    'Наложенный платеж' .
    $form->field($model, 'paysystem[value][nalozhplat][active]', ['options' => ['style' => 'position: absolute; z-index: 99; top: 0px; right: 0px;']])->checkbox()->label('');
$l6 .= '</label>';
$l6 .= $form->field($model, 'paysystem[value][nalozhplat][value]', ['options' => ['class' => 'col-md-12']])->textInput(['placeholder' => ''])->label(false);
$l6 .= $form->field($model, 'paysystem[value][nalozhplat][name]', ['options' => ['class' => 'col-md-12']])->hiddenInput()->label(false);
$l6 .= '</div>';
$l6 .= '<div class="callout col-md-12">';
$l6 .= '<label class="box-header with-border">' .
    'Банковская карта' .
    $form->field($model, 'paysystem[value][bankcard][active]', ['options' => ['style' => 'position: absolute; z-index: 99; top: 0px; right: 0px;']])->checkbox()->label('');
$l6 .= '</label>';
$l6 .= $form->field($model, 'paysystem[value][bankcard][value]', ['options' => ['class' => 'col-md-12']])->textInput(['placeholder' => ''])->label(false);
$l6 .= $form->field($model, 'paysystem[value][bankcard][name]', ['options' => ['class' => 'col-md-12']])->hiddenInput()->label(false);
$l6 .= '</div>';
$l6 .= '<div class="callout col-md-12">';

$l6 .= '<label class="box-header with-border">' .
    'Банковский платеж';
$l6 .= $form->field($model, 'paysystem[value][bankpay][active]', ['options' => ['style' => 'position: absolute; z-index: 99; top: 0px; right: 0px;']])->checkbox()->label('');

$l6 .= '</label>';

$l6 .= $form->field($model, 'paysystem[value][bankpay][value][name]', ['options' => ['class' => 'col-md-6']])->textInput(['placeholder' => 'Наименование организации'])->label(false);
$l6 .= $form->field($model, 'paysystem[value][bankpay][value][inn]', ['options' => ['class' => 'col-md-3']])->textInput(['placeholder' => 'ИНН'])->label(false);
$l6 .= $form->field($model, 'paysystem[value][bankpay][value][kpp]', ['options' => ['class' => 'col-md-3']])->textInput(['placeholder' => 'КПП'])->label(false);
$l6 .= $form->field($model, 'paysystem[value][bankpay][value][bankname]', ['options' => ['class' => 'col-md-5']])->textInput(['placeholder' => 'Наименование банка'])->label(false);
$l6 .= $form->field($model, 'paysystem[value][bankpay][value][bik]', ['options' => ['class' => 'col-md-3']])->textInput(['placeholder' => 'БИК'])->label(false);
$l6 .= $form->field($model, 'paysystem[value][bankpay][value][ks]', ['options' => ['class' => 'col-md-4']])->textInput(['placeholder' => 'Корреспондентский счет'])->label(false);
$l6 .= $form->field($model, 'paysystem[value][bankpay][value][rs]', ['options' => ['class' => 'col-md-5']])->textInput(['placeholder' => 'Рассчетный счет'])->label(false);
$l6 .= $form->field($model, 'paysystem[value][bankpay][name]', ['options' => ['class' => 'col-md-7']])->hiddenInput()->label(false);
$l6 .= '</div>';
$l6 .= '</div>';
$l6 .= $form->field($model, 'paysystem[active]', ['options' => ['style' => 'top: 0px; right: 10px; position: absolute;']])->checkbox()->label('');
$l6 .= '</div>';
$l6 .= '</div>';
$l6 .= '</div>';
$l6 .= '<div style="margin-top: 10px; width: 100%; ">';
$l6 .= '<div class="box" style="background: snow;">';
$l6 .= '<div class="box-body">';
$l6 .= '<label class="box-header with-border">' .
    'Агрегаторы платежей (автоматическая оплата)' .
    '</label>';
$l6 .= $form->field($model, 'paymentgate[active]', ['options' => ['style' => 'top: 0px; right: 10px; position: absolute;']])->checkbox()->label('');

$l6 .= '<div id="paygate">';


$l6_2 = '<div class="callout col-md-12">';
$l6_2 .= '<label class="box-header with-border" class="" style="padding: 0px 0px 0px 15px;">' .
    'Robokassa' .
    '</label>';
$l6_2 .= '<div id="robokassa" class="">';

$l6_2 .= '<div class="">';
$l6_2 .= $form->field($model, 'paymentgate[value][robokassa][value][login]', ['options' => ['class' => 'col-md-3']])->textInput(['placeholder' => 'Логин'])->label(false);
$l6_2 .= $form->field($model, 'paymentgate[value][robokassa][value][password1]', ['options' => ['class' => 'col-md-4']])->passwordInput(['placeholder' => 'Пароль 1'])->label(false);
$l6_2 .= $form->field($model, 'paymentgate[value][robokassa][value][password2]', ['options' => ['class' => 'col-md-4']])->passwordInput(['placeholder' => 'Пароль 2'])->label(false);
$l6_2 .= '</div>';
$l6_2 .= '</div>' .
    '</div>';


$l6_3 = '<div class="callout col-md-12">';
$l6_3 .= '<label class="box-header with-border" style="padding: 0px 0px 0px 15px;">' .
    'RBK Money' .
    '</label>';
$l6_3 .= '<div id="rbkmoney" class="">';

$l6_3 .= '<div class="">';
$l6_3 .= $form->field($model, 'paymentgate[value][rbkmoney][value][login]', ['options' => ['class' => 'col-md-3']])->textInput(['placeholder' => 'Логин'])->label(false);
$l6_3 .= $form->field($model, 'paymentgate[value][rbkmoney][value][eshopId]', ['options' => ['class' => 'col-md-3']])->textInput(['placeholder' => 'Номер сайта участника'])->label(false);
$l6_3 .= $form->field($model, 'paymentgate[value][rbkmoney][value][keyword]', ['options' => ['class' => 'col-md-4']])->passwordInput(['placeholder' => 'Пароль API'])->label(false);
$l6_3 .= '</div>';
$l6_3 .= '</div>' .
    '</div>';


$l6_4 = '<div class="callout col-md-12">';
$l6_4 .= '<label class="box-header with-border" style="padding: 0px 0px 0px 15px;">' .
    'Payonline' .
    '</label>';
$l6_4 .= '<div id="payonline" class="">';

$l6_4 .= '<div class="">';
$l6_4 .= $form->field($model, 'paymentgate[value][payonline][value][merchantid]', ['options' => ['class' => 'col-md-3']])->textInput(['placeholder' => 'ID мерчанта'])->label(false);
$l6_4 .= $form->field($model, 'paymentgate[value][payonline][value][privatesecurekey]', ['options' => ['class' => 'col-md-4']])->passwordInput(['placeholder' => 'Приватный ключ'])->label(false);
$l6_4 .= '</div>';
$l6_4 .= '</div>' .
    '</div>';


$l6_5 = '<div class="callout  col-md-12">';
$l6_5 .= '<label class="box-header with-border" style="padding: 0px 0px 0px 15px;">' .
    'Payanyway' .
    '</label>';
$l6_5 .= '<div id="payanyway" class="">';

$l6_5 .= '<div class="">';
$l6_5 .= $form->field($model, 'paymentgate[value][payanyway][value][merchantid]', ['options' => ['class' => 'col-md-3']])->textInput(['placeholder' => 'Идентификатор магазина'])->label(false);
$l6_5 .= '</div>';
$l6_5 .= '</div>' .
    '</div>';


$l6_6 = '<div class="callout  col-md-12">';
$l6_6 .= '<label class="box-header with-border" style="padding: 0px 0px 0px 15px;">' .
    'Dengionline' .
    '</label>';
$l6_6 .= '<div id="dengionline" class="">';

$l6_6 .= '<div class="">';
$l6_6 .= $form->field($model, 'paymentgate[value][dengionline][value][projectid]', ['options' => ['class' => 'col-md-3']])->textInput(['placeholder' => 'ID проекта'])->label(false);
$l6_6 .= $form->field($model, 'paymentgate[value][dengionline][value][privatesecurekey]', ['options' => ['class' => 'col-md-4']])->passwordInput(['placeholder' => 'Секретный ключ'])->label(false);
$l6_6 .= $form->field($model, 'paymentgate[value][dengionline][value][modetype]', ['options' => ['class' => 'col-md-3']])->textInput(['placeholder' => 'ID платежного метода'])->label(false);
$l6_6 .= '</div>';
$l6_6 .= '</div>' .
    '</div>';

$l6_7 = '<div class="callout col-md-12">';
$l6_7 .= '<label class="box-header with-border" style="padding: 0px 0px 0px 15px;">' .
    'Walletone' .
    '</label>';
$l6_7 .= '<div id="walletone" class="">';

$l6_7 .= '<div class="">';
$l6_7 .= $form->field($model, 'paymentgate[value][walletone][value][merchantid]', ['options' => ['class' => 'col-md-3']])->textInput(['placeholder' => 'ID мерчанта'])->label(false);
$l6_7 .= $form->field($model, 'paymentgate[value][walletone][value][privatesecurekey]', ['options' => ['class' => 'col-md-4']])->passwordInput(['placeholder' => 'Секретный ключ'])->label(false);
$l6_7 .= '</div>';
$l6_7 .= '</div>' .
    '</div>';


$l6_8 = '<div class="callout col-md-12">';
$l6_8 .= '<label class="box-header with-border" style="padding: 0px 0px 0px 15px;">' .
    'Payu' .
    '</label>';
$l6_8 .= '<div id="payu" class="">';

$l6_8 .= '<div class="">';
$l6_8 .= $form->field($model, 'paymentgate[value][payu][value][merchantid]', ['options' => ['class' => 'col-md-3']])->textInput(['placeholder' => 'ID мерчанта'])->label(false);
$l6_8 .= $form->field($model, 'paymentgate[value][payu][value][privatesecurekey]', ['options' => ['class' => 'col-md-4']])->passwordInput(['placeholder' => 'Приватный ключ'])->label(false);
$l6_8 .= '</div>';
$l6_8 .= '</div>' .
    '</div>';

$l6_9 = '<div class="callout  col-md-12">';
$l6_9 .= '<label class="box-header with-border" style="padding: 0px 0px 0px 15px;">' .
    'Pay2pay' .
    '</label>';
$l6_9 .= '<div id="pay2pay" class="">';

$l6_9 .= '<div class="">';
$l6_9 .= $form->field($model, 'paymentgate[value][pay2pay][value][merchantid]', ['options' => ['class' => 'col-md-3']])->textInput(['placeholder' => 'ID мерчанта'])->label(false);
$l6_9 .= $form->field($model, 'paymentgate[value][pay2pay][value][privatesecurekey]', ['options' => ['class' => 'col-md-4']])->passwordInput(['placeholder' => 'Приватный ключ'])->label(false);
$l6_9 .= '</div>';
$l6_9 .= '</div>' .
    '</div>';

$l6_10 = '<div class="callout col-md-12">';
$l6_10 .= '<label class="box-header with-border" style="padding: 0px 0px 0px 15px;">' .
    'Interkassa' .
    '</label>';
$l6_10 .= '<div id="interkassa" class="">';

$l6_10 .= '<div class="">';
$l6_10 .= $form->field($model, 'paymentgate[value][interkassa][value][merchantid]', ['options' => ['class' => 'col-md-3']])->textInput(['placeholder' => 'ID мерчанта'])->label(false);
$l6_10 .= $form->field($model, 'paymentgate[value][interkassa][value][privatesecurekey]', ['options' => ['class' => 'col-md-4']])->passwordInput(['placeholder' => 'Приватный ключ'])->label(false);
$l6_10 .= '</div>';
$l6_10 .= '</div>' .
    '</div>';

$l6_11 = '<div class="callout col-md-12">';
$l6_11 .= '<label class="box-header with-border" style="padding: 0px 0px 0px 15px;">' .
    'Z-Payment' .
    '</label>';
$l6_11 .= '<div id="z-payment" class="">';

$l6_11 .= '<div class="">';
$l6_11 .= $form->field($model, 'paymentgate[value][zpayment][value][merchantid]', ['options' => ['class' => 'col-md-3']])->textInput(['placeholder' => 'ID мерчанта'])->label(false);
$l6_11 .= $form->field($model, 'paymentgate[value][zpayment][value][privatesecurekey]', ['options' => ['class' => 'col-md-4']])->passwordInput(['placeholder' => 'Приватный ключ'])->label(false);
$l6_11 .= '</div>';
$l6_11 .= '</div>' .
    '</div>';


$l6 .= $form->field($model, 'paymentgate[value][activegate]')->radioList(['robokassa' => $l6_2, 'rbkmoney' => $l6_3, 'payonline' => $l6_4, 'payanyway' => $l6_5, 'dengionline' => $l6_6, 'walletone' => $l6_7,
    'payu' => $l6_8, 'pay2pay' => $l6_9, 'interkassa' => $l6_10, 'zpayment' => $l6_11], ['item' => function ($index, $label, $name, $checked, $value) {
    $check = $checked ? ' checked="checked"' : '';
    return '<label class="" style="width:100%; margin: 10px; height: 100%;">' .
    '<input type="radio" name="' . $name . '" value="' . $value . '" ' . $check . ' style="position: absolute; right: 55px;">' . $label . '</label>';
}])->label(false);
$l6 .= '</div>' .
    '</div>' .
    '</div>' .
    '</div>' .
    '</div>';

//--------------------------------------------------------------------------------------------------------------------//
//                                                Вкладка 7. Категории                                                //
//                                                                                                                    //
//--------------------------------------------------------------------------------------------------------------------//

function view_cat($arr, $parent_id = 0, $catnamearr)
{
    static $html;

    if (empty($arr[$parent_id])) {
    } else {
        if ($parent_id !== 0) {
            $html .= '<button type="button" name="tog" class="btn-xs btn-info btn" data-toggle="' . $parent_id . '" id="group" >+</button><div  id="categoriesdiv" toggle="' . $parent_id . '" style="display:none;"><ul id = "categories" class="dropdown">';
        } else {
            $html .= '<div><ul class="box-body box ">';
        }
        for ($i = 0; $i < count($arr[$parent_id]); $i++) {
            $catdesc = $arr[$parent_id][$i]['categories_id'];
            if (in_array($catdesc, Yii::$app->params['constantapp']['APP_CAT'])) {
                $check = 'checked';
            } else {
                $check = '';
            }
            if (!$arr[$parent_id][$i] == '') {
                $html .= '<li id="categoriessub" class="js-box"><legends><label><input type="checkbox" ' . $check . ' data="categ" value="' . $arr[$parent_id][$i]['categories_id'] . '" name="categories_id[]" cat-toggle="' . $arr[$parent_id][$i]['categories_id'] . '"/></label></legends><a style="color: black;" href="#">'
                    . $catnamearr["$catdesc"] . '</a>';
                view_cat($arr, $arr[$parent_id][$i]['categories_id'], $catnamearr);
                $html .= '</li>';
            }
        }
        $html .= '</ul></div>';

    }
    return $html;
}

$l7 = '<div style="margin: 10px; height: 100%;">';
$l7 .= '<div class="box">';
$l7 .= '<div class="box-body">';
$l7 .= '<label class="box-header with-border">' .
    'Категории' .
    '</label>';
$l7 .= '<div style="margin: 10px; height: 100%;">';
$l7 .= view_cat($arr_cat, 0, $catnamearr);
$l7 .= '</div>';
$l7 .= '</div>';
$l7 .= '</div>';
$l7 .= '</div>';

//--------------------------------------------------------------------------------------------------------------------//
//                                        Вкладка 8. Реквизиты компании                                               //
//                                                                                                                    //
//--------------------------------------------------------------------------------------------------------------------//

$l8 = '<div style=" height: 100%;">';
$l8 .= '<div class="box"  style="background: snow;" >';
$l8 .= '<div class="box-body">';
$l8 .= '<label class="box-header with-border">' .
    'Реквизиты организации' .
    '</label>';
$l8 .= '<div class="" style="">';
$l8 .= $form->field($model, 'requisites[value][shortname]', ['options' => ['class' => 'col-md-6']])->label('Краткое наименование организации');
$l8 .= $form->field($model, 'requisites[value][fullname]', ['options' => ['class' => 'col-md-6']])->label('Полное наименование организации');
$l8 .= $form->field($model, 'requisites[value][chiefpost]', ['options' => ['class' => 'col-md-6']])->label('Должность руководителя' . \frontend\widgets\Hint::widget(['hint' => 'chiefpost']));
$l8 .= $form->field($model, 'requisites[value][chiefname]', ['options' => ['class' => 'col-md-6']])->label('ФИО руководителя');
$l8 .= $form->field($model, 'requisites[value][glavbuh]', ['options' => ['class' => 'col-md-6']])->label('ФИО Главного бухгалтера');
$l8 .= $form->field($model, 'requisites[value][legaladdress]', ['options' => ['class' => 'col-md-6']])->label('Юридический адрес организации');
$l8 .= $form->field($model, 'requisites[value][realaddress]', ['options' => ['class' => 'col-md-6']])->label('Фактический адрес');
$l8 .= $form->field($model, 'requisites[value][inn]', ['options' => ['class' => 'col-md-6']])->label('ИНН');
$l8 .= $form->field($model, 'requisites[value][kpp]', ['options' => ['class' => 'col-md-6']])->label('КПП');
$l8 .= $form->field($model, 'requisites[value][ogrn]', ['options' => ['class' => 'col-md-6']])->label('ОГРН');
$l8 .= $form->field($model, 'requisites[value][okpo]', ['options' => ['class' => 'col-md-6']])->label('ОКПО');
$l8 .= $form->field($model, 'requisites[value][okved]', ['options' => ['class' => 'col-md-6']])->label('ОКВЭД');
$l8 .= $form->field($model, 'requisites[value][ogrnip]', ['options' => ['class' => 'col-md-6']])->label('ОГРНИП (Для индивидуальных предпринимателей)');
$l8 .= '</div>';
$l8 .= '<div class="" >';
$l8 .= $form->field($model, 'requisites[value][bankname]', ['options' => ['class' => 'col-md-6']])->label('Наименование банка');
$l8 .= $form->field($model, 'requisites[value][bik]', ['options' => ['class' => 'col-md-6']])->label('БИК');
$l8 .= $form->field($model, 'requisites[value][ks]', ['options' => ['class' => 'col-md-6']])->label('Корреспондентский счет');
$l8 .= $form->field($model, 'requisites[value][rs]', ['options' => ['class' => 'col-md-6']])->label('Рассчетный счет');
$l8 .= '</div>' .
    '</div>' .
    '</div>' .
    '</div>';


echo Tabs::widget([
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
        [
            'label' => 'Доставка',
            'content' => $l5,

        ],
        [
            'label' => 'Платежные системы',
            'content' => $l6,

        ],
        [
            'label' => 'Реквизиты организации',
            'content' => $l8,

        ],
        [
            'label' => 'Категории',
            'content' => $l7,
        ],

    ]]); ?>

<div class="form-group">
    <?= Html::submitButton('Сохранить', ['class' => 'box btn', 'name' => 'partners-settings-button', 'style' => 'background: snow;']) ?>
</div>
<?php ActiveForm::end(); ?>

<script type="text/javascript">

    $(document).ready(function () {
        $("[name= 'tog']").click(function () {
            var $target = $(this).attr('data-toggle');

            if ($("div[toggle =" + $target + "]").is(':visible')) {
                $("div[toggle =" + $target + "]").hide();
                $(this).text('+');
            } else {
                $("div[toggle =" + $target + "]").show();
                $(this).text('-');
            }
        });
        (function () {
            function clicker(e) {
                var legendObject;
                var fieldsetObject;
                var controlCheckbox;

                var trigger = e.srcElement || e.target;
                if (!trigger.tagName || trigger.tagName.toLowerCase() != "input" || trigger.type.toLowerCase() != "checkbox") return;


                var testElement = trigger;
                while (testElement) {
                    if (!testElement.tagName) return;
                    var tagName = testElement.tagName.toLowerCase();
                    if (tagName == "legends") {
                        legendObject = testElement;
                    } else if (tagName == "li" && /(^|\s)+js-box(\s|$)+/.test(testElement.className)) {
                        fieldsetObject = testElement;
                        break;
                    }
                    testElement = testElement.parentNode;
                }
                ;
                if (!fieldsetObject) return;
                if (legendObject) {
                    var controlCheckboxValue = trigger.checked;
                    var inputs = fieldsetObject.getElementsByTagName("input");
                    for (var i = 0; i < inputs.length; i++) {
                        var input = inputs[i];
                        if (input.type.toLowerCase() == "checkbox" && input != controlCheckbox) {
                            input.checked = controlCheckboxValue;
                        }
                        ;
                    }
                    ;
                } else {

                    if (legendObject = fieldsetObject.getElementsByTagName("legends")[0]) {
                        var inputs = legendObject.getElementsByTagName("input");
                        for (var i = 0; i < inputs.length; i++) {
                            var input = inputs[i];
                            if (input.type.toLowerCase() == "checkbox") {
                                controlCheckbox = input;
                                break;
                            }
                            ;
                        }
                        ;
                    }
                    ;
                    if (!controlCheckbox) return;
                    var controlCheckboxValue = true;

                    var inputs = fieldsetObject.getElementsByTagName("input");
                    for (var i = 0; i < inputs.length; i++) {
                        var input = inputs[i];

                        if (input.type.toLowerCase() == "checkbox" && input != controlCheckbox && !input.checked) {
                            controlCheckboxValue = false;
                        }
                        ;
                    }
                    ;

                    controlCheckbox.checked = controlCheckboxValue;
                }
            };


            if (document.addEventListener) {
                document.addEventListener('change', clicker, true);
                document.addEventListener('click', clicker, true);
            } else {
                document.attachEvent('onchange', clicker);
                document.attachEvent('onclick', clicker);
            }
            ;
        })();
        $("legends").change(function () {
            var $addCategoriesArray = [];
            //   $data = $(this).getAttribute('data-categ');
            // console.log(this.childNodes);
        });
    });

</script>
