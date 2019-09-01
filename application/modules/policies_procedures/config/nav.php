<?php defined('BASEPATH') OR exit('No direct script access allowed');

$config['navigation']['policies_management']['title'] = lang('Policies & Management');
$config['navigation']['policies_management']['icon'] = 'fa fa-users';
$config['navigation']['policies_management']['order'] = 3;

$config['navigation']['policies_management']['items']['policies_procedures']['title'] = lang('Policies & Procedures');
$config['navigation']['policies_management']['items']['policies_procedures']['link'] = '/policies_procedures';
$config['navigation']['policies_management']['items']['policies_procedures']['order'] = 4;
$config['navigation']['policies_management']['items']['policies_procedures']['credential'] = Orm_User::check_credential(array(Orm_User::USER_STUDENT), true) || Orm_User::check_credential(array(Orm_User::USER_FACULTY, Orm_User::USER_STAFF), false, 'policies_procedures-list');