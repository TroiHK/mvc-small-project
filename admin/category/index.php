<?php
// Load config
include_once dirname(__DIR__) . '/admin_path.php';

// check login
if(!isset($_SESSION["AdminId"])){
    header('Location: /admin/login/');
    exit;
}

// Mở file KL_Common.php, file này chứa hàm KL_Load() chạy hệ thống
include_once PATH_SYSTEM . '/core/KL_Common.php';

// Run app
$action = isset($_GET['action']) && $_GET['action'] != '' ? $_GET['action'] : 'index';

KL_load('category', $action);