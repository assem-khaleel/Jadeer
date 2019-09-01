<?php defined('BASEPATH') OR exit('No direct script access allowed');

$config['navigation']['survey']['title'] = lang('Survey');
$config['navigation']['survey']['icon'] = 'fa fa-list-alt';
$config['navigation']['survey']['order'] = 4;

$config['navigation']['survey']['items']['alumni_center']['title'] = lang('Alumni Center');
$config['navigation']['survey']['items']['alumni_center']['link'] = '/alumni_center';
$config['navigation']['survey']['items']['alumni_center']['order'] = 2;
$config['navigation']['survey']['items']['alumni_center']['credential'] = Orm_User::check_credential(array(Orm_User::USER_FACULTY, Orm_User::USER_STAFF), false, 'alumni-list');