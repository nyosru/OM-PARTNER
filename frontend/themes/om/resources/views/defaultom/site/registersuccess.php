<?php

$this -> title = 'Успешная регистрация';
?>
<div class="index-card-4" style="text-align: center;">

    <h1> Вы успешно зарегистрировались!</h1>

</div>
<script>
    if(typeof(ga) != 'undefined') {
        ga("send", "event", "register");
    }
    </script>