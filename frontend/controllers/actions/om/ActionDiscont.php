<?php
namespace frontend\controllers\actions\om;

use common\models\PartnersPage;
use yii\bootstrap\Tabs;
use Faker\Provider\zh_TW\DateTime;
use Yii;
use common\models\PartnersConfig;

trait ActionDiscont
{
    public function actionDiscont()
    {

        $this->layout = 'main';
        return $this->render('discont');

    }
}