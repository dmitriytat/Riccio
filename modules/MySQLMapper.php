<?php

/**
 * Description of MySQLMapper
 *
 * @author dimko
 */
class MySQLMapper extends DBMapper
{
    protected $mysqli;

    public function __construct($mysqli)
    {
        $this->mysqli = $mysqli;
    }

    /**
     * Считывание данных из базы в обьект
     */
    public function read($id, $field="id")
    {
        $result = $this->mysqli->query("SELECT * FROM " . strtolower(get_called_class()) . " WHERE $field = '$id' LIMIT 1;");
        if (!$result) {
            printf("Error: %s\n", $this->mysqli->error);
        }
        $this->data = $result->fetch_array(MYSQLI_ASSOC);
        $result->close();
    }

    /*
     * Обновление данных обьекта
     */
    public function refresh()
    {
        $result = $this->mysqli->query("SELECT * FROM " . strtolower(get_called_class()) . " WHERE id = {$this->id} LIMIT 1;");
        if (!$result) {
            printf("Error: %s\n", $this->mysqli->error);
        }
        $this->data = $result->fetch_array(MYSQLI_ASSOC);
        $result->close();
    }


    /*
     * Запись измененного обьекта в базу данных
     */
    public function write()
    {
        $sql = "UPDATE " . strtolower(get_called_class()) . " SET ";
        $t = "";
        $i=0;
        foreach ($this->data as $key => $value) {
            if ($key != 'id'){
                if ($i>0) $t.= ", ";
                $t .= $key . "='" . $value . "'";
                $i++;
            }
        }
        $sql .= $t. " WHERE id = {$this->id} ";
        $result = $this->mysqli->query($sql);
        if (!$result) {
            printf("Error: %s\n", $this->mysqli->error);
        }
    }

    /**
     * Отображение доступных данных
     */
    public function showData()
    {
        echo json_encode($this);
    }
}

?>


