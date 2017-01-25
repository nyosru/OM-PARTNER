<?php
namespace common\traits\Cat;


use common\forms\Cat\CatLandConfigForm;

class CatImagesService
{
    /**
     * @var string
     */
    protected $path_images;

    public function __construct(CatLandConfigForm $CatLandConfigForm)
    {
        $this->path_images = $CatLandConfigForm->getPathSavePictures();
    }

    public function getListPictures()
    {
        $path_to_pictures = \Yii::getAlias($this->path_images);

        $scandir_res = scandir($path_to_pictures);
        $scandir_res = array_diff_key($scandir_res, ['.', '..']);
        $scandir_res = array_filter($scandir_res, function ($x) use ($path_to_pictures) {
            if (!is_dir($path_to_pictures . $x)) {
                return 1;
            }

            return 0;
        });

        $images_path = stristr($this->path_images, '/images');
        foreach ($scandir_res as &$image_name) {
            $image_name = \Yii::getAlias('@web' . $images_path) . $image_name;
        }

        return $scandir_res;
    }
}