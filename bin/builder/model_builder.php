<?php

require_once dirname(__FILE__) . '/config.php';

/* @var $connection Mysql_Connection */

if (!$tables) {
    $tables = $connection->get_tables(isset($argv[1]) ? $argv[1] : '');
}

$tables = array_diff($tables, $not_tables);

if(!is_dir($model_output_dir)) {
    mkdir($model_output_dir, 0777, true);
}

foreach ($tables as $table_name) {

    $table_alias = get_alias($table_name);


    $orm_class_name = 'Orm_' . str_replace(' ', '_', ucwords(strtolower(str_replace('_', ' ', $table_name))));
    $model_class_name = str_replace(' ', '_', ucwords(strtolower(str_replace('_', ' ', $table_name)))) . '_Model';

    $file_name = $model_class_name . '.php';

    $primaries = $connection->get_table_primaries($table_name);
    $table_desc = $connection->get_table_description($table_name);

    $incremental_field = '';
    $filters = '';

    $has_is_deleted ='';

    foreach ($table_desc as $field_desc) {

        if($field_desc['Field']=='is_deleted') {
            $has_is_deleted= "\n\$this->db->where('{$table_alias}.{$field_desc['Field']}', 0);";
            continue;
        }

        $is_primary = in_array($field_desc['Field'], $primaries);

        $filters .= draw_filters($table_alias, $field_desc, $is_primary);

        if($field_desc['Extra'] == 'auto_increment') {
            $incremental_field = $field_desc['Field'];
        }
    }

    // one to one
    $one_to_one = $connection->get_table("SELECT
                        `TABLE_NAME`,
                        `COLUMN_NAME`,
                        `REFERENCED_TABLE_NAME`,
                        `REFERENCED_COLUMN_NAME`
                    FROM
                        `INFORMATION_SCHEMA`.`KEY_COLUMN_USAGE`
                    WHERE
                        `TABLE_SCHEMA` = SCHEMA() AND `REFERENCED_TABLE_NAME` IS NOT NULL AND `REFERENCED_TABLE_NAME` = '{$table_name}'");

    $delete_one_to_one = '';

    if($one_to_one){
        foreach($one_to_one as $relation) {
            $ref_table_name = $relation['REFERENCED_TABLE_NAME'];
            $ref_column_name = $relation['REFERENCED_COLUMN_NAME'];

            $main_table_name = $relation['TABLE_NAME'];
            $main_column_name = $relation['COLUMN_NAME'];

            $delete_one_to_one .= "\$related_count += \$this->db->where('{$main_column_name}', \${$ref_column_name})->count_all_results('{$main_table_name}');\n";
        }
    }


    //
    // create class
    //
    $class_body = "<?php
                    defined('BASEPATH') OR exit('No direct script access allowed');

                    /**
                    * Class {$model_class_name}
                    *
                    * @property CI_DB_query_builder | CI_DB_mysqli_driver \$db
                    */
                    class {$model_class_name} extends CI_Model {

                        /**
                         * get table rows according to the assigned filters and page
                         * 
                         * @param array \$filters
                         * @param int \$page
                         * @param int \$per_page
                         * @param array \$orders
                         * @param int \$fetch_as
                         *
                         * @return {$orm_class_name} | {$orm_class_name}[] | array | int
                         */
                        public function get_all(\$filters = array(), \$page = 0, \$per_page = 10, \$orders = array(), \$fetch_as = Orm::FETCH_OBJECTS) {

                            \$page = (int) \$page;
                            \$per_page = (int) \$per_page;

                            \$this->db->select('{$table_alias}.*');
                            \$this->db->distinct();
                            \$this->db->from({$orm_class_name}::get_table_name() . ' AS {$table_alias}');{$has_is_deleted}

                            {$filters}
                            if (\$orders) {
                                \$this->db->order_by(implode(',', \$orders));
                            }

                            if (\$page) {
                                \$offset = (\$page - 1) * \$per_page;
                                \$this->db->limit(\$per_page, \$offset);
                            }

                            switch(\$fetch_as) {
                                case Orm::FETCH_OBJECT:
                                    return {$orm_class_name}::to_object(\$this->db->get()->row_array());
                                    break;
                                case Orm::FETCH_OBJECTS:
                                    \$objects = array();
                                    foreach(\$this->db->get()->result_array() as \$row) {
                                        \$objects[] = {$orm_class_name}::to_object(\$row);
                                    }
                                    return \$objects;
                                    break;
                                case Orm::FETCH_ARRAY:
                                    return \$this->db->get()->result_array();
                                    break;
                                case Orm::FETCH_COUNT:
                                    return \$this->db->count_all_results();
                                    break;
                            }
                        }

                        /**
                         * insert new row to the table
                         *
                         * @param array \$params
                         * @return " . ($incremental_field ? 'int' : 'boolean') . "
                         */
                        public function insert(\$params = array()) {
                            " . ($incremental_field ? '' : 'return ') . "\$this->db->insert({$orm_class_name}::get_table_name(), \$params);" . ($incremental_field ? "\nreturn \$this->db->insert_id();" : '') . "
                        }

                        /**
                         * update item
                         *\n* @param int $" . implode("\n* @param int $", $primaries) . "
                         * @param array \$params 
                         * @return boolean
                         */
                        public function update($". implode(', $', $primaries) . ", \$params = array()) {
                            return \$this->db->update({$orm_class_name}::get_table_name(), \$params, array(" . implode(', ', array_map(function($primary){ return "'{$primary}' => \${$primary}"; }, $primaries)) . "));
                        }

                        /**
                         * delete item
                         *\n* @param int $" . implode("\n* @param int $", $primaries) . "
                         * @return boolean
                         */
                        public function delete($" . implode(', $', $primaries) . ") {
                            " . ($delete_one_to_one ? '$related_count = 0;' . "\n" . $delete_one_to_one : '') . " " . ($delete_one_to_one ? 'if($related_count === 0) {' . "\n" : '') . " return \$this->db->".
                            ($has_is_deleted==''?"delete": "update") .
                            "({$orm_class_name}::get_table_name(), ".
                            ($has_is_deleted==''? "" : "array('is_deleted' => 1), ") ."array(" . implode(', ', array_map(function ($primary) { return "'{$primary}' => \${$primary}";}, $primaries)) . "));" . ($delete_one_to_one ? "\n" . '}' . "\n" . 'return false;' : '') . "
                        }

                    }
        ";

    $file = $model_output_dir . $file_name;

    if (!file_exists($file)) {
        file_put_contents($file, indent_php_code($class_body));
    }

    echo '.';
}

function draw_filters($table_alias, $field_desc, $is_primary = false) {


    $filters = '';

    $field = $field_desc['Field'];
    $type = strtoupper(preg_replace('#\(.*\)#','', $field_desc['Type']));

    switch($type) {
        case 'INT':
        case 'TINYINT':
        case 'SMALLINT':
        case 'MEDIUMINT':
        case 'BIGINT':
        case 'FLOAT':
        case 'DOUBLE':
        case 'DECIMAL':
        case 'TIMESTAMP':
            $filters .= "if (isset(\$filters['{$field}'])) {
                            \$this->db->where('{$table_alias}.{$field}', \$filters['{$field}']);
                        }" . "\n";
            break;

        case 'DATE':
        case 'DATETIME':
        case 'TIME':
        case 'YEAR':
            $filters .= "if (!empty(\$filters['{$field}'])) {
                            \$this->db->where('{$table_alias}.{$field}', \$filters['{$field}']);
                        }
                        if (!empty(\$filters['greater_{$field}'])) {
                            \$this->db->where('{$table_alias}.{$field} >=', \$filters['greater_{$field}']);
                        }
                        if (!empty(\$filters['less_{$field}'])) {
                            \$this->db->where('{$table_alias}.{$field} <=', \$filters['less_{$field}']);
                        }
                        if (!empty(\$filters['from_{$field}']) && !empty(\$filters['to_{$field}'])) {
                            \$this->db->group_start();
                            \$this->db->where('{$table_alias}.{$field} >=', \$filters['from_{$field}']);
                            \$this->db->where('{$table_alias}.{$field} <=', \$filters['to_{$field}']);
                            \$this->db->group_end();
                        }" . "\n";
            break;

        case 'CHAR':
        case 'VARCHAR':
        case 'BLOB':
        case 'TEXT':
        case 'TINYBLOB':
        case 'TINYTEXT':
        case 'MEDIUMBLOB':
        case 'MEDIUMTEXT':
        case 'LONGBLOB':
        case 'LONGTEXT':
        case 'ENUM':
            $filters .= "if (!empty(\$filters['{$field}'])) {
                            \$this->db->where('{$table_alias}.{$field}', \$filters['{$field}']);
                        }" . "\n";
            break;

        default :
            $filters .= "if (!empty(\$filters['{$field}'])) {
                            \$this->db->where('{$table_alias}.{$field}', \$filters['{$field}']);
                        }" . "\n";
            break;
    }

    if ($is_primary) {
        $filters .= "if (isset(\$filters['not_{$field}'])) {
                        \$this->db->where('{$table_alias}.{$field} !=', \$filters['not_{$field}']);
                    }
                    if (!empty(\$filters['in_{$field}'])) {
                        \$this->db->where_in('{$table_alias}.{$field}', \$filters['in_{$field}']);
                    }
                    if (!empty(\$filters['not_in_{$field}'])) {
                        \$this->db->where_not_in('{$table_alias}.{$field}', \$filters['not_in_{$field}']);
                    }". "\n";
    }

    return $filters;
}

echo "\n";