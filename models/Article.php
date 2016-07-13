<?php

class Article extends ActiveRecord
{
    protected static $scheme = array(
        'alias' => 'varchar(128) NOT NULL UNIQUE',
        'title' => 'varchar(256) NOT NULL',
        'keywords' => 'varchar(256) NOT NULL',
        'description' => 'varchar(256) NOT NULL',
        'content' => 'varchar(4096) NOT NULL'
    );
}
