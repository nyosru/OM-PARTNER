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


$this -> title = 'Доставка';

?>


            <?php if(Yii::$app->user->can('admin')){CKEditorInline::begin(['preset' => 'standart']);}
            $data = new PartnersConfig();
            $check = Yii::$app->params['constantapp']['APP_ID'];
            $page = 'delivery';
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
                                page: 'delivery'}
                        );
                        alert('Изменения сохранены');

                    });
                </script>
            <?}?>

