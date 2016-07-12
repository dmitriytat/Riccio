<?php

/**
 * HelloPlugin
 *
 * @author dimko
 */
class Keywords extends Plugin
{
    public function __construct()
    {
        EventSystem::regEvent("data.keywords", $this, "proceed");
    }

    public function proceed(&$param)
    {
        if (isset($param)) {
            $words = explode(",", $param);
            $temp = '';
            foreach ($words as $word) {
                $temp .= TemplateSystem::render('plugins/' . get_called_class() . '/keyword.tpl', array('word' => $word));
            }

            $param = $temp;
        }
    }
}

?>
