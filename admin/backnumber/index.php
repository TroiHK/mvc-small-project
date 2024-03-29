<?php
// Load config
include_once realpath(dirname(__FILE__) . '/..') . '/admin_path.php';

// Check IP login
check_ip_login();

// check login
if(!isset($_SESSION["user_id"])){
  header('Location: /admin/login/');
  exit;
}

// Mở file KL_Common.php, file này chứa hàm KL_Load() chạy hệ thống
include_once PATH_SYSTEM . '/core/KL_Common.php';

// Run app
$action = isset($_GET['action']) && $_GET['action'] != '' ? $_GET['action'] : 'index';

KL_load('backnumber', $action);