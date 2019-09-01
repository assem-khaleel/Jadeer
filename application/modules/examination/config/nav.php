<?php defined('BASEPATH') OR exit('No direct script access allowed');


$config['navigation']['examination']['title'] = lang('Examination');
$config['navigation']['examination']['icon'] = 'fa fa-file-text-o';
$config['navigation']['examination']['link'] = '/examination';
$config['navigation']['examination']['order'] = 1;
$config['navigation']['examination']['credential'] = Orm_User::check_credential([Orm_User::USER_STAFF, Orm_User::USER_FACULTY], false, 'examination-list') || Orm_User::check_credential([Orm_User::USER_STUDENT]) ;

