<?php defined('BASEPATH') OR exit('No direct script access allowed');

$config['navigation']['policies_management']['title'] = lang('Policies & Management');
$config['navigation']['policies_management']['icon'] = 'fa fa-users';
$config['navigation']['policies_management']['order'] = 3;

$config['navigation']['policies_management']['items']['meeting_minutes']['title'] = lang('Meeting Minutes');
$config['navigation']['policies_management']['items']['meeting_minutes']['link'] = '/meeting_minutes';
$config['navigation']['policies_management']['items']['meeting_minutes']['order'] = 3;
$config['navigation']['policies_management']['items']['meeting_minutes']['credential'] = Orm_User::check_credential(array(Orm_User::USER_STAFF, Orm_User::USER_FACULTY), false, 'meeting_minutes-list');