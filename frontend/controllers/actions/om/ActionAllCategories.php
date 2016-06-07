<?php
namespace frontend\controllers\actions\om;

use common\models\PartnersPage;
use yii\bootstrap\Tabs;
use Faker\Provider\zh_TW\DateTime;
use Yii;
use common\models\PartnersConfig;

trait ActionAllCategories
{
    public function actionAllcategories()
    {


            return $this->render('allcategories');



    }
}