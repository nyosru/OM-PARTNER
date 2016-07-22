<?php
namespace common\traits\Manufacturers;
use common\models\Manufacturers;
use Yii;

trait HideMan
{
    public function HideMan()
    {

        $key = Yii::$app->cache->buildKey('hideman-new');
        $hide_man = Yii::$app->cache->get($key);
        if (!isset($hide_man['data'])) {
            $man = new Manufacturers();
            $list = $man->find()->where(['hide_products' => '1'])->select('manufacturers_id')->asArray()->all();
            foreach ($list as $value) {
                $hide_man[] = $value['manufacturers_id'];
            }
            Yii::$app->cache->set($key, ['data' => $hide_man], 86400);
            $hide_man = $list;
        } else {
            $hide_man = $hide_man['data'];
        }
        return $hide_man;

    }
}