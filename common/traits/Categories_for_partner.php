<?php
namespace common\traits;

use Yii;
use common\models\PartnersCategories;
use common\models\PartnersCatDescription;

Trait Categories_for_partner
{
    public function categories_for_partners()
    {
        $categoriess = new PartnersCategories();
        $categoriesd = new PartnersCatDescription();
        $key = Yii::$app->cache->buildKey('categories');
        $data = Yii::$app->cache->get($key);
        if ($data['data'] == FALSE) {
            $f = $categoriess->find()->select(['categories_id', 'parent_id'])->where('categories_status != 0')->createCommand()->queryAll();
            $s = $categoriesd->find()->select(['categories_id', 'categories_name'])->createCommand()->queryAll();
            $data = array($f, $s);
            Yii::$app->cache->set($key, ['data' => $data], 3600);
        } else {
            $data = $data['data'];
        }
        return $data;
    }
}

?>