<?php
// Load config
include_once realpath(dirname(__FILE__)) . '/admin_path.php';
// check login
if (!isset($_SESSION["user_id"])) {
  header('Location: /admin/login/');
  exit;
}

$arrImages = explode(',', $_GET['q']);
$zipname = 'jpeg-pages.zip';
$zip = new ZipArchive;
$zip->open($zipname, ZipArchive::CREATE);
foreach ($arrImages as $file) {
  $imgInfo = pathinfo($file);
  $zip->addFile($_SERVER['DOCUMENT_ROOT'] . '/' . $file, $imgInfo['filename'] . '.' . $imgInfo['extension']);
}
$zip->close();

header('Content-Type: application/zip');
header('Content-disposition: attachment; filename='.$zipname);
header('Content-Length: ' . filesize($zipname));

flush();
readfile($zipname);
// delete file
unlink($zipname);

// close tab
echo "<script>window.close();</script>";