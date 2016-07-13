<?php

class Message extends ActiveRecord
{
    protected static $scheme = array(
        'user' => 'INT(6) UNSIGNED NOT NULL',
        'text' => 'VARCHAR(30) NOT NULL'
    );
}