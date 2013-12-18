<?php
dbg("Controller loaded.");

// Include model files.
foreach (glob("m_*.php") as $filename) include $filename;

// OO controller.
class Controller {
    public function index() {
        dbg("accueil");
    }
    public function autre_methode($un_arg = "valeur par defaut") {
        dbg("autre methode, ayant pour arg: ".$un_arg);
    }
}
