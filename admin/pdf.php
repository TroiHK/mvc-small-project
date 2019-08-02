<?php
// Load config
include_once realpath(dirname(__FILE__)) . '/admin_path.php';
// check login
if (!isset($_SESSION["user_id"])) {
  header('Location: /admin/login/');
  exit;
}
  $arrTitle = explode('/',$_GET['q']);
  $title = $arrTitle[count($arrTitle) - 1];
  $file = $_SERVER['DOCUMENT_ROOT'] . '/data/uploads/' . $_GET['q'];

  header("Content-type:application/pdf");

  header("Content-Disposition:inline;filename='$file");
  header("Accept-Ranges: bytes");

  @readfile($file);
?>