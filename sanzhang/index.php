<?php

define('ROOT_DIR', __DIR__  . '/');
require_once '../frame/init.php';
$aa = explode('/', substr($_SERVER['REQUEST_URI'], 1));
$_controller = ucfirst($aa[0]);
$_action = $aa[1];
$class = new $_controller();
$class->$_action();
require_once TPL_DIR . $_controller . '/' . $_action . '.html';

?>