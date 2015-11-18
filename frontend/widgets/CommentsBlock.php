<?php

namespace frontend\widgets;

use common\traits\Trim_Tags;
use Yii;
use yii\helpers\Html;

class CommentsBlock extends \yii\bootstrap\Widget
{
    use Trim_Tags;
    public function init()
    {
        ?>
        <div id="partners-main-left-cont">
            <div class="header-catalog"> Отзывы о нашем магазине
            </div>
        <?
        $commentsprovider = new \yii\data\ActiveDataProvider([
            'query' => \common\models\PartnersComments::find()->where(['partners_id' => Yii::$app->params['constantapp']['APP_ID'], 'status' => '1'])->orderBy(['date_modified' => SORT_DESC, 'id' => SORT_DESC]),
            'pagination' => [
                'defaultPageSize' => intval(Yii::$app->params['partnersset']['commentsonindex']['value']),
            ],
        ]);
        $commentsprovider = $commentsprovider->getModels();
        if (!$commentsprovider) {
            echo 'Комментарии отсутствуют';
        } else {
            foreach ($commentsprovider as $valuecomments) {
                echo '<div>';
                echo '<span style=" none repeat scroll 0% 0%; padding: 4px 25px; width: 100%; box-shadow: 2px 1px 5px -4px black;">' . $valuecomments->date_modified . '</span><br/>';
                $text = $this->trim_tags_text($valuecomments->post, 400);
                echo '<span style="padding: 10px 25px; margin: 0px; display: block; none repeat scroll 0% 0%; font-style: italic;">' . $text . '</span>';
                echo '</div>';
            }

        }
        echo '<div>';
        if (!Yii::$app->user->isGuest) {
            $modelform = new \common\models\PartnersComments();
            $form = \yii\bootstrap\ActiveForm::begin(['id' => 'comments_add', 'action' => '/site/newcomments', 'options' => ['style' => 'width: 95%;margin: auto;']]);
            $l1 = '<div>';
            $l1 .= $form->field($modelform, 'post')->label('Текст комментария')->textarea(['rows' => 6, 'style' => 'resize:none;']);
            $l1 .= '</div>';
            $l1 .= '<div class="form-group">';
            $l1 .= Html::submitButton('отправить', ['class' => 'sendcomments-button btn btn-primary ', 'name' => 'partners-settings-button']);
            $l1 .= '</div>';
            echo $l1;
            \yii\bootstrap\ActiveForm::end();
        } else {
            echo 'Вы должны быть авторизованы для добавления отзыва';
        }
        echo '</div>';
        echo '</div>';

    }
}
