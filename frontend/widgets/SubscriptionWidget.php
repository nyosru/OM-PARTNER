<?php

namespace frontend\widgets;

use Yii;
use yii\helpers\Url;
use common\traits\api\sendays\SendaysForm;
use yii\helpers\VarDumper;

class SubscriptionWidget extends \yii\base\Widget
{
	public function run()
	{
		parent::init();

		$sf = new SendaysForm('odezhda_master' , 2);
		$form = $sf->create(Url::to('/subscription'), 'post', true);

		return $this->render('subscription', [
			'form' => $form
		]);
	}
}