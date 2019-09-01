<?php

/* @var $connection Mysql_Connection */

require_once dirname(__FILE__) . '/config.php';

require_once APPPATH . 'config/migration.php';

if(!$config['migration_enabled']) {
    die("migration not enabled\n");
}

$on_one_file = true;
$table_prefix = '';

$migration_version = intval($config['migration_version']) + 1;
$migration_path = rtrim($config['migration_path'],'/') ;

if (!$tables) {
    $tables = $connection->get_tables(isset($argv[1]) ? $argv[1] : '');
}

if(($key = array_search('ci_sessions', $not_tables)) !== false) {
    unset($not_tables[$key]);
}

$tables = array_diff($tables, $not_tables);

if(!is_dir($migration_path)) {
    mkdir($migration_path, 0777, true);
}

$up = '';
$down = '';

foreach ($tables as $table_name) {

    $primaries = $connection->get_table_primaries($table_name);
    $table_desc = $connection->get_table_description($table_name);

    if($table_prefix) {
        $table_name = str_replace($table_prefix, '', $table_name);
    }

    if(!$on_one_file) {
        sleep(1);
    }

    $migration_class_name = str_replace(' ', '_', ucwords(strtolower(str_replace('_', ' ', $table_name))));

    $file_name = date('YmdHis') . '_' . strtolower($migration_class_name) . '.php';

    $migration_class_name = 'Migration_' . $migration_class_name;

    $extra_sqls = array();
    $fields = array();
    $add_key = '';

    foreach ($table_desc as $field_desc) {
        $fields[] = draw_field($field_desc, $table_name, $extra_sqls);
    }

    $fields = implode(",\n", $fields);

    $indexes = $connection->get_table("SHOW INDEX FROM `{$table_name}`");

    if($indexes) {
        $index_list = array();
        foreach ($indexes as $index) {
            $columns = isset($index_list[$index['Key_name']]['columns']) ? $index_list[$index['Key_name']]['columns'] : array();
            $index_list[$index['Key_name']] = ['columns' => $columns, 'unique' => !boolval($index['Non_unique']), 'primary' => boolval($index['Key_name'] == 'PRIMARY'), 'sub_part' => !is_null($index['Sub_part'])];

            if($index['Sub_part']) {
                array_push($index_list[$index['Key_name']]['columns'], "`{$index['Column_name']}`({$index['Sub_part']})");
            } else {
                array_push($index_list[$index['Key_name']]['columns'], "'{$index['Column_name']}'");
            }
        }

        foreach ($index_list as $key => $value) {

            $columns = implode(',', $value['columns']);

            if($value['sub_part']) {
                if($value['unique']) {
                    $extra_sqls[] = "CREATE UNIQUE INDEX `{$key}` ON {$table_name}({$columns})";
                } else {
                    $extra_sqls[] = "CREATE INDEX `{$key}` ON {$table_name}({$columns})";
                }
            } else {

                if(count($value['columns']) > 1) {
                    $columns = "[{$columns}]";
                }

                if($value['primary']) {
                    $add_key .= "\$this->dbforge->add_key($columns, TRUE);\n";
                } else {
                    $add_key .= "\$this->dbforge->add_key($columns);\n";
                }
            }
        }
    }

    $extra = '';
    foreach ($extra_sqls as $extra_sql) {

        $extra .= "\n
            \$sql = \"{$extra_sql}\";
            \$this->db->query(\$sql);";

    }

    if(!$on_one_file) {
        $up = '';
        $down = '';
    }

    $up .= "\n
        /**
        * migration for {$table_name}
        */
        \$this->dbforge->add_field(array(
            {$fields}
        ));
    
        {$add_key}
        \$this->dbforge->create_table('{$table_name}');{$extra}";

    $down .= "\n
        /**
        * migration for {$table_name}
        */
    \$this->dbforge->drop_table('{$table_name}');";

    if(!$on_one_file) {
        export($migration_class_name, $up, $down, $file_name);
    }

    echo '.';
}

if($on_one_file) {

    $migration_class_name = 'Initial';

    $file_name = date('YmdHis') . '_' . strtolower($migration_class_name) . '.php';

    $migration_class_name = 'Migration_' . $migration_class_name;

    export($migration_class_name, $up, $down, $file_name);
}


