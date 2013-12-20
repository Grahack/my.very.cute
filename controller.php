<?php
dbg("Controller loaded.");

// Include model files.
foreach (glob("m_*.php") as $filename) include $filename;

// OO controller.
class Controller {
    public function index() {
        dbg("Home page");
    }
    public function what_is_the_url_of_this_method($an_arg = "a great default value") {
        dbg("another method, having an arg: ".$an_arg);
    }
}
