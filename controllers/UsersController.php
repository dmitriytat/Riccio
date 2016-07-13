<?php

/**
 * Created by PhpStorm.
 * User: dmitriy
 * Date: 13.07.16
 * Time: 20:39
 */
class UsersController
{
    public static function all($params)
    {
        $users = User::all();

        if (isset($params['ext']) && $params['ext'] == "json") {
            return json_encode($users);
        } else {
            return TemplateSystem::render('users.tpl', array('users' => $users));
        }
    }

    public static function one($params)
    {
        $user = User::findOne(array('id' => $params['id']));

        if (isset($params['ext']) && $params['ext'] == "json") {
            return json_encode($user);
        } else {
            return TemplateSystem::render('user.tpl', array('data' => $user));
        }
    }
}