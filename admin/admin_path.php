<?php
// Đường dẫn tới hệ  thống
define('PATH_SYSTEM', dirname(__DIR__) . '/system');
define('PATH_APPLICATION', __DIR__);
define('PATH_UPLOADS', 'data/uploads');

// Lấy thông số cấu hình
require (PATH_SYSTEM . '/config/config.php');

// Init
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

header('Content-Type: text/html; charset=UTF-8');

session_start();