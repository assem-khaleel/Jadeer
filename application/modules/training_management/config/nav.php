<?php defined('BASEPATH') OR exit('No direct script access allowed');

$config['navigation']['training_management']['title'] = lang('Training Management');
$config['navigation']['training_management']['link'] = '/training_management';
$config['navigation']['training_management']['icon'] = 'fa fa-briefcase';
$config['navigation']['training_management']['order'] =6;
$config['navigation']['training_management']['credential'] = Orm_User::check_credential(array(Orm_User::USER_FACULTY, Orm_User::USER_STAFF), false, 'training_management-list');