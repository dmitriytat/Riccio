<?php

abstract class ActiveRecord extends ArrayObject
{
    static $mysqli;
    protected static $scheme = array();

    function __set($property, $value)
    {
        $this[$property] = $value;
    }

    public function __construct($data = array())
    {
        foreach ($data as $key => $value) {
            $this[$key] = $value;
        }
    }

    public static function sync($wipe = false)
    {
        if (!count(static::$scheme)) {
            return false;
        };

        $className = get_called_class();

        if ($wipe) {
            $result = self::$mysqli->query("DROP TABLE IF EXISTS " . strtolower($className));

            if (!$result) {
                echo "Error drop table: " . self::$mysqli->error;
                return false;
            }
        }

        $fields = '';

        foreach (static::$scheme as $key => $value) {
            $fields .= " $key $value,";
        }

        $sql = 'CREATE TABLE IF NOT EXISTS ' . strtolower($className) . ' (
                id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
                ' . $fields . '
                created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
                updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP)';

        if (self::$mysqli->query($sql)) {
            return true;
        } else {
            echo "Error creating table: " . self::$mysqli->error;
            return false;
        }
    }

    public function save()
    {
        $className = get_called_class();

        if (isset($this->id) && $this->id) {

            $t = "";
            $i = 0;

            foreach (get_object_vars($this) as $key => $value) {
                if ($key != 'id') {
                    if ($i > 0) $t .= ", ";
                    $t .= $key . "='" . $value . "'";
                    $i++;
                }
            }

            $result = self::$mysqli->query("UPDATE " . strtolower($className) . " SET $t WHERE id='$this->id' ;");

            if (!$result) {
                throw new Exception("Error updating record: " . self::$mysqli->error);
            }
        } else {
            $result = self::$mysqli->query(sprintf(
                "INSERT INTO " . strtolower($className) . " (%s) VALUES (\"%s\")",
                implode(',', array_keys((array)$this)),
                implode('","', array_values((array)$this))
            ));

            if (!$result) {
                throw new Exception("Error insert record: " . self::$mysqli->error);
            }

            $this->id = self::$mysqli->insert_id;
        }

        return $this;
    }

    public function destroy()
    {
        $className = get_called_class();

        self::$mysqli->query("DELETE FROM " . strtolower($className) . " WHERE id='$this->id'");

        if (self::$mysqli->affected_rows) {
            $this->id = null;
        }

        return $this;
    }

    public function reload()
    {
        $className = get_called_class();

        if ($this->id) {
            $result = self::$mysqli->query("SELECT * FROM " . strtolower($className) . " WHERE id='$this->id' LIMIT 1;");

            while ($obj = $result->fetch_object()) {
                foreach ((array)$obj as $key => $value) {
                    $this->$key = $value;
                }
            }

            $result->close();
        }

        return $this;
    }

    public static function find($attributes = array())
    {
        $className = get_called_class();

        $where = 'WHERE ';
        if (!empty($attributes)) {
            foreach ($attributes as $key => $val)
                $where .= "$key='$val' AND ";
            $where = substr($where, 0, -5);
        } else
            $where = '';

        $result = self::$mysqli->query("SELECT * FROM " . strtolower($className) . " $where ;");

        $records = array();

        while ($obj = $result->fetch_object()) {
            $records[] = new $className((array)$obj);
        }

        $result->close();

        return $records;
    }

    public static function findOne($attributes = array())
    {
        $className = get_called_class();

        $where = 'WHERE ';
        if (!empty($attributes)) {
            foreach ($attributes as $key => $val)
                $where .= "$key='$val' AND ";
            $where = substr($where, 0, -5);
        } else
            $where = '';

        $result = self::$mysqli->query("SELECT * FROM " . strtolower($className) . " $where LIMIT 1;");

        $records = null;

        if (!$result) {
            throw new Exception("Error fetching record: " . self::$mysqli->error);
        }

        while ($obj = $result->fetch_object()) {
            $records = new $className((array)$obj);
        }

        $result->close();

        return $records;
    }

    public static function all($attributes = array(), $limit = 0, $offset = 0)
    {
        $className = get_called_class();

        $where = 'WHERE ';
        if (!empty($attributes)) {
            foreach ($attributes as $key => $val)
                $where .= "$key='$val' AND ";
            $where = substr($where, 0, -5);
        } else
            $where = '';

        $limit = $limit > 0 ? 'LIMIT ' . $limit : '';
        $offset = $offset > 0 ? 'OFFSET ' . $offset : '';

        $result = self::$mysqli->query("SELECT * FROM " . strtolower($className) . " $where $limit $offset;");

        $records = array();

        while ($obj = $result->fetch_object()) {
            $records[] = new $className((array)$obj);
        }

        $result->close();

        return $records;
    }
}