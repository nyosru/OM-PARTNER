<?php

namespace frontend\modules\cat\controllers\v0;

use frontend\modules\cat\controllers\actions\ActionIndex;
use frontend\modules\cat\controllers\actions\ActionPreviewLand;
use Yii;
use yii\web\Controller;

class DefaultController extends Controller
{
    use ActionIndex;
    use ActionPreviewLand;

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
