<?php
/**
 * Created by PhpStorm.
 * User: mazen
 * Date: 9/4/16
 * Time: 2:12 PM
 */

$path = isset($_SERVER['PATH_INFO']) && file_exists($_SERVER['PATH_INFO']) ? __DIR__ . $_SERVER['PATH_INFO'] : realpath(__DIR__ .'/../') . '/assets/jadeer/img/file-not-found.png' ;

header('Content-Type: '.mime_content_type($path));
readfile($path);
