<?php

function __autoload($className)
{
    $className = str_replace("..", "", $className);

    if (is_file("modules/" . $className . ".php"))
        include_once "modules/" . $className . ".php";
    else if (is_file("plugins/" . $className . "/". $className . ".php"))
        include_once "plugins/" . $className . "/". $className . ".php";
    else echo "Class \"$className\" load error!";
}

/**
 * Ядро системы
 *
 * @author dimko
 */
class Core
{
    private $mysqli;
    private $plugins;

    public $data = array();

    function __get($property)
    {
        if (isset($this->data[$property])) {
            return $this->data[$property];
        } else {
            echo "Error $property doesn`t set\n";
        }
    }

    public function __construct($mysqli)
    {
        $this->mysqli = $mysqli;

        $result = $this->mysqli->query("SELECT * FROM `core` LIMIT 1;");
        if (!$result) {
            printf("Error: %s\n", $this->mysqli->error);
        }
        $res = $result->fetch_array(MYSQLI_ASSOC);
        $result->close();

        $this->data['title'] = $res['title'];
        $this->data['home'] = $res['home'];
        $this->data['theme'] = $res['theme'];
        $this->data['copy'] = $res['copy'];

        $this->plugins = new ArrayObject();
        $this->loadPlugins();
    }

    public function getData($keys = array())
    {
        $result = array();
        if (!empty($keys)) :
            foreach ($keys as $key)
                $result[$key] = $this->data[$key];
        else:
            $result = $this->data;
        endif;
        return $result;
    }

    /**
     * Загрузка плагинов
     */
    private function loadPlugins()
    {
        if ($dir = scandir('plugins/'))
            foreach ($dir as $class) {
                $plugfile = 'plugins/' . $class . '/'. $class .'.php';
                if (is_file($plugfile)) {
                    if (class_exists($class))
                        if (get_parent_class($class) == 'Plugin') {
                            $class = new $class();
                            $this->plugins->append($class);
                        }
                }
            }
    }

}

?>
