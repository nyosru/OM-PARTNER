<?php
namespace common\traits;

use Yii;
use common\models\Manufacturers;

Trait Hide_manufacturers_for_partners
{
    public function hide_manufacturers_for_partners()
    {
        $key = Yii::$app->cache->buildKey('hideman');
        $hide_man = Yii::$app->cache->get($key);
        if (!isset($hide_man['data'])) {
            $man = new Manufacturers();
            $hide_man = $man->find()->where(['hide_products' => '1'])->select('manufacturers_id')->asArray()->all();
            Yii::$app->cache->set($key, ['data' => $hide_man], 86400);
        } else {
            $hide_man = $hide_man['data'];
        }
        return $hide_man;
    }
}

?>