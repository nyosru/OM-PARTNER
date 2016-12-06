<?php
namespace frontend\modules\sp\controllers\actions;

use common\models\CommonOrders;
use common\models\Referrals;
use Yii;
use yii\data\ActiveDataProvider;
use yii\data\Pagination;
use yii\validators\DateValidator;


trait ActionAddClientOrderComments
{
    public function actionAddClientOrderComments()
    {
        $formmodel = new CommentForm();
        if(Yii::$app->request->isAjax){
            $formmodel->attr =  (integer)Yii::$app->request->post('attr');
            $formmodel->id = (integer)Yii::$app->request->post('id');
            $formmodel->order = (integer)Yii::$app->request->post('order');
            $formmodel->loadComment();
        }
        if (Yii::$app->request->isPost){
            $formmodel->load(Yii::$app->request->post());
        }
        if($comment = (Yii::$app->request->post('comments')) == TRUE){
            $comment =   BaseHtmlPurifier::process($comment);
            $formmodel->comments = $comment;
        }
        echo '<div class="comment-content-body">';
        $form = \yii\bootstrap\ActiveForm::begin([
            'options' => ['data-pjax' => true],
            'id'=>'product-comment',
            'action'=>'/sp/add-position-order-comments',
            'method'=> 'post',
            'enableClientScript' => true
        ]);
        echo '<div>';

        if( $formmodel->validate() && $formmodel->saveComment()){
            echo '<div>Комментарий к заказу сохранен</div>';
        }
        echo $form->field($formmodel, 'order',['options'=>['style'=>'display:inline-block; margin:10px']])->label('Заказ № '. $formmodel->order)->hiddenInput();
        echo '<input style="display:inline-block; margin:10px; width:50%; border:none" value="http://'.$_SERVER['HTTP_HOST'].'/'.BASEURL.'product?id='.$formmodel->id.'">';
        echo '</div>';
        echo $form->field($formmodel, 'comment', ['options'=> ['style'=>'display:inline-block;width:80%', 'class'=>'col-md-8']])
            ->label(false)->textarea(['rows' => '6','options'=>[
                'style'=>'display:inline-block;width:80%;min-height: 100px;']]);
        echo \yii\helpers\Html::submitButton('Сохранить', ['class' => 'btn btn-primary', 'name' => 'common', 'style'=>"margin: 15px;"]);
        $form = \yii\bootstrap\ActiveForm::end();
        echo '</div>';
    }
}