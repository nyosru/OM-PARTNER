<?php
namespace frontend\controllers\actions;

use common\models\PartnersComments;
use common\models\PartnersOrders;
use common\models\User;
use Yii;
use yii\data\ActiveDataProvider;


trait ActionNewComments
{
    public function actionNewcomments()
    {

        $user = Yii::$app->getUser()->id;
        if (!$user) {
            Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
            return $this->redirect('/site/login');
        } else {
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

            $text = preg_replace($search, $replace, Yii::$app->request->post()['PartnersComments']['post']);
            $model = new PartnersComments();
            $model->category = 0;
            $model->date_added = date('Y-m-d h:i:s');
            $model->date_modified = date('Y-m-d h:i:s');;
            $model->partners_id = Yii::$app->params['constantapp']['APP_ID'];
            $model->status = 0;
            $model->user_id = Yii::$app->user->getIdentity()->id;
            $model->post = $text;
            if ($model->save()) {
                return $this->goHome();
            } else {

                return $this->goHome();
            }

        }

    }
}

?>