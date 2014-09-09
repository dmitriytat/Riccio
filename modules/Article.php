<?php
/**
 * Статья
 * 
 * @author dimko
 */
class Article extends MySQLMapper {
    public function __construct($mysqli, $id) {
        $this->mysqli=$mysqli;
        $this->read("alias", $id);
    }
}

?>
