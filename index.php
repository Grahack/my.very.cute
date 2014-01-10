<?php
/* Minimalistic PHP MVC OOP WEB framework.
 *
 * Warning: do not use in production, pedagogical project only.
 */

// User defined constants:
define('BASE', 'http://127.0.0.1/my.very.cute/');
define('DEFAULT_METHOD', 'index');
define('DEBUG', true);

// Defs:
function dbg($var) {global $$var; if (DEBUG) echo ((isset($$var) ? ($var.': '.(is_array($$var)?print_r($$var, true):$$var)) : $var)).'<br />';}
function view($view_file, $vars = array(), $capture = false) {
    if ($capture) ob_start();
    if (file_exists($view_file)) include($view_file);
    else echo '<pre>'.print_r($vars, true).'</pre>';
    if ($capture) return ob_get_clean();
}
require('controller.php');

// Parse the request in $method and $args.
$req_URL = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
dbg('req_URL');
if (strpos($req_URL, BASE, 0) !== 0) exit("BASE not config'ed!");
if ($req_URL == BASE) {
    $path = '';
} else {
    $path = substr($req_URL, strlen(BASE.'index.php/'));
}
if ($path == '') $path = DEFAULT_METHOD;
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
