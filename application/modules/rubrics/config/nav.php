<?php defined('BASEPATH') OR exit('No direct script access allowed');

$config['navigation']['quality']['title'] = lang('Quality');
$config['navigation']['quality']['icon'] = 'fa fa-quora';
$config['navigation']['quality']['order'] = 3;

$config['navigation']['quality']['items']['rubrics']['title'] = lang('Rubrics').'*';
$config['navigation']['quality']['items']['rubrics']['link'] = '/rubrics';
$config['navigation']['quality']['items']['rubrics']['order'] = 3;
$config['navigation']['quality']['items']['rubrics']['credential'] = Orm_User::check_credential(array(Orm_User::USER_FACULTY, Orm_User::USER_STAFF), false, 'rubrics-list');
