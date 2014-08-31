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

    /**
     * Обновление данных и загрузка их из базы
     */
    public function refresh(){
        $result=$this->mysqli->query("SELECT * FROM ".strtolower(get_called_class()).";");
         while($obj = $result->fetch_object()){ 
            $this->data[$obj->key]=$obj->value;
        }
        $result->close();
    }

    public function refreshBIG($id){
        $result=$this->mysqli->query("SELECT * FROM ".strtolower(get_called_class())." WHERE id = {$id} LIMIT 1;");
        $this->data = $result->fetch_array(MYSQLI_ASSOC);
        $result->close();
    }

    /**
     * Отображение доступных данных
     */
    public function showData() {
        echo json_encode($this);
    }
}
?>
