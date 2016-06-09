<?php
namespace frontend\controllers\actions\om;

use yii;
use yii\helpers\ArrayHelper;
use common\models\FiguresDays;
use common\models\FiguresDaysProduct;

trait ActionFiguresDays
{
    public function actionFiguresdays()
    {

        $figuresprovider = new \yii\data\ActiveDataProvider([
            'query' => FiguresDays::find()->joinWith('products')->joinWith('info')->joinWith('productsDescription')->
            joinWith('productsAttributes')->joinWith('productsAttributesDescr')->asArray(),
            'pagination' => [
                'defaultPageSize' => 5,
            ],
        ]);
        $pagination = $figuresprovider->getPagination();
        $figuresprovider = $figuresprovider->getModels();
        return $this->render('figures', ['figuresprovider' => $figuresprovider, 'pagination' => $pagination]);
    }
}