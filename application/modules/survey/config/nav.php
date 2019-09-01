<?php defined('BASEPATH') OR exit('No direct script access allowed');

$config['navigation']['survey']['title'] = lang('Survey');
$config['navigation']['survey']['icon'] = 'fa fa-list-alt';
$config['navigation']['survey']['order'] = 4;

$config['navigation']['survey']['items']['survey']['title'] = lang('Survey');
$config['navigation']['survey']['items']['survey']['link'] = '/survey';
$config['navigation']['survey']['items']['survey']['order'] = 1;
$config['navigation']['survey']['items']['survey']['credential'] = Orm_User::check_credential_or(array(Orm_User::USER_FACULTY, Orm_User::USER_STAFF), false, Orm_Survey::get_role_types('list'));