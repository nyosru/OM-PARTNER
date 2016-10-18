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
        
        $this->itemres = $firstval;
        if (isset($arr[$this->itemres])) {
            while ($arr[$this->itemres] != '0') {
                if (isset($catnamearr[$this->itemres])) {
                    $this->chpures[] = ['name' => $catnamearr[$this->itemres], 'id' => $this->itemres];

                    $this->itemres = $arr[$this->itemres];
                }
            }
            if (isset($catnamearr[$this->itemres])) {
                $this->chpures[] = ['name' => $catnamearr[$this->itemres], 'id' => $this->itemres];
            }
        }
        return array_reverse($this->chpures);
    }
}