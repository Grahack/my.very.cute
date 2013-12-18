<?php
// User defined constants:
$BASE = 'http://127.0.0.1/my.very.cute/';
$DEFAULT_METHOD = 'index';
$DEBUG = true;

// Defs:
function dbg($var) {global $DEBUG, $$var; if ($DEBUG) echo ((isset($$var) ? ($var.': '.(is_array($$var)?print_r($$var, true):$$var)) : $var)).'<br />';}
function req_URL() {return "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";}
require('controller.php');

// Parse the request and trigger the controller.
$req_URL = req_URL();
if ($req_URL == $BASE) {
    $path = '';
} else {
    $path = substr($req_URL, strlen($BASE.'index.php/'));
}
if ($path == '') $path = $DEFAULT_METHOD;
dbg('req_URL');
dbg('path');
$expl = explode('/', $path, 2);
dbg('expl');
$method = $expl[0];
if (count($expl) == 1) {
    $args = array();
} else {
    $args = explode('/', $expl[1]);
}
dbg('method');
dbg('args');
$controller = new Controller();
if (method_exists ($controller , $method)) {
    $controller->$method();
} else {
    header("HTTP/1.0 404 Not Found");
    dbg('404!');
}
