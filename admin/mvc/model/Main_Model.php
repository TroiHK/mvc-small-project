<?php if (!defined('PATH_SYSTEM')) die('Bad requested!');

class Main_Model extends KL_Model
{
    public function import($data, $update_img = false)
    {
        $error = '';
        $i = 2;
        // var_dump($data);
        // die();
        foreach ($data as $key => $value) {
            if ($value[0] == 'Vol') continue;
            $id = 0;
            $pdf_path = PATH_UPLOADS . '/vol/images/pdf/';
            $img_url = $value[9] ? $pdf_path . $value[9] : $pdf_path . 'vol_' . $value[0] . '_' . ($value[1] ? $value[1] : 0) . '.jpg';

            $row = array(
                'backnumber_vol_id' => $value[0],
                'backnumber_image' => $img_url,
                'backnumber_category_id' => $value[3],
                'backnumber_pdf_page' => $value[1] ? $value[1] : 0,
                'backnumber_book_page' => $value[2] ? $value[2] : 0,
                'backnumber_series_name_vi' => $value[5],
                'backnumber_series_name_ja' => $value[6],
                'backnumber_content_vi' => $value[7],
                'backnumber_content_ja' => $value[8],
                'backnumber_status' => 1,
                'backnumber_create_date' => date("Y-m-d H:i:s"),
                'backnumber_create_user' => $_SESSION['user_id'],
            );

            $arr = array(
                'table' => 'backnumber',
                'where' => array(
                    'relation' => 'AND',
                    array(
                        'key' => 'backnumber_vol_id',
                        'value' => $value[0],
                        'operator' => '='
                    ),
                    array(
                        'key' => 'backnumber_category_id',
                        'value' => $value[3],
                        'operator' => '='
                    ),
                    array(
                        'key' => 'backnumber_pdf_page',
                        'value' => $value[1] ? $value[1] : 0,
                        'operator' => '='
                    ),
                    array(
                        'key' => 'backnumber_book_page',
                        'value' => $value[2] ? $value[2] : 0,
                        'operator' => '='
                    ),
                    array(
                        'key' => 'backnumber_series_name_vi',
                        'value' => $value[5],
                        'operator' => '='
                    ),
                    array(
                        'key' => 'backnumber_series_name_ja',
                        'value' => $value[6],
                        'operator' => '='
                    ),
                    array(
                        'key' => 'backnumber_content_vi',
                        'value' => $value[7],
                        'operator' => '='
                    ),
                    array(
                        'key' => 'backnumber_content_ja',
                        'value' => $value[8],
                        'operator' => '='
                    )
                )
            );
            $check_backnumber = $this->db_get_data($arr, 'row');

            if ( !$check_backnumber ) {
                $id = $this->db_insert($row, 'backnumber');

                if ($id == null) {
                    $error .= $i . ', ';
                }
                $i++;
            } else {
                if ( $update_img && $img_url ) {
                    $ud_row = array(
                        'backnumber_image' =>  $img_url,
                    );

                    $ud_where = array(
                        array(
                            'key' => 'backnumber_id',
                            'value' => $check_backnumber['backnumber_id'],
                            'operator' => '='
                        )
                    );

                    $status = $this->db_update($ud_row, 'backnumber', $ud_where);
                }
            }
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
                if ($k == 'lang' || empty($v)) continue;

                if ($k == 'series_name' || $k == 'content') {
                    $where_item = array(
                        'key' => 'backnumber_' . $k . '_' . $data['lang'],
                        'value' => '%' . $v . '%',
                        'operator' => 'LIKE'
                    );
                    if ( isset($where_item) ) $where[] = $where_item;
                } elseif ($k == 'pdf_page' || $k == 'book_page') {
                    if ( is_array($v) ) {
                        $where_item = array(
                            'key' => 'backnumber_' . $k,
                            'value' => join("','",$v),
                            'operator' => 'IN'
                        );
                    } else {
                        if ( strpos($v, ',') !== false ) {
                            $vls = explode(',', $v);
                            $total_where = array();
                            foreach ($vls as $key => $value) {
                                $value = trim($value);
                                $pos = strpos($value, '-');
                                if ( $value === '' ) continue; 

                                if ( $pos !== false ) {
                                    $total_where[] = $this->get_where_by_dash($pos, $value, $k);
                                } else {
                                    $where_item = array(
                                        'key' => 'backnumber_' . $k,
                                        'value' => $value,
                                        'operator' => '='
                                    );
                                    $total_where[] = $where_item;
                                }
                            }
                        } else {
                            $v = trim($v);
                            $pos = strpos($v, '-');

                            if ( $pos !== false ) {
                                $where_item = $this->get_where_by_dash($pos, $v, $k);
                            } else {
                                $where_item = array(
                                    'key' => 'backnumber_' . $k,
                                    'value' => $v,
                                    'operator' => '='
                                );
                            }
                        }
                    }

                    if ( isset($total_where) && count($total_where) > 0 ) {
                        $total_where['relation'] = "OR";
                        $where[] = $total_where;
                    } else {
                        if ( isset($where_item) && $where_item != '' ) $where[] = $where_item;
                    }
                } else {
                    $where_item = array(
                        'key' => 'backnumber_' . $k,
                        'value' => is_array($v) ? join("','",$v) : $v,
                        'operator' => is_array($v) ? 'IN' : '='
                    );
                    if ( isset($where_item) ) $where[] = $where_item;
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

    public function renderItem($row = array(), $vol = array(), $category = array(), $i = null) {
        $html = '<tr>';
        $html .= '<td class="text-center">' . $i . '</td>';
        $html .= '<td class="text-center">' . $row['backnumber_vol_id'] . '</td>';
        $html .= '<td class="text-center">' . $row['group_pdf_page'] . '</td>';
        $html .= '<td class="text-center">' . $row['group_book_page'] . '</td>';

        if ( isset($category[$row['backnumber_category_id']]['category_name_' . LANGUAGE_CODE]) ) {
            $html .= '<td>' . $category[$row['backnumber_category_id']]['category_name_' . LANGUAGE_CODE] . '</td>';
        } else {
            $html .= '<td></td>';
        }

        $html .= '<td>' . stripslashes($row['backnumber_series_name_' . LANGUAGE_CODE]) . '</td>';
        $html .= '<td>' . stripslashes($row['backnumber_content_' . LANGUAGE_CODE]) . '</td>';

        $html .= '<td class="text-center">';
        if ($row['backnumber_image']) {
            $img_path_parts = pathinfo($row['backnumber_image']);
            $url = $img_path_parts['dirname'] . '/' . $img_path_parts['filename'] . '.' . $img_path_parts['extension'];
            $url_thumb = $img_path_parts['dirname'] . '/' . $img_path_parts['filename'] . '-thumb.' . $img_path_parts['extension'];
            $url_thumb = IMAGICK ? $url_thumb : $url;
            $text_translate = _pll('Vol') . ',' . _pll('PDF Page') . ',' . _pll('Book Page'). ',' . _pll('Download this page'). ',' . _pll('Download all pages');

            $html .= '<a href="#showPdfModal" data-texts=" ' . $text_translate . ' " data-images="' . implode(",", $row['image_arr']) . '" data-vol="' . $vol[$row['backnumber_vol_id']]['vol_pdf'] . '" data-vol-id="' . $row['backnumber_vol_id'] . '" data-pdf-page="' . $row['group_pdf_page'] . '" data-book-page="' . $row['group_book_page'] . '" class="show-pdf" data-toggle="modal">';
            $html .= '<img width="75" src="/' . $url_thumb . '" >';
            $html .= '</a>';
        }
        // $html .= '</td>';

        // $html .= '<td class="text-center">';
        // if ($vol[$row['backnumber_vol_id']]['vol_pdf']) {
        //     $html .= '<a href="/admin/pdf.php?q=' . str_replace('data/uploads/','',$vol[$row['backnumber_vol_id']]['vol_pdf']) . '#page=' . $row['backnumber_pdf_page'] . '" target="_blank" title="">';
        //     $html .= '<i class="far fa-file-pdf text-danger"></i></a>';
        // }
        $html .= '</td></tr>';

        return $html;
    }

    public function renderList($data = array(), $vol = array(), $category = array()) {
        $html = '';
        $data_concat = array();
        $index = 1;

        for ($i=0; $i < count($data); $i++) {
            $data_concat[$i] = $data[$i];
            $image_arr = array();
            $image_arr[] = $data_concat[$i]['backnumber_image'];
            $j = $i+1;
            $flag = 1;
            while ( $flag > 0 ) {
                if ( isset($data_concat) &&  isset($data[$j]['backnumber_vol_id']) &&
                    $data_concat[$i]['backnumber_vol_id'] == $data[$j]['backnumber_vol_id'] &&
                    $data_concat[$i]['backnumber_category_id'] == $data[$j]['backnumber_category_id'] &&
                    $data_concat[$i]['backnumber_content_vi'] == $data[$j]['backnumber_content_vi'] &&
                    $data_concat[$i]['backnumber_series_name_vi'] == $data[$j]['backnumber_series_name_vi'] &&
                    $data_concat[$i]['backnumber_content_ja'] == $data[$j]['backnumber_content_ja'] &&
                    $data_concat[$i]['backnumber_series_name_ja'] == $data[$j]['backnumber_series_name_ja'] &&
                    $data[$j-1]['backnumber_pdf_page'] == ($data[$j]['backnumber_pdf_page'] - 1) ) {

                    $image_arr[] = $data[$j]['backnumber_image'];
                    $j++;
                } else {
                    $flag = 0;
                    if ( $j-1 > $i ) {
                        $data_concat[$i]['group_pdf_page'] = $data_concat[$i]['backnumber_pdf_page'] . '~' . $data[$j-1]['backnumber_pdf_page'];
                        $data_concat[$i]['group_book_page'] = $data_concat[$i]['backnumber_book_page'] . '~' . $data[$j-1]['backnumber_book_page'];
                        $data_concat[$i]['image_arr'] = $image_arr;
                        $html .= $this->renderItem($data_concat[$i], $vol, $category, $index);
                        $index++;
                        $i = $j-1;
                    } else {
                        $data_concat[$i]['group_pdf_page'] = $data_concat[$i]['backnumber_pdf_page'];
                        $data_concat[$i]['group_book_page'] = $data_concat[$i]['backnumber_book_page'];
                        $data_concat[$i]['image_arr'] = $image_arr;
                        $html .= $this->renderItem($data_concat[$i], $vol, $category, $index);
                        $index++;
                    }
                }
            }
        }

        return $html;
    }

    private function get_where_by_dash($pos, $v, $k) {
        $where_item = '';
        $length = strlen($v);
        if ( $pos === 0 ) {
            $where_item = array(
                'key' => 'backnumber_' . $k,
                'value' => ltrim($v, '-'),
                'operator' => '<='
            );
        } elseif ($pos == $length - 1) {
            $where_item = array(
                'key' => 'backnumber_' . $k,
                'value' => rtrim($v, '-'),
                'operator' => '>='
            );
        } else {
            $vls = explode('-', $v);
            if ( $vls[0] < $vls[1] ) {
                for($i = $vls[0]; $i <= $vls[1]; $i++){
                    $arrIn[$i] = $i * 1;
                }
            } else {
                for($i = $vls[1]; $i <= $vls[0]; $i++){
                    $arrIn[$i] = $i * 1;
                }
            }

            $where_item = array(
                'key' => 'backnumber_' . $k,
                'value' => join("','",$arrIn),
                'operator' => 'IN'
            );
        }
        return $where_item;
    }
}
