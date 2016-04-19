<?php
namespace frontend\controllers\actions;

use common\models\PartnersCategories;
use Yii;
use yii\db\ActiveRecord;
use yii\helpers\ArrayHelper;
function get_rand_data() {
    return [
        'a' => mt_rand(1, 1000),
        'b' => mt_rand(1, 1000),
        'c' => mt_rand(1, 1000),
        'd' => mt_rand(1, 1000),
        'e' => mt_rand(1, 1000),
    ];
}
function prepare_data(&$data) {
    return ($data['a'] * $data['b'] / ( $data['c'] * $data['d'] )) / $data['e'];
}

class Data {
    protected $data = [];
    public function __construct(array &$data = []) {
        $this->data = $data;
    }
    public function run() {
        return ($this->data['a'] * $this->data['b'] / ( $this->data['c'] * $this->data['d'] )) / $this->data['e'];
    }
    public function setData(array &$data) {
        $this->data = $data;
        return $this;
    }
    public function setDataNotReturn(array &$data) {
        $this->data = $data;
    }
}
class StaticData {
    public static function run(&$data) {
        return ($data['a'] * $data['b'] / ( $data['c'] * $data['d'] )) / $data['e'];
    }
}
function show_delta($end, $start, $text) {
    return $text.': '.round(($end-$start), 5). " seconds\n";
}

trait ActionTestUnit
{
    public function actionTestunit()
    {
        $test_iteration = 500000;

        $start = microtime(1);
        for($i =0; $i<$test_iteration; ++$i) {
            $data = get_rand_data();
            prepare_data($data);
        }

        $out = show_delta(microtime(1), $start, 'Array mode').'</br>';

        $start = microtime(1);
        for($i =0; $i<$test_iteration; ++$i) {
            $data = get_rand_data();
            $result = ($data['a'] * $data['b'] / ( $data['c'] * $data['d'] )) / $data['e'];
        }

        $out .=  show_delta(microtime(1), $start, 'Array run body for mode').'</br>';

        $start = microtime(1);
        for($i =0; $i<$test_iteration; ++$i) {
            $data = get_rand_data();
            (new Data($data))->run();
        }

        $out .=   show_delta(microtime(1), $start, 'Object mode').'</br>';

        $start = microtime(1);
        $runner = new Data();
        for($i =0; $i<$test_iteration; ++$i) {
            $data = get_rand_data();
            $runner->setData($data)->run();
        }

        $out .=    show_delta(microtime(1), $start, 'Object mode (v2)').'</br>';

        $start = microtime(1);
        $runner = new Data();
        for($i =0; $i<$test_iteration; ++$i) {
            $data = get_rand_data();
            $runner->setDataNotReturn($data);
            $runner->run();
        }

        $out .= show_delta(microtime(1), $start, 'Object mode (v3)').'</br>';

        $start = microtime(1);
        for($i =0; $i<$test_iteration; ++$i) {
            $data = get_rand_data();
            StaticData::run($data);
        }

        $delta = microtime(1) - $start;

        $out .= show_delta(microtime(1), $start, 'Static object mode').'</br>';

        return $out;
    }
}