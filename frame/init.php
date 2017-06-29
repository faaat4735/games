<?php

use Ebd\Loader\Autoloader;
use Ebd\ServiceLocator\ServiceLocator;
use Ebd\Utils\Http;


//DS
if (!defined('DS')) {
    define('DS', DIRECTORY_SEPARATOR);
}


/**
 * filesystem constants
 */
define('APP_DIR',       ROOT_DIR . 'app/');
define('LOG_DIR',       ROOT_DIR . 'log/');
define('CLASS_DIR',    APP_DIR  . 'class/');
define('CONFIG_DIR',    APP_DIR  . 'config/');
define('INC_DIR',       APP_DIR  . 'include/');
define('TPL_DIR',       APP_DIR  . 'template/');
// additions
define('JS_DIR',        ROOT_DIR . 'static/src/js/');
define('CSS_DIR',       ROOT_DIR . 'static/src/css/');
define('IMG_DIR',       ROOT_DIR . 'static/src/image/');



/**
 * load the private configure
 */
if (file_exists(CONFIG_DIR . 'config.php')) {
    include CONFIG_DIR . "config.php";
}

/**
 * Run enviorment
 */
// !defined('ENV_PRODUCTION') && define('ENV_PRODUCTION', false);
// if (!ENV_PRODUCTION) {
//     error_reporting(E_ALL);
// }

/**
 * Specially for CLI
 */
// !isset($_SERVER['REMOTE_ADDR']) && $_SERVER['REMOTE_ADDR'] = 'cli';
// !isset($_SERVER['HTTP_HOST']) && $_SERVER['HTTP_HOST'] = 'www.eyebuydirect.com';

/**
 * library
 */
!defined('LIB_DIR') && define('LIB_DIR', __DIR__ . '/library/Frank/');

// /**
//  * Res director
//  */
!defined('RES_DIR') && define('RES_DIR', ROOT_DIR . '../res/');
define('UPLOAD_PHOTO_DIR',      RES_DIR . 'upload/photo/');

// /**#@+
//  * host information
//  */
// !defined('SSL_ENABLED') && define('SSL_ENABLED', false);
// !defined('HTTP_CDN') && define('HTTP_CDN', (SSL_ENABLED ? 'https://' : 'http://') . 'cdn.' . $_SERVER["HTTP_HOST"]);
// !defined('HTTP_SERVER') && define('HTTP_SERVER', (SSL_ENABLED ? 'https://' : 'http://') . $_SERVER["HTTP_HOST"]);
// !defined('HTTPS_SERVER') && define('HTTPS_SERVER', (SSL_ENABLED ? 'https://' : 'http://') . $_SERVER["HTTP_HOST"]);
// /**#@-*/

// /**#@+
//  * database information
//  */
// !defined('DB_HOST') && define('DB_HOST', '192.168.0.8');
// !defined('DB_PORT') && define('DB_PORT', 3306);
// !defined('DB_USERNAME') && define('DB_USERNAME', 'ebd_dev');
// !defined('DB_PASSWORD') && define('DB_PASSWORD', 'ebd');
// !defined('DB_DATABASE') && define('DB_DATABASE', 'ebd_main_bak');
// /**#@-*/


// /**#@+
//  * redis
//  */
// !defined('REDIS_ENABLED') && define('REDIS_ENABLED', false);
// !defined('REDIS_HOST') && define('REDIS_HOST', '192.168.0.8');
// !defined('REDIS_PORT') && define('REDIS_PORT', '6379');
// /**#@-*/


/**
 * register autoload
 */
// require LIB_DIR . 'Ebd/Loader/Autoloader.php';
// Autoloader::setNamespaces(array(
//     'Ebd' => LIB_DIR,
//     'App' => APP_DIR . 'class/',
//     'Amazon' => INC_DIR . 'AmazonTmp/', // delete later
// ));
// Autoloader::register();

//auto load classes
function ebd_autoload($className)
{
    $classFileName = str_replace('_', DS, $className) . '.class.php';

    if (file_exists(CLASS_DIR . $classFileName)) {
        require_once CLASS_DIR . $classFileName;
    }
    // elseif (file_exists(LIB_CLASS_DIR . $classFileName)) {
    //     require_once LIB_CLASS_DIR . $classFileName;
    // }
    else {
        return false;
    }
}
spl_autoload_register('ebd_autoload');

// /* @var $locator ServiceLocator */
// $GLOBALS['locator'] = new ServiceLocator(include CONFIG_DIR . 'services.php');

// /**
//  * Locale & Currency Rate & Point Rate & language
//  */
// $locale = $locator->get('Locale');
// define('LOCALE_ID',     $locale['locale_id']);
// define('CURRENCY_CODE', $locale['currency_code']);
// define('CURRENCY_RATE', $locale['currency_rate']);
// define('POINT_RATE',    $locale['point_rate']);
// define('TAX_RATE',      isset($locale['tax_rate']) && $locale['tax_rate'] > 0 ? $locale['tax_rate'] : 0 );

// /**
//  * Third-party send mail 'BRONTO' or 'SES'
//  */
// !defined('MAIL_SENDER') && define('MAIL_SENDER', 'BRONTO');

// // render page via utf8 charset
// Http::mimeType('html', 'utf-8');