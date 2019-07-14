<?php if ( ! defined('PATH_SYSTEM')) die ('Bad requested!');

class Backnumber_Model extends KL_Model
{
    public function add($data)
    {
        $row = array(
            'backnumber_vol_id' => $data['vol_id'],
            'backnumber_category_id' => $data['category_id'],
            'backnumber_pdf_page' => $data['pdf_page'] ? $data['pdf_page'] : 0,
            'backnumber_book_page' => $data['book_page'] ? $data['book_page'] : 0,
            'backnumber_series_name_vi' => $data['series_name_vi'],
            'backnumber_series_name_ja' => $data['series_name_ja'],
            'backnumber_content_vi' => $data['content_vi'],
            'backnumber_content_ja' => $data['content_ja'],
            'backnumber_status' => 1,
            'backnumber_create_date' => date("Y-m-d H:i:s"),
            'backnumber_create_user' => $_SESSION['AdminId'],
        );

        $id = $this->db_insert($row, 'backnumber');

        if (isset($id) && !empty($id)) {
            return false;
        }

        return true;
    }

    public function edit($id, $data)
    {
        $row = array(
            'backnumber_vol_id' => $data['vol_id'],
            'backnumber_category_id' => $data['category_id'],
            'backnumber_pdf_page' => $data['pdf_page'] ? $data['pdf_page'] : 0,
            'backnumber_book_page' => $data['book_page'] ? $data['book_page'] : 0,
            'backnumber_series_name_vi' => $data['series_name_vi'],
            'backnumber_series_name_ja' => $data['series_name_ja'],
            'backnumber_content_vi' => $data['content_vi'],
            'backnumber_content_ja' => $data['content_ja'],
        );

        $where = array(
            array(
                'key' => 'backnumber_id',
                'value' => $id,
                'operator' => '='
            )
        );

        $status = $this->db_update($row,'backnumber', $where);

        if ($status) {
            return false;
        }

        return true;
    }

    public function delete($id){
        $sql = "DELETE FROM backnumber WHERE backnumber_id=".$id;
        $error = $this->db_execute($sql);
        return !$error;
    }

    public function deleteAll($arr){
        $sql = "DELETE FROM backnumber WHERE backnumber_id IN ($arr)";
        $error = $this->db_execute($sql);
        return !$error;
    }

    public function all()
    {
        $sql = "SELECT * FROM backnumber ORDER BY backnumber_id ASC";
        return $this->db_get_list($sql);
    }

    public function getRowById($id)
    {
        $sql = "SELECT * FROM backnumber WHERE backnumber_id=" . $id;
        return $this->db_get_row($sql);
    }
}