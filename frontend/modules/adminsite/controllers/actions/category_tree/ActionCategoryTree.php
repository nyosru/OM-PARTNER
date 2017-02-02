<?php
namespace frontend\modules\adminsite\controllers\actions\category_tree;

use common\traits\Categories\CategoryDataStore;
use common\traits\Categories\CategoryJstreeService;
use common\traits\PageGen\MetaGenClass;
use Yii;

trait ActionCategoryTree
{

    public function actionCategoryTree()
    {
        $customCatalog = new MetaGenClass();

        $data_category_tree = $customCatalog->customCatalog();
        $defaultCategoryDataStore = new CategoryDataStore(
            $data_category_tree['cat'],
            $data_category_tree['name'],
            $data_category_tree['template'],
            $data_category_tree['theme']
        );

        $data_new_category_tree = file_get_contents(\Yii::getAlias('@frontend') . '/runtime/category-tree/custom_tree.json');
        $data_new_category_tree = (array)json_decode($data_new_category_tree, true);
        $customCategoryDataStore = new CategoryDataStore(
            $data_new_category_tree['cat'],
            $data_new_category_tree['name'],
            $data_new_category_tree['template'],
            $data_new_category_tree['theme']
        );

        $defaultCategoryJstreeService = new CategoryJstreeService($defaultCategoryDataStore);
        $customCategoryJstreeService = new CategoryJstreeService($customCategoryDataStore);

        return $this->render(
            'category_tree/index',
            [
                'default_categories_tree' => json_encode($defaultCategoryJstreeService->getBuiltJsTree()),
                'custom_categories_tree'  => json_encode($customCategoryJstreeService->getBuiltJsTree())
            ]);
    }

}