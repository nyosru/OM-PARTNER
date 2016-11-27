<?php
use yii\bootstrap\Modal;
use yii\bootstrap\ActiveForm;
use yii\bootstrap\Html;

?>
<tr>
    <td><?=$model->domain?></td>
    <td><?=$model->template?></td>
    <td><?=$model->version?></td>
    <td>
        <?php
        echo $model->status ?
            '<span class="glyphicon glyphicon-ok"></span>' :
            '<span class="glyphicon glyphicon-remove"></span>';
        ?>
    </td>
    <td>
        <?php
        Modal::begin([
            'header' => '<h2>'.$model->domain.'</h2>',
            'toggleButton' => [
                'tag' => 'button',
                'class' => 'btn btn-block btn-primary',
                'label' => 'Изменить',
            ]
        ]);

        $form = ActiveForm::begin([
            'action' => ['save-domain','id_domain'=>$model->id,'id'=>$model->partner_id],
        ]);

        echo $form->field($model, 'domain')->textInput();

        echo $form->field($model, 'template')->textInput();

        echo $form->field($model, 'version')->textInput();

        echo $form->field($model, 'status')->checkbox(['id'=>'checkbox_form_'.$model->id]);

        echo Html::submitButton('Сохранить', ['class' => 'btn btn-primary']);

        ActiveForm::end();

        Modal::end();
        ?>
    </td>
</tr>
