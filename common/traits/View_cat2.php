<?php
namespace common\traits;

trait View_cat2
{
    public function view_catphp($arr, $parent_id = 0, $catnamearr, $allow_cat, $opencat = [])
    {
        static $output2;
        if (empty($arr[$parent_id])) {
            return $output2;
        } else {
            if ($parent_id == 0 || in_array($arr[$parent_id]['parent_id'], $opencat)) {
                $style = '';
            } else {
                $style = 'style="display: none;"';
            }
            $output2 .= '<ul id="accordion" class="accordion" ' . $style . ' data-categories="' . $arr[$parent_id]['categories_id'] . '" data-parent="' . $arr[$parent_id]['parent_id'] . '">';
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
                    $output2 .= '<li class=" ' . $openli .'"><div class="link '.$aclass.'"  data-cat="' . $catdesc . '"> '.$exthtml.'<a class="lock-on '.$aclass.'" href="' . BASEURL . '/catalog?cat=' . $catdesc . '&count=20&start_price=&end_price=1000000&prod_attr_query=&page=0&sort=0&searchword=">' . $catnamearr["$catdesc"] . '</a></div>';
                    $this->view_catphp($arr, $arr[$parent_id][$i]['categories_id'], $catnamearr, $allow_cat, $opencat);
                    $output2 .= '</li>';
                }
            }
            $output2 .= '</ul>';
        }
        return $output2;
    }
}

?>