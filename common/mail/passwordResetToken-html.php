<?php
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $user common\models\User */
$contentutm = \frontend\widgets\UtmLinker::widget(['param'=>Yii::$app->params['params']['utm']]);
$resetLink = Yii::$app->urlManager->createAbsoluteUrl([BASEURL . '/reset-password', 'token' => $user->password_reset_token]);
?>
<div class="password-reset">
    <p>Здравствуйте <?= Html::encode($user->username) ?>,</p>

    <p>Перейдите по ссылке ниже что бы сбросить пароль:</p>

    <p><?= Html::a(Html::encode($resetLink), $resetLink.'&'.$contentutm) ?></p>
</div>
