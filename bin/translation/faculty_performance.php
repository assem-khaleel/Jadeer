<?php

define('TRANS_PATH', dirname(__FILE__));

/* @var $connection Mysql_Connection */

require_once realpath(TRANS_PATH . '/../builder/config.php');

$inputs = $connection->get_table("SELECT * FROM fp_forms_inputs");

$out = array();
foreach ($inputs as $input) {

    $label_en = trim($input['input_label_en']);
    $label_ar = trim($input['input_label_ar']);

    $out[] = <<<OUT
    [
        "id" => {$input['id']},
        "form_id" => {$input['form_id']},
        "input_label_en" => "{$label_en}",
        "input_label_ar" => "{$label_ar}",
    ]
OUT;

}

$output = implode(",\n", $out);

file_put_contents('./fb.txt', $output);
