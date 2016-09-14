<?php
/**
 * Created by PhpStorm.
 * User: dmitriy
 * Date: 13.05.16
 * Time: 10:47
 */
?>

<script type="text/javascript">
    function timer() {
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
</script>
<?php
$this->title = 'Инвайт СП';
switch ($type){
    case 'maxlimit':
        echo 'Превышен лимит приглашений';
        break;
    case 'time':
        echo '<span id="" href="#">Повторная попытка доступна через:</span>';
        echo '<div class="loading"><span style="top: 0px; position: absolute; bottom: 0px; height: 45%; margin: auto; left: 0px; right: 0px; width: 100%; font-weight: 400; font-size: 18px; text-align: center;" id="RealButton" href="#">60</span></div>';
        echo '<span id="RealButton"  href="#">60</span>';
        break;
    case 'no-email':
        echo 'Не указан почтовый ящик';
        break;
    case 'success':
        echo '<span id="" href="#">Успешная отправка. Повторная попытка доступна через:</span>';
        echo '<span id="RealButton" href="#">60</span>';
        break;
    default:

}
?>

