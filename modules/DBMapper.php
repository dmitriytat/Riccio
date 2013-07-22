<?php

/**
 * Description of DBMapper
 *
 * @author dimko
 */
class DBMapper {    
    protected $data=array();

    function __get($property) {

        if (isset($this->data[$property])) {
            return $this->data[$property];
        } else {
            echo "Error $property doesn`t set";
        }
    }

    function __set($property, $val) {
        $this->data[$property] = $val;
    }
}

?>