function draw_field($field_desc, $table_name, &$extra_sqls = array()) {

    $type = strtoupper(preg_replace('#\(.*\)#','', $field_desc['Type']));

    $type_details = explode(' ', $type);
    $type = isset($type_details[0]) ? $type_details[0] : '';

    preg_match('#\(.*\)#', $field_desc['Type'], $matchs);
    $constraint = isset($matchs[0]) ? str_replace(['(',')'], '', $matchs[0]) : '';

    $field_descriptions = array();

    switch($type) {
        case 'INT':
        case 'TINYINT':
        case 'SMALLINT':
        case 'MEDIUMINT':
        case 'BIGINT':

            if($field_desc['Field'] == 'id' || strpos(strtolower($field_desc['Field']), '_id') !== false) {
                $field_descriptions[] = "'type' => 'BIGINT'";
                $field_descriptions[] = "'constraint' => 20";
            } else {
                $field_descriptions[] = "'type' => '{$type}'";
                $field_descriptions[] = "'constraint' => {$constraint}";
            }

            break;

        case 'TIMESTAMP':
            $field_descriptions[] = "'type' => '{$type}'";
            if($constraint) {
                $field_descriptions[] = "'constraint' => {$constraint}";
            }
            break;

        case 'FLOAT':
        case 'DOUBLE':
        case 'DECIMAL':
        case 'REAL':
            $field_descriptions[] = "'type' => '{$type}'";
            $field_descriptions[] = "'constraint' => '{$constraint}'";
            break;

        case 'TEXT':
        case 'TINYBLOB':
        case 'TINYTEXT':
        case 'MEDIUMBLOB':
        case 'MEDIUMTEXT':
        case 'LONGBLOB':
        case 'LONGTEXT':
        case 'DATE':
        case 'DATETIME':
        case 'TIME':
        case 'YEAR':
            $field_descriptions[] = "'type' => '{$type}'";
            break;

        case 'ENUM':
            $field_descriptions[] = "'type' => \"{$type}({$constraint})\"";
            break;

        case 'CHAR':
        case 'VARCHAR':
        case 'BLOB':
        default :
            $field_descriptions[] = "'type' => '{$type}'";
            $field_descriptions[] = "'constraint' => '{$constraint}'";
            break;
    }

    if($field_desc['Null'] == 'YES') {
        $field_descriptions[] = "'null' => TRUE";
    } else {
        $field_descriptions[] = "'null' => FALSE";
    }

    switch($field_desc['Default']) {

        case 'CURRENT_TIMESTAMP':
            if($field_desc['Null'] == 'YES') {
                $extra_sqls[] = "ALTER TABLE `{$table_name}` CHANGE COLUMN `{$field_desc['Field']}` `{$field_desc['Field']}` {$type} NULL DEFAULT CURRENT_TIMESTAMP" . ($field_desc['Extra'] ? ' ' . $field_desc['Extra'] : '');
            } else {
                $extra_sqls[] = "ALTER TABLE `{$table_name}` CHANGE COLUMN `{$field_desc['Field']}` `{$field_desc['Field']}` {$type} NOT NULL DEFAULT CURRENT_TIMESTAMP" . ($field_desc['Extra'] ? ' ' . $field_desc['Extra'] : '');
            }
            break;

        default:
            if($field_desc['Default'] || $field_desc['Default'] === '0' || $field_desc['Default'] === '') {
                $field_descriptions[] = "'default' => '{$field_desc['Default']}'";
            }
            break;

    }

    if($field_desc['Extra'] == 'auto_increment') {
        $field_descriptions[] = "'auto_increment' => TRUE";
    }

    if(in_array('UNSIGNED', $type_details)) {
        $field_descriptions[] = "'unsigned' => TRUE";
    }

    if(in_array('ZEROFILL', $type_details)) {
        $field_descriptions[] = "'zerofill' => TRUE";
    }

    $field_descriptions = implode(",\n", $field_descriptions);
    return "'{$field_desc['Field']}' => array(
    {$field_descriptions}
    )";
}

function export($class_name, $up, $down, $file_name) {

    global $migration_path;

    $class_body = "<?php
                    
                    defined('BASEPATH') OR exit('No direct script access allowed');
                    
                    /**
                     * Class {$class_name}
                     *
                     * @property CI_DB_forge \$dbforge
                     * @property CI_DB_query_builder | CI_DB_mysqli_driver \$db
                     */
                    class {$class_name} extends CI_Migration {
                    
                        public function up() { {$up} \n }
                    
                        public function down() { {$down} \n }
                        
                    }";

    $file = $migration_path . '/' . $file_name;

    if (!file_exists($file)) {
        file_put_contents($file, indent_php_code($class_body));
    }
}

echo "\n";