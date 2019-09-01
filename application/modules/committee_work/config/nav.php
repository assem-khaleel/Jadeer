<?php defined('BASEPATH') OR exit('No direct script access allowed');

$config['navigation']['policies_management']['title'] = lang('Policies & Management');
$config['navigation']['policies_management']['icon'] = 'fa fa-users';
$config['navigation']['policies_management']['order'] = 3;

$config['navigation']['policies_management']['items']['committee_work']['title'] = lang('Committee');
$config['navigation']['policies_management']['items']['committee_work']['link'] = '/committee_work';
$config['navigation']['policies_management']['items']['committee_work']['order'] = 1;
$config['navigation']['policies_management']['items']['committee_work']['credential'] = Orm_User::check_credential(array(Orm_User::USER_STAFF, Orm_User::USER_FACULTY),false,'committee_work-list');