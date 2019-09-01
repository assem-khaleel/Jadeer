<?php defined('BASEPATH') OR exit('No direct script access allowed');


$config['navigation']['advisory']['title'] = lang('Advisory').'*';
$config['navigation']['advisory']['icon'] = 'fa fa-gift';
$config['navigation']['advisory']['link'] = '/advisory';
$config['navigation']['advisory']['order'] = 1;
$config['navigation']['advisory']['credential'] = Orm_User::check_credential([Orm_User::USER_STAFF, Orm_User::USER_FACULTY], false, 'advisory-list') || Orm_User::check_credential([Orm_User::USER_STUDENT]) ;
