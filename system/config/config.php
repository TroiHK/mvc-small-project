<?php if ( ! defined('PATH_SYSTEM')) die ('Bad requested!');
// Thông số database
define('DB_HOST',       'localhost');
define('DB_NAME',   'backnumber');
define('DB_USER',       'root');
define('DB_PASSWORD',   '');

// Global Variables
$lang = isset($_GET['lang']) && $_GET['lang'] ? $_GET['lang'] : 'vi';
define('LANGUAGE_CODE', $lang);
define('IMAGICK', extension_loaded('imagick') ? true : false);
