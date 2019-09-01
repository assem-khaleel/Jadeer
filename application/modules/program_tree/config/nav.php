<?php defined('BASEPATH') OR exit('No direct script access allowed');

$config['navigation']['curriculum']['title'] = lang('Curriculum');
$config['navigation']['curriculum']['icon'] = 'fa fa-book';
$config['navigation']['curriculum']['order'] = 1;

$config['navigation']['curriculum']['items']['program_tree']['title'] = lang('Program Tree');
$config['navigation']['curriculum']['items']['program_tree']['link'] = '/program_tree';
$config['navigation']['curriculum']['items']['program_tree']['order'] = 2;
$config['navigation']['curriculum']['items']['program_tree']['credential'] = Orm_User::check_credential(array(Orm_User::USER_FACULTY, Orm_User::USER_STAFF), false, 'program_tree-list');