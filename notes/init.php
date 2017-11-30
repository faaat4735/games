<?php
if (file_exists(dirname(__FILE__) . '/private.php')) {
    require_once(dirname(__FILE__) . '/private.php');
}

!defined('DBNAME') &&  define('DBNAME', '');
!defined('HOSTNAME') &&  define('HOSTNAME', '');
!defined('DBUSER') &&  define('DBUSER', '');
!defined('DBPASS') &&  define('DBPASS', '');


