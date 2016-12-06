<?php
namespace frontend\modules\sp\controllers\actions;

use common\forms\PartnersOrders\CommentForm;
use common\models\CommonOrders;
use common\models\PartnersOrders;
use common\models\Referrals;
use common\models\ReferralsUser;
use Yii;
use yii\data\ActiveDataProvider;
use yii\data\Pagination;
use yii\helpers\BaseHtmlPurifier;
use yii\validators\DateValidator;
use yii\widgets\Pjax;


trait ActionAddPositionOrderComments
{
    public function actionAddPositionOrderComments()
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
            echo '<div>Комментарий к продукту сохранены</div>';
        }
        echo $form->field($formmodel, 'attr',['options'=>['style'=>'display:none']])->label(false)->hiddenInput();
        echo $form->field($formmodel, 'id',['options'=>['style'=>'display:inline-block; margin:10px']])->label('Продукт '. $formmodel->id)->hiddenInput();
        echo $form->field($formmodel, 'order',['options'=>['style'=>'display:inline-block; margin:10px']])->label('Заказ № '. $formmodel->order)->hiddenInput();
        echo '<input style="display:inline-block; margin:10px; width:50%; border:none" value="http://'.$_SERVER['HTTP_HOST'].'/'.BASEURL.'product?id='.$formmodel->id.'">';
        echo '</div>';
        echo '<img class="col-md-4" style="display: inline-block;width: 20%;clear: both;" src="/imagepreview?src='.$formmodel->id.'">';
        echo $form->field($formmodel, 'comment', ['options'=> ['style'=>'display:inline-block;width:80%', 'class'=>'col-md-8']])
            ->label(false)->textarea(['rows' => '6',
            'style'=>'resize: vertical;display:inline-block;width:100%;min-height: 100px;']);
        echo \yii\helpers\Html::submitButton('Сохранить', ['class' => 'btn btn-primary', 'name' => 'common', 'style'=>"margin: 15px;"]);
          $form = \yii\bootstrap\ActiveForm::end();
        echo '</div>';
    }
}