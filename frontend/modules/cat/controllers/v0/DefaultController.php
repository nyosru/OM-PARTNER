<?php

namespace frontend\modules\cat\controllers\v0;

use frontend\modules\cat\controllers\actions\ActionIndex;
use frontend\modules\cat\controllers\actions\ActionLanding;
use frontend\modules\cat\controllers\actions\ActionUpdateConfig;
use Yii;
use yii\web\Controller;

class DefaultController extends Controller
{
    use ActionIndex;
    use ActionUpdateConfig;
    use ActionLanding;

    public function behaviors()
    {
        return [];
    }

    public function actions()
    {
        $this->layout = 'main';
        return 'Админка';
    }

}
