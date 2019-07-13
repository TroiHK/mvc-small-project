<?php if ( ! defined('PATH_SYSTEM')) die ('Bad requested!');
// Info database
define('DB_HOST',       'localhost');
define('DB_NAME',   'backnumber');
define('DB_USER',       'root');
define('DB_PASSWORD',   '');

// Global Variables
define('LANGUAGE_CODE', isset($_GET['lang']) && $_GET['lang'] == 'ja' ? 'ja' : 'vi');
