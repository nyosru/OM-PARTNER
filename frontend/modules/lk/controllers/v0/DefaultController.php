<?php

namespace frontend\modules\lk\controllers\v0;
use frontend\modules\lk\controllers\actions\ActionMenu;
use frontend\modules\lk\controllers\actions\ActionViewCart;
use yii\web\Controller;

use Yii;
use common\traits\Hide_manufacturers_for_partners;
use common\traits\ManufacturersDiapazonData;
use frontend\modules\lk\controllers\actions\ActionIndex;
use frontend\modules\lk\controllers\actions\ActionMyorder;
use frontend\modules\lk\controllers\actions\ActionUserinfo;
use frontend\modules\lk\controllers\actions\ActionClaims;
use frontend\modules\lk\controllers\actions\ActionOrderedproducts;

/**
 * Контроллер Личный кабинет
 */
class DefaultController extends Controller
{

    use ManufacturersDiapazonData,
        Hide_manufacturers_for_partners,
        ActionIndex,
        ActionUserinfo,
        ActionClaims,
        ActionOrderedproducts,
        ActionMenu,
        ActionViewCart,
        ActionMyorder;
}



