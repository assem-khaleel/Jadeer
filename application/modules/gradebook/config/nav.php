<?php defined('BASEPATH') OR exit('No direct script access allowed');

$config['navigation']['curriculum']['title'] = lang('Curriculum');
$config['navigation']['curriculum']['icon'] = 'fa fa-book';
$config['navigation']['curriculum']['order'] = 4;

$config['navigation']['curriculum']['items']['gradebook']['title'] = lang('Gradebook').'*';
$config['navigation']['curriculum']['items']['gradebook']['link'] = '/gradebook';
$config['navigation']['curriculum']['items']['gradebook']['order'] = 4;
$config['navigation']['curriculum']['items']['gradebook']['credential'] =  Orm_User::check_credential(array(Orm_User::USER_FACULTY, Orm_User::USER_STAFF), false, 'curriculum_mapping-list') && Orm_User::check_credential(array(Orm_User::USER_FACULTY, Orm_User::USER_STAFF), false, 'gradebook-list');
