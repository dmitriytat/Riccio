<?php

/**
 * HelloPlugin
 *
 * @author dimko
 */
class MessagesPlugin extends Plugin
{
    public function __construct()
    {
        EventSystem::regEvent("MessagesPlugin", $this, "proceed");
    }

    public function proceed(&$param)
    {
        if (isset($param)) {
            $param = TemplateSystem::render('messages.tpl', array('messages' => Message::all(array('article' => $param[0]), 10)), 'plugins/' . get_called_class() . '/');
        }
    }
}

?>
