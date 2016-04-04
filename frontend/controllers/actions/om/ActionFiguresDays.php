<?php
namespace frontend\controllers\actions\om;

use yii;
use common\models\FiguresDays;
use common\models\FiguresDaysProduct;

trait ActionFiguresDays{
    public function actionFiguresdays(){
        $figuresprovider = new \yii\data\ActiveDataProvider([
            'query' => FiguresDays::find()->joinWith('products'),
              'pagination' => [
              'defaultPageSize' => 20,
            ],
        ]);
        $pagination = $figuresprovider->getPagination();
        $figuresprovider = $figuresprovider->getModels();
        return $this->render('figures',['figuresprovider'=>$figuresprovider,'pagination'=>$pagination]);
    }
}