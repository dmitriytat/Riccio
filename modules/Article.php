<?php
/**
 * Статья
 * 
 * @author dimko
 */
class Article extends MySQLMapper {

    private $plugins;

    public function __construct($mysqli, $id) {
        $this->mysqli=$mysqli;
        $this->read($id, "alias");
    }
}

?>
