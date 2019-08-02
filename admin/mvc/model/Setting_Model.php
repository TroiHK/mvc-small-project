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
}
