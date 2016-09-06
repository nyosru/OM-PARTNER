<?php
namespace common\traits;

trait  Load_cat
{
    public function load_cat($arr, $parent_id = 0, $catnamearr, $allow = [0], $disallow = [0])
    {
        static $str_load_cat;
        if (empty($arr[$parent_id])) {
        } else {
            for ($i = 0; $i < count($arr[$parent_id]); $i++) {
                $catdesc = $arr[$parent_id][$i]['categories_id'];
                if (!$arr[$parent_id][$i] == '') {
                    if(is_array($allow) && in_array($arr[$parent_id][$i]['parent_id'],  $allow)){
                        $allow[] = $arr[$parent_id][$i]['categories_id'];
                    }
                    if(
                    ((is_array($allow) && in_array($catdesc,  $allow))
                        &&
                        (is_array($disallow) && !in_array($catdesc,  $disallow)))


                    ){
                        $str_load_cat[] = $catdesc;
                        $this->load_cat($arr, $arr[$parent_id][$i]['categories_id'], $catnamearr, $allow, $disallow);
                    }
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