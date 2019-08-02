<?php
// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// error_reporting(E_ALL);

header('Content-Type: text/html; charset=utf-8');
session_start();

// Đường dẫn tới hệ  thống
define('PATH_SYSTEM', realpath(dirname(__FILE__) . '/..') . '/system');
define('PATH_APPLICATION', dirname(__FILE__));
define('PATH_UPLOADS', 'data/uploads');
define('PATH_VENDOR', realpath(dirname(__FILE__) . '/..') . '/vendor');

// Lấy thông số cấu hình
require_once (PATH_SYSTEM . '/config/config.php');
require_once (PATH_SYSTEM . '/core/KL_Global_Functions.php');

$GLOBALS['translate_language'] = get_cache('translate_language');
