<?php

class Mysql_Connection {

    private $conn;

    public function __construct($db_host, $db_user, $db_pass, $db_name, $charset = 'utf8') {
        //connect
        $this->conn = mysqli_connect($db_host, $db_user, $db_pass) or die('cannot connect');
        //use db
        mysqli_select_db($this->conn, $db_name) or die("cannot connect to database '{$db_name}'");
        //charset
        mysqli_query($this->conn, "SET NAMES {$charset}");
    }

    public function mysql_execute_query($query) {
        $result = mysqli_query($this->conn, $query);
        if (!$result) {
            error_log(mysqli_error($this->conn) . '|' . $query);
        }
        return $result;
    }

    public function get_table($query) {
        $res = $this->mysql_execute_query($query);

        if ($res) {
            $records = array();
            while ($row = mysqli_fetch_assoc($res)) {
                $records[] = $row;
            }
            return $records;
        }
        return false;
    }

    public function execute_none_query($query) {
        if ($this->mysql_execute_query($query)) {
            return true;
        }
        return false;
    }

    public function get_value($query) {
        $record = $this->get_row($query);
        if ($record) {
            list($field, $value) = each($record);
            return $value;
        }
    }

    public function get_row($query) {
        $res = $this->mysql_execute_query($query);

        if ($res and $row = mysqli_fetch_assoc($res)) {
            return $row;
        }
    }

    public function get_column($query, $conlumn = 0) {
        $res = $this->mysql_execute_query($query);

        if ($res) {
            $records = array();
            if (is_numeric($conlumn) || !$conlumn) {
                while ($row = mysqli_fetch_array($res)) {
                    $records[] = (isset($row[$conlumn]) ? $row[$conlumn] : '');
                }
            } else {
                while ($row = mysqli_fetch_assoc($res)) {
                    $records[] = (isset($row[$conlumn]) ? $row[$conlumn] : '');
                }
            }
            return $records;
        }
        return false;
    }

    public function get_enum_list($table, $column) {
        $table = $this->escape_string($table);
        $column = $this->escape_string($column);
        $sql = "show columns from `$table` like '$column'";
        $enum_list = array();
        $row = $this->get_row($sql);
        if ($row) {
            $type = strstr((isset($row['Type']) ? $row['Type'] : ''), '(');
            if ($type) {
                $type = trim($type, '()');
                $items = explode("',", $type);

                foreach ($items as $item) {
                    $enum_list[] = trim($item, "'");
                }
            }
        }
        return $enum_list;
    }

    public function escape_array($array) {
        $data = array();
        foreach ($array as $key => $value) {
            $data[$key] = $this->escape_string($value);
        }
        return $data;
    }

    public function escape_string($value) {
        if ($value) {
            return mysqli_real_escape_string($this->conn, $value);
        }
        return $value;
    }

    public function get_insert_id() {
        return mysqli_insert_id($this->conn);
    }

    public function get_found_rows() {
        return $this->get_value('SELECT FOUND_ROWS()');
    }

    public function get_tables($like = '') {
        $like = trim($like);
        $like = !empty($like) ? " LIKE '{$this->escape_string($like)}%'" : '';
        return $this->get_column('SHOW TABLES' . $like);
    }

    public function get_table_description($table) {
        $table = $this->escape_string($table);
        return $this->get_table("DESC $table");
    }

    public function get_table_primaries($table_name) {
        return $this->get_column("SHOW INDEX FROM `{$table_name}` WHERE Key_name = 'PRIMARY'", 'Column_name');
    }

    public function get_table_engine($table_name) {
        $table_info = $this->get_row("SHOW TABLE STATUS LIKE '{$table_name}'");
        if ($table_info) {
            return strtolower($table_info['Engine']);
        }
    }
}
