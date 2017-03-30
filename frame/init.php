<?php

use Ebd\Loader\Autoloader;
use Ebd\ServiceLocator\ServiceLocator;
use Ebd\Utils\Http;

/**
 * filesystem constants
 */
define('APP_DIR',       ROOT_DIR . 'app/');
// define('TMP_DIR',       ROOT_DIR . 'tmp/');
define('LOG_DIR',       ROOT_DIR . 'log/');
// define('PUBLIC_DIR',    WWW_DIR  . 'public/');
define('CLASS_DIR',    APP_DIR  . 'class/');
define('CONFIG_DIR',    APP_DIR  . 'config/');
define('INC_DIR',       APP_DIR  . 'include/');
define('TPL_DIR',       APP_DIR  . 'template/');
// additions
define('JS_DIR',        ROOT_DIR . 'static/src/js/');
define('CSS_DIR',       ROOT_DIR . 'static/src/css/');
// define('AUDIO_DIR',     ROOT_DIR . 'static/src/audio/');
// define('BANNER_DIR',    ROOT_DIR . 'static/src/banner/');
define('IMG_DIR',       ROOT_DIR . 'static/src/image/');
// define('MAIL_IMG_DIR',  ROOT_DIR . 'static/src/mail/');



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
// define('UPLOAD_PHOTOTRY_DIR',   RES_DIR . 'upload/phototry/');
// define('UPLOAD_SOCIAL_DIR',     RES_DIR . 'upload/social/');
// define('UPLOAD_BANNER_DIR',     RES_DIR . 'upload/banner/');
// define('UPLOAD_RXIMAGE_DIR',    RES_DIR . 'upload/rx_image/');

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

// !defined('DB2_HOST') && define('DB2_HOST', DB_HOST);
// !defined('DB2_PORT') && define('DB2_PORT', DB_PORT);
// !defined('DB2_USERNAME') && define('DB2_USERNAME', DB_USERNAME);
// !defined('DB2_PASSWORD') && define('DB2_PASSWORD', DB_PASSWORD);
// !defined('DB2_DATABASE') && define('DB2_DATABASE', DB_DATABASE);
// /**#@-*/


// /**#@+
//  * redis
//  */
// !defined('REDIS_ENABLED') && define('REDIS_ENABLED', false);
// !defined('REDIS_HOST') && define('REDIS_HOST', '192.168.0.8');
// !defined('REDIS_PORT') && define('REDIS_PORT', '6379');
// /**#@-*/

// /**
//  * Locale code
//  */
// $_isMicroSite = strtolower(substr($_SERVER['HTTP_HOST'], 0, 6));
// define('MICRO_SITE', $_isMicroSite == 'eyezen' ? 1 : 0 );
// define('CN_SITE', (strpos($_SERVER['HTTP_HOST'], 'cn') === 0) ? 1 : 0 );

// $_locales = array('US' => 'en', 'AU' => 'en', 'CA' => 'en',  'DE' => 'de', 'FR' => 'fr', 'GB' => 'en');
// if (stripos($_SERVER['HTTP_HOST'], 'eyebuydirect.de') !== false) {
//     define('LOCATION_CODE', 'DEU');
//     define('LOCALE_CODE', 'DE');
// } else if (stripos($_SERVER['HTTP_HOST'], 'eyebuydirect.co.uk') !== false) {
//     define('LOCATION_CODE', 'GBR');
//     define('LOCALE_CODE', 'GB');
// } else {
//     $_locations = array('US' => 'USA', 'AU' => 'AUS', 'CA' => 'CAN', 'DE' => 'DEU', 'FR' => 'FRA', 'GB' => 'GBR');
//     $_prefix = strtoupper(substr($_SERVER['HTTP_HOST'], 0, 2));
//     define('LOCATION_CODE', isset($_locations[$_prefix]) ? $_locations[$_prefix] : (MICRO_SITE ? 'EYEZEN' : 'USA'));
    
//     $_locale = strtoupper(substr($_SERVER['HTTP_HOST'], 0, 2));
//     define('LOCALE_CODE', array_key_exists($_locale, $_locales) ? $_locale : 'US');
// }

// /**
//  * the base path of urls
//  */
//  if (LOCALE_CODE === 'CA' && substr($_SERVER['REQUEST_URI'], 0, 4) === '/fr/') {
//     !defined('BASE_PATH') && define('BASE_PATH', '/fr/');
//  } else {
//     !defined('BASE_PATH') && define('BASE_PATH', '/');
// }

// /**
//  *  Language
//  */
// define('LANG_CODE',     BASE_PATH == '/fr/' ? 'fr' : $_locales[LOCALE_CODE]);
// define('LANG_LOCALE',   LANG_CODE . '-' . LOCALE_CODE);

// /**#@+
//  * configuration
//  */
// const MIN_STOCK         = 2;
// const BIFOCAL_HEIGHT            = 28;
// const PROGRESSIVE_HEIGHT        = 30;
// const RIMLESS_MULTIFOCAL_HEIGHT = 24;

// const TYPE_EYEGLASSES   = 'eyeglasses';
// const TYPE_SUNGLASSES   = 'sunglasses';

// const PLUGIN_MANAGER    = 'Ebd\Controller\PluginManager';
// const HELPER_MANAGER    = 'Ebd\View\HelperManager';
// const MODEL_MANAGER     = 'Ebd\Model\ModelManager';
// const PAYMENT_MANAGER   = 'Ebd\Ecommerce\Payment\PaymentManager';
// const SHIPPING_MANAGER  = 'Ebd\Ecommerce\Shipping\ShippingManager';
// const TOTAL_MANAGER     = 'Ebd\Ecommerce\Total\TotalManager';
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
    // $classFileName = str_replace('_', DS, $className) . '.class.php';
    $classFileName = $className . '.class.php';
    require_once CLASS_DIR . $classFileName;


    // if (file_exists(CLASS_DIR . $classFileName)) {
    //     require_once CLASS_DIR . $classFileName;
    // }

    // elseif (file_exists(LIB_CLASS_DIR . $classFileName)) {
    //     require_once LIB_CLASS_DIR . $classFileName;
    // }

    // else {
    //     return false;
    // }
}
spl_autoload_register('ebd_autoload');

// /**
//  * I18N
//  */
// function __($str)
// {
//     return gettext($str);
// }

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