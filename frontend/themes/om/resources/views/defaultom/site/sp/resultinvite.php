<?php
/**
 * Created by PhpStorm.
 * User: dmitriy
 * Date: 13.05.16
 * Time: 10:47
 */
?>
<style>
    .loading {
        position: absolute;
        left: 50%;
        top: 50%;
        margin: -60px 0px 0px -60px;
        background: #FFF none repeat scroll 0% 0%;
        width: 60px;
        height: 60px;
        border-radius: 100%;
        border: 3px solid rgb(0, 165, 162);
    }
    .loading::after {
        content: "";
        height: 120%;
        position: absolute;
        border-radius: 100%;
        top: -10%;
        left: -10%;
        opacity: 0.7;
        box-shadow: -4px -5px 3px -5px rgb(255, 191, 8);
        animation: 2s linear 0s normal none infinite running rotate;
        width: 120%;
    }
    .loading::before {
        content: "";
        height: 80%;
        position: absolute;
        border-radius: 100%;
        top: 10%;
        left: 10%;
        opacity: 0.7;
        box-shadow: -4px -5px 3px -5px rgb(234, 81, 109);
        animation: 2s linear 0s normal none infinite running inversrotate;
        width: 80%;
    }
    @keyframes rotate {
        0% {
            transform: rotateZ(0deg);
        }
        100% {
            transform: rotateZ(360deg);
        }
    }
    @keyframes inversrotate {
        0% {
            transform: rotateZ(360deg);
        }
        100% {
            transform: rotateZ(0deg);
        }
    }
    </style>

<?php
$this->title = 'Инвайт СП';
switch ($type){
    case 'maxlimit':
        echo 'Превышен лимит приглашений';
        break;
    case 'time':
        echo '<span id="" href="#">Повторная попытка доступна через:</span>';
        echo '<div class="loading"><span style=" color:#000; top: 0px; position: absolute; bottom: 0px; height: 45%; margin: auto; left: 0px; right: 0px; width: 100%; font-weight: 400; font-size: 18px; text-align: center;" id="RealButton" href="#">60</span></div>';
        echo '<span style="z-index: 99999;color: #000;" id="RealButton"  href="#">60</span>';
        break;
    case 'no-email':
        echo 'Не указан почтовый ящик';
        break;
    case 'success':
        echo '<span id="" href="#">Успешная отправка. Повторная попытка доступна через:</span>';
        echo '<span style="z-index: 99999;color: #000;" id="RealButton" href="#">60</span>';
        break;
    default:

}
?>

<script type="text/javascript">
    $(window).onload(function timer() {
        var obj = document.getElementById('RealButton');
        var regexp = /(\d+)/i;
        var RealTimer = regexp.exec(obj.innerHTML)[0];
        RealTimer = RealTimer - 1;
        if (RealTimer < 0) RealTimer = 0;
        obj.innerHTML =  RealTimer ;
        if (RealTimer == 0) {
            location.replace("#");
            return true;
        }
        else {
            setTimeout(timer, 1000);
        }
    }
    setTimeout(timer, 1000);
    );
</script>