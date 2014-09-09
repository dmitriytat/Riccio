<?php

function __autoload($className) {
    $className = str_replace("..", "", $className);

    if (is_file("modules/" . $className . ".php"))
        include_once "modules/" . $className . ".php";
    else if (is_file("plugins/" . $className . ".php"))
        include_once "plugins/" . $className . ".php";
    else echo "Class \"$className\" load error!";
}

/**
 * Ядро системы
 * 
 * @author dimko
 */
class Core extends MySQLMapper {

    private $plugins;

    public function __construct($mysqli) {
        $this->mysqli=$mysqli;
        $this->read("id", 1);
        $this->plugins = new ArrayObject();
        $this->loadPlugins();
    }

    /**
     * Загрузка плагинов
     */
    private function loadPlugins() {
        if ($dir = scandir("plugins/"))
            foreach ($dir as $plugfile) {
                $ext = substr($plugfile, -3);
                if (is_file("plugins/" . $plugfile) && $ext == "php") {
                    $plugin = substr($plugfile, 0, -4);
                    if (class_exists($plugin))
                        if (get_parent_class($plugin) == "Plugin") {
                            $plugin = new $plugin();
                            $this->plugins->append($plugin);
                        }
                }
            }
    }

}

?>
