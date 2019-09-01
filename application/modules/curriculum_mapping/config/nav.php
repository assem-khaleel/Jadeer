<?php defined('BASEPATH') OR exit('No direct script access allowed');

$config['navigation']['curriculum']['title'] = lang('Curriculum');
$config['navigation']['curriculum']['icon'] = 'fa fa-book';
$config['navigation']['curriculum']['order'] = 1;

$config['navigation']['curriculum']['items']['curriculum_mapping']['title'] = lang('Curriculum Mapping');
$config['navigation']['curriculum']['items']['curriculum_mapping']['link'] = '/curriculum_mapping';
$config['navigation']['curriculum']['items']['curriculum_mapping']['order'] = 1;
$config['navigation']['curriculum']['items']['curriculum_mapping']['credential'] = Orm_User::check_credential(array(Orm_User::USER_FACULTY, Orm_User::USER_STAFF), false, 'curriculum_mapping-list');