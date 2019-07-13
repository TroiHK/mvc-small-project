<?php
// Load config
include_once dirname(__DIR__) . '/admin_path.php';

// Mở file KL_Common.php, file này chứa hàm KL_Load() chạy hệ thống
include_once PATH_SYSTEM . '/core/KL_Common.php';

// Run app
$action = isset($_GET['logout']) && $_GET['logout'] == true ? 'logout' : 'index';

KL_load('login', $action);