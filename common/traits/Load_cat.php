<?php
namespace common\traits;

trait  Load_cat
{
    public function load_cat($arr, $parent_id = 0, $catnamearr, $allow_cat)
    {
        static $str_load_cat;
        if (empty($arr[$parent_id])) {

        } else {
            for ($i = 0; $i < count($arr[$parent_id]); $i++) {
                $catdesc = $arr[$parent_id][$i]['categories_id'];
                if (!$arr[$parent_id][$i] == '') {
                    $str_load_cat[] = $catdesc;
                    $this->load_cat($arr, $arr[$parent_id][$i]['categories_id'], $catnamearr, $allow_cat);
                }
            }
        }
        if ($parent_id != 0) {
            $str_load_cat[] = $parent_id;
        }
        return array_unique($str_load_cat);
    }
}

?>