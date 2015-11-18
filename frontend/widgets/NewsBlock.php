<?php

namespace frontend\widgets;

use common\traits\Trim_Tags;
use Yii;
use yii\bootstrap\Modal;
use yii\helpers\Html;

class NewsBlock extends \yii\bootstrap\Widget
{
    use Trim_Tags;

    public function init()
    {
        ?>
        <div id="partners-main-left-cont">
        <div class="header-catalog"> НОВОСТИ
        </div>
        <?
        $newsprovider = new \yii\data\ActiveDataProvider([
            'query' => \common\models\PartnersNews::find()->where(['partners_id' => Yii::$app->params['constantapp']['APP_ID'], 'status' => '1'])->orderBy(['date_modified' => SORT_DESC, 'id' => SORT_DESC]),
            'pagination' => [
                'defaultPageSize' => intval(Yii::$app->params['partnersset']['newsonindex']['value']),
            ],
        ]);
        $newsprovider = $newsprovider->getModels();
        if (!$newsprovider) {
            echo 'Новости отсутствуют';
        } else {
            foreach ($newsprovider as $valuenews) {
                echo '<div>';
                echo '<span style=" none repeat scroll 0% 0%; padding: 4px 25px; width: 100%; box-shadow: 2px 1px 5px -4px black;">' . $valuenews->date_modified . '</span><br/>';
                echo '<span style="padding: 10px 25px; margin: 0px; display: block; none repeat scroll 0% 0%; font-weight: 600">' . $valuenews->name . '</span>';
                $text = $this->trim_tags_text($valuenews->post);
                echo '<span style="padding: 0px 15px; display: block; margin: 0px 10px 10px;">';
                Modal::begin([
                    'header' =>  $valuenews->name,
                    'headerOptions'=> [
                        'class'=>'newsmodhead',
                    ],
                    'toggleButton' => ['label' => $text.'...',
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
            ?></div><?
        }
    }
}
