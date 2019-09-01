<?php

require_once dirname(__FILE__) . '/config.php';

/* @var $connection Mysql_Connection */
if (!$tables) {
    $tables = $connection->get_tables(isset($argv[1]) ? $argv[1] : '');
}

$tables = array_diff($tables, $not_tables);

if(!is_dir($orm_output_dir)) {
    mkdir($orm_output_dir, 0777, true);
}

foreach ($tables as $table_name) {

    $orm_class_name = 'Orm_' . str_replace(' ', '_', ucwords(strtolower(str_replace('_', ' ', $table_name))));
    $model_class_name = str_replace(' ', '_', ucwords(strtolower(str_replace('_', ' ', $table_name)))) . '_Model';

    $file_name = strtolower($orm_class_name) . '.php';

    $primaries = $connection->get_table_primaries($table_name);
    $table_desc = $connection->get_table_description($table_name);

    $class_attributes = '';
    $setters_getters = '';
    $db_params = '';
    $incremental_field = '';

    foreach ($table_desc as $field_desc) {

        $is_primary = in_array($field_desc['Field'], $primaries);

        $class_attributes .= class_attributes($field_desc);
        $setters_getters .= setter_getter_functions($field_desc['Field'], $is_primary);
        $db_params .= db_params($field_desc);

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
                        `TABLE_SCHEMA` = SCHEMA() AND `REFERENCED_TABLE_NAME` IS NOT NULL AND `TABLE_NAME` = '{$table_name}'");

    $relation_one_to_one = '';
    $relations = array();

    if($one_to_one){
        foreach($one_to_one as $relation) {

            $ref_table_name = $relation['REFERENCED_TABLE_NAME'];
            $column_name = $relation['COLUMN_NAME'];

            $relations[$ref_table_name][] = $column_name;
        }

        foreach($relations as $table => $columns) {
            $relation_one_to_one .= relation_one_to_one($table, $columns);
        }
    }

    // many to one
    $many_to_one = $connection->get_table("SELECT
                        `TABLE_NAME`,
                        `COLUMN_NAME`,
                        `REFERENCED_TABLE_NAME`,
                        `REFERENCED_COLUMN_NAME`
                    FROM
                        `INFORMATION_SCHEMA`.`KEY_COLUMN_USAGE`
                    WHERE
                        `TABLE_SCHEMA` = SCHEMA() AND `REFERENCED_TABLE_NAME` IS NOT NULL AND `REFERENCED_TABLE_NAME` = '{$table_name}'");

    $relation_many_to_one = '';

    if($many_to_one){
        foreach($many_to_one as $relation) {
            $relation_many_to_one .= relation_many_to_one($relation);
        }
    }

    $is_default_primary = ($primaries[0] === 'id' && count($primaries) === 1);

    $override_functions = '';

    if(!$is_default_primary) {

        $override_functions = "
        
        /**
        * push instance
        */
        protected function push_instance() {
            " . push_instance($primaries) . "
        }

        /**
         * pull_instance
         *
         * @param array \$row
         * @return array
         */
        protected static function pull_instance(\$row) {

            " . implode("\n", array_map(function($primary){ return "\${$primary} = intval(isset(\$row['{$primary}']) ? \$row['{$primary}'] : 0);"; }, $primaries)) . "

            if(isset(self::\$instances[$" . implode('][$', $primaries) . "])) {
                return self::\$instances[$" . implode('][$', $primaries) . "];
            }

            return null;
        }
        ";

    }

    //
    // create class
    //
    $class_body = "<?php
        defined('BASEPATH') OR exit('No direct script access allowed');
        
        class {$orm_class_name} extends Orm {

            /**
            * @var \$instances {$orm_class_name}[]
            */
            protected static \$instances = array();
            protected static \$table_name = '{$table_name}';

           /**
            * class attributes
            */
            {$class_attributes}
           /**
            * @return {$model_class_name}
            */
            public static function get_model() {
                return Orm::get_ci_model('{$model_class_name}');
            }{$override_functions}
              
           /**
            * get instance        
            *\n* @param int $" . implode("\n* @param int $", $primaries) . "
            * @return {$orm_class_name}
            */
            public static function get_instance($". implode(', $', $primaries) . ") {

                " . implode("\n", array_map(function($primary){ return "\${$primary} = intval(\${$primary});"; }, $primaries)) . "

                if(isset(self::\$instances[$" . implode('][$', $primaries) . "])) {
                    return self::\$instances[$" . implode('][$', $primaries) . "];
                }

                return self::get_one(array(" . implode(', ', array_map(function($primary){ return "'{$primary}' => \${$primary}"; }, $primaries)) . "));
            }
            
            /**
             * Get all rows as Objects
             * 
             * @param array \$filters
             * @param int \$page
             * @param int \$per_page
             * @param array \$orders
             * 
             * @return {$orm_class_name}[] | int
             */
            public static function get_all(\$filters = array(), \$page = 0, \$per_page = 0, \$orders = array()) {
                return self::get_model()->get_all(\$filters, \$page, \$per_page, \$orders, Orm::FETCH_OBJECTS);
            }
            
            /**
             * get one row as Object
             *
             * @param array \$filters
             * @param array \$orders
             * @return {$orm_class_name}
             */
            public static function get_one(\$filters = array(), \$orders = array()) {

                \$result = self::get_model()->get_all(\$filters, 1, 1, \$orders, Orm::FETCH_OBJECT);

                if (\$result && " . implode(' && ', array_map(function($primary){ return "\$result->get_{$primary}()"; }, $primaries)) . ") {
                    return \$result;
                }

                return new {$orm_class_name}();
            }
            
            /**
             * get count
             *
             * @param array \$filters
             * @return int
             */
            public static function get_count(\$filters = array()) {
                return self::get_model()->get_all(\$filters, 0, 0, array(), Orm::FETCH_COUNT);
            }
                
            public function to_array() {
                \$db_params = array();
                {$db_params}
                return \$db_params;
            }
                
            public function save() {
                if (\$this->get_object_status() == 'new') {
                    " . ($incremental_field ? '$insert_id = ' : '') . "self::get_model()->insert(\$this->to_array());" . ($incremental_field ? "\n\$this->set_{$incremental_field}(\$insert_id);" : '') . "
                } elseif(\$this->get_object_fields()) {
                    self::get_model()->update(" . implode(', ', array_map(function($primary){ return "\$this->get_{$primary}()"; }, $primaries)) . ", \$this->get_object_fields());
                }

                \$this->set_object_status('saved');
                \$this->reset_object_fields();
                return " . ($incremental_field ? "\$this->get_{$incremental_field}()" : '$this') . ";
            }

            public function delete() {
                return self::get_model()->delete(" . implode(', ', array_map(function($primary){ return "\$this->get_{$primary}()"; }, $primaries)) . ");
            }
            {$setters_getters} {$relation_one_to_one} {$relation_many_to_one}

        }
        ";

    $file = $orm_output_dir . $file_name;

    if (!file_exists($file)) {
        file_put_contents($file, indent_php_code($class_body));
    }

    echo '.';
}

function push_instance($primaries) {

    $fields = array();
    foreach($primaries as $primary) {
        $fields[] = "\$this->{$primary}";
    }

    if($primaries) {
        $condition = implode(' && ', $fields);
        $instance_key = '[' . implode('][', $fields) . ']';

        $out = "if ({$condition}) {
                self::\$instances{$instance_key} = \$this;
            }";

        return "{$out}";
    }
}


function db_params($field_desc) {

    if($field_desc['Extra'] == 'auto_increment') {
        $out = "if (Orm::is_integration_mode() && \$this->get_id()) {
                    \$db_params['{$field_desc['Field']}'] = \$this->get_{$field_desc['Field']}();
                }";
    } else {
        $out = "\$db_params['{$field_desc['Field']}'] = \$this->get_{$field_desc['Field']}();";
    }

    return "{$out}\n";
}

