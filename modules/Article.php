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
        $this->refreshBIG($id);
      //  $this->initArticle();
    }

    /**
     * Загрузка статьи
     */
    private function initArticle() {
    }
}

?>
