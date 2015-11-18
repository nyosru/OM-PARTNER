<?php

namespace frontend\widgets;

use Yii;
use yii\helpers\Html;

class NewsBlock extends \yii\bootstrap\Widget
{

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
                $search = array("'<script[^>]*?>.*?</script>'si",
                    "'<[\/\!]*?[^<>]*?>'si",
                    "'([\r\n])[\s]+'",
                    "'&(quot|#34);'i",
                    "'&(amp|#38);'i",
                    "'&(lt|#60);'i",
                    "'&(gt|#62);'i",
                    "'&(nbsp|#160);'i",
                    "'&(iexcl|#161);'i",
                    "'&(cent|#162);'i",
                    "'&(pound|#163);'i",
                    "'&(copy|#169);'i",
                    "'&#(\d+);'e");

                $replace = array("",
                    "",
                    "\\1",
                    "\"",
                    "&",
                    "<",
                    ">",
                    " ",
                    chr(161),
                    chr(162),
                    chr(163),
                    chr(169),
                    "chr(\\1)");

                $text = preg_replace($search, $replace, $valuenews->post);
                echo '<span style="padding: 0px 15px; display: block; margin: 0px 10px 10px;">' . mb_substr($text, 0, 180, 'UTF-8') . '...</span> <br/>';

                echo '</div>';
            }
            ?></div><?
        }
    }
}
