<?php defined('BASEPATH') OR exit('No direct script access allowed');

$config['navigation']['accreditation']['title'] = lang('Accreditation');
$config['navigation']['accreditation']['icon'] = 'fa fa-sitemap';
$config['navigation']['accreditation']['order'] = 2;

$config['navigation']['accreditation']['items']['kpi']['title'] = lang('KPIs');
$config['navigation']['accreditation']['items']['kpi']['link'] = '/kpi';
$config['navigation']['accreditation']['items']['kpi']['order'] = 6;
$config['navigation']['accreditation']['items']['kpi']['credential'] = Orm_User::check_credential(array(Orm_User::USER_FACULTY, Orm_User::USER_STAFF), false, 'kpi-list');

//Dashboard
$config['navigation']['dashboard']['title'] = lang('Dashboards');
$config['navigation']['dashboard']['icon'] = 'ion-ios-pulse-strong';
$config['navigation']['dashboard']['order'] = 0;

$config['navigation']['dashboard']['items']['dashboard_kpi']['title'] = lang('KPIs');
$config['navigation']['dashboard']['items']['dashboard_kpi']['link'] = '/dashboard/kpi';
$config['navigation']['dashboard']['items']['dashboard_kpi']['order'] = 7;
$config['navigation']['dashboard']['items']['dashboard_kpi']['credential'] = Orm_User::check_credential(array(Orm_User::USER_FACULTY, Orm_User::USER_STAFF), false, 'dashboard-kpi');