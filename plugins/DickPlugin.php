<?php

/**
 * HelloPlugin
 *
 * @author dimko
 */
class DickPlugin extends Plugin
{

    public function __construct()
    {
        EventSystem::regEvent("article_title", $this, "show");
        EventSystem::regEvent("article_keywords", $this, "show");
        EventSystem::regEvent("article_description", $this, "show");
        EventSystem::regEvent("article_content", $this, "show");
    }

    public function show($param)
    {
        return $param .= "хуй";
    }
}

?>
