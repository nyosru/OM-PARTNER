<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\bootstrap\Modal;
use yii\bootstrap\Button;
use yii\bootstrap\Dropdown;
use common\models\User;

$this->title = 'Партнеры';
$this->registerCssFile('/css/partners.css');
?>

<div class="container" id="partners-head">
    <div class="container" id="partners-left-head-back">
        <div id='partners-left-head'>
            <div><?
                echo Html::input('text', 'username', $user->name, ['class' => 'form-control', 'placeholder' => 'Имя партнера', 'id' => '']);
                ?></div>
            <div id="partners-left-head-two-row"><?
                ?><span><?
                    echo Button::widget(['label' => '<', 'id' => 'cback', 'options' => ['class' => 'btn-sm btn-info', 'href' => '/partners/?step=1'], 'tagName' => 'a']);
                    echo Button::widget(['label' => '>', 'id' => 'cforvard', 'options' => ['class' => 'btn-sm btn-info', 'href' => '/partners/?step=1'], 'tagName' => 'a']);
                    ?></span><?
                Modal::begin(['header' => '<h4>Добавить партнера</h4>', 'toggleButton' => ['label' => 'Добавить', 'tag' => 'button', 'class' => 'btn btn-sm btn-info', 'id' => 'partners-add-comp']]);
                $form = ActiveForm::begin(['action' => '/partners/default/save']);
                echo $form->field($model, 'name');
                echo $form->field($model, 'domain');
                echo $form->field($model, 'template');
                echo Html::submitButton(Yii::t('app', 'Отправить'), ['class' => 'btn btn-primary', 'id' => 'act']);
                ActiveForm::end();
                Modal::end();
                ?></div>
        </div>
    </div>
    <div class="container-fluid" id="partners-right-head-back">
        <div id="partners-main-right">
            <div class="col-sm-6"><p>Текстовый идентификатор партнера: <?= $partners_info->name; ?></p></div>
            <div class="col-sm-6"><p>Числовой идентификатор партнера: <?= $partners_info->id; ?></p></div>
            <div class="col-sm-6"><p>Адрес сайта на котором работает магазин: <a target="_blank"
                                                                                 href="http://<?= $partners_info->domain; ?>"><?= $partners_info->domain; ?></a>
                </p></div>
            <div class="col-sm-6"><p>Учетная запись ОМ связанная с партером: <?= $partners_info->customers_id; ?></p>
            </div>
        </div>
    </div>
