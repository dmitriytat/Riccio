<?php

/**
 * PHP Event system
 * 
 * @author dimko
 */
class EventSystem {

    private static $events = array();

    /**
     * Регистрация и подписка на событие
     * @param mixed $event Событие
     * @param object $object Обьект
     * @param callable $function Обработчик
     */
    public static function regEvent($event, $object, $function) {
        if (!isset(self::$events[$event])) {
            self::$events[$event] = new ArrayObject();
        }
        $objfunc = new ObjectFunction($object, $function);
        self::$events[$event]->append($objfunc);
    }

    /**
     * Оповещение подписанных обьектов
     * @param mixed $event Событие
     * @param array $parameters Параметры для обработчика
     */
    public static function fireEvent($event, $parameters = array()) {
        if (isset(self::$events[$event])) {
            foreach (self::$events[$event] as $e) {
                if (isset($e->object)) {
                    call_user_func_array(array($e->object, $e->function), $parameters);
                }
            }
        }
    }

}

/**
 * Пара обьект + значение
 */
class ObjectFunction {

    public $object;
    public $function;

    public function __construct($object, $function) {
        $this->object = $object;
        $this->function = $function;
    }

}

?>
