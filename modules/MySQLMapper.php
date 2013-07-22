<?php

/**
 * Description of MySQLMapper
 *
 * @author dimko
 */
class MySQLMapper extends DBMapper {
    protected $mysqli;
    public function __construct($mysqli) {
        $this->mysqli=$mysqli;
    }

    public function refresh(){
        $result=$this->mysqli->query("SELECT * FROM ".strtolower(get_called_class()).";");
         while($obj = $result->fetch_object()){ 
            $this->data[$obj->key]=$obj->value;
        }
        $result->close();
    }
}

?>
