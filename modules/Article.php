<?php

/**
 * Статья
 *
 * @author dimko
 */
class Article
{
    private $mysqli;

    public function __construct($mysqli)
    {
        $this->mysqli = $mysqli;
    }


    /**
     * @param array $select данные для выборки
     * @param array $where условия обьеденяются через и
     * @param int $limit ограничение на колличество вывода
     * @return array или одну статью или массив в зависимости от ограничения
     */
    public function getArticle($select = array(), $where = array(), $limit = 1)
    {
        $Article = array();

        $slct = '';
        if (!empty($select)) {
            foreach ($select as $sel)
                $slct .= "$sel, ";
            $slct = substr($slct, 0, -2);
        } else
            $slct = '*';

        $whr = 'WHERE ';
        if (!empty($where)) {
            foreach ($where as $key => $val)
                $whr .= "$key='$val' AND ";
            $whr = substr($whr, 0, -5);
        } else
            $whr = '';

        $result = $this->mysqli->query("SELECT $slct FROM article $whr LIMIT $limit;");
        if (!$result) {
            printf("Error: %s\n", $this->mysqli->error);
        }

        while ($res = $result->fetch_array(MYSQLI_ASSOC)) {
            if ($limit > 1)
                $Article[] = $res;
            else
                $Article = $res;
        }

        $result->close();

        return $Article;
    }
}

?>
