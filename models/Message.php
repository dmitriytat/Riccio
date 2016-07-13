<?php

class Message extends ActiveRecord
{
    protected static $scheme = array(
        'article' => 'INT(6) UNSIGNED NOT NULL',
        'text' => 'VARCHAR(140) NOT NULL'
    );
}