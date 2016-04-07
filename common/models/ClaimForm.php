<?php
/**
 * Created by PhpStorm.
 * User: dmitriy
 * Date: 04.04.16
 * Time: 13:16
 */
namespace common\models;

use common\models\Orders;
use Yii;
use yii\base\Model;
use common\models\User;
use common\models\Customers;

/**
 * Claim form
 */
class ClaimForm extends Model
{

    public $opid;
    public $action;
    public $myphoto;
    private $urlPatr = '@web/images/priten/';
    private $valid_formats = ["jpg", "png", "gif", "jpeg"];
    public $pritenwrite;

    public function rules(){
     return [
         ['myphoto','file'],
         ['opid', 'integer'],
         [['opid','pritenwrite'], 'required'],
         ['pritenwrite', 'string']
     ];
    }
    public function formimagesave()
    {

        if (($customer = PartnersUsersInfo::find()->select('customers_id')->where(['id' => Yii::$app->user->id])->createCommand()->queryOne()) == TRUE && ($products_value = \common\models\Orders::find()->select(['customers_id', 'priten'])->joinWith('products')->where(['orders_products_id' => $this->opid])->asArray()->all()) == TRUE && $products_value['customers_id'] == $customer) {
            $now = date('Y-m-d h:i:s');
            $path = $this->urlPatr;
            $name = trim($this->myphoto['name']);
            $size = $_FILES['myphoto']['size'];
            if (strlen($name)) {
                $name_array = explode('.', $name);
                $ext = strtolower(array_pop($name_array));
                if (in_array($ext, $this->valid_formats)) {
                    if ($size < (4 * 1024 * 1024)) {
                        $actual_image_name = $this->opid . '_' . uniqid() . "." . $ext;
                        $tmp = $this->myphoto['tmp_name'];
                        if (is_file($tmp)) {
                            if (move_uploaded_file($tmp, $path . $actual_image_name)) {
                                $photo = new OrdersProductsPritenPhoto();
                                $photo->customer_id = $customer;
                                $photo->orders_products_id = $this->opid;
                                $photo->date_add = $now;
                                $photo->image_name_server = $actual_image_name;
                                $photo->image_name = $name;
                                if ($photo->save()) {
                                    $orderproducts = OrdersProducts::find()->where(['orders_products_id' => $this->opid])->one();
                                    $orderproducts->priten = "1";
                                    if ($orderproducts->update()) {
                                        return true;
                                    } else $this->addError('myphoto', 'Ошибка загрузки на сервер');
                                } else $this->addError('myphoto', 'Ошибка загрузки на сервер');
                            } else $this->addError('myphoto', 'Ошибка загрузки на сервер');
                        } else $this->addError('myphoto', 'Ошибка загрузки на сервер');
                    } else  $this->addError('myphoto', 'Ошибка копирования файла');
                } else $this->addError('myphoto', 'Максимальный размер файла 4 MB');
            } else $this->addError('myphoto', 'Неправильный формат файла..');
        } else {
        return $this->addError('myphoto', 'Необходимо авторизоваться');
        }
        return $this->addError('myphoto', 'Необходимо авторизоваться');
    }


    public function formcommentsave(){
        if (
            ($customer = PartnersUsersInfo::find()->select('customers_id')->where(['id' => Yii::$app->user->id])->createCommand()->queryOne()) == TRUE
            && ($products_value = \common\models\Orders::find()->select(['customers_id', 'priten'])->joinWith('products')->where(['orders_products_id' => $this->opid])->asArray()->all()) == TRUE
            && $products_value['customers_id'] == $customer) {
            if(($checkphoto = OrdersProductsPritenPhoto::find()->where(['orders_products_id'=>$this->opid])->createCommand()->queryOne()) == TRUE) {
                $now = date('Y-m-d h:i:s');
                if (strlen(strip_tags(trim($this->pritenwrite))) > 0) {
                    $claim = new OrdersProductsPriten();
                    $claim->type = '1';
                    $claim->author = $customer;
                    $claim->orders_products_id = $this->opid;
                    $claim->orders_products_priten = addslashes(strip_tags(trim($this->pritenwrite)));
                    $claim->date_add = $now;
                    $claim->av = '1';
                    $claim->save();
                    $orderproducts = OrdersProducts::find()->where(['orders_products_id' => $this->opid])->one();
                    $orderproducts->priten = "1";
                    if ($orderproducts->update()) {
                        return true;
                    } else $this->addError('pritenwrite', 'Ошибка добавления комментария');

                } else $this->addError('pritenwrite', 'Ошибка добавления комментария');
            }else $this->addError('pritenwrite', 'Должно быть загружено хотя бы одно изображение');
        }else $this->addError('pritenwrite', 'необходимо авторизоваться');
    }
}