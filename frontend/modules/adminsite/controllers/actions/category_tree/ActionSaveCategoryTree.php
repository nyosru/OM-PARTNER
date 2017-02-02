<?php
namespace frontend\modules\adminsite\controllers\actions\category_tree;

use common\traits\Categories\CategoryDataStore;
use common\traits\Categories\CategoryJstreeService;
use common\traits\PageGen\MetaGenClass;
use Yii;

trait ActionSaveCategoryTree
{

    public function actionSaveCategoryTree()
    {
        if (!Yii::$app->request->isPost) {
            throw new \yii\web\NotFoundHttpException(404);
        }

        $customCatalog = new MetaGenClass();

        $data_product_tree = $customCatalog->customCatalog();

        $categoryDataStore = new CategoryDataStore(
            $data_product_tree['cat'],
            $data_product_tree['name'],
            $data_product_tree['template'],
            $data_product_tree['theme']
        );

        $categoryJstreeService = new CategoryJstreeService($categoryDataStore);
        $categoryJstreeService->buildCategoryTreeFromJstreeData(json_decode(Yii::$app->request->post('jstree_data'), true), true);

        return $this->redirect(Yii::$app->request->referrer);
    }

}