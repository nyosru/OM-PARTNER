<?php

namespace frontend\modules\lk\controllers\vsp0;
use yii\web\Controller;

use Yii;
use common\traits\Hide_manufacturers_for_partners;
use common\traits\ManufacturersDiapazonData;
use frontend\modules\lk\controllers\actions\sp\ActionIndex;
use frontend\modules\lk\controllers\actions\sp\ActionMyorder;

/**
 * Контроллер Личный кабинет СП
 */
class DefaultController extends Controller
{

    use ManufacturersDiapazonData,
        Hide_manufacturers_for_partners,
        ActionIndex,
        ActionMyorder;

    public function behaviors()
    {
        return [];
    }

    public function actions()
    {
        $this->layout = 'main';
        return 'Личный кабинет';
    }
}



