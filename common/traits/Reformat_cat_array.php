<?php
namespace common\traits;
Trait Reformat_cat_array
{
    public function reformat_cat_array($catdata, $categories, $checks)
    {
        foreach ($catdata as $value) {
            if (in_array(intval($value['categories_id']), $checks)) {
                $catdataallow[] = $value;
            }
        }
        for ($i = 0; $i < count($catdataallow); $i++) {
            $row = $catdataallow[$i];
            if (empty($arr_cat[$row['parent_id']])) {
                $arr_cat[$row['parent_id']] = $row;
            }
            $arr_cat[$row['parent_id']][] = $row;
        }
        foreach ($categories as $value) {
            $catnamearr[$value['categories_id']] = $value['categories_name'];
        }

        return ['cat' => $arr_cat, 'name' => $catnamearr];
    }
}