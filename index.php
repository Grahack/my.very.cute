<?php
// User defined constants:
$BASE = 'http://127.0.0.1/my.very.cute/';
$DEFAULT_METHOD = 'index';
$DEBUG = true;

// Defs:
function dbg($var) {global $DEBUG, $$var; if ($DEBUG) echo ((isset($$var) ? ($var.': '.(is_array($$var)?print_r($$var, true):$$var)) : $var)).'<br />';}
function req_URL() {return "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";}
require('controller.php');

// Parse the request in $method and $args.
$req_URL = req_URL();
if ($req_URL == $BASE) {
    $path = '';
} else {
    $path = substr($req_URL, strlen($BASE.'index.php/'));
}
if ($path == '') $path = $DEFAULT_METHOD;
dbg('req_URL');
dbg('path');
$expl = explode('/', rtrim($path, '/'), 2);
dbg('expl');
$method = $expl[0];
if (count($expl) == 1) {
    $args = array();
} else {
    $args = explode('/', $expl[1]);
}
dbg('method');
dbg('args');

// Trigger the right method of the controller with the right args.
$controller = new Controller();
if (method_exists($controller, $method)) {
    call_user_func_array (array($controller, $method), $args);
} else {
    header("HTTP/1.0 404 Not Found");
    dbg('404!');
}
