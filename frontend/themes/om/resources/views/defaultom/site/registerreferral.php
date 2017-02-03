<?php

$this -> title = 'Успешная регистрация';
?>
<style>
    .ref-register::before{
        content: '';
        position: absolute;
        bottom: calc(20% - 2px);
        right: 0;
        width: 70%;
        height: 5px;
        z-index: 2;
        background-color: #ffbf08;
    }
    .ref-register{
        font-size: 28px;
        font-weight: 700;
        display: inline-block;
        padding-bottom: 20px;
        color: #333;
        position: relative;
        font-family: 'Raleway', sans-serif;
        margin: 0px;
        background: none;
        line-height: 1.6em;
    }
    .ref-info{
        border-radius: 4px;
        padding: 5px;
        height: 40px;
        position: relative;
        background-color: rgb(234, 81, 109);
        border-color: rgb(234, 81, 109);
        color: white;
        left: -5px;
        margin-right: 0px;
        float: left;
    }
    .ref-text{
        height: 40px;
        color: rgb(119, 119, 119);
        border: 1px solid rgb(204, 204, 204);
        border-radius: 4px;
        padding: 5px;
        font-size: 20px;
    }
    .ref-block{
        color: rgb(119, 119, 119);
        border: 1px solid rgb(204, 204, 204);
        border-radius: 4px;
        padding: 5px;
        font-size: 20px;
        margin: 10px;
    }
</style>

<div class="" style="text-align: center;">
    <h1 class="ref-register"> Вы успешно зарегистрировались!</h1>
</div>
<div class="col-md-12">
<div class="col-md-8 ref-info" style="font-size: 20px;"> Мы отправили Ваш пароль на почту</div>
<div class="col-md-4 ref-text"><?=$data['user']['email']?></div>
</div>
<div class="col-md-12">
<div class="col-md-12 ref-block">
<div style="font-size: 20px; width: 40%;margin: 20px;" > Данные вашего организатора СП</div>
    <div class="col-md-6" style="font-size: 20px"> ФИО </div>
    <div class="col-md-6" style="font-size: 20px"><?=$data['referral']['lastname'].' '.$data['referral']['name'].' '.$data['referral']['secondname']?></div>
    <div class="col-md-6" style="font-size: 20px"> Элетронная почта </div>
    <div class="col-md-6" style="font-size: 20px"><?=$data['referral']['email']?></div>
    <div class="col-md-6" style="font-size: 20px"> Телефон </div>
    <div class="col-md-6" style="font-size: 20px"><?=$data['referral']['telephone']?></div>
    <div class="col-md-6" style="font-size: 20px"> Процент организатора </div>
    <div class="col-md-6" style="font-size: 20px"><?=$data['referral']['percent']?></div>
</div>
</div>
    <script>
    if(typeof(ga) != 'undefined') {
        ga("send", "event", "register");
    }
    </script>