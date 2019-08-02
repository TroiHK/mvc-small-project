<?php
// $arr = explode('/',$_SERVER['REDIRECT_URL']);
// if( !empty($arr[1]) &&isset($arr[1])){
//   include_once($_SERVER['DOCUMENT_ROOT'].'/admin/'.$arr[1].'/index.php');
// } else {
//   include_once($_SERVER['DOCUMENT_ROOT'].'/admin/index.php');
// }
header('Location: /admin');
exit();