</div>
<div class="container" id="partners-main">
    <div class="container" id="partners-main-left-back">
        <div id="partners-main-left">

            <div id="partners-main-left-cont">


                <?
                foreach ($data as $key => $value) {
                    echo Html::beginTag('div', ['class' => 'small-box bg-green']);

                    echo Html::BeginTag('div', ['class' => 'inner']);

                    echo Html::BeginTag('h4', ['class' => '']) . $value['name'] . Html::EndTag('h4');

                    echo Html::BeginTag('div', ['class' => 'partners-comp-domain']) . $value['domain'] . Html::EndTag('div');
                    echo Html::EndTag('div');
                    echo Html::BeginTag('span', ['class' => 'icon']) . $value['id'] . Html::EndTag('span');


                    echo html::beginTag('a', ['href' => "?id=" . $value['id'], 'class' => 'small-box-footer href']);
                    ?>Больше информации <i class="fa fa-arrow-circle-right"></i><?
                    echo Html::EndTag('a');
                    echo Html::EndTag('div');

                }
                ?>

            </div>

        </div>
    </div>
    <div class="container-fluid" id="partners-main-right-back">
        <div id="partners-main-right">
            <?
            for ($i = 0; $i < count($catdata); $i++) {
                $row = $catdata[$i];
                if (empty($arr_cat[$row['parent_id']])) {
                    $arr_cat[$row['parent_id']] = $row;
                }
                $arr_cat[$row['parent_id']][] = $row;
            }
            foreach ($categories as $value) {
                $catnamearr[$value['categories_id']] = $value['categories_name'];
            }
            function view_cat($arr, $parent_id = 0, $catnamearr)
            {
                if (empty($arr[$parent_id])) {
                } else {
                    echo '<button type="button" name="tog" class="btn-xs btn-info btn" data-toggle="' . $arr[$parent_id]['parent_id'] . '" id="group" >+</button><div  id="categoriesdiv" toggle="' . $arr[$parent_id]['parent_id'] . '" style="display:none;"><ul id = "categories" class="dropdown">';


                    for ($i = 0; $i < count($arr[$parent_id]); $i++) {
                        $catdesc = $arr[$parent_id][$i]['categories_id'];


                        if (!$arr[$parent_id][$i] == '') {
                            echo '<li id="categoriessub" class="js-box"><legends><label><input type="checkbox" data="categ" name="group[' . $arr[$parent_id][$i]['categories_id'] . ']" cat-toggle="' . $arr[$parent_id][$i]['categories_id'] . '"/></label></legends><a href="#">'
                                . $catnamearr["$catdesc"] . '</a>';


                            view_cat($arr, $arr[$parent_id][$i]['categories_id'], $catnamearr);


                            echo '</li>';
                        }
                    }
                    echo '</ul></div>';

                }
            }

            ?>

            <div class="box box-warning box-solid collapsed-box">
                <div class="box-header with-border">
                    <h3 class="box-title">Изменение данных партнера</h3>

                    <div class="box-tools pull-right">
                        <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i></button>
                    </div>
                    <!-- /.box-tools -->
                </div>
                <!-- /.box-header -->
                <div style="display: none;" class="box-body">
                    <?php $form = ActiveForm::begin(['id' => 'partners', 'action'=> '/partners/default/update']); ?>
                    <?= $form->field($model, 'id')->hiddenInput(['value' => $partners_info->id])->label(false); ?>
                    <div class="col-sm-6">
                        <?= $form->field($model, 'name')->textInput(['value' => $partners_info->name])->label('Строковый идентификатор') ?>
                    </div><div class="col-sm-6">
                        <?= $form->field($model, 'domain')->textInput(['value' => $partners_info->domain])->label('Домен') ?>
                    </div><div class="col-sm-6">
                        <?= $form->field($model, 'template')->textInput(['value' => $partners_info->template])->label('Шаблон') ?>
                    </div><div class="col-sm-6">
                        <?= $form->field($model, 'customers_id')->textInput(['value' => $partners_info->customers_id])->label('Пользователь ОМ') ?>
                    </div>
                    <div class="form-group">
                        <?= Html::submitButton('Сохранить', ['class' => 'btn btn-primary', 'name' => 'form-button']) ?>
                    </div>
                    <?php ActiveForm::end(); ?>
                </div>
                <!-- /.box-body -->
            </div>
            <div class="box box-warning box-solid collapsed-box">
                <div class="box-header with-border">
                    <h3 class="box-title">Привелегии администратора</h3>

                    <div class="box-tools pull-right">
                        <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i></button>
                    </div>
                    <!-- /.box-tools -->
                </div>
                <!-- /.box-header -->
                <div style="display: none;" class="box-body">

                  <?

                  $users = User::find()->where(['role' => 'admin', 'id_partners' => $partners_info->id])->asArray()->all();


                  ?>
                    <table id="user-admin" class="responsive hover stripe cell-border"></table>
                    <table id="user-admin-add" class="responsive hover stripe cell-border"></table>

                    <div class="btn btn-primary" id="add-user-admin-btn" data-partner="<?=$partners_info->id?>">Добавить</div>

                </div>
                <!-- /.box-body -->
            </div>

            <div class="box box-warning box-solid collapsed-box">
                <div class="box-header with-border">
                    <h3 class="box-title">Управление категориями</h3>

                    <div class="box-tools pull-right">
                        <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i></button>
                    </div>
                    <!-- /.box-tools -->
                </div>
                <!-- /.box-header -->
                <div style="display: none;" class="box-body">

                    <?
                    view_cat($arr_cat, 0, $catnamearr); ?>

                </div>
                <!-- /.box-body -->
            </div>
        </div>
    </div>
</div>



