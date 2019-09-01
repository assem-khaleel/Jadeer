<?php defined('BASEPATH') OR exit('No direct script access allowed');

$config['navigation']['policies_management']['title'] = lang('Policies & Management');
$config['navigation']['policies_management']['icon'] = 'fa fa-clone';
$config['navigation']['policies_management']['order'] = 3;

$config['navigation']['policies_management']['items']['room_management']['title'] = lang('Room Management');
$config['navigation']['policies_management']['items']['room_management']['link'] = '/room_management';
$config['navigation']['policies_management']['items']['room_management']['order'] = 2;
$config['navigation']['policies_management']['items']['room_management']['credential'] = Orm_User::check_credential(array(Orm_User::USER_FACULTY, Orm_User::USER_STAFF), false, 'room_management-list');

