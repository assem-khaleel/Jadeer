<?php defined('BASEPATH') OR exit('No direct script access allowed');

$config['navigation']['award_management']['title'] = lang('Award Management').'*';
$config['navigation']['award_management']['icon'] = 'fa fa-trophy';
$config['navigation']['award_management']['link'] = '/award_management';
$config['navigation']['award_management']['order'] = 1;
$config['navigation']['award_management']['credential'] = Orm_User::check_credential(array(Orm_User::USER_FACULTY, Orm_User::USER_STAFF), false, 'award_management-list') || Orm_User::check_credential(array(Orm_User::USER_STUDENT), TRUE) ;
