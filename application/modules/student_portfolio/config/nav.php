<?php defined('BASEPATH') OR exit('No direct script access allowed');

$config['navigation']['portfolios']['title'] = lang('Portfolios');
$config['navigation']['portfolios']['icon'] = 'fa fa-clone';
$config['navigation']['portfolios']['order'] = 5;

$config['navigation']['portfolios']['items']['student_portfolio']['title'] = lang('Student');
$config['navigation']['portfolios']['items']['student_portfolio']['link'] = '/student_portfolio';
$config['navigation']['portfolios']['items']['student_portfolio']['order'] = 2;
$config['navigation']['portfolios']['items']['student_portfolio']['credential'] = Orm_User::check_credential(array(Orm_User::USER_STUDENT), true) || Orm_User::check_credential(array(Orm_User::USER_FACULTY, Orm_User::USER_STAFF), false, 'student_portfolio-list');