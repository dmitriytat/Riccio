<?php

/**
 * Created by PhpStorm.
 * User: Дмитрий
 * Date: 11.01.2015
 * Time: 17:11
 */
class SocialShare extends Plugin
{
    public function __construct()
    {
        EventSystem::regEvent("SocialShare", $this, "proceed");
    }

    public function proceed(&$param)
    {
        $param = TemplateSystem::render('plugins/' . get_called_class() . '/buttons.tpl', array('url' => implode('', $param)));
    }
}