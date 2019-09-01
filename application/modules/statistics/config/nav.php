<?php defined('BASEPATH') OR exit('No direct script access allowed');

$config['navigation']['accreditation']['title'] = lang('Accreditation');
$config['navigation']['accreditation']['icon'] = 'fa fa-sitemap';
$config['navigation']['accreditation']['order'] = 2;

$config['navigation']['accreditation']['items']['statistics']['title'] = lang('Statistics');
$config['navigation']['accreditation']['items']['statistics']['link'] = '/statistics';
$config['navigation']['accreditation']['items']['statistics']['order'] = 5;
$config['navigation']['accreditation']['items']['statistics']['credential'] = Orm_User::check_credential(array(Orm_User::USER_FACULTY, Orm_User::USER_STAFF), false, 'accreditation-statistics');