function setter_getter_functions($field_name, $is_primary = false) {

    $field_id = '';
    if($is_primary) {
        $field_id = "\n\n\$this->push_instance();";
    }

    $out = "public function set_{$field_name}(\$value) {
                \$this->add_object_field('{$field_name}', \$value);
                \$this->{$field_name} = \$value;{$field_id}
            }

            public function get_{$field_name}() {
                return \$this->{$field_name};
            }";

    return "\n{$out}\n";
}

function class_attributes($field_desc) {

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
            $default = 0;
            break;

        case 'DATE':
            $default = "'0000-00-00'";
            break;

        case 'DATETIME':
            $default = "'0000-00-00 00:00:00'";
            break;

        case 'TIME':
            $default = "'00:00:00'";
            break;

        case 'YEAR':
            $default = "'0000'";
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
            $default = "''";
            break;

        default :
            $default = "''";
            break;
    }

    if(!is_null($field_desc['Default'])) {
        if(is_string($default)) {
            $default = "'{$field_desc['Default']}'";
        } else {
            $default = "{$field_desc['Default']}";
        }
    }

    return "protected \${$field_desc['Field']} = {$default};\n";
}

function relation_one_to_one($table_name, $columns) {

    $orm_class_name = 'Orm_' . str_replace(' ', '_', ucwords(strtolower(str_replace('_', ' ', $table_name))));

    $out = "/**
     * @return {$orm_class_name}
     */
    public function related_{$table_name}()
    {
        return {$orm_class_name}::get_instance(" . implode(', ', array_map(function($column){ return "\$this->get_{$column}()"; }, $columns)) . ");
    }";

    return "\n{$out}\n";
}

function relation_many_to_one($relation) {

    global $connection;

    $ref_table_name = $relation['REFERENCED_TABLE_NAME'];
    $ref_column_name = $relation['REFERENCED_COLUMN_NAME'];

    $table_name = $relation['TABLE_NAME'];
    $column_name = $relation['COLUMN_NAME'];

    $primaries = $connection->get_table_primaries($table_name);

    if(in_array($column_name, $primaries)) {
        return;
    }

    $orm_class_name = 'Orm_' . str_replace(' ', '_', ucwords(strtolower(str_replace('_', ' ', $table_name))));

    $out = "private \$all_{$table_name} = null;

    /**
     * @return {$orm_class_name}[]
     */
    public function related_all_{$table_name}() {
        if(is_null(\$this->all_{$table_name})) {
            \$this->all_{$table_name} = {$orm_class_name}::get_all(array('{$column_name}' => \$this->get_{$ref_column_name}()));
        }
        return \$this->all_{$table_name};
    }";

    return "\n{$out}\n";
}


echo "\n";