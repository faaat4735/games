<?php

define('ROOT_DIR', __DIR__  . '/');
require_once '../frame/init.php';
require_once '../frame/library/Frank/Core/Front.php';
$front = new Front();
$front->run($front->dispatch());

?>