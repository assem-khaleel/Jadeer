<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Created by PhpStorm.
 * User: qanah
 * Date: 7/30/15
 * Time: 12:40 PM
 */

//Settings
$config['map']['settings']['manage'] = 'settings-manage';
$config['map']['settings']['semester'] = 'settings-semester';
$config['map']['settings']['standard'] = 'settings-standard';
$config['map']['settings']['criteria'] = 'settings-criteria';
$config['map']['settings']['item'] = 'settings-item';
$config['map']['settings']['unit'] = 'settings-unit';
$config['map']['settings']['campus'] = 'settings-campus';
$config['map']['settings']['institution'] = 'settings-institution';
$config['map']['settings']['college'] = 'settings-college';
$config['map']['settings']['department'] = 'settings-department';
$config['map']['settings']['degree'] = 'settings-degree';
$config['map']['settings']['program'] = 'settings-program';
$config['map']['settings']['major'] = 'settings-major';
$config['map']['settings']['program_plan'] = 'settings-program_plan';
$config['map']['settings']['course'] = 'settings-course';
$config['map']['settings']['course_section'] = 'settings-course_section';
$config['map']['settings']['user'] = 'settings-user';
$config['map']['settings']['role'] = 'settings-role';
$config['map']['settings']['login_as'] = 'settings-login_as';
$config['map']['settings']['notification'] = 'settings-notification';
$config['map']['settings']['translation'] = 'settings-translation';
$config['map']['settings']['jobs'] = 'settings-jobs';

//Setup
$config['map']['setup']['mission'] = 'setup-mission';
$config['map']['setup']['vision'] = 'setup-vision';
$config['map']['setup']['goal'] = 'setup-goal';
$config['map']['setup']['objective'] = 'setup-objective';

//Doc_Repo
$config['map']['doc_repo']['list'] = 'doc_repo-list';
$config['map']['doc_repo']['manage'] = 'doc_repo-manage';

foreach (scandir(APPPATH . 'modules') as $module) {

    $acl_file = APPPATH . "modules/{$module}/config/acl.php";

    if(file_exists($acl_file) && License::get_instance()->check_module($module)) {
        include_once $acl_file;
    }
}