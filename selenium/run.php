<?php

error_reporting(-1);
ini_set('display_errors', 1);

define('ENVIRONMENT', 'testing');
define('BASEPATH', realpath(dirname(__FILE__) . '/../') . DIRECTORY_SEPARATOR);
define('APPPATH', BASEPATH . 'application' . DIRECTORY_SEPARATOR);

require BASEPATH . 'vendor/autoload.php';

$config = []; require APPPATH . 'config/config.php';
$class = (isset($_REQUEST['class']) ? $_REQUEST['class'] : '');

if($class && class_exists($class)) {
    $app = new Selenium\Test\Core\App($config, $class);
    $app->run();

    //$class::run($config);
    echo 'Run Successfully';
} else {
    echo 'Class Not Exist "' . $class .'"';
}