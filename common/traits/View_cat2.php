<?php
namespace common\traits;

trait View_cat2
{
    public $output2 = '';
    public function view_catphp($arr, $parent_id = 0, $catnamearr, $allow_cat, $opencat = [])
    {

        if (empty($arr[$parent_id])) {
            return $this->output2;
        } else {
            if ($parent_id == 0 || in_array($arr[$parent_id]['parent_id'], $opencat)) {
                $style = '';
            } else {
                $style = 'style="display: none;"';
            }
            $this->output2 .= '<ul id="accordion" class="accordion" ' . $style . ' data-categories="' . $arr[$parent_id]['categories_id'] . '" data-parent="' . $arr[$parent_id]['parent_id'] . '">';
            for ($i = 0; $i < count($arr[$parent_id]); $i++) {
                $catdesc = $arr[$parent_id][$i]['categories_id'];
                if (!$arr[$parent_id][$i] == '') {
                    if (in_array($catdesc, $opencat)) {
                        $openli = 'open';
                    } else {
                        $openli = '';
                    }
                    $xcat = count($opencat)-1;
                    if($catdesc == $opencat[$xcat]){
                        $aclass =  'checked';
                    }else{
                        $aclass =  '';
                    }
                    if($parent_id == 0){
                        $exthtml = '';
                    }elseif(!$arr[$arr[$parent_id][$i]['categories_id']]){
                        $exthtml = '&nbsp;';
                    }elseif(in_array($catdesc, $opencat)){
                        $exthtml = '- ';
                    }else{
                        $exthtml = '+ ';
                    }
                    $this->output2 .= '<li class=" ' . $openli .'"><div class="link '.$aclass.'"  data-cat="' . $catdesc . '"> '.$exthtml.'<a class="lock-on '.$aclass.'" href="' . BASEURL . '/catalog?cat=' . $catdesc . '&count=20&start_price=&end_price=1000000&prod_attr_query=&page=0&sort=0&searchword=">' . $catnamearr["$catdesc"] . '</a></div>';
                    $this->view_catphp($arr, $arr[$parent_id][$i]['categories_id'], $catnamearr, $allow_cat, $opencat);
                    $this->output2 .= '</li>';
                }
            }
            $this->output2 .= '</ul>';
        }
        return $this->output2;
    }
    public function view_cat($arr, $parent_id = 0, $catnamearr, $allow_cat)
    {
        static $output;
        if (empty($arr[$parent_id])) {
            return $output;
        } else {
            if ($parent_id !== 0) {
                $style = 'style="display: none;"';
            }
            $output .= '<ul class="treeview-side treeview" id="category-treeview" ' . $style . '">';
            for ($i = 0; $i < count($arr[$parent_id]); $i++) {
                $catdesc = $arr[$parent_id][$i]['categories_id'];
                if (!$arr[$parent_id][$i] == '') {
                    $output .= '<li class=""><a href="' . BASEURL . '/catalog?cat=' . $catdesc .
                        '&count=20&start_price=&end_price=1000000&prod_attr_query=&page=undefined&sort=0&searchword="><div class="link data-j" data-j="on" data-cat="' .
                        $catdesc . '">' . $catnamearr["$catdesc"] . '</div></a>';
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