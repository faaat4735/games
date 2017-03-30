<?php
/**
 * Standard Library
 *
 * @package Frank_Network
 */

namespace Frank\Network;

class Http
{
    /**
     * Send header status
     *
     * @param int|string $status
     * @param boolean $replace (optional)
     * @example
     *  Http::headerStatus(301); header('Location: http://example.com/');
     *  Http::headerStatus('404 Not Found')
     *  Http::headerStatus('301 Moved Permanently')
     *  Http::headerStatus('302 Found')
     */
    public static function headerStatus($status, $replace = true)
    {
        if (is_numeric($status)) {
            // Status Code Definitions, see http://www.w3.org/Protocols/rfc2616/rfc2616.html
            $statusCodes = array (
                // Informational 1xx
                100 => 'Continue',
                101 => 'Switching Protocols',

                // Successful 2xx
                200 => 'OK',
                201 => 'Created',
                202 => 'Accepted',
                203 => 'Non-Authoritative Information',
                204 => 'No Content',
                205 => 'Reset Content',
                206 => 'Partial Content',

                // Redirection 3xx
                300 => 'Multiple Choices',
                301 => 'Moved Permanently',
                302 => 'Found',
                303 => 'See Other',
                304 => 'Not Modified',
                305 => 'Use Proxy',
                // 306 is deprecated but reserved
                307 => 'Temporary Redirect',

                // Client Error 4xx
                400 => 'Bad Request',
                401 => 'Unauthorized',
                402 => 'Payment Required',
                403 => 'Forbidden',
                404 => 'Not Found',
                405 => 'Method Not Allowed',
                406 => 'Not Acceptable',
                407 => 'Proxy Authentication Required',
                408 => 'Request Timeout',
                409 => 'Conflict',
                410 => 'Gone',
                411 => 'Length Required',
                412 => 'Precondition Failed',
                413 => 'Request Entity Too Large',
                414 => 'Request-URI Too Long',
                415 => 'Unsupported Media Type',
                416 => 'Requested Range Not Satisfiable',
                417 => 'Expectation Failed',

                // Server Error 5xx
                500 => 'Internal Server Error',
                501 => 'Not Implemented',
                502 => 'Bad Gateway',
                503 => 'Service Unavailable',
                504 => 'Gateway Timeout',
                505 => 'HTTP Version Not Supported',
            );
            if (array_key_exists($status, $statusCodes)) {
                $status = $status . ' ' . $statusCodes[$status];
            }
        }

        // cgi, cgi-fcgi, fpm-fcgi and so on
        if (false !== stripos(php_sapi_name(), 'cgi')) {
            header('Status: ' . $status, $replace);
        }
        // for others
        else {
            header($_SERVER['SERVER_PROTOCOL'] . ' ' . $status, $replace);
        }
    }

    /**
     * If current page is using HTTPS protocol, it returns true
     *
     * @return boolean
     */
    public static function isHttps()
    {
        return
            (isset($_SERVER['HTTP_X_SERVER_PORT']) && $_SERVER['HTTP_X_SERVER_PORT'] == 443)
            || (isset($_SERVER['SERVER_PORT']) && $_SERVER['SERVER_PORT'] == 443);
    }

    /**
     * Get real IP address (also for proxy)
     * It is not safe for un-proxy
     *
     * @return string
     */
    public static function getIp()
    {
        if (
            isset($_SERVER['HTTP_X_REAL_IP'])
            && preg_match('/^[\d\.]{7,15}$/', $_SERVER['HTTP_X_REAL_IP'])
        ) {
            return $_SERVER['HTTP_X_REAL_IP'];
        }
        return $_SERVER["REMOTE_ADDR"];
    }

    /**
     * URL redirect
     *
     * @param string $url
     * @param int|string $status (optional) http status code
     */
    public static function redirect($url, $status = 302)
    {
        if (302 != $status) {
            self::headerStatus($status);
        }
        header('Location: ' . $url);
        exit;
    }

    /**
     * Browser cache
     *
     * cache limiter:
     * 1. nocache 禁止客户端和中间路由器缓存本页
     * 2. public 允许客户端和中间路由器缓存本页
     * 3. private 仅允许客户端缓存本页，不允许中间路由器缓存本页
     * 4. 另外还有一种特殊的模式：private_no_expire。
     *    由于某些浏览器（例如Mozilla）在private模式下，不能正确处理expire header，
     *    此时应该使用private_no_expire模式，这样expire header将不会被发送到客户端。
     *
     * @param int $lifeTime (optional) (需要缓存的时间, 0表示不缓存)
     * @return void
     */
    public static function cache($lifeTime)
    {
        if ($lifeTime) {
            header("Cache-Control: cache"); // HTTP/1.1
            header("Pragma: cache"); // HTTP/1.0
            header("Date: " . gmdate("D, j M Y H:i:s") . ' GMT');
            header("Expires: " . gmdate("D, j M Y H:i:s", time() + $lifeTime) . " GMT");
        } else {
            header("Cache-Control: no-cache, no-store, must-revalidate"); // HTTP/1.1
            header("Pragma: no-cache"); // HTTP/1.0
            header("Expires: Mon, 26 Jul 1997 05:00:00 GMT"); // Date in the past
            header("Last-Modified: " . gmdate("D, j M Y H:i:s") . " GMT"); // always modified
        }
    }

    /**
     * @return boolean
     */
    public static function isPost()
    {
        return isset($_SERVER['REQUEST_METHOD']) && $_SERVER['REQUEST_METHOD'] == 'POST';
    }

    /**
     * @return boolean
     */
    public static function isAjax()
    {
        return isset($_SERVER['HTTP_X_REQUESTED_WITH']) && $_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest';
    }

    /**
     * @param string $type
     * @param string|null $charset
     * @example
     *  Http::mimeType('js', 'utf-8')
     *  Http::mimeType('exe')
     */
    public static function mimeType($type, $charset = null)
    {
        $types = array(
            'html'      => 'text/html',
            'xml'       => 'text/xml',
            'css'       => 'text/css',
            'txt'       => 'text/plain',
            'json'      => 'application/json',
            'jsonp'     => 'application/javascript',
            'js'        => 'application/javascript',
            'javascript'=> 'application/javascript',
            'rss'       => 'application/rss+xml',
            'atom'      => 'application/atom+xml',
            'xhtml'     => 'application/xhtml+xml',

            'gif'       => 'image/gif',
            'jpg'       => 'image/jpeg',
            'png'       => 'image/png',
            'ico'       => 'image/ico',
            'bmp'       => 'image/x-ms-bmp',
            'flv'       => 'video/x-flv',
            'doc'       => 'application/msword',
            'xls'       => 'application/vnd.ms-excel',
            'csv'       => 'application/vnd.ms-excel',
            'pdf'       => 'application/pdf',
            'zip'       => 'application/zip',
            'rar'       => 'application/x-rar-compressed',
            'swf'       => 'application/x-shockwave-flash',
            '*'         => 'application/octet-stream',
        );

        if (!isset($types[$type])) {
            $type = '*';
        }

        $contentType = 'Content-Type: ' . $types[$type];
        if ($charset) {
            $contentType .= '; charset=' . $charset;
        }
        header($contentType);
    }

    /**
     * Content-Disposition Header
     * 
     * @param string $filename
     */
    public static function disposition($filename)
    {
        header('Content-Disposition: attachment; filename=' . $filename);
    }
}
