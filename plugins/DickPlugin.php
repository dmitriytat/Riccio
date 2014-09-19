<?php

/**
 * HelloPlugin
 * 
 * @author dimko
 */
class HelloPlugin extends Plugin {

    public function __construct() {
        EventSystem::regEvent("widget", $this, "show");
    }

    public function show(&$param) {
        $param .= "<div>Hello plugin!</div>";
    }

}

?>
