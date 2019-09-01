<?php defined('BASEPATH') OR exit('No direct script access allowed');

$config['navigation']['accreditation']['title'] = lang('Accreditation');
$config['navigation']['accreditation']['icon'] = 'fa fa-sitemap';
$config['navigation']['accreditation']['order'] = 2;

$config['navigation']['accreditation']['items']['national']['title'] = lang('National');
$config['navigation']['accreditation']['items']['national']['link'] = '/accreditation/national';
$config['navigation']['accreditation']['items']['national']['order'] = 1;
$config['navigation']['accreditation']['items']['national']['credential'] = Orm_User::check_credential(array(Orm_User::USER_FACULTY, Orm_User::USER_STAFF), false, 'accreditation-list');

$config['navigation']['accreditation']['items']['international']['title'] = lang('International');
$config['navigation']['accreditation']['items']['international']['link'] = '/accreditation/international';
$config['navigation']['accreditation']['items']['international']['order'] = 2;
$config['navigation']['accreditation']['items']['international']['credential'] = Orm_User::check_credential(array(Orm_User::USER_FACULTY, Orm_User::USER_STAFF), false, 'accreditation-list');

$config['navigation']['accreditation']['items']['reviewer']['title'] = lang('Reviewer');
$config['navigation']['accreditation']['items']['reviewer']['link'] = '/accreditation/reviewer';
$config['navigation']['accreditation']['items']['reviewer']['order'] = 3;
$config['navigation']['accreditation']['items']['reviewer']['credential'] = Orm_User::check_credential_or(array(Orm_User::USER_STAFF, Orm_User::USER_FACULTY), false, ['accreditation-list', 'accreditation-read']);

//Dashboard
$config['navigation']['dashboard']['title'] = lang('Dashboards');
$config['navigation']['dashboard']['icon'] = 'ion-ios-pulse-strong';
$config['navigation']['dashboard']['order'] = 0;

$config['navigation']['dashboard']['items']['dashboard_national']['title'] = lang('National Accreditation');
$config['navigation']['dashboard']['items']['dashboard_national']['link'] = '/dashboard/national';
$config['navigation']['dashboard']['items']['dashboard_national']['order'] = 4;
$config['navigation']['dashboard']['items']['dashboard_national']['credential'] = Orm_User::check_credential(array(Orm_User::USER_FACULTY, Orm_User::USER_STAFF), false, 'dashboard-national_accreditation');

$config['navigation']['dashboard']['items']['dashboard_international']['title'] = lang('International Accreditation');
$config['navigation']['dashboard']['items']['dashboard_international']['link'] = '/dashboard/international';
$config['navigation']['dashboard']['items']['dashboard_international']['order'] = 5;
$config['navigation']['dashboard']['items']['dashboard_international']['credential'] = Orm_User::check_credential(array(Orm_User::USER_FACULTY, Orm_User::USER_STAFF), false, 'dashboard-international_accreditation');

$config['navigation']['dashboard']['items']['dashboard_status']['title'] = lang('Accreditation Status');
$config['navigation']['dashboard']['items']['dashboard_status']['link'] = '/dashboard/status';
$config['navigation']['dashboard']['items']['dashboard_status']['order'] = 6;
$config['navigation']['dashboard']['items']['dashboard_status']['credential'] = Orm_User::check_credential(array(Orm_User::USER_FACULTY, Orm_User::USER_STAFF), false, 'dashboard-status');