<?php
namespace frontend\controllers\actions\om;


use common\models\Featured;
use Yii;
use common\models\PartnersProductsToCategories;

trait ActionSiteIndex
{
    public function actionIndex()
    {

        if (isset(Yii::$app->params['partnersset']['slogan']['value']) && Yii::$app->params['partnersset']['slogan']['active'] == 1) {
            $title = $this->trim_tags_text(Yii::$app->params['partnersset']['slogan']['value']);
        } else {
            $title = Yii::$app->params['constantapp']['APP_NAME'];
        }
        $newproducts = $this->NewProducts(60, 'ef1923ef-', 600);
        $dataproducts = $this->FeaturedProducts(60, 'wdaww7dqsef-', 450);
        return $this->render('indexpage', ['dataproducts' => $dataproducts, 'newproducts' => $newproducts,'title'=>$title]);
    }
}

?>