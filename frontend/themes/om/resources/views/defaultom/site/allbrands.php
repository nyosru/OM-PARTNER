<?php
/**
 * Created by PhpStorm.
 * User: dmitriy
 * Date: 13.05.16
 * Time: 10:47
 */

$this -> title = 'Бренды';
foreach ($brands as $brandkey=>$brandvalue){
    echo '<a href="'.BASEURL.'/catalog?count=60&amp;sfilt[]='.$brandvalue['specification_values_id'].'" class="btn" style="border: 1px solid #00A5A1; width: calc(100% / 4 - 10px); margin: 5px;"><div >'.$brandvalue['specification_value']. '</div></a>';
}

