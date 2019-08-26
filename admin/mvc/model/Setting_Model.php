<?php if (!defined('PATH_SYSTEM')) die('Bad requested!');

class Setting_Model extends KL_Model
{
  public function edit($id, $data)
  {

    $row = array(
      'user_setting' => serialize($data['setting']),
    );
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

  public function add_ip($post)
  {
    $where = array(
      array(
        'key' => 'config_key',
        'value' => 'ip_range',
        'operator' => '='
      )
    );
    $this->db_delete('config', $where);

    $data = array(
      'config_key'  => 'ip_range',
      'config_value'  => base64_encode(serialize($post['ip_range'])),
      'config_create_date' => date("Y-m-d H:i:s"),
      'config_create_user' => 1,
    );

    $status = $this->db_insert($data, 'config');

    return !$status;
  }
}
