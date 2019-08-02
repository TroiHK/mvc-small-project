<?php if (!defined('PATH_SYSTEM')) die('Bad requested!');

class User_Model extends KL_Model
{
  public function add($data, $library)
  {
    $pass = $library->encrypt($data['user_name'], addslashes($data['user_password']));
    $row = array(
      'user_name' => $data['user_name'],
      'user_fullname' => $data['user_fullname'],
      'user_email' => $data['user_email'],
      'user_address' => $data['user_address'],
      'user_tel' => $data['user_tel'],
      'user_password' => $pass,
      'user_permission' => isset($data['user_permission']) && !empty($data['user_permission']) ? $data['user_permission'] : 0,
      'user_status' => 1,
      'user_create_date' => date("Y-m-d H:i:s"),
      'user_create_user' => $_SESSION['user_id'],
    );

    $id = $this->db_insert($row, 'user');

    if (isset($id) && !empty($id)) {
      return false;
    }

    return true;
  }

  public function edit($id, $data, $library)
  {
    $row = array(
      'user_fullname' => $data['user_fullname'],
      'user_address' => $data['user_address'],
      'user_tel' => $data['user_tel'],
      'user_permission' => isset($data['user_permission']) && !empty($data['user_permission']) ? $data['user_permission'] : 0,
    );

    if (!empty($data['user_password']) && isset($data['user_password'])) {
      $pass = $library->encrypt($data['user_name'], addslashes($data['user_password']));
      $row['user_password'] = $pass;
    }

    $where = array(
      array(
        'key' => 'user_id',
        'value' => $id,
        'operator' => '='
      )
    );

    $status = $this->db_update($row, 'user', $where);

    return !$status;
  }

  public function delete($id)
  {
    $sql = "DELETE FROM user WHERE user_id=" . $id.' AND user_permission <> 1';
    $error = $this->db_execute($sql);
    return !$error;
  }

  public function deleteAll($arr)
  {

    $getUser = array(
      'select' => 'user_id',
      'table'  => 'user',
      'where'  => array(
        array(
          'key' => 'user_permission',
          'value' => 1,
          'operator' => '='
        )
      )
    );


    $id_admin = $this->db_get_data($getUser);
    $arr = explode(',', $arr);
    foreach ($id_admin as $value) {

      $id = $value['user_id'];

      if (($key = array_search($id, $arr)) !== false) {
        unset($arr[$key]);
      }
    }

    $arr = implode(',', $arr);

    $sql = "DELETE FROM user WHERE user_id IN ($arr)";
    $error = $this->db_execute($sql);
    return !$error;
  }
}
