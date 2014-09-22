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
    public function read()
    {
        $where = "";
        $numargs = func_num_args();
        if ($numargs % 2 != 0) echo "Read args count error!";
        $arg_list = func_get_args();
        for ($i = 0; $i < $numargs; $i += 2) {
            $where .= $arg_list[$i] . " = '" . $arg_list[$i + 1] . "'";
            if ($i < $numargs - 2) $where .= " AND ";
        }

        $result = $this->mysqli->query("SELECT * FROM " . strtolower(get_called_class()) . " WHERE $where LIMIT 1;");
        if (!$result) {
            printf("Error: %s\n", $this->mysqli->error);
        }
        $this->data = $result->fetch_array(MYSQLI_ASSOC);

        $this->toTemplate();
        $result->close();
        return $this->id;
    }

    /**
     * Считывание данных из базы в обьект
     */
    public function readList($classname)
    {
        $where = "";
        $numargs = func_num_args();
        if ($numargs % 2 != 1) echo "Read args count error!";
        $arg_list = func_get_args();
        for ($i = 1; $i < $numargs; $i += 2) {
            $where .= $arg_list[$i] . " = '" . $arg_list[$i + 1] . "'";
            if ($i < $numargs - 3) $where .= " AND ";
        }
        if ($where != "") $where = "WHERE " . $where;

        echo $where;
        $result = $this->mysqli->query("SELECT * FROM " . strtolower($classname) . " $where;");
        if (!$result) {
            printf("Error: %s\n", $this->mysqli->error);
        }

        while ($line = $result->fetch_array(MYSQLI_ASSOC)) {
            $this->data[$line['id']] = $line;
        }

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
        $sql = "";
        if (isset($this->id) and $this->id != 0) {
            $sql = "UPDATE " . strtolower(get_called_class()) . " SET ";
            $t = "";
            $i = 0;
            foreach ($this->data as $key => $value) {
                if ($key != 'id') {
                    if ($i > 0) $t .= ", ";
                    $t .= $key . "='" . $value . "'";
                    $i++;
                }
            }
            $sql .= $t . " WHERE id = {$this->id} ";
        } else {
            $sql = sprintf(
                "INSERT INTO " . strtolower(get_called_class()) . " (%s) VALUES (\"%s\")",
                implode(',', array_keys($this->data)),
                implode('","', array_values($this->data))
            );
            $this->id=$this->mysqli->insert_id;
        }
        $result = $this->mysqli->query($sql);
        if (!$result) {
            printf("Error: %s\n", $this->mysqli->error);
        }

        return $this->id;
    }
}

?>


