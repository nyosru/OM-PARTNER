<?php

namespace frontend\controllers\actions;

use Yii;
use yii\web\HttpException;
use common\traits\api\sendays\SendaysForm;

trait ActionSubscription
{
	public function actionSubscription()
	{
		$request = Yii::$app->request;
		if (array_key_exists('application/json', $request->getAcceptableContentTypes()) && $request->isPost && $request->isAjax) {
			$sf = new SendaysForm('odezhda_master' , 1);
			$save = $sf->save($request->post());
			echo json_encode($save);
		}
		else
			throw new HttpException(404);
	}
}