<?php
namespace frontend\controllers\actions;

use common\models\Configuration;
use common\models\ContactForm;
use common\models\User;
use Yii;

trait ActionContacts
{
    public function actionContacts()
    {
        $to = Configuration::find()->select(['configuration_value'])->where(['configuration_key'=>'CONTACT_US_LIST'])->createCommand()->queryOne();


        $model = new ContactForm();
        if(!Yii::$app->request->post()){
            foreach (explode(",", $to['configuration_value']) as $k => $v) {
                $send_to_array[] =  preg_replace('/\<[^*]*/', '', $v);
            }
            return $this->render('contacts',['model'=>$model, 'to'=>$send_to_array]);
        }else{

            if($model->load(Yii::$app->request->post())) {
                $send_to_array = explode(",", $to['configuration_value']);
                preg_match('/\<[^>]+\>/', $send_to_array[$model->to], $send_email_array);
                $send_to_email = preg_replace("/>/", "", $send_email_array[0]);
                $send_to_email = preg_replace("/</", "", $send_to_email);
                $model->to = $send_to_email;
                if(!Yii::$app->user->isGuest){
                    $cust =User::find()->where(['partners_users.id'=>Yii::$app->user->getId(), 'partners_users.id_partners'=>Yii::$app->params['constantapp']['APP_ID']])->joinWith('userinfo')->joinWith('customers')->joinWith('addressBook')->one();
                    $model->email  = $cust['email'];
                    $model->name =  $cust['userinfo']['name'].' '.$cust['userinfo']['lastname'];
                }else{
                    $model->email = $this->trim_tags_text($model->email);
                    $model->name = $this->trim_tags_text($model->name);
                }
                $model->subject = $this->trim_tags_text($model->subject);;
                $model->body =  $this->trim_tags_text($model->body);;
                if($model->validate()){
                    if($model->sendEmail()){
                        $model = new ContactForm();
                        $result = 'Ваше письмо успешно отправлено!';
                    }else{
                        $result = 'Ошибка отправки!';
                    }
                }
                $send_to_array =[];
                foreach (explode(",", $to['configuration_value']) as $k => $v) {
                    $send_to_array[] =  preg_replace('/\<[^*]*/', '', $v);
                }
                return $this->render('contacts', ['model' => $model, 'to' => $send_to_array, 'result' => $result]);
            }
        }
    }
}