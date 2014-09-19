<?php

/**
 * Created by PhpStorm.
 * User: Дмитрий
 * Date: 13.09.14
 * Time: 0:26
 */
class RList extends MySQLMapper
{
    public function __construct($mysqli, $classname)
    {
        $this->mysqli = $mysqli;
        $this->readList($classname);
    }
}