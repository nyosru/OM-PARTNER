<?php

namespace common\traits\api\sendays;

use Yii;
use yii\helpers\Url;
use yii\httpclient\Client;
use yii\helpers\BaseHtml;
use yii\web\HttpException;
use yii\validators\RequiredValidator;
use yii\validators\RangeValidator;
use yii\validators\DateValidator;
use kartik\date\DatePicker;
use kartik\datetime\DateTimePicker;

/**
 * Class SendaysForm works with forms API
 *
 * example:
 *   $request = Yii::$app->request;
 *   $sf = new SendaysForm('odezhda_master' , 1);
 *
 *   if ($request->isPost) {
 *     $save = $sf->save($request->post());
 *
 *     if ($save['response'] === 1) {
 *       echo $save['page'];
 *       exit;
 *     }
 *   }
 *
 *   echo $sf->create(Url::to(''));
 *
 * @package common\traits\api\sendays
 */
class SendaysForm
{
	private $formData = null;
	private $formId;
	private $serviceId;

	public function __construct($service_id, $form_id)
	{
		$this->serviceId = $service_id;
		$this->formId = $form_id;

		$this->formData = $this->getForm();
	}

	/**
	 * Creates page with form
	 *
	 * @param string $action
	 * @param string $method
	 * @param bool $just_fields
	 *
	 * @return string - html page | html fields
	 * @throws HttpException
	 */
	public function create(string $action, string $method = 'post', $just_fields = false)
	{
		if ($this->formData['obj']['state'] != '1')
			throw new HttpException('500', 'Форма отключена. Пожалуйста, зайдите в другой раз.');

		$form = $this->generateForm($this->formData['obj']['fields'], $action, $method);

		return $just_fields ? $form : str_replace('[% form.html %]', $form, $this->formData['obj']['landing_page']);
	}

	/**
	 * Saves form data into api
	 *
	 * @param array $data - data user entered
	 *
	 * @return array: 1|0 - response code, page - html result content
	 * @throws HttpException
	 */
	public function save(array $data): array
	{
		$validate = $this->validate($data);

		// date into mysql format
		foreach ($this->formData['obj']['fields'] as $field)
			if ($field['type'] === 'dt')
				$data[$field['name']] = date('Y-m-d H:i:s', strtotime($data[$field['name']]));

		if ($validate['response'] === 1) {
			unset($data['_csrf']);
			$data = json_encode($data);

			$client = new Client(['baseUrl' => 'https://sendsay.ru/form/' . $this->serviceId . '/' . $this->formId . '/']);
			$response = $client->createRequest()
				->setFormat(Client::FORMAT_JSON)
				->addHeaders([
					'accept' => 'application/json',
					'Content-Type' => 'application/json'
				])
				->setMethod('POST')
				->setContent($data)
				->send();

			if ($response->isOk)
				if (!isset($response->data['errors'])) {

					// redirect to url
					if (isset($response->data['redirect']))
						Yii::$app->getResponse()->redirect(Url::to($response->data['redirect']));

					return [
						'response' => 1,
						'page' => $response->data['page']
					];
				}	else {
					return [
						'response' => 0,
						'errors' => $response->data['errors']
					];
				}
			else
				throw new HttpException(500);
		} else
			return $validate;
	}

	/**
	 * Generates the form
	 *
	 * @param string $action
	 * @param string $method
	 *
	 * @return string - html form
	 */
	private function generateForm(array $form_fields, string $action, string $method): string
	{
		$form = BaseHtml::beginForm($action, $method);
		$form .= BaseHtml::tag('style',
			'.subpro_clear{padding-top:5px; padding-bottom:25px;} input{padding-left:3px; width:280px;} small{display:block; font-size:.7em;}',
			['type' => 'text/css']);
		$form .= $this->generateFields($form_fields);

		// button
		$btn = BaseHtml::button('Отправить', ['type' => 'submit', 'class' => 'subpro_btn']);
		$right_btn_helper = BaseHtml::tag('div', $btn, ['class' => 'subpro_right']);
		$form .= BaseHtml::tag('div', $right_btn_helper, ['class' => 'subpro_clear']);

		$form .= BaseHtml::endForm();
		return $form;
	}

	/**
	 * The method gets form from sendsay.ru
	 *
	 * @return array
	 * @throws HttpException
	 */
	private function getForm(): array
	{
		$client = new Client(['baseUrl' => 'https://sendsay.ru/form/' . $this->serviceId . '/' . $this->formId . '/']);
		$response = $client->createRequest()
			->setFormat(Client::FORMAT_JSON)
			->addHeaders(['accept' => 'application/json'])
			->setMethod('GET')
			->send();

		if ($response->isOk)
			return $response->data;
		else
			throw new HttpException(500);
	}

