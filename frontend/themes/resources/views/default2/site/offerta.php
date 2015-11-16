<?php
use yii\filters\AccessControl;
use yii\web\User;
/* @var $this yii\web\View */
?>
<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\bootstrap\Modal;
use yii\bootstrap\Button;
use yii\bootstrap\Dropdown;
use yii\bootstrap\Carousel;
use yii\helpers\BaseUrl;
use dosamigos\ckeditor\CKEditorInline;
use yii\jui\Slider;
use common\models\PartnersConfig;

$this -> title = 'Оферта';

?>
<div class="container" id="partners-main">
    <div class="container" id="partners-main-left-back">
        <div id="partners-main-left">
            <div id="partners-main-left-cont">
                <?
                ?><div class="header-catalog"><i class="fa fa-bars"></i> КАТАЛОГ ТОВАРОВ
                </div><?
              echo $view
                ?>
            </div>
            <div id="filters">
                <div id="price-lable" style="display:none;">
                    Цена </div>

                <div id="min-price" class="btn" style="display:none">0</div><div style="display:none" id="max-price" class="btn">10000</div>

            </div>
            <? if (isset(Yii::$app->params['partnersset']['newsonindex']['value']) && Yii::$app->params['partnersset']['newsonindex']['active'] == 1) { ?>
                <div id="partners-main-left-cont">
                    <div class="header-catalog"><i class="fa fa-bars"></i> НОВОСТИ
                    </div>
                    <?
                    $newsprovider = new \yii\data\ActiveDataProvider([
                        'query' => \common\models\PartnersNews::find()->where(['partners_id' => Yii::$app->params['constantapp']['APP_ID']])->orderBy('date_modified'),
                        'pagination' => [
                            'defaultPageSize' => intval(Yii::$app->params['partnersset']['newsonindex']['value']),
                        ],
                    ]);
                    $newsprovider = $newsprovider->getModels();
                    if (!$newsprovider) {
                        echo 'Новости отсутствуют';
                    } else {
                        foreach ($newsprovider as $valuenews) {
                            echo '<div>';
                            echo '<span style="background: rgb(255, 191, 8) none repeat scroll 0% 0%; padding: 4px 14px; width: 100%; box-shadow: 2px 1px 5px -4px black;">' . $valuenews->date_modified . '</span><br/>';
                            echo '<span style="padding: 10px 25px; margin: 0px; display: block; background: rgb(255, 191, 8) none repeat scroll 0% 0%;">' . $valuenews->name . '</span>';
                            $search = array("'<script[^>]*?>.*?</script>'si",
                                "'<[\/\!]*?[^<>]*?>'si",
                                "'([\r\n])[\s]+'",
                                "'&(quot|#34);'i",
                                "'&(amp|#38);'i",
                                "'&(lt|#60);'i",
                                "'&(gt|#62);'i",
                                "'&(nbsp|#160);'i",
                                "'&(iexcl|#161);'i",
                                "'&(cent|#162);'i",
                                "'&(pound|#163);'i",
                                "'&(copy|#169);'i",
                                "'&#(\d+);'e");

                            $replace = array("",
                                "",
                                "\\1",
                                "\"",
                                "&",
                                "<",
                                ">",
                                " ",
                                chr(161),
                                chr(162),
                                chr(163),
                                chr(169),
                                "chr(\\1)");

                            $text = preg_replace($search, $replace, $valuenews->post);
                            echo '<span style="padding: 0px 10px; display: block; margin: 10px;">' . mb_substr($text, 0, 180, 'UTF-8') . '...</span> <br/>';

                            echo '</div>';
                        }
                    }
                    ?>
                </div>
            <? } ?>
        </div>
    </div>
    <div class="container-fluid" id="partners-main-right-back">
        <div id="partners-main-right" class="bside">

            <?php if(Yii::$app->user->can('admin')){CKEditorInline::begin(['preset' => 'standart']);}
            $data = new PartnersConfig();
            $check = Yii::$app->params['constantapp']['APP_ID'];
            $page = 'offerta';
            $data = $data->find()->where(['partners_id' => $check, 'type' => $page])->one();
            if($data){
            echo stripcslashes($data->value);
            }else{?>


                НАЖМИТЕ ТУТ ЧТО БЫ ИЗМЕНИТЬ ОПИСАНИЕ
            <?}?>
            <?php if(Yii::$app->user->can('admin')){CKEditorInline::end(); ?>
                <button class="savehtml">Сохранить</button>
                <script>
                    $(document).on('click', '.savehtml', function() {
                        $html = $('.cke_editable').html();


                        $.post(
                            '/site/savehtml',
                            { html: $html,
                                page: 'offerta'}
                        );
                        alert('Изменения сохранены');

                    });
                </script>
            <?}?>
        </div>
    </div>

