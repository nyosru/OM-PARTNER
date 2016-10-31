<?php
namespace frontend\controllers\actions\om;

use common\models\Customers;
use common\models\PartnersPage;
use common\models\PartnersUsersInfo;
use common\models\Referrals;
use common\models\SignupFormOM;
use common\models\Specifications;
use common\models\User;
use frontend\models\SignupForm;
use yii\bootstrap\Tabs;
use Faker\Provider\zh_TW\DateTime;
use Yii;
use common\models\PartnersConfig;
use yii\validators\EmailValidator;

trait ActionRegisterSP
{
    public function actionRegisterSp()
    {
        if(!Yii::$app->user->isGuest){
            $userinfo = PartnersUsersInfo::find()->where(['id'=>Yii::$app->getUser()->identity->getId()])->asArray()->one();
            if(Yii::$app->request->post('accept')
                && ($userinfo)== TRUE
                && ($customer_id = $userinfo['customers_id']) == TRUE
            ){
                $customer = Customers::find()->where(['customers_id'=>$customer_id])->asArray()->one();
            if(
                $customer
                && ($check = Referrals::find()->where(['user_id'=>$userinfo['id']])->orWhere(['customer_id'=>$customer['customers_id']])->exists() ) == FALSE
            ){
                $refferal = new Referrals();
                $i = 0;
                do{
                    $i++;
                    $rs =  Yii::$app->security->generateRandomString();
                    $accept = Referrals::find()->where(['referral_url'=>$rs])->asArray()->exists();
                }while($accept && $i <= 5);
                $refferal->user_id = $userinfo['id'];
                $refferal->customer_id = $customer_id;
                $refferal->referral_url = $rs;
                $refferal->status = 1;
                if($refferal->validate() && $refferal->save()){
                    Yii::$app->params['params']['products_mail'] =  $this->NewProducts(6,'mail_new-34', 7200);
                    Yii::$app->params['params']['utm'] =  [
                        'source'=>'newom',
                        'medium'=>'email',
                        'campaign'=>'om',
                        'content'=>'invite-sp'
                    ];
                    Yii::$app->mailer->htmlLayout = 'layouts-om/html';
                    Yii::$app->mailer->compose('register-sp' , ['refer'=>$refferal->referral_url, 'ident'=>$refferal->id])
                        ->setFrom('odezhdamaster@gmail.com')
                        ->setTo(Yii::$app->getUser()->identity->email)
                        ->setSubject('Приглашение в сервис  '  . $_SERVER['HTTP_HOST'])
                        ->send();
                    \Yii::$app->getSession()->setFlash('success', 'Успешно отправлено');
                    return $this->render('sp/result-sp', ['type'=>'success',
                        'text'=>'все отлично'
                    ]);
                }else{
                    return $this->render('sp/result-sp', ['type'=>'success',
                        'text'=>'что то пошло не так'
                    ]);
                }

            }else{
               return $this->redirect('/');
            }
            }
              return $this->render('sp/registersp', ['type'=>'allow',
                'user'=> [
                    'name'=> $userinfo['name'],
                    'secondname' => $userinfo['secondname'],
                    'lastname' => $userinfo['lastname'],
                    'city' => $userinfo['city'],
                    'state' => $userinfo['state'],
                    'country' => $userinfo['country'],
                    'telephone' => $userinfo['telephone'],
                    'mail' => Yii::$app->user->identity->email,
                ]
            ]);
        }else{
            $model = new SignupFormOM();
            if ($model->load(Yii::$app->request->post())) {
                if ($model->validuser()) {
                    if ($model->validcountryregion()) {

                        if ($user = $model->signup()) {
                            if (Yii::$app->getUser()->login($user)) {

                                return $this->goHome();
                            }
                        } else {
                            return $this->render('signup', ['model' => $model]);
                        }
                    } else {
                        return $this->render('signup', ['model' => $model]);
                    }
                } else {
                    return $this->render('signup', ['model' => $model]);
                }
            }
            return $this->render('signup', ['model' => $model]);
        }
        

    }
}