<?php defined('BASEPATH') OR exit('No direct script access allowed');

$config['navigation']['quality']['title'] = lang('Quality');
$config['navigation']['quality']['icon'] = 'fa fa-quora';
$config['navigation']['quality']['order'] = 3;

$config['navigation']['quality']['items']['assessment_loop']['title'] = lang('Assessment Loop');
$config['navigation']['quality']['items']['assessment_loop']['link'] = '/assessment_loop';
$config['navigation']['quality']['items']['assessment_loop']['order'] = 2;
$config['navigation']['quality']['items']['assessment_loop']['credential'] = Orm_User::check_credential(array(Orm_User::USER_FACULTY, Orm_User::USER_STAFF), false, 'assessment_loop-list');