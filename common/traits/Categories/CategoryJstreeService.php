<?php
namespace common\traits\Categories;

class  CategoryJstreeService extends ACategoryService
{
    /**
     * @var array
     */
    protected $interface_parent = [
        'id'       => '#',
        'text'     => '',
        'icon'     => '',
        'children' => [],
        "data"     => [
            'categories_id' => '#',
            'original_name' => '#',
        ],
    ];

    /**
     * @var array
     */
    protected $interface_child = [
        'id'       => '#',
        'text'     => '',
        'icon'     => '',
        'children' => [],
        "data"     => [
            'categories_id' => '#',
            'original_name' => '#',
        ],
    ];

    protected $custom_config_name = 'custom_tree';

    /**
     * CategoryJstreeService constructor.
     * @param CategoryDataStore $categoryDataStore
     */
    public function __construct(CategoryDataStore $categoryDataStore)
    {
        parent::__construct($categoryDataStore);
    }

    /**
     * @return array
     */
    public function getBuiltJsTree()
    {
        $data = [];
        foreach ($this->cat as $key_cat => $i_cat) {

            if ($i_cat['parent_id'] != 0) {
                continue;
            }

            $parent = $this->interface_parent;

            /** @var array $i_cat_name */
            $i_cat_name = array_filter(array_keys($this->name), function ($name_key) use ($i_cat) {
                if ($i_cat['categories_id'] == $name_key) {
                    return 1;
                }

                return 0;
            });

            $parent['id'] = $i_cat['categories_id'];
            $parent['data']['categories_id'] = $i_cat['categories_id'];
            $parent['data']['original_name'] = $this->name[array_values($i_cat_name)[0]];
            $parent['text'] = $this->name[array_values($i_cat_name)[0]];
            $data[] = $this->appendChildren($parent, $i_cat['categories_id']);
        }

        return $data;
    }

    /**
     * @param $parent
     * @param $parent_id
     * @param int $i
     * @return mixed
     */
    protected function appendChildren($parent, $parent_id, $i = 0)
    {
        $new_child = $this->interface_child;
        /** @var array $children */
        $children = $this->getChildren($parent_id);

        if (count($children) == 0) {
            return $parent;
        }

        foreach ($children as $child) {

            /** @var array $i_child_name */
            $i_child_name = array_filter(array_keys($this->name), function ($name_key) use ($child) {
                if ($child['categories_id'] == $name_key) {

                    return 1;
                }

                return 0;
            });

            $new_child['id'] = $child['categories_id'];
            $new_child['data']['categories_id'] = $child['categories_id'];
            $new_child['data']['original_name'] = $this->name[array_values($i_child_name)[0]];
            $new_child['text'] = $this->name[array_values($i_child_name)[0]];
            $parent['children'][] = $this->appendChildren($new_child, $child['categories_id'], $i + 1);
        }

        return $parent;
    }

    /**
     * @param $parent_id
     * @return array
     */
    protected function getChildren($parent_id)
    {
        /** @var array $children */
        $children = array_filter($this->cat, function ($cat) use ($parent_id) {
            if ($parent_id == $cat['parent_id']) {
                return 1;
            }

            return 0;
        });

        return $children;
    }

    /**
     * @param array $data
     * @param bool $update_custom_tree_file
     * @return array
     */
    public function buildCategoryTreeFromJstreeData($data = [], $update_custom_tree_file = false)
    {
        if (count($data) == 0) {
            return [];
        }

        $new_tree['cat'] = [];
        $new_tree['name'] = $this->name;
        $new_tree['template'] = $this->template;
        $new_tree['theme'] = $this->theme;

        foreach ($data as $key_datum => $datum) {

            if (
                !$this->checkExistCategory($this->cat, $datum['data']['categories_id'])
                ||
                $this->checkExistCategory($new_tree['cat'], $datum['data']['categories_id'])
            ) {
                continue;
            }

            if ($new_tree['name'][$datum['data']['categories_id']]) {
                $new_tree['name'][$datum['data']['categories_id']] = $datum['text'];
            }

            $new_tree['cat'][] = ['categories_id' => $datum['data']['categories_id'], 'parent_id' => 0];
            $new_tree = $this->appendChildrenToNewTree($new_tree, $datum);
        }


        if ($update_custom_tree_file === true) {
            $this->saveOrUpdateCustomTree($new_tree);
        }

        return $new_tree;
    }

    protected function appendChildrenToNewTree($new_tree, $parent)
    {
        if (count($parent['children']) == 0) {
            return $new_tree;
        }

        foreach ($parent['children'] as $children_datum) {

            if (
                !$this->checkExistCategory($this->cat, $children_datum['data']['categories_id'])
                ||
                $this->checkExistCategory($new_tree['cat'], $children_datum['data']['categories_id'])
            ) {
                continue;
            }

            if ($new_tree['name'][$children_datum['data']['categories_id']]) {
                $new_tree['name'][$children_datum['data']['categories_id']] = $children_datum['text'];
            }

            $new_tree['cat'][] = ['categories_id' => $children_datum['data']['categories_id'], 'parent_id' => $parent['data']['categories_id']];
            $new_tree = $this->appendChildrenToNewTree($new_tree, $children_datum);
        }

        return $new_tree;
    }

    protected function saveOrUpdateCustomTree($data)
    {
        if (!file_exists(\Yii::getAlias('@frontend') . '/runtime/category-tree/' . $this->custom_config_name . '.json')) {
            if (!mkdir(\Yii::getAlias('@frontend') . '/runtime/category-tree', 0777, true)) {
                \Yii::$app->session->setFlash('error', 'Ошибка, данные не сохранены');

                return false;
            }
        }

        if (file_put_contents(\Yii::getAlias('@frontend') . '/runtime/category-tree/' . $this->custom_config_name . '.json',
            json_encode($data))) {
            \Yii::$app->session->setFlash('success', 'Удача! Данные сохранены');

            return true;

        }

        \Yii::$app->session->setFlash('error', 'Ошибка!');

        return false;
    }

    protected function checkExistCategory($data, $category_id)
    {
        $category_exist = array_filter($data, function ($datum) use ($category_id) {
            if ($category_id == $datum['categories_id']) {
                return 1;
            }

            return 0;
        });

        if (count($category_exist) == 0) {
            return false;
        }

        return true;
    }
}