<?php if (!defined('PATH_SYSTEM')) die('Bad requested!');

class Category_Model extends KL_Model
{
    public function add($data)
    {
        $row = array(
            'category_name_vi' =>  $data['name-vi'],
            'category_name_ja' => $data['name-ja'],
            'category_description_vi' => $data['description-vi'],
            'category_description_ja' => $data['description-ja'],
            'category_status' => 1,
            'category_create_date' => date("Y-m-d H:i:s"),
            'category_create_user' => $_SESSION['user_id'],
        );

        $id = $this->db_insert($row, 'category');

        if (isset($id) && !empty($id)) {
            return false;
        }

        return true;
    }

    public function edit($id, $data)
    {
        $row = array(
            'category_name_vi' =>  $data['name-vi'],
            'category_name_ja' => $data['name-ja'],
            'category_description_vi' => $data['description-vi'],
            'category_description_ja' => $data['description-ja'],
        );

        $where = array(
            array(
                'key' => 'category_id',
                'value' => $id,
                'operator' => '='
            )
        );

        $status = $this->db_update($row,'category', $where);

        if ($status) {
            return false;
        }

        return true;
    }


    public function delete($id)
    {
        $sql = "DELETE FROM category WHERE category_id=" . $id;
        $error = $this->db_execute($sql);
        return !$error;
    }

    public function deleteAll($arr){
        $sql = "DELETE FROM category WHERE category_id IN ($arr)";
        $error = $this->db_execute($sql);
        return !$error;
    }
}
