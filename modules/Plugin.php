<?php

/**
 * Description of Plugin
 *
 * @author dimko
 */
abstract class Plugin {
    abstract public function __construct();
    abstract public function proceed(&$param);
}
