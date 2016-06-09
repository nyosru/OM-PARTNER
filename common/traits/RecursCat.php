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
    public $chpu;
    public $item;

    public function Requrscat($arr, $firstval, $catnamearr)
    {
        //  static $this->chpu;
        //  static $this->item;
        $this->item = $firstval;
        if (isset($arr[$this->item])) {
            while ($arr[$this->item] != '0') {
                if (isset($catnamearr[$this->item])) {
                    $this->chpu[] = ['name' => $catnamearr[$this->item], 'id' => $this->item];

                    $this->item = $arr[$this->item];
                }
            }
            if (isset($catnamearr[$this->item])) {
                $this->chpu[] = ['name' => $catnamearr[$this->item], 'id' => $this->item];
            }
        }
        return array_reverse($this->chpu);
    }
}