<?php

/* @var $this yii\web\View */
/* @var $user common\models\User */

$resetLink = Yii::$app->urlManager->createAbsoluteUrl([BASEURL . '/reset-password', 'token' => $user->password_reset_token]);
?>
Здравствуйте <?= $user->username ?>,

Перейдите по ссылке ниже чтобы сбросить пароль:

<?= $resetLink ?>
