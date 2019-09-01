<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Created by PhpStorm.
 * User: qanah
 * Date: 7/30/15
 * Time: 12:40 PM
 */

foreach (['Courses', 'Students', 'Faculty', 'Staff', 'Alumni', 'Employer','Training','Advisory'] as $type) {
    $type = strtolower($type);
    $config['map']["survey_{$type}"]['list'] = "survey_{$type}-list";
    $config['map']["survey_{$type}"]['manage'] = "survey_{$type}-manage";
    $config['map']["survey_{$type}"]['report'] = "survey_{$type}-report";
    $config['map']["survey_{$type}"]['evaluation'] = "survey_{$type}-evaluation";
}