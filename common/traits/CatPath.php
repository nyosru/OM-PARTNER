<?php
namespace common\traits;


use Yii;

trait   CatPath
{

    public function Catpath($id, $action)
    {
        $cat = (integer)$id;
        $key = Yii::$app->cache->buildKey('catpath-sys-cachehhjjk-'.Yii::$app->params['customcat'].'-'. $cat . '-' . $action.'-'.Yii::$app->params['customcat']);

        if (($resultchpu = Yii::$app->cache->get($key)) == FALSE) {

            $catdataarr = $this->categories_for_partners();
            $catdata = $catdataarr[0];
            $categories = $catdataarr[1];
            foreach ($categories as $value) {
                $catnamearr[$value['categories_id']] = $value['categories_name'];
            }
            foreach ($catdata as $value) {
                $catdatas[$value['categories_id']] = $value['parent_id'];
                if(!$catnamearr[$value['categories_id']]){
                    $catnamearr[$value['categories_id']] = 'NoName'.$value['categories_id'];
                }
            }
            // Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
            $chpu = $this->Requrscat($catdatas, $cat, $catnamearr);



            if ($action == TRUE && $action == 'name') {
                $resultchpu = [];
                foreach ($chpu as $key => $value) {
                    $resultchpu[] = $value['name'];
                }
                Yii::$app->cache->set($key, $resultchpu, 3600);
                return $resultchpu;
            } elseif ($action == 'num') {
                $resultchpu = [];
                foreach ($chpu as $key => $value) {
                    $resultchpu[] = $value['id'];
                }
                Yii::$app->cache->set($key, $resultchpu, 3600);
                return $resultchpu;
            } elseif ($action == 'namenum') {
                $resultchpu = [];
                foreach ($chpu as $key => $value) {
                    $resultchpu['num'][] = $value['id'];
                    $resultchpu['name'][] = $value['name'];
                }
                Yii::$app->cache->set($key, $resultchpu, 3600);
                return $resultchpu;
            } else {
                Yii::$app->cache->set($key, $chpu, 3600);
                return $chpu;
            }
        }else{
            return $resultchpu;
        }
    }



}