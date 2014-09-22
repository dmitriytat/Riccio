<?php
/**
 * Created by PhpStorm.
 * User: Дмитрий
 * Date: 10.09.14
 * Time: 0:38
 */

class User  extends MySQLMapper {
    public function __construct($mysqli) {
        $this->mysqli=$mysqli;
    }
}