<?php defined('BASEPATH') OR exit('No direct script access allowed');

$config['navigation']['quality']['title'] = lang('Quality');
$config['navigation']['quality']['icon'] = 'fa fa-quora';
$config['navigation']['quality']['order'] = 3;

$config['navigation']['quality']['items']['strategic_planning']['title'] = lang('Strategic Planning');
$config['navigation']['quality']['items']['strategic_planning']['link'] = '/strategic_planning';
$config['navigation']['quality']['items']['strategic_planning']['order'] = 1;
$config['navigation']['quality']['items']['strategic_planning']['credential'] = Orm_User::check_credential(array(Orm_User::USER_FACULTY, Orm_User::USER_STAFF), false, 'strategic_planning-list');