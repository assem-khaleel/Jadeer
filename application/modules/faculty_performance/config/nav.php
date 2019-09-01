<?php
/**
 * Created by PhpStorm.
 * User: qanah
 * Date: 6/19/17
 * Time: 12:44 PM
 */

$config['navigation']['faculty_performance']['title'] = lang('Faculty Performance');
$config['navigation']['faculty_performance']['icon'] = 'fa fa-university';
$config['navigation']['faculty_performance']['order'] = 6;

$config['navigation']['faculty_performance']['items']['faculty_performance']['title'] = lang('Forms');
$config['navigation']['faculty_performance']['items']['faculty_performance']['link'] = '/faculty_performance';
$config['navigation']['faculty_performance']['items']['faculty_performance']['order'] = 1;
$config['navigation']['faculty_performance']['items']['faculty_performance']['credential'] = Orm_User::check_credential(array(Orm_User::USER_FACULTY,Orm_User::USER_STAFF), false, 'faculty_performance-forms');

$config['navigation']['faculty_performance']['items']['faculty_settings']['title'] = lang('Settings');
$config['navigation']['faculty_performance']['items']['faculty_settings']['link'] = '/faculty_performance/faculty_settings';
$config['navigation']['faculty_performance']['items']['faculty_settings']['order'] = 2;
$config['navigation']['faculty_performance']['items']['faculty_settings']['credential'] = Orm_User::check_credential(array(Orm_User::USER_STAFF,Orm_User::USER_FACULTY), false, 'faculty_performance-settings');

$config['navigation']['faculty_performance']['items']['faculty_report']['title'] = lang('Report');
$config['navigation']['faculty_performance']['items']['faculty_report']['link'] = '/faculty_performance/faculty_report';
$config['navigation']['faculty_performance']['items']['faculty_report']['order'] = 3;
$config['navigation']['faculty_performance']['items']['faculty_report']['credential'] = Orm_User::check_credential(array(Orm_User::USER_STAFF, Orm_User::USER_FACULTY), false, 'faculty_performance-report');