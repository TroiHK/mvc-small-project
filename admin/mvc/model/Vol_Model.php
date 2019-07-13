<?php if ( ! defined('PATH_SYSTEM')) die ('Bad requested!');

class Vol_Model extends KL_Model
{
    public function add($data)
    {
        $row = array(
            'vol_number' => $data['number'],
            'vol_name' => $data['name'],
            'vol_status' => 1,
            'vol_create_date' => date("Y-m-d H:i:s"),
            'vol_create_user' => $_SESSION['AdminId'],
        );

        $target_dir = PATH_UPLOADS . '/vol/';
        if ( isset($_FILES["image"]["name"]) && !empty($_FILES["image"]["name"]) ) {
            $arrImg = explode('.',$_FILES["image"]["name"]);
            $nameImage = $arrImg[0].'_'.strtotime("now").'.'.$arrImg[1];
            $row['vol_image'] = $target_dir . 'images/' . basename(strtolower($nameImage));
        }

        if (isset($_FILES["pdf"]["name"]) && !empty($_FILES["pdf"]["name"])) {
            $row['vol_pdf'] = $target_dir . 'pdf/' . basename($_FILES["pdf"]["name"]);
        }

        $id = $this->db_insert($row, 'vol');

        if (isset($id) && !empty($id)) {
            $dirImage = isset($row['vol_image']) ? $_SERVER['DOCUMENT_ROOT'] . '/' . $row['vol_image'] : false;
            $dirPdf = isset($row['vol_pdf']) ? $_SERVER['DOCUMENT_ROOT'] . '/' . $row['vol_pdf'] : false;

            if ( $dirImage ) {
                if (file_exists($dirImage)) {
                    unlink($dirImage);
                }
                move_uploaded_file($_FILES['image']['tmp_name'], $dirImage);
            }

            if ( $dirPdf ) {
                if (file_exists($dirPdf)) {
                    unlink($dirPdf);
                }
                move_uploaded_file($_FILES['pdf']['tmp_name'], $dirPdf);
            }

            return false;
        }

        return true;
    }

    public function edit($id, $data)
    {
        $row = array(
            'vol_number' =>  $data['vol_number'],
            'vol_name' => $data['vol_name'],
        );

        $target_dir = PATH_UPLOADS . '/vol/';
        if ( isset($_FILES["vol_image"]["name"]) && !empty($_FILES["vol_image"]["name"]) ) {
            $arrImg = explode('.',$_FILES["vol_image"]["name"]);
            $nameImage = $arrImg[0].'_'.strtotime("now").'.'.$arrImg[1];
            $row['vol_image'] = $target_dir . 'images/' . basename(strtolower($nameImage));
        }

        if (isset($_FILES["vol_pdf"]["name"]) && !empty($_FILES["vol_pdf"]["name"])) {
            $row['vol_pdf'] = $target_dir . 'pdf/' . basename($_FILES["vol_pdf"]["name"]);
        }

        $where = array(
            array(
                'key' => 'vol_id',
                'value' => $id,
                'operator' => '='
            )
        );

        $status = $this->db_update($row,'vol', $where);

        if ($status) {
            $dirImage = isset($row['vol_image']) ? $_SERVER['DOCUMENT_ROOT'] . '/' . $row['vol_image'] : false;
            $dirPdf = isset($row['vol_pdf']) ? $_SERVER['DOCUMENT_ROOT'] . '/' . $row['vol_pdf'] : false;

            if ( $dirImage ) {
                if (file_exists($dirImage)) {
                    unlink($dirImage);
                }
                move_uploaded_file($_FILES['vol_image']['tmp_name'], $dirImage);
            }

            if ( $dirPdf ) {
                if (file_exists($dirPdf)) {
                    unlink($dirPdf);
                }
                move_uploaded_file($_FILES['vol_pdf']['tmp_name'], $dirPdf);
            }

            return false;
        }

        return true;
    }

    public function delete($id){
        $sql = "DELETE FROM vol WHERE vol_id=".$id;
        $error = $this->db_execute($sql);
        return !$error;
    }

    public function deleteAll($arr){
        $sql = "DELETE FROM vol WHERE vol_id IN ($arr)";
        $error = $this->db_execute($sql);
        return !$error;
    }

    public function all()
    {
        $sql = "SELECT * FROM vol ORDER BY vol_number DESC";
        return $this->db_get_list($sql);
    }

    public function shortVol()
    {
        $sql = "SELECT vol_number, vol_name, vol_pdf FROM vol ORDER BY vol_number DESC";
        return $this->db_get_list($sql);
    }

    public function getRowById($id)
    {
        $sql = "SELECT * FROM vol WHERE vol_id=" . $id;
        return $this->db_get_row($sql);
    }
}