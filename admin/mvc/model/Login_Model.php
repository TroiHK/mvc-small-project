<?php

if (!defined('PATH_SYSTEM')) die('Bad requested!');

class Login_Model extends KL_Model
{
  public function check_login($data, $library)
  {
    $error = false;

    $sql = "SELECT * FROM user WHERE user_name='" . addslashes($data["username"]) . "' AND user_password='" . $library->encrypt(addslashes($data["username"]), addslashes($data["password"])) . "'";

    $user = $this->db_get_row($sql);

    if (empty($user)) {
      $error = 'User or password incorrect';
    } else {
      $_SESSION["permission"] = $user["user_permission"];
      $_SESSION["user_id"] = $user["user_id"];
      $_SESSION["user_name"] = addslashes($user["user_name"]);
      $_SESSION["fullname"] = addslashes($user["user_fullname"]);
      $_SESSION["user_password"] = addslashes($user["user_password"]);
      $_SESSION["setting"] = unserialize($user["user_setting"]);
    }
    return $error;
  }

  public function forgot_password($email,$library)
  {
    $arr = array(
      'table' => 'user',
      'where' => array(
        array(
          'key' => 'user_email',
          'value' => $email,
          'operator' => '='
        )
      )
    );
    $data = $this->db_get_data($arr, 'row');

    $pass = $library->encrypt($data['user_name'],'cetusvn');

    $where = array(
      array(
        'key' => 'user_email',
        'value' => $email,
        'operator' => '='
      )
    );

    $status = $this->db_update(array('user_password' => $pass) , 'user', $where);

    if ($status) {
      return false;
    }

    return true;
  }
}
