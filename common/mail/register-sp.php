<?php
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $user common\models\User */

?>
<?php
$contentutm = \frontend\widgets\UtmLinker::widget(['param'=>Yii::$app->params['params']['utm']]);
?>
<p style="font-family:'Roboto', Arial;padding:0 15px;margin:20px 0 10px 0;font-weight:bold;color:#000000;text-align:left;font-size:22px;">
    Доброго времени суток!
</p>
<p style="line-height:25px;padding:0 15px;margin:0 0 10px 0;color:#000000;text-align:left;font-family:'Roboto', Arial;font-size:16px;">
    Вы зарегистрировались в реферальной системе интернет магазина Одежда-мастер<br>
    Ваш цифровой идентификатор <?=$ident;?><br>
    Ваша реферальная ссылка http://<?=$_SERVER['HTTP_HOST'].BASEURL;?>/invite?sp=<?=$refer;?><br>
</p>
<p style="text-align:center;margin:10px 0 30px 0;">
    Дальнейшие инструкции вы можете получить <a href="http://<?=$_SERVER['HTTP_HOST'].BASEURL;?>/sp-instruction">тут</a>
</p>
