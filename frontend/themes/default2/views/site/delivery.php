<?php
use yii\filters\AccessControl;
use yii\web\User;
/* @var $this yii\web\View */
?>
<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\bootstrap\Modal;
use yii\widgets\Pjax;
use yii\bootstrap\Button;
use yii\bootstrap\Dropdown;
use yii\bootstrap\Carousel;
use common\models\Partners;
use yii\helpers\BaseUrl;
use dosamigos\ckeditor\CKEditorInline;
use yii\jui\Slider;
use common\models\PartnersConfig;
$this -> title = 'Доставка';
?>
<div class="container" id="partners-main">
    <div class="container" id="partners-main-left-back">
        <div id="partners-main-left">
            <div id="partners-main-left-cont">
                <?
                $run = new Partners();
                $check = $run -> GetId($_SERVER['HTTP_HOST']);
                $checks = $run -> GetAllowCat($check);
                foreach ($catdata as $value) {
                    if (in_array(intval($value['categories_id']), $checks)) {
                        $catdataallow[] = $value;
                    }
                }
                for ($i = 0; $i < count($catdataallow); $i++) {
                    $row = $catdataallow[$i];
                    if (empty($arr_cat[$row['parent_id']])) {
                        $arr_cat[$row['parent_id']] = $row;
                    }
                    $arr_cat[$row['parent_id']][] = $row;
                }
                foreach ($categories as $value) {
                    $catnamearr[$value['categories_id']] = $value['categories_name'];
                }
                function view_cat($arr, $parent_id = 0, $catnamearr, $allow_cat) {
                    if (empty($arr[$parent_id])) {
                        return;
                    } else {
                        if ($parent_id !== 0) {$style = 'style="display: none;"';
                        }
                        echo '<ul id="accordion" class="accordion" ' . $style . '">';
                        for ($i = 0; $i < count($arr[$parent_id]); $i++) {
                            $catdesc = $arr[$parent_id][$i]['categories_id'];
                            if (!$arr[$parent_id][$i] == '') {
                                echo '<li class=""><div class="link data-j" data-j="on" data-cat="' . $catdesc . '">' . $catnamearr["$catdesc"] .'</div>';
                                view_cat($arr, $arr[$parent_id][$i]['categories_id'], $catnamearr, $allow_cat);
                                echo '</li>';
                            }
                        }
                        echo '</ul>';
                    }
                }
                ?><div class="header-catalog"><i class="fa fa-bars"></i> КАТАЛОГ ТОВАРОВ
                </div><?
                view_cat($arr_cat, 0, $catnamearr, $check);
                ?>
            </div>
            <div id="filters">
                <div id="price-lable" style="display:none;">
                    Цена </div>

                <div id="min-price" class="btn" style="display:none">0</div><div style="display:none" id="max-price" class="btn">10000</div>

            </div>
        </div>
    </div>
    <div class="container-fluid" id="partners-main-right-back">
        <div id="partners-main-right" class="bside">

            <?php if(Yii::$app->user->can('admin')){CKEditorInline::begin(['preset' => 'standart']);}
            $data = new PartnersConfig();
            $run = new Partners();
            $check = $run->GetId($_SERVER['HTTP_HOST']);
            $page = 'delivery';
            $data = $data->find()->where(['partners_id' => $check, 'type' => $page])->one();
            if($data){
            echo $data->value;
            }else{?>


                НАЖМИТЕ ТУТ ЧТО БЫ ИЗМЕНИТЬ ОПИСАНИЕ
            <?}?>
            <?php if(Yii::$app->user->can('admin')){CKEditorInline::end(); ?>
                <button class="savehtml">Сохранить</button>
                <script>
                    $(document).on('click', '.savehtml', function() {
                        $html = $('.cke_editable').html();


                        $.post(
                            "/site/savehtml",
                            { html: $html,
                                page: 'delivery'}
                        );
                        alert('Изменения сохранены');

                    });
                </script>
            <?}?>
        </div>
    </div>

