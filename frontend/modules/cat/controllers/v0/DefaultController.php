<?php

namespace frontend\modules\cat\controllers\v0;

use frontend\modules\cat\controllers\actions\ActionIndex;
use Yii;
use yii\web\Controller;

class DefaultController extends Controller
{
    use ActionIndex;

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
