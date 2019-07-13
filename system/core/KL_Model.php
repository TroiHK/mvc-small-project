<?php if (!defined('PATH_SYSTEM')) die('Bad requested!');

class KL_Model
{
    protected $conn = NULL;

    public function __construct($is_model = true)
    {
        if (!$this->conn) {
            $this->conn = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME)
                or die('Could not connect to mySQL!');
            mysqli_set_charset($this->conn, 'UTF-8');
        }
    }

    // Hàm ngắt kết nối
    public function db_close()
    {
        if ($this->conn) {
            mysqli_close($this->conn);
        }
    }

    // Hàm lấy danh sách, kết quả trả về danh sách các record trong một mảng
    public function db_get_list($sql)
    {
        $data  = array();
        $result = $this->db_execute($sql);

        while ($row = mysqli_fetch_assoc($result)){
            $data[] = $row;
        }

        return $data;
    }

    // Hàm lấy chi tiết, dùng select theo ID vì nó trả về 1 record
    function db_get_row($sql)
    {
        $result = $this->db_execute($sql);
        $row = array();

        if (mysqli_num_rows($result) > 0){
            $row = mysqli_fetch_assoc($result);
        }

        return $row;
    }

    // Hàm thực thi câu truy  vấn insert, update, delete
    function db_execute($sql)
    {
        return mysqli_query($this->conn, $sql);
    }

    // Hàm thực thi câu truy vấn insert
    function db_insert($data = array(), $table)
    {
        // Hai biến danh sách fields và values
        $fields = '';
        $values = '';

        // Lặp mảng dữ liệu để nối chuỗi
        foreach ($data as $field => $value) {
            $fields .= $field . ',';
            $values .= "'" . addslashes($value) . "',";
        }

        // Xóa ký từ , ở cuối chuỗi
        $fields = trim($fields, ',');
        $values = trim($values, ',');

        // Tạo câu SQL
        $sql = "INSERT INTO $table($fields) VALUES ({$values})";

        // Thực hiện INSERT
        return $this->db_execute($sql);
    }

    // Hàm thực thi truy vấn update
    function db_update($data = array(), $table, $where = array())
    {
        // Relation, Hai biến danh sách field_value và conditions
        $relation = isset($where['relation']) ? ' ' . $where['relation'] . ' ' : ' AND ';
        $fields_values = '';
        $conditions = '';
        $conditions = $this->db_where_string($where, $conditions, $relation);

        $conditions = trim($conditions, $relation);

        foreach ($data as $field => $value) {
            $fields_values .= $field . " = '" . $value . "',";
        }

        $fields_values = trim($fields_values, ',');

        $sql = "UPDATE $table SET $fields_values WHERE $conditions";

        return $this->db_execute($sql);
    }


    // Hàm thực thi lấy dữ liệu
    // $arr bao gồm: select, from, where, where_like, group_by, order_by
    function db_get_all($arr)
    {
        $sql = '';

        if ($arr['select']) {
            $sql = "SELECT " . $arr['select'];
        }

        if ($arr['from']) {
            $sql .= " FROM " . $arr['from'];
        }

        if (isset($arr['where']) && $arr['where']) {
            // Relation và conditions
            $relation = isset($arr['where']['relation']) ? ' ' . $arr['where']['relation'] . ' ' : ' AND ';
            $conditions = '';
            $conditions = $this->db_where_string($arr['where'], $conditions, $relation);
        }

        if ( isset($conditions) && $conditions ){
            $sql .= ' WHERE ' . $conditions;
        }

        if ($arr['group_by']) {
            $sql .= " GROUP BY " . $arr['group_by'];
        }

        if ($arr['order_by']) {
            $sql .= " ORDER BY " . $arr['order_by'];
        }
        
        return $this->db_get_list($sql);
    }

    // Return Where String
    function db_where_string($where = array(), $conditions = '', $relation = '')
    {
        foreach ($where as $k_lv1 => $v_lv1) {
            if ( $k_lv1 === 'relation' ) continue;

            if (isset($v_lv1['relation'])) {
                $conditions .= '(';
                $relation_lv1 = ' ' . $v_lv1['relation'] . ' ';

                foreach ($v_lv1 as $k_lv2 => $v_lv2) {
                    if ($k_lv2 === 'relation') continue;

                    $operator = isset($v_lv2['operator']) ? $v_lv2['operator'] : '=';
                    $conditions .= $v_lv2['key'] . " " . $operator . " '" . $v_lv2['value'] . "'" . $relation_lv1;
                }

                $conditions = trim($conditions, $relation_lv1);
                $conditions .= ')' . $relation;
            } else {
                $operator = isset($v_lv1['operator']) ? $v_lv1['operator'] : '=';
                $conditions .= $v_lv1['key'] . " " . $operator . " '" . $v_lv1['value'] . "'" . $relation;
            }
        }

        return trim($conditions, $relation);
    }
}
