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

if($page && ($action = Yii::$app->request->getQueryParam('action')) == FALSE && $action !=="refresh"){
    echo stripcslashes($page->content);
}elseif(Yii::$app->user->can('admin')){
    //$page = new \common\models\PartnersPage();
    $form = ActiveForm::begin([
        'options'=>[
        'action'=>'ad',
        'style'=>'float: left; width: 100%;']
    ]);
    //echo $form->field($page, 'name');
    echo $form->field($page, 'content')->widget('\vova07\imperavi\Widget',[
        'settings' => [
            'verifiedTags' => ['div','a', 'img', 'b', 'strong', 'sub', 'sup', 'i', 'em', 'u', 'small', 'strike', 'del', 'cite', 'ul', 'ol', 'li'],
            'lang' => 'ru',
            'minHeight' => 200,
            'plugins' => ['fontsize','fontcolor', 'table']]]);

    echo '<div class="form-group">'.Html::submitButton('Сохранить', ['class' => 'btn btn-primary', 'name' => 'login-button']).'</div>';
    $form = ActiveForm::end();
}else{
    echo 'Страница не найдена';
}

?>


