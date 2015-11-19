<?php

/**
 * Created by PhpStorm.
 * User: User
 * Date: 19.11.2015
 * Time: 11:54
 */
class Timer
{

    public $id;
    public $timeTimer;

    /* Функция запуска таймера */
    function start()
    {
        $mtime = microtime();//узнаем текущие время в секундах и милисекундах
        $mtime = explode(' ', $mtime);
        $mtime = $mtime[1] + $mtime[0];
        $this->timeTimer[$this->id]['start'] = $mtime;//занесем результат в глобальную переменную
    }

    function stop()
    {
        $mtime = microtime();
        $mtime = explode(' ', $mtime);
        $mtime = $mtime[1] + $mtime[0];
        $this->timeTimer[$this->id]['stop'] = $mtime;
        $this->timeTimer[$this->id]['result'] = $mtime - $this->timeTimer[$this->id]['start'];
    }

    function get($rand = 5)
    {
        if ($this->timeTimer[$this->id]['result']) return $this->timeTimer[$this->id]['result'];
        $mtime = microtime();
        $mtime = explode(' ', $mtime);
        $mtime = $mtime[1] + $mtime[0];
        return round($mtime - $this->timeTimer[$this->id]['start'], $rand);

    }

    function __construct($id = '')
    {
        if (!$id) {
            trigger_error('Wrong parametr input [TIMER]', E_USER_WARNING);
        }
        if ($this->timeTime[$id]) {
            trigger_error('Can not init timer', E_USER_WARNING);
        }
        $this->id = $id;
    }
}