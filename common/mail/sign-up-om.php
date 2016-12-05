<?php
$contentutm = \frontend\widgets\UtmLinker::widget(['param'=>Yii::$app->params['params']['utm']]);
?>
    <p style="font-family:'Roboto', Arial;padding:0 15px;margin:20px 0 10px 0;font-weight:bold;color:#000000;text-align:left;font-size:22px;">
        Уважаемая (ый) <?=$name; ?> при регистрации!
    </p>
    <p style="line-height:25px;padding:0 15px;margin:0 0 10px 0;color:#000000;text-align:left;font-family:'Roboto', Arial;font-size:16px;">
        Спасибо, что выбрали Одежда-Мастер! С нами выгодно и удобно работать.
    </p>
    <ul style="list-style:none;width:100%;text-align:center;padding: 0;margin:30px 0 0 0;">
        <li style="padding:10px;width:250px;display:inline-block;border:1px solid #41BCBA;border-radius:6px;margin:0 4px 10px 0;color:#41BCBA;font-family:'Roboto', Arial;font-size:14px;">
            <b>код клиента</b><br><?=$id; ?>
        </li>
        <li style="padding:10px;width:250px;display:inline-block;border:1px solid #EA516D;border-radius:6px;margin:0 4px 10px 0;color:#EA516D;font-family:'Roboto', Arial;font-size:14px;">
            <b>логин</b><br><?=$username; ?>
        </li>
        <li style="padding:10px;width:250px;display:inline-block;border:1px solid #fed517;border-radius:6px;margin:0 4px 10px 0;color:#ffd414;font-family:'Roboto', Arial;font-size:14px;">
            <b>пароль</b><br><?=$password; ?>
        </li>
    </ul>
    <p style="text-align:center;margin:10px 0 30px 0;">
        <a href="http://<?=$_SERVER['HTTP_HOST'].BASEURL;?>/lk/?<?=$contentutm;?>" target="_blank" style="font-weight:bold;text-decoration:underline;color:#007BC1;font-family:'Roboto', Arial;font-size:14px;">Перейти в личный кабинет</a>
    </p>
    