<?php

class User extends ActiveRecord
{
    protected static $scheme = array(
        'login' => 'VARCHAR(30) NOT NULL',
        'password' => 'VARCHAR(30) NOT NULL'
    );
}