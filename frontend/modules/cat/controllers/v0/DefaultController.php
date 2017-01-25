<?php

namespace frontend\modules\cat\controllers\v0;

use frontend\modules\cat\controllers\actions\ActionConfigList;
use frontend\modules\cat\controllers\actions\ActionDeleteConfig;
use frontend\modules\cat\controllers\actions\ActionIndex;
use frontend\modules\cat\controllers\actions\ActionLanding;
use frontend\modules\cat\controllers\actions\ActionUpdateConfig;
use Yii;
use yii\web\Controller;

class DefaultController extends Controller
{
    use ActionLanding;

    public function behaviors()
    {
        return [];
    }

    public function actions()
    {
        $this->layout = 'main_land';
        return 'Админка';
    }

}
