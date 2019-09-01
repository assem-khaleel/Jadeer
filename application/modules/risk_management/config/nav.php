<?php defined('BASEPATH') OR exit('No direct script access allowed');

$config['navigation']['risk_management']['title'] = lang('Risk Management').'*';
$config['navigation']['risk_management']['link'] = '/risk_management';
$config['navigation']['risk_management']['icon'] = 'fa fa-bug';
$config['navigation']['risk_management']['order'] = 4;
$config['navigation']['risk_management']['credential'] = Orm_User::check_credential(array(Orm_User::USER_FACULTY, Orm_User::USER_STAFF), false, 'risk_management-list');
