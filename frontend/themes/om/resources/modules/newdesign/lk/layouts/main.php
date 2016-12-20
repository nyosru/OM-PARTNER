<?php

echo $this->render('@app/themes/' . Yii::$app->params['constantapp']['APP_VERSION']['themesversion'] . '/resources/views/'.Yii::$app->params['constantapp']["APP_THEMES"].'/layouts/main',['content'=>$content]);

?>