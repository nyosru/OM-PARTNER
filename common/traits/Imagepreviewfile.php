<?php
namespace common\traits;

use common\models\PartnersProducts;
use common\models\PartnersProductsToCategories;
use common\models\ProductImage;
use Yii;

Trait Imagepreviewfile
{
    public function viewpreviewfile($from, $src, $where, $action = 'none', $sub = FALSE)
    {

        $id = (integer)$src;
            $namefile = $id.'-'.(integer)$sub;
            $subdir = '';

            for ($i = 0; $i < 3; $i++) {
                $subdir .= '/' . substr($namefile, $i * 2, 2);
            }
            $dir = 'newpreview';
            $time_sec=time();
            if ((file_exists(Yii::getAlias($where) . $dir . $subdir . $namefile . '.jpg')
                    && ($time_sec - filemtime(Yii::getAlias($where) . $dir . $subdir . $namefile . '.jpg')) < 10800 )
                || $action !== 'refresh') {
                return Yii::getAlias($where) . $dir . $subdir . $namefile . '.jpg';
            } else {
             return FALSE;
            }
    }

}

?>
