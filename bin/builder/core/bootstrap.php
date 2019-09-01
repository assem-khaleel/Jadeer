<?php

require_once dirname(__FILE__) . '/connection.php';

/* @var $connection Mysql_Connection */
$connection = new Mysql_Connection($db_host, $db_user, $db_pass, $db_name);

function indent_php_code($phpcode) {
    $lines = explode("\n", $phpcode);
    $ind = 0;
    $new_code = '';
    foreach ($lines as $line) {
        $line = trim($line);

        if ($line AND ( $line[0] == '}' || $line[0] == ')')) {
            $ind--;
        }

        $new_code .= str_pad('', $ind * 4, ' ', STR_PAD_LEFT) . $line . "\n";

        if ($line AND ( $line[strlen($line) - 1] == '{' || $line[strlen($line) - 1] == '(')) {
            $ind++;
        }
    }
    return $new_code;
}

function get_alias($table_name) {
    $table_alias = '';
    $aliases = explode('_', $table_name);
    foreach ($aliases as $alias) {
        $table_alias .= substr($alias, 0, 1);
    }

    return strtolower($table_alias);
}
