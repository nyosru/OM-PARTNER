<?php

namespace frontend\widgets;

use common\models\PartnersNews;
use common\traits\Trim_Tags;
use Yii;
use yii\bootstrap\Modal;
use yii\helpers\Html;

class NewsBlockOM extends \yii\bootstrap\Widget
{
    use Trim_Tags;

    public function init()
    {
        $x = PartnersNews::find()->select('MAX(`date_modified`) as last_modified ')->where(['partners_id' => Yii::$app->params['constantapp']['APP_ID']])->asArray()->one();
        $key = Yii::$app->cache->buildKey('partner-' . Yii::$app->params['constantapp']['APP_ID'] . '-newspage-' . (integer)(Yii::$app->request->post('page')).'-set-'.(integer)(Yii::$app->params['partnersset']['newsonindex']['value']));
        if (($newsprovider = Yii::$app->cache->get($key)) == FALSE || $x['last_modified'] !== $newsprovider['lastupdate']) {
            $newsprovider = new \yii\data\ActiveDataProvider([
            'query' => \common\models\PartnersNews::find()->where(['partners_id' => Yii::$app->params['constantapp']['APP_ID'], 'status' => '1'])->orderBy(['date_modified' => SORT_DESC, 'id' => SORT_DESC]),
            'pagination' => [
                'defaultPageSize' => (integer)(Yii::$app->params['partnersset']['newsonindex']['value']),
            ],
        ]);
            $newsprovider = $newsprovider->getModels();
            Yii::$app->cache->set($key, ['data' => $newsprovider, 'lastupdate' => $x['last_modified']]);
        } else {

            $newsprovider = $newsprovider['data'];

        }
        if (!$newsprovider) {
            echo 'Новости отсутствуют';
        } else {
            foreach ($newsprovider as $valuenews) {
                echo '<div>';
                echo '<span style="color: rgb(0, 165, 161);">' . date('Y-m-d', strtotime($valuenews->date_modified)) . '</span><br/>';
                $text = $this->trim_tags_text($valuenews->name, 90);
                echo '<span style="display: block; ">';
                Modal::begin([
                    'header' =>  $valuenews->name,
                    'headerOptions'=> [
                        'class'=>'newsmodhead',
                    ],
                    'toggleButton' => ['label' => $text,
                        'tag' => 'div',
                        'style' => 'cursor:pointer'
                    ],
                    'size' => yii\bootstrap\Modal::SIZE_LARGE,
                    'options' => [

                    ]
                ]);
                echo $valuenews->post;
                Modal::end();

                echo '</span> <br/>';

                echo '</div>';
            }
            
        }
    }
}
