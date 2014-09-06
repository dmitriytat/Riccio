<?php

/**
 * Абстрактный класс мапера баз данных
 *
 * @author dimko
 */
abstract class DBMapper {
    public  $data=array(); // Костыль, нужно protected

    function __get($property) {

        if (isset($this->data[$property])) {
            return $this->data[$property];
        } else {
            echo "Error $property doesn`t set\n";
        }
    }

    function __set($property, $val) {
        $this->data[$property] = $val;
    }

    abstract public function read($id);
    abstract public function refresh();
    abstract public function write();
}

?>
