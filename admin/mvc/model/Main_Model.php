<?php if (!defined('PATH_SYSTEM')) die('Bad requested!');

class Main_Model extends KL_Model
{
    public function import($data)
    {
        $error = '';
        $i = 2;
        foreach ($data as $value) {
            if ($value[0] == 'Vol') continue;
            $row = array(
                'backnumber_vol_id' => $value[0],
                'backnumber_category_id' => $value[3],
                'backnumber_pdf_page' => $value[1] ? $value[1] : 0,
                'backnumber_book_page' => $value[2] ? $value[2] : 0,
                'backnumber_series_name_vi' => $value[5],
                'backnumber_series_name_ja' => $value[6],
                'backnumber_content_vi' => $value[7],
                'backnumber_content_ja' => $value[8],
                'backnumber_status' => 1,
                'backnumber_create_date' => date("Y-m-d H:i:s"),
                'backnumber_create_user' => $_SESSION['AdminId'],
            );

            $id = $this->db_insert($row, 'backnumber');

            if (empty($id)) {
                $error .= $i . ', ';
            }

            $i++;
        }

        return $error;
    }

    public function all($data)
    {
        $where = array(
            'relation' => 'AND',
        );

        if ($data) {
            foreach ($data as $k => $v) {
                if ($k == 'lang' || $v == '') continue;
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
                        'value' => $v,
                        'operator' => '='
                    );
                    $where[] = $where_item;
                }
            }
        }

        $arr = array(
            'select' => '*, GROUP_CONCAT(distinct backnumber_pdf_page) as group_pdf_page,GROUP_CONCAT(distinct backnumber_book_page) as group_book_page',
            'from' => 'backnumber',
            'where' => $where,
            'group_by' => 'backnumber_category_id,backnumber_vol_id,backnumber_content_ja,backnumber_content_vi,backnumber_series_name_vi,backnumber_series_name_ja',
            'order_by' => 'backnumber_id ASC'
        );

        return $this->db_get_all($arr);
    }
}
