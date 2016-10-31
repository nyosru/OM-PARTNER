<?php
/**
 * Created by PhpStorm.
 * User: dmitriy
 * Date: 15.04.16
 * Time: 12:33
 */

namespace common\traits;


trait RecursCat
{
    public $chpures;
    public $itemres;

    public function Requrscat($arr, $firstval, $catnamearr)
    {

        $itemres = $firstval;
        if (isset($arr[$itemres])) {
            while ($arr[$itemres] != '0') {
                if (isset($catnamearr[$itemres])) {
                    $chpures[] = ['name' => $catnamearr[$itemres], 'id' => $itemres];

                    $itemres = $arr[$itemres];
                }
            }
            if (isset($catnamearr[$itemres])) {
                $chpures[] = ['name' => $catnamearr[$itemres], 'id' => $itemres];
            }
        }
        return array_reverse($chpures);
    }
}