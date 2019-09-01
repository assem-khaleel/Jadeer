<?php defined('BASEPATH') OR exit('No direct script access allowed');

$config['navigation']['portfolios']['title'] = lang('Portfolios');
$config['navigation']['portfolios']['icon'] = 'fa fa-clone';
$config['navigation']['portfolios']['order'] = 5;

$config['navigation']['portfolios']['items']['portfolio_course']['title'] = lang('Course');
$config['navigation']['portfolios']['items']['portfolio_course']['link'] = '/portfolio_course';
$config['navigation']['portfolios']['items']['portfolio_course']['order'] = 3;
$config['navigation']['portfolios']['items']['portfolio_course']['credential'] = Orm_User::check_credential(array(Orm_User::USER_STUDENT), true) || Orm_User::check_credential(array(Orm_User::USER_FACULTY, Orm_User::USER_STAFF), false, 'portfolio_course-list');