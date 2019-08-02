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
            'vol_create_user' => $_SESSION['user_id'],
        );

        $target_dir = PATH_UPLOADS . '/vol/';
        if ( isset($_FILES["image"]["name"]) && !empty($_FILES["image"]["name"]) ) {
            $arrImg = explode('.',$_FILES["image"]["name"]);
            $nameImage = $arrImg[0].'_'.strtotime("now").'.'.$arrImg[1];
            $row['vol_image'] = $target_dir . 'images/' . basename(strtolower($nameImage));
        }

        if (isset($data["vol_pdf"]) && !empty($data["vol_pdf"])) {
            $row['vol_pdf'] = $target_dir . 'pdf/' . basename($data["vol_pdf"]);
        }

        $id = $this->db_insert($row, 'vol');

        if (isset($id) && !empty($id)) {
            $dirImage = isset($row['vol_image']) ? $_SERVER['DOCUMENT_ROOT'] . '/' . $row['vol_image'] : false;

            if ( $dirImage ) {
                move_uploaded_file($_FILES['image']['tmp_name'], $dirImage);
                $this->imagick($row['vol_image'], $target_dir . 'images/');
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

        if (isset($data["vol_pdf"]) && !empty($data["vol_pdf"])) {
            $row['vol_pdf'] = $target_dir . 'pdf/' . basename($data["vol_pdf"]);
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

            if ( $dirImage ) {
                if (file_exists($dirImage)) {
                    unlink($dirImage);
                }
                move_uploaded_file($_FILES['vol_image']['tmp_name'], $dirImage);
                $this->imagick($row['vol_image'], $target_dir . 'images/');
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

    public function imagick($file_path, $output) {
        $file_path = $file_path ? $_SERVER['DOCUMENT_ROOT'] . '/' . $file_path : false;
        if ( IMAGICK && file_exists($file_path) ) {
            $img = new Imagick();

            $path_parts = pathinfo($file_path);
            $file_name = $path_parts['filename'];
            $file_ext = $path_parts['extension'];

            // $dest1 = $_SERVER['DOCUMENT_ROOT'] . '/' . $output . $file_name . '-op.' . $path_parts['extension'];
            $dest2 = $_SERVER['DOCUMENT_ROOT'] . '/' . $output . $file_name . '-thumb.' . $path_parts['extension'];

            $img->readImage($file_path);
            // $img->setImageCompression(imagick::COMPRESSION_JPEG);
            // $img->setImageCompressionQuality(80);

            $img->stripImage();
            // file_put_contents($dest1, $img);

            $img->resizeImage(75, 0, imagick::FILTER_LANCZOS, 1);
            file_put_contents($dest2, $img);

            $img->clear();
            $img->destroy();
        }
    }
}