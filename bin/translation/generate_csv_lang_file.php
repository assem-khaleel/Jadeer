<?php

define('TRANS_PATH', dirname(__FILE__));

/* @var $connection Mysql_Connection */

require_once realpath(TRANS_PATH . '/../builder/config.php');

require_once APPPATH . 'config/migration.php';

$migration_path = rtrim($config['migration_path'],'/') ;

$lang = explode("\n", file_get_contents(TRANS_PATH . '/lang.txt'));

$output = array();

$file = $migration_path . "/translation.csv";

if(file_exists($file)) {
    unlink($file);
}

$english = 2;
$languages = $connection->get_table("SELECT DISTINCT `language_id` FROM `translation`");

$txt = "LANG_KEY";

foreach ($languages as $language) {
    $txt .= "|LANG_{$language['language_id']}";
}

file_put_contents($file, $txt.PHP_EOL , FILE_APPEND);

foreach ($lang as $string) {
    $key_string = trim(str_replace(array(' ', "'", "\n", "\r", "\t", "<br>"), array('_', '', '_', '', '', '<\br>'), strtolower(trim($string))));

    $translation = $connection->get_table("SELECT `language_id`,`translation` FROM `translation` WHERE `string` = '{$key_string}'");

    $string = str_replace(array("\n", "\r", "<br>"), '<\br>', $string);

    $txt = "{$string}";

    foreach ($languages as $language) {

        $translation_value = '';
        foreach ($translation as $trans) {
            if($trans['language_id'] == $language['language_id']) {
                $translation_value = trim($trans['translation']);
            }
        }

        if($language['language_id'] == $english && empty($translation_value)) {
            $translation_value = trim($string);
        }

        $translation_value = str_replace(array("\n", "\r", "<br>"), '<\br>', $translation_value);

        $txt .= "|{$translation_value}";
    }

    file_put_contents($file, $txt.PHP_EOL , FILE_APPEND);
}