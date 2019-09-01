<?php defined('BASEPATH') OR exit('No direct script access allowed');

$config['navigation']['portfolios']['title'] = lang('Portfolios');
$config['navigation']['portfolios']['icon'] = 'fa fa-clone';
$config['navigation']['portfolios']['order'] = 5;

$config['navigation']['portfolios']['items']['faculty_portfolio']['title'] = lang('Faculty');
$config['navigation']['portfolios']['items']['faculty_portfolio']['link'] = '/faculty_portfolio';
$config['navigation']['portfolios']['items']['faculty_portfolio']['order'] = 1;
$config['navigation']['portfolios']['items']['faculty_portfolio']['credential'] = Orm_User::check_credential(array(Orm_User::USER_STUDENT), true) || Orm_User::check_credential(array(Orm_User::USER_FACULTY, Orm_User::USER_STAFF), false, 'faculty_portfolio-list');