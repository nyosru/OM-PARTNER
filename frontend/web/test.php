<?php
$src = 'cat/34.jpg';
$split = explode('/', $src);
$split= array_splice($split, -1, 1);
print_r($split);
?>