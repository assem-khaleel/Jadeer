<?php

define('ENVIRONMENT', 'development');
define('BASEPATH', realpath(dirname(__FILE__) . '/../../') . DIRECTORY_SEPARATOR);
define('APPPATH', BASEPATH . 'application' . DIRECTORY_SEPARATOR);

require APPPATH . 'config/database.php';

$db_host = $db[$active_group]['hostname'];
$db_user = $db[$active_group]['username'];
$db_pass = $db[$active_group]['password'];
$db_name = $db[$active_group]['database'];

$orm_output_dir = APPPATH . 'orm_tmp' . DIRECTORY_SEPARATOR;
$model_output_dir = APPPATH . 'models_tmp' . DIRECTORY_SEPARATOR;
$crud_output_dir = APPPATH . 'crud_tmp' . DIRECTORY_SEPARATOR;

$tables = array();
$not_tables = array('ci_sessions', 'migrations');

require_once dirname(__FILE__) . '/core/bootstrap.php';