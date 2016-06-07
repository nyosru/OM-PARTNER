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
    private $urlPatr = '@webroot/images/priten/';
    private $valid_formats = ["jpg", "png", "gif", "jpeg"];
    public $pritenwrite;

    public function rules()
    {
        return [
            ['myphoto', 'file'],
            ['opid', 'integer'],
            [['opid', 'pritenwrite'], 'required'],
            ['pritenwrite', 'string']
        ];
    }

    public function formimagesave()
    {

        if (
            ($customer = PartnersUsersInfo::find()->select('customers_id')->where(['id' => Yii::$app->user->id])->createCommand()->queryOne()) == TRUE
            && ($products_value = \common\models\Orders::find()->select(['customers_id', 'priten'])->joinWith('products')->where(['orders_products_id' => $this->opid])->asArray()->one()) == TRUE
            && $products_value['customers_id'] == $customer['customers_id']
        ) {
            $now = date('Y-m-d h:i:s');
            $path = Yii::getAlias($this->urlPatr) . '/' . $this->opid . '/';
            $name = trim($this->myphoto['name']);
            $size = $this->myphoto['size'];
            if (strlen($name)) {
                $name_array = explode('.', $name);
                $ext = strtolower(array_pop($name_array));
                if (in_array($ext, $this->valid_formats)) {
                    if ($size < (4 * 1024 * 1024)) {
                        $actual_image_name = $this->opid . '_' . md5($name) . "." . $ext;
                        $tmp = $this->myphoto['tempName'];
                        if (is_file($tmp)) {
                            if (mkdir($path, 0777, true)) {
                                return $this->addError('myphoto', $path);
                            }
                            if (move_uploaded_file($tmp, $path . $actual_image_name)) {
                                $countphoto = OrdersProductsPritenPhoto::find()->where(['orders_products_id' => $this->opid])->count();
                                if ($countphoto >= 10) {
                                    return $this->addError('myphoto', 'Максимум 10 фотографий');
                                }
                                $photo = OrdersProductsPritenPhoto::find()->where(['orders_products_id' => $this->opid, 'image_name_server' => $actual_image_name])->one();
                                if (!$photo) {
                                    $photo = new  OrdersProductsPritenPhoto();
                                }
                                $photo->customer_id = $customer['customers_id'];
                                $photo->orders_products_id = $this->opid;
                                $photo->date_add = $now;
                                $photo->image_name_server = $actual_image_name;
                                $photo->image_name = $name;
                                if ($photo->save()) {
                                    $orderproducts = OrdersProducts::find()->where(['orders_products_id' => $this->opid])->one();
                                    $orderproducts->priten = "1";
                                    $orderproducts->validate();
                                    if ($orderproducts->save()) {
                                        return ['name' => $actual_image_name, 'state' => 'succes'];
                                    }
                                    return ['name' => $actual_image_name, 'state' => 'error'];;
                                } else $this->addError('myphoto', $photo->errors);
                            } else $this->addError('myphoto', $tmp);
                        } else $this->addError('myphoto', $this->myphoto);
                    } else  $this->addError('myphoto', 'Ошибка копирования файла');
                } else $this->addError('myphoto', 'Максимальный размер файла 4 MB');
            } else $this->addError('myphoto', 'Неправильный формат файла..');
        } else {
            return $this->addError('myphoto', 'Необходимо авторизоваться5');
        }

    }


    public function formcommentsave()
    {
        if (
            ($customer = PartnersUsersInfo::find()->select('customers_id')->where(['id' => Yii::$app->user->id])->createCommand()->queryOne()) == TRUE
            && ($products_value = \common\models\Orders::find()->select(['customers_id', 'priten'])->joinWith('products')->where(['orders_products_id' => $this->opid])->asArray()->one()) == TRUE
            && $products_value['customers_id'] == $customer['customers_id']
        ) {
            if (($checkphoto = OrdersProductsPritenPhoto::find()->where(['orders_products_id' => $this->opid])->createCommand()->queryOne()) == TRUE) {
                $now = date('Y-m-d h:i:s');
                if (strlen(strip_tags(trim($this->pritenwrite))) > 0) {
                    $claim = new OrdersProductsPriten();
                    $claim->type = '1';
                    $claim->author = $customer['customers_id'];
                    $claim->orders_products_id = $this->opid;
                    $claim->orders_products_priten = addslashes(strip_tags(trim($this->pritenwrite)));
                    $claim->date_add = $now;
                    $claim->av = '1';
                    $claim->save();
                    $orderproducts = OrdersProducts::find()->where(['orders_products_id' => $this->opid])->one();
                    $orderproducts->priten = "1";
                    $orderproducts->validate();
                    if ($orderproducts->save()) {
                        return ['state' => 'succes'];
                    } else $this->addError('pritenwrite', 'Ошибка добавления комментария');

                } else $this->addError('pritenwrite', 'Ошибка добавления комментария');
            } else $this->addError('pritenwrite', 'Должно быть загружено хотя бы одно изображение');
        } else $this->addError('pritenwrite', 'Необходимо авторизоваться');
    }
}