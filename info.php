<?php

require_once "modules/Core.php";

$Core = new Core();

class ARObject extends ActiveRecord {

    public $id;
    private $info;
    protected $data;
    public $state;

}

$a = new ARObject();
$a->save();
?>
