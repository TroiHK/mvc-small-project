<?php if (!defined('PATH_SYSTEM')) die('Bad requested!');

class KL_Model
{
    protected $conn = NULL;
    protected $db = NULL;

    public function __construct($is_model = true)
    {
        if (!$this->conn) {
            if ( phpversion() < 5.3 ) {
                $this->conn = mysql_connect(DB_HOST, DB_USER, DB_PASSWORD)
                    or die('Could not connect to mySQL on localhost!');
                $this->db = mysql_select_db(DB_NAME, $this->conn);
                mysql_set_charset('utf8', $this->conn);
            } else {
                $this->conn = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME)
                    or die('Could not connect to mySQL!');
                mysqli_set_charset($this->conn, 'utf8');
            }

        }
    }

    /**
     * Function disconnects
     *
     */
    public function db_close()
    {
        if ($this->conn) {
            if ( phpversion() < 5.3 ) {
                mysql_close($this->conn);
            } else {
                mysqli_close($this->conn);
            }
        }
    }

    /**
     * The function takes a list, resulting in a list of records in an array
     *
     * @param   [string]  $sql  [sql statement]
     *
     * @return  [array]         [return data]
     */
    public function db_get_list($sql)
    {
        $data  = array();

        if ( phpversion() < 5.3 ) {
            $result = mysql_query($sql, $this->conn);
            while ($row = mysql_fetch_array($result, MYSQL_ASSOC)) {
                $data[] = $row;
            }
        } else {
            $result = $this->db_execute($sql);

            while ($row = mysqli_fetch_assoc($result)){
                $data[] = $row;
            }
        }

        return $data;
    }

    /**
     * The function takes the details, using the selection according to the ID because it returns a record
     *
     * @param   [string]  $sql  [sql statement]
     *
     * @return  [array]        [return data]
     */
    function db_get_row($sql)
    {
        if ( phpversion() < 5.3 ) {
            $result = mysql_query($sql, $this->conn);
            $row = array();

            if ($result) {
                $row = mysql_fetch_assoc($result);
            }
        } else {
            $result = $this->db_execute($sql);
            $row = array();

            if (mysqli_num_rows($result) > 0){
                $row = mysqli_fetch_assoc($result);
            }
        }

        return $row;
    }

    /**
     * The function of executing insert, update, delete queries function takes the list, resulting in a list of records in an array
     *
     * @param   [string]  $sql  [sql statement]
     *
     * @return  [boolean]        [return true, false]
     */
    function db_execute($sql)
    {
        if ( phpversion() < 5.3 ) {
            return mysql_query($sql, $this->conn);
        }
        return mysqli_query($this->conn, $sql);
    }

    /**
     * Function to execute insert queries
     *
     * @param   [array]   $data   [data]
     * @param   [string]  $table  [FORM sql]
     *
     * @return  [int OR boolean]          [return id sql OR true,false]
     */
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
        $sql = "INSERT INTO " . $table . "($fields) VALUES ({$values})";
        // Thực hiện INSERT
        if ( phpversion() < 5.3 ) {
            if ($this->db_execute($sql)) {
                return mysql_insert_id();
            }
        }

        return $this->db_execute($sql);
    }

    /**
     * Function to execute update queries
     *
     * @param   [array]  $data   [data]
     * @param   [string]  $table  [FORM sql]
     * @param   [array]  $where  [WHERE sql]
     *
     * @return  [boolean]          [return true, false]
     */
    function db_update($data = array(), $table, $where = array())
    {
        // Relation, Hai biến danh sách field_value và conditions
        $relation = isset($where['relation']) ? ' ' . $where['relation'] . ' ' : ' AND ';
        $fields_values = '';
        $conditions = '';
        $conditions = $this->db_where_string($where, $conditions, $relation);

        $conditions = trim($conditions, $relation);

        foreach ($data as $field => $value) {
            $fields_values .= $field . " = '" . addslashes($value) . "',";
        }

        $fields_values = trim($fields_values, ',');

        $sql = "UPDATE $table SET $fields_values WHERE $conditions";

        return $this->db_execute($sql);
    }

    function db_delete($table, $where = array()){
        $relation = isset($where['relation']) ? ' ' . $where['relation'] . ' ' : ' AND ';
        $conditions = '';
        $conditions = $this->db_where_string($where, $conditions, $relation);
        $conditions = trim($conditions, $relation);
        $sql = "DELETE FROM $table WHERE $conditions";
        return $this->db_execute($sql);
    }

    /**
     * Execution the function takes data
     *
     * @param   [array]  $arr   [included: select, table, where, group_by, order_by]
     * @param   [string]  $type  [get type data: list OR row]
     *
     * @return  [array]         [return list OR row data]
     */
    function db_get_data($arr, $type = 'all')
    {
        $sql = '';
        if (isset($arr['select']) && !empty($arr['select'])) {
            $sql = "SELECT " . $arr['select'];
        } else {
            $sql = "SELECT *";
        }

        if (isset($arr['table']) && !empty($arr['table'])) {
            $sql .= " FROM " . $arr['table'];
        }

        if (isset($arr['where']) && $arr['where']) {
            // Relation và conditions
            $relation = isset($arr['where']['relation']) ? ' ' . $arr['where']['relation'] . ' ' : ' AND ';
            $conditions = '';
            $conditions = $this->db_where_string($arr['where'], $conditions, $relation);
        }

        if (isset($conditions) && $conditions) {
            $sql .= ' WHERE ' . $conditions;
        }

        if (isset($arr['group_by']) && !empty($arr['group_by'])) {
            $sql .= " GROUP BY " . $arr['group_by'];
        }

        if (isset($arr['order_by']) && !empty($arr['order_by'])) {
            $sql .= " ORDER BY " . $arr['order_by'];
        }

        if ($type === 'all') {
            return $this->db_get_list($sql);
        }

        return $this->db_get_row($sql);
    }

    // Return Where String
    function db_where_string($where = array(), $conditions = '', $relation = '')
    {
        foreach ($where as $k_lv1 => $v_lv1) {
            if ($k_lv1 === 'relation') continue;

            if (isset($v_lv1['relation'])) {
                $conditions .= '(';
                $relation_lv1 = ' ' . $v_lv1['relation'] . ' ';

                foreach ($v_lv1 as $k_lv2 => $v_lv2) {
                    if ($k_lv2 === 'relation') continue;
                    $operator = isset($v_lv2['operator']) ? $v_lv2['operator'] : '=';
                    $conditions .= $v_lv2['key'] . " " . $operator . " '" . addslashes($v_lv2['value']) . "'" . $relation_lv1;
                }

                $conditions = trim($conditions, $relation_lv1);
                $conditions .= ')' . $relation;
            } else {
                $operator = isset($v_lv1['operator']) ? $v_lv1['operator'] : '=';
                $conditions .= $v_lv1['key'] . " " . $operator . " '" . addslashes($v_lv1['value']) . "'" . $relation;
            }
        }

        return trim($conditions, $relation);
    }
}
