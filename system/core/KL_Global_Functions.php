<?php
// Get text translate
function _pll($string)
{
  $text = isset($GLOBALS['translate_language'][base64_encode($string)]) ? $GLOBALS['translate_language'][base64_encode($string)][LANGUAGE_CODE] : $string;
  return $text;
}

function set_cache($key, $value)
{
  include_once PATH_SYSTEM . '/core/KL_Model.php';
  $model = new KL_Model();
  $arr = array(
    'select' => 'config_key',
    'table' => 'config',
    'where' => array(
      array(
        'key' => 'config_key',
        'value' => $key,
        'operator' => '='
      )
    )
  );

  $getData = $model->db_get_data($arr, 'row');
  if (isset($getData) && !empty($getData)) {
    return false;
  }

  $data = array(
    'config_key'  => $key,
    'config_value'  => base64_encode(serialize($value)),
    'config_create_date' => date("Y-m-d H:i:s"),
    'config_create_user' => 1,
  );

  $model->db_insert($data, 'config');
  $model->db_close();
}

function delete_cache($key)
{
  include_once PATH_SYSTEM . '/core/KL_Model.php';
  $model = new KL_Model();
  $where = array(
    array(
      'key' => 'config_key',
      'value' => $key,
      'operator' => '='
    )
  );
  $model->db_delete('config', $where);
  $model->db_close();
}

function get_cache($key)
{
  include_once PATH_SYSTEM . '/core/KL_Model.php';
  $model = new KL_Model();
  $arr = array(
    'select'  => 'config_value',
    'table' => 'config',
    'where' => array(
      array(
        'key' => 'config_key',
        'value' => $key,
        'operator' => '='
      )
    )
  );
  $data = $model->db_get_data($arr, 'row');
  if (isset($data) && !empty($data)) {
    $data['config_value']  = unserialize(base64_decode($data['config_value']));
  }
  $model->db_close();
  return isset($data['config_value']) && !empty($data['config_value']) ? $data['config_value'] : false;
}

function getNumPagesPdf($filepath){
  $fp = @fopen(preg_replace("/\[(.*?)\]/i", "",$_SERVER['DOCUMENT_ROOT'].$filepath),"r");
  $max=0;
  while(!feof($fp)) {
          $line = fgets($fp,255);
          if (preg_match('/\/Count [0-9]+/', $line, $matches)){
                  preg_match('/[0-9]+/',$matches[0], $matches2);
                  if ($max<$matches2[0]) $max=$matches2[0];
          }
  }
  fclose($fp);
  // if($max==0){
  //     $im = new imagick($filepath);
  //     $max=$im->getNumberImages();
  // }

  return $max;
}

// Function to get the client IP address
function get_client_ip() {
  $ipaddress = '';
  if (isset($_SERVER['HTTP_CLIENT_IP']))
    $ipaddress = $_SERVER['HTTP_CLIENT_IP'];
  else if(isset($_SERVER['HTTP_X_FORWARDED_FOR']))
    $ipaddress = $_SERVER['HTTP_X_FORWARDED_FOR'];
  else if(isset($_SERVER['HTTP_X_FORWARDED']))
    $ipaddress = $_SERVER['HTTP_X_FORWARDED'];
  else if(isset($_SERVER['HTTP_FORWARDED_FOR']))
    $ipaddress = $_SERVER['HTTP_FORWARDED_FOR'];
  else if(isset($_SERVER['HTTP_FORWARDED']))
    $ipaddress = $_SERVER['HTTP_FORWARDED'];
  else if(isset($_SERVER['REMOTE_ADDR']))
    $ipaddress = $_SERVER['REMOTE_ADDR'];
  else
    $ipaddress = 'UNKNOWN';
  return $ipaddress;
}

// Check IP in range
function ip_in_range( $ip, $range ) {
  if ( strpos( $range, '/' ) == false ) {
    $range .= '/32';
  }
    // $range is in IP/CIDR format eg 127.0.0.1/24
  list( $range, $netmask ) = explode( '/', $range, 2 );
  $range_decimal = ip2long( $range );
  $ip_decimal = ip2long( $ip );
  $wildcard_decimal = pow( 2, ( 32 - $netmask ) ) - 1;
  $netmask_decimal = ~ $wildcard_decimal;
  return ( ( $ip_decimal & $netmask_decimal ) == ( $range_decimal & $netmask_decimal ) );
}

// Check IP login
function check_ip_login() {
  if ( !isset($_SESSION["user_id"]) && !isset($_SESSION["had_check_ip"]) ) {
    include_once PATH_SYSTEM . '/core/KL_Model.php';
    $model = new KL_Model();
    $arr = array(
      'select'  => 'config_value',
      'table' => 'config',
      'where' => array(
        array(
          'key' => 'config_key',
          'value' => 'ip_range',
          'operator' => '='
        )
      )
    );
    $data = $model->db_get_data($arr, 'row');
    $model->db_close();

    if ( isset($data['config_value']) ) {
      $ip_list = explode(',', str_replace( " ", "", unserialize(base64_decode($data['config_value'])) ));
      foreach ($ip_list as $ip) {
        $check = ip_in_range( get_client_ip(), $ip );
        if ( $check ) {
          $_SESSION["permission"] = 2;
          $_SESSION["user_id"] = "ip_account";
          break;
        }
      }
    }

    $_SESSION["had_check_ip"] = true;
  }
}
