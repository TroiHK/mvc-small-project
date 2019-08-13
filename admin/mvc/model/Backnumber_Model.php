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
            'backnumber_create_user' => $_SESSION['user_id'],
        );

        $target_dir = PATH_UPLOADS . '/vol/';
        if ( isset($_FILES["image"]["name"]) && !empty($_FILES["image"]["name"]) ) {
            $arrImg = explode('.',$_FILES["image"]["name"]);
            $nameImage = $arrImg[0].'_'.strtotime("now").'.'.$arrImg[1];
            $row['backnumber_image'] = $target_dir . 'images/pdf/' . basename(strtolower($nameImage));
        }

        $id = $this->db_insert($row, 'backnumber');

        if (isset($id) && !empty($id)) {
            $dirImage = isset($row['backnumber_image']) ? $_SERVER['DOCUMENT_ROOT'] . '/' . $row['backnumber_image'] : false;

            if ( $dirImage ) {
                move_uploaded_file($_FILES['image']['tmp_name'], $dirImage);
                $this->imagick($row['backnumber_image'], $target_dir . 'images/pdf/');
            }

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

        $target_dir = PATH_UPLOADS . '/vol/';
        if ( isset($_FILES["image"]["name"]) && !empty($_FILES["image"]["name"]) ) {
            $arrImg = explode('.',$_FILES["image"]["name"]);
            $nameImage = $arrImg[0].'_'.strtotime("now").'.'.$arrImg[1];
            $row['backnumber_image'] = $target_dir . 'images/pdf/' . basename(strtolower($nameImage));
        }

        $where = array(
            array(
                'key' => 'backnumber_id',
                'value' => $id,
                'operator' => '='
            )
        );

        $status = $this->db_update($row,'backnumber', $where);

        if ($status) {
            $dirImage = isset($row['backnumber_image']) ? $_SERVER['DOCUMENT_ROOT'] . '/' . $row['backnumber_image'] : false;

            if ( $dirImage ) {
                move_uploaded_file($_FILES['image']['tmp_name'], $dirImage);
                $this->imagick($row['backnumber_image'], $target_dir . 'images/pdf/');
            }

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

    public function getRowById($id)
    {
        $sql = "SELECT * FROM backnumber WHERE backnumber_id=" . $id;
        return $this->db_get_row($sql);
    }

    public function renderItem($row = array(), $vol = array(), $category = array(), $i = null) {
        $html = '<tr>';
        $html .= '<td class="text-center"><span class="custom-checkbox">';
        $html .= '<input type="checkbox" id="checkbox' . $i . '" name="backnumber[]" value="' . $row['backnumber_id'] . '">';
        $html .= '<label for="checkbox' . $i . '"></label>';
        $html .= '</span></td>';
        $html .= '<td class="text-center">' . $i . '</td>';
        $html .= '<td class="text-center">' . $row['backnumber_vol_id'] . '</td>';
        $html .= '<td class="text-center">' . $row['backnumber_pdf_page'] . '</td>';
        $html .= '<td class="text-center">' . $row['backnumber_book_page'] . '</td>';

        $html .= '<td>' . $category[$row['backnumber_category_id']]['category_name_' . LANGUAGE_CODE] . '</td>';
        $html .= '<td>' . stripslashes($row['backnumber_series_name_' . LANGUAGE_CODE]) . '</td>';
        $html .= '<td>' . stripslashes($row['backnumber_content_' . LANGUAGE_CODE]) . '</td>';
        $html .= '<td>';
        if ($row['backnumber_image']) {
            $img_path_parts = pathinfo($row['backnumber_image']);
            $url = $img_path_parts['dirname'] . '/' . $img_path_parts['filename'] . '.' . $img_path_parts['extension'];
            $url_thumb = $img_path_parts['dirname'] . '/' . $img_path_parts['filename'] . '-thumb.' . $img_path_parts['extension'];
            $url_thumb = IMAGICK ? $url_thumb : $url;
            $html .= '<img width="75" src="/' . $url_thumb . '" alt="' . $path_parts['basename'] . '">';
        }
        $html .= '</td>';

        $html .= '<td class="text-center">';
        if ($vol[$row['backnumber_vol_id']]['vol_pdf']) {
            $html .= '<a href="/admin/pdf.php?q=' . str_replace('data/uploads/','',$vol[$row['backnumber_vol_id']]['vol_pdf']) . '#page=' . $row['backnumber_pdf_page'] . '" target="_blank" title=""><i class="far fa-file-pdf text-danger"></i></a>';
        }
        $html .= '</td>';

        $html .= '<td class="text-center">';
        $html .= '<a href="/admin/backnumber/?lang=' . LANGUAGE_CODE . '&action=edit&id=' . $row['backnumber_id'] . '" class="edit edit-item"><i class="material-icons" data-toggle="tooltip" title="Edit">&#xE254;</i></a>';
        $html .= '<a href="#deleteBnModal" data-href="/admin/backnumber/?lang=' . LANGUAGE_CODE . '&action=delete&id=' . $row['backnumber_id'] . '" class="delete delete-item" data-toggle="modal"><i class="material-icons" data-toggle="tooltip" title="Delete">&#xE872;</i></a>';
        $html .= '</td></tr>';

        return $html;
    }

    public function renderList($data = array(), $vol = array(), $category = array()) {
        $html = '';
        $index = 1;

        for ($i=0; $i < count($data); $i++) {
            $html .= $this->renderItem($data[$i], $vol, $category, $index);
            $index++;
        }

        return $html;
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

    public function all($data)
    {
        $where = array(
            'relation' => 'AND',
        );

        if ($data) {
            foreach ($data as $k => $v) {
                if ($k == 'lang' || empty($v)) continue;

                if ($k == 'series_name' || $k == 'content') {
                    $where_item = array(
                        'key' => 'backnumber_' . $k . '_' . $data['lang'],
                        'value' => '%' . $v . '%',
                        'operator' => 'LIKE'
                    );
                    $where[] = $where_item;
                } else {
                    $where_item = array(
                        'key' => 'backnumber_' . $k,
                        'value' => is_array($v) ? join("','",$v) : $v,
                        'operator' => is_array($v) ? 'IN' : '='
                    );
                    $where[] = $where_item;
                }
            }
        }

        if ( count($where) <= 1 ) {
            $sql = "SELECT MAX(backnumber_vol_id) as value FROM backnumber";
            $max_vol = $this->db_get_row($sql);

            if ( $max_vol['value']*1 > 10 ) {
                $where_item = array(
                    'key' => 'backnumber_vol_id',
                    'value' => $max_vol['value']*1 - 10,
                    'operator' => '>'
                );
                $where[] = $where_item;
            }
        }

        $arr = array(
            'table' => 'backnumber',
            'where' => $where,
            'order_by' => 'backnumber_vol_id DESC, backnumber_pdf_page ASC'
        );

        return $this->db_get_data($arr);
    }
}