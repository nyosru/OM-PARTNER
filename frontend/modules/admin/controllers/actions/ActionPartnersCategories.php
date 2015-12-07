<?php
namespace frontend\modules\admin\controllers\actions;

use common\models\Partners;
use common\models\PartnersCatDescription;
use common\models\PartnersCategories;
use yii\data\ActiveDataProvider;
use Yii;

trait ActionPartnersCategories
{

    public function actionPartnerscategories()
    {
        $categoriesprovider = new ActiveDataProvider([
            'query' => Partners::find()->where(['partners_id' => Yii::$app->params['constantapp']['APP_ID']]),
            'pagination' => [
                'pageSize' => 20,
            ],
        ]);
        $categoriess = new PartnersCategories();
        $categoriesd = new PartnersCatDescription();
        // Выбираем все категории массива с ролительскими id
        $start_arr = $categoriess->find()->select(['categories_id', 'parent_id'])->where('categories_status != 0')->asArray()->All();
        // выбираем соответствие id названию категории
        $s = $categoriesd->find()->select(['categories_id', 'categories_name'])->asArray()->All();

        // Берем по очереди каждый элемент массива
        for ($i = 0; $i < count($start_arr); $i++) {
            // Сохраняем его в переменную row
            $row = $start_arr[$i];
            // Если в соответствующей строке нет parent_id
            if (empty($arr_cat[$row['parent_id']])) {
                // создаем ячейку для этого элемента
                $arr_cat[$row['parent_id']] = [];// $row;
            }
            // Делаем переменную row дочерним элементом
            $arr_cat[$row['parent_id']][] = $row;
        }
        // Для каждого элемента в массиве s
        foreach ($s as $value) {
            $catnamearr[$value['categories_id']] = $value['categories_name'];
        }

        return $this->render('partnerscategories', ['catnamearr' => $catnamearr, 'arr_cat' => $arr_cat]);
    }

}