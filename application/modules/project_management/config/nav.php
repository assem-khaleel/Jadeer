<?php defined('BASEPATH') OR exit('No direct script access allowed');


$config['navigation']['project_management']['title'] = lang('Project Management');

if (Orm_User::has_role_teacher()){
    $config['navigation']['project_management']['link'] = '/project_management/assigned_sub_phases';
}else{$config['navigation']['project_management']['link'] = '/project_management';
}
$config['navigation']['project_management']['icon'] = 'fa fa-tasks';
$config['navigation']['project_management']['order'] = 3;
$config['navigation']['project_management']['credential'] = Orm_User::check_credential(array(Orm_User::USER_FACULTY, Orm_User::USER_STAFF), false, 'project_management-list');