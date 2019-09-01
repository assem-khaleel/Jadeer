<?php defined('BASEPATH') OR exit('No direct script access allowed');


$config['navigation']['report']['title'] = lang('Reports') .' *';
$config['navigation']['report']['link'] = '/report';
$config['navigation']['report']['icon'] = 'fa fa-flag';
$config['navigation']['report']['order'] = 6;
$config['navigation']['report']['credential'] = Orm_User::check_credential(array(Orm_User::USER_FACULTY, Orm_User::USER_STAFF), false, 'report-list');