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

    /*
     * Загрузка данных класса в шаблонизатор
     */
    public function toTemplate(){
        foreach ($this->data as $key => $value) {
            TemplateSystem::assign(strtolower(get_called_class()) ."_". $key, $value);
        }
    }

    /**
     * Отображение доступных данных
     */
    public function showData()
    {
        echo json_encode($this);
    }

    abstract public function read($id, $field);
    abstract public function refresh();
    abstract public function write();
}

?>