	/**
	 * This method generates fields for form
	 *
	 * @param array $fieldsRaw - raw fields
	 *
	 * @return string - html fields
	 */
	private function generateFields(array $fieldsRaw): string
	{
		$form = '';

		foreach ($fieldsRaw as $item) {
			$label = BaseHtml::label($item['label'], $item['name']);
			$options = [
				'id' => $item['name']
			];
			if ($item['required'] == '1')
				$options['required'] = true;

			switch ($item['type']) {
				case 'text':
					if (isset($item['max_length']) && (int)$item['max_length'] > 0)
						$options['maxlength'] = $item['max_length'];

					$type = $item['name'] === '_member_email' ? 'email' : 'text';
					$field = BaseHtml::input($type, $item['name'], $item['default'], $options);
					break;

				case 'select':
					$items = [];
					$selection = [];
					if ($item['multiselect'] == '1')
						$options['multiple'] = true;

					foreach ($item['variants'] as $variant) {
						$items[$variant['value']] = $variant['label'];
						if ($variant['selected'] === '1')
							$selection[] = $variant['value'];
					}

					$field = BaseHtml::dropDownList($item['name'], $selection, $items, $options);
					break;

				case 'dt':
					$format = 'mm-dd-yyyy';

					if ($item['max_length'] === 'Ys')
						$format .= ' hh:ii:ss';

					elseif ($item['max_length'] === 'Ym')
						$format .= ' hh:ii';

					elseif ($item['max_length'] === 'Yh')
						$format .= ' hh';

					if ($item['max_length'] === 'YD')
						$field = DatePicker::widget([
							'name' => $item['name'],
							'type' => DatePicker::TYPE_INPUT,
							'pluginOptions' => [
								'format' => $format
							]
						]);
					else
						$field = DateTimePicker::widget([
							'name' => $item['name'],
							'type' => DateTimePicker::TYPE_INPUT,
							'pluginOptions' => [
								'format' => $format
							]
						]);

//					$field = BaseHtml::input('text', $item['name'], null, $options);
//					$format = 'ДД.ММ.ГГГГ';
//
//					if ($item['max_length'] === 'Ys')
//						$format .= ' ЧЧ:ММ:ССС';
//
//					elseif ($item['max_length'] === 'Ym')
//						$format .= ' ЧЧ:ММ';
//
//					elseif ($item['max_length'] === 'Yh')
//						$format .= ' ЧЧ';
//
//					$field .= BaseHtml::tag('small', 'Дата в формате: ' . $format);

					break;

				default:
					$field = null;
			}

			$required_tag = BaseHtml::tag('span', '*', ['style' => 'color:#F00']);
			if ($options['required'])
				$label .= '&#32' . $required_tag;

			$left_helper = BaseHtml::tag('div', $label, ['class' => 'subpro_left']);
			$right_helper = BaseHtml::tag('div', $field, ['class' => 'subpro_right']);
			$item = BaseHtml::tag('div', $left_helper . $right_helper, ['class' => 'subpro_clear sendsayFieldItem']);

			$form .= $item;
		}

		return $form;
	}

	/**
	 * Validate inputs
	 *
	 * @param array $data - form data
	 *
	 * @return array [
	 *                  response:
	 *                    1 - everything is ok
	 *                    0 - something is wrong
	 *                  errors - errors array
	 *               ]
	 */
	private function validate(array $data): array
	{
		$errors = [];

		foreach ($this->formData['obj']['fields'] as $item) {
			if ($item['required']) {
				$required_validator = new RequiredValidator();
				$required_validator->validate($data[$item['name']], $errors[$item['name']][]);
			}

			switch ($item['type']) {
				case 'text':
					if ($item['max_length'] && strlen($data[$item['name']]) > $item['max_length'])
						$errors[$item['name']][] = 'Максимальное количество сиволов - ' . $item['max_length'];

					if ($item['name'] === '_member_email') {
						$client = new Client(['baseUrl' => 'https://sendsay.ru/form/' . $this->serviceId . '/' . $this->formId . '/']);
						$response = $client->createRequest()
							->setFormat(Client::FORMAT_JSON)
							->addHeaders([
								'accept' => 'application/json',
								'Content-Type' => 'application/json'
							])
							->setMethod('GET')
							->setContent(json_encode([
								'_action' => 'email_validate',
								'_member_email' => $data[$item['name']]
							]))
							->send();

						if ($response->isOk) {
							if (isset($response->data['errors']))
								$errors[$item['name']][] = 'Проверьте правильность введенного поля';
						}
						else
							throw new HttpException(500);
					}
					break;

				case 'select':
					$items = [];

					foreach ($item['variants'] as $variant) {
						$items[] = $variant['value'];
					}

					$range_validator = new RangeValidator([
						'range' => $items
					]);
					$range_validator->validate($data[$item['name']], $errors[$item['name']][]);
					break;

				case 'dt':
					$format = 'mm-dd-yyyy';

					if ($item['max_length'] === 'Ys')
						$format .= ' hh:ii:ss';

					elseif ($item['max_length'] === 'Ym')
						$format .= ' hh:ii';

					elseif ($item['max_length'] === 'Yh')
						$format .= ' hh';

					$date_validator = new DateValidator([
						'format' => $format
					]);
					$date_validator->validate($data[$item['name']], $errors[$item['name']][]);
					break;
			}
		}

		// clean every element
		foreach ($errors as $key => $error)
			$errors[$key] = array_filter($error);
		$errors = array_filter($errors); // when every error is empty, it cleans all errors array

		$response = !$errors ? 1 : 0;
		return [
			'response' => $response,
			'errors' => $errors
		];
	}
}