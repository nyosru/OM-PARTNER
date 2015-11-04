<?php
namespace common\traits;

trait View_cat
{
    public function view_cat($arr, $parent_id = 0, $catnamearr, $allow_cat)
    {
        static $output;
        if (empty($arr[$parent_id])) {
            return $output;
        } else {
            if ($parent_id !== 0) {
                $style = 'style="display: none;"';
            }
            $output .= '<ul id="accordion" class="accordion" ' . $style . '">';
            for ($i = 0; $i < count($arr[$parent_id]); $i++) {
                $catdesc = $arr[$parent_id][$i]['categories_id'];
                if (!$arr[$parent_id][$i] == '') {
                    $output .= '<li class=""><a href="/site/catalog?_escaped_fragment_=cat=' . $catdesc . '&count=20&start_price=&end_price=1000000&prod_attr_query=&page=undefined&sort=0&searchword="></a><div class="link data-j" data-j="on" data-cat="' . $catdesc . '">' . $catnamearr["$catdesc"] . '</div>';
                    $this->view_cat($arr, $arr[$parent_id][$i]['categories_id'], $catnamearr, $allow_cat);
                    $output .= '</li>';
                }
            }
            $output .= '</ul>';
        }
        return $output;
    }
}

?>