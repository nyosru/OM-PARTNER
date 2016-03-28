<?php
namespace frontend\controllers\actions\om;

use common\models\PartnersPage;
use yii\bootstrap\Tabs;
use Faker\Provider\zh_TW\DateTime;
use Yii;
use common\models\PartnersConfig;

trait ActionDayProduct
{
    public function actionDayproduct()
    {

        $this->layout = 'main';
        return $this->render('dayproduct', []);

    }
}