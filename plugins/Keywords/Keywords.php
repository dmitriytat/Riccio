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
        EventSystem::regEvent("keywords", $this, "proceed");
    }

    public function proceed($param)
    {
        if (isset($param)) {
            $words = explode(",", $param);
            $temp = '';
            foreach ($words as $word) {
                $temp .= TemplateSystem::showPage('keyword.tpl', array('word'=>$word), 'plugins/'.get_called_class());
            }
            $param = $temp;
        }
    }
}

?>
