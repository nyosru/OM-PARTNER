<?php

namespace app\modules\partners\controllers;

use common\models\PartnersUsersInfo;
use Yii;
use yii\web\Controller;
use yii\filters\AccessControl;
use common\models\Partners;
use app\modules\partners\models\PartnersCategories;
use app\modules\partners\models\PartnersCatDescription;
use common\models\User;

class DefaultController extends Controller
{
	
	public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions' => ['index','save','savecateg', 'getpartnerscategories', 'update', 'usersforaddrequest', 'usersaddadmin', 'usersadmin', 'usersdeladmin'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
              ]
         ]
		 ];
     }


	public function Getdata()
    {
		$modelClass =  new Partners();
		$var = $modelClass->attributeLabels();
        return $var;
    }
	
	public function actionGetDBdata($count, $step)
    {
		$modelClass =  new Partners();
		$var = $modelClass->find()->select(['id','name', 'domain'])->limit($count)->offset($step)->asArray()->All();
        return $var;
    }

    public function stepdata($count, $step)
    {
        $modelClass =  new Partners();
        $var = $modelClass->find()->limit($count)->offset($step)->asArray()->All();
        return $var;
    }

	public function actionIndex()
    {
        if(isset($_GET['count']) && $_GET['count'] !=='' ){$count = intval($_GET['count']);}else{$count = 10;}
        if(isset($_GET['id']) && $_GET['id'] !=='' ){$id = intval($_GET['id']);}else{$id = 1;}
        if(isset($_GET['step']) && $_GET['step'] !=='' ){
            $step = intval($_GET['step'])+$count;}else{$step = 0;}
		$modelClass =  new Partners();
		$var = $this->Getdata();
		$dbRes = $this->actionGetDBdata($count,$step);
		//$this->layout = 'base';
       $partners_info = Partners::findOne($id);
       $categoriess = new PartnersCategories();
       $categories = $categoriess->find()->select(['categories_id', 'parent_id'])->where('categories_status != 0')->limit(1000000)->offset(0)->asArray()->All();
        $categoriesd = new PartnersCatDescription();
        $cat = $categoriesd->find()->select(['categories_id','categories_name'])->limit(1000000)->offset(0)->asArray()->All();

	return $this->render('tab',['props'=> $var, 'data'=>$dbRes, 'model' =>$modelClass, 'count' => $count, 'step'=>$step, 'categories' => $cat, 'catdata' => $categories, 'partners_info' => $partners_info]);
    }

    public function actionSave()
    {
        $modelClass =  new Partners();
        $savedata = Yii::$app->request->post('Partners');
        $modelClass->name = $savedata[name] ;
        $modelClass->domain = $savedata[domain];
        $modelClass->template = $savedata[template];
        $modelClass->create_date = date("Y-m-d H:i:s");
        $modelClass->update_date = date("Y-m-d H:i:s");
        if($modelClass->save())
        {
            //return true;
            Yii::$app->response->redirect(['/partners/default/', 'id' => $id['id']]);
        }else{
            return $modelClass->errors;
        }

    }

    public function actionUpdate()
    {
        $id = Yii::$app->request->post('Partners');
        $modelp = new Partners();
        $modelp = $modelp::findOne($id['id']);
        $modelp->name = $id['name'];
        $modelp->domain = $id['domain'];
        $modelp->template = $id['template'];
        $modelp->customers_id =$id['customers_id'];
        $modelp->update_date = date("Y-m-d H:i:s");
        if($modelp->update()) {
            //return true;
            Yii::$app->response->redirect(['/partners/default/', 'id' => $id['id']]);
        }


    }

    public function actionSavecateg()
    {
      $str =  Yii::$app->request->get('categories');
        $id =  Yii::$app->request->get('id');
        if($id !== ''){
            $modelClass =  Partners::findOne($id);
            $modelClass->allow_cat = $str;
            $modelClass->update_date = date("Y-m-d H:i:s");
            if($modelClass->update()){
                return true;
            }else{
                Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
                return $modelClass->errors;
            }
        }else{
            return false;
        }

    }

    public function actionGetpartnerscategories()
    {
        $id = Yii::$app->request->post('id');
        $modelClass =  Partners::findOne($id);
        $var = $modelClass->allow_cat;
        $var = explode(',', $var);
        Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        return $var;
    }

    public function actionUsersforaddrequest()
    {
        $id = Yii::$app->request->getQueryParam('id');
        $modelClass =  User::find()->select('partners_users.id, partners_users.username')->where(['id_partners' => $id, 'role' => 'register'])->joinWith('userinfo')->asArray()->all();
        Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        return $modelClass;
    }
    public function actionUsersaddadmin()
    {
        $id = Yii::$app->request->post('id');
        $auth = Yii::$app->authManager;
        $auth->revokeAll($id);
        $auth->assign($auth->getRole('admin'), $id);
        $modelClass = User::findOne($id);
        $modelClass->role = 'admin';
        $modelClass->update();
        Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        return $id;
    }
    public function actionUsersadmin()
    {
        $id = Yii::$app->request->post('id');
        $modelClass =  User::find()->select('partners_users.id, partners_users.username')->where(['id_partners' => $id, 'role' => 'admin'])->joinWith('userinfo')->asArray()->all();
        Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        return $modelClass;
    }
    public function actionUsersdeladmin()
    {
        $id = Yii::$app->request->post('id');
        $auth = Yii::$app->authManager;
        $auth->revokeAll($id);
        $auth->assign($auth->getRole('register'), $id);
        $modelClass = User::findOne($id);
        $modelClass->role = 'register';
        $modelClass->update();
        Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        return $id;
    }
}
