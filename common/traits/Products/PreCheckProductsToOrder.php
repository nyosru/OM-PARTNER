<?php
namespace common\traits\Products;

use common\models\PartnersProducts;
use common\models\PartnersProductsToCategories;
use common\models\User;
use Yii;


trait PreCheckProductsToOrder {
	public function preCheckProductsToOrder($product, $category = false, $region = false, $address_id = false, $count = false, $attr = false, $skip_time = false) {
		// По умолчанию даем заказать продукт
		$check = true;

		//Проверяем передан нам продукт или ид продукта(ид от недоверенных ресурсов)
		if (!is_array($product)) {
			$hide_man = $this->hide_manufacturers_for_partners();
			foreach ($hide_man as $value) {
				$list[] = $value['manufacturers_id'];
			}
			$hide_man = implode(',', $list);
			// Получаем продукт со всей ботвой
			$product = PartnersProducts::find()
				->where(['products.`products_id`' => (integer)$product])
				->JoinWith('productsDescription')
				->JoinWith('categories')
				->JoinWith('productsAttributes')
				->JoinWith('productsAttributesDescr')
				->andWhere('products_status = 1 and  death_reason = ""  and products.products_quantity > 0 and  products.products_price != 0 ')
				->andWhere('products.manufacturers_id NOT IN (' . $hide_man . ') ')
				->asArray()
				->one();
		}

		//Проверяем активность продукта, его наличие, и установленную цену == продукт существует и можно выполнять последующие проверки
		if ($product['products_status'] = 1 && $product['products_quantity'] != 0 && $product['products_price'] != 0) {

			// Запрет категорий в регионах
			// Проверяем передана ли нам категория товара и есть ли она у продукта, если категория не передана или отсутствует у продукта пропускаем эту проверку
			if (!$category === false || ($category = $product['categories']['categories_id']) == true) {

				// Массив категория=>[запрещенные регионы]
				$restricted_categories_to_region = [
					2764 => [222],
					2804 => [222],
					3247 => [222],
					2682 => [222]
				];
				//Возможно категория продукта находится в относительной иерархии дерева каталогов, так что чекаем
				// если есть совпадения тут мы их поймаем
				$categories = end(array_keys(array_intersect_key(array_flip($this->Catpath($category, 'num')),
					$restricted_categories_to_region)));

				// если категория продукта или его родительская категория находится в проверяемых проводим проверку
				if ($categories) {

					// Проверяем передали нам регион или нет, соответственно если не передали надо его получить
					if ($region === false) {

						// Получаем регион
						$region = User::find()->where([
								'partners_users.id' => Yii::$app->user->getId(),
								'partners_users.id_partners' => Yii::$app->params['constantapp']['APP_ID']
							])->joinWith('userinfo')->joinWith('customers')->joinWith('addressBook');
						//проверяем передали нам параметр на какой адрес заказ или нет, если нет проверяем дефолтный адрес клиента
						if ($address_id === false) {
							$region->select('customers.customers_default_address_id, address_book.address_book_id, address_book.entry_zone_id');
						}
						else {
							$region->select('address_book_id, address_book.entry_zone_id');
							$region->andWhere(['address_book_id' => (integer)$address_id]);
						}
						if (($region = $region->asArray()->one()) == true) {
							$region = $region['entry_zone_id'];
						}
					}
					// Проверяем наличие региона клиента в запрещенных
					if (in_array($region, $restricted_categories_to_region[ $categories ])) {
						// Если нашли возвращаем ошибку валидации
						$check = false;

						return [
							'result' => $check,
							'type' => 'restrictedregion',
							'message' => 'Товар не доступен в вашем регионе'
						];
					}
				}
			}


			// Проверяем время доступности для заказа(часики)
			if ($skip_time == false) {
				$man = $this->manufacturers_diapazon_id();
				$thisweeekday = date('N') - 1;
				$timstamp_now = time() - strtotime('today');
				if (array_key_exists($product['manufacturers_id'], $man) &&
					$man[ $product['manufacturers_id'] ][ $thisweeekday ]
				) {
					$stop_time = (int)$man[ $product['manufacturers_id'] ][ $thisweeekday ]['stop_time'];
					$start_time = (int)$man[ $product['manufacturers_id'] ][ $thisweeekday ]['start_time'];

					if (($start_time <= $timstamp_now && $timstamp_now <= $stop_time) && $start_time !== $stop_time) {
						$check = true;
					}
					else {
						$check = false;

						return [
							'result' => $check,
							'type' => 'restrictedtime',
							'message' => 'Товар не доступен для заказа в это время'
						];
					}
				}
				else {
					$check = true;
				}
			}

			return ['result' => $check, 'type' => 'success', 'message' => 'Товар доступен'];
		}
		else {
			$check = false;

			return ['result' => $check, 'type' => 'notexist', 'message' => 'Товар удален или отсутствует'];
		}

	}
}

?>