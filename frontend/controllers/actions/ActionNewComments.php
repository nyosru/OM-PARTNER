<?php
namespace frontend\controllers\actions;

use common\models\PartnersComments;
use common\models\PartnersUsersInfo;
use Yii;
use yii\base\Exception;
use yii\data\ActiveDataProvider;


trait ActionNewComments
{
    public function actionNewcomments()
    {

        $user = Yii::$app->getUser()->id;
        if (!$user) {
            Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
            return $this->redirect(BASEURL . '/login');
        } else {
            $text = $this->trim_tags_text(Yii::$app->request->post()['PartnersComments']['post']);
            $relate = $this->trim_tags_text(Yii::$app->request->post()['PartnersComments']['relate_id']);
            $category = $this->trim_tags_text( Yii::$app->request->post()['PartnersComments']['category']);
            $model = new PartnersComments();
//            $modeluser = new PartnersUsersInfo();
//            $modeluser = $modeluser::findOne(['id'=>$user]);
//            if(!$modeluser){
//                $modeluser = new PartnersUsersInfo();
//                $modeluser->setScenario('commentsuserinfo');
//                $modeluser->id = $user;
//                $modeluser->name = PartnersUsersInfo::findOne(Yii::$app->user->identity->getId())['name'];
//                $modeluser->lastname = Yii::$app->request->post()['PartnersUsersInfo']['lastname'];
//                $modeluser->save();
//            } else {
//                $modeluser->name = Yii::$app->request->post()['PartnersUsersInfo']['name'];
//                $modeluser->lastname = Yii::$app->request->post()['PartnersUsersInfo']['lastname'];
//                $modeluser->save();
//            }
            $model->category = $category;
            $model->relate_id = $relate;
            $model->date_added = date('Y-m-d H:i:s');
            $model->date_modified = date('Y-m-d H:i:s');
            $model->partners_id = Yii::$app->params['constantapp']['APP_ID'];
            $model->status = 1;
            $model->user_id = Yii::$app->user->getIdentity()->id;
            $model->post = $text;
            if ($model->save()) {
                if (Yii::$app->request->referrer) {
                    return $this->redirect(Yii::$app->request->referrer);
                } else {
                    return $this->goHome();
                }
            } else {
                Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
                return $this->redirect(Yii::$app->request->referrer);
            }


        }

    }
}

?>