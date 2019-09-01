<?php defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Created by PhpStorm.
 * User: qanah
 * Date: 6/6/17
 * Time: 4:43 PM
 *
 * navigation item : link, title, credential
 */
// Dashboards Block
$config['navigation']['dashboard']['title'] = lang('Dashboards');
$config['navigation']['dashboard']['icon'] = 'ion-ios-pulse-strong';
$config['navigation']['dashboard']['order'] = '0';

$config['navigation']['dashboard']['items']['dashboard_personal']['title'] = lang('Personal');
$config['navigation']['dashboard']['items']['dashboard_personal']['link'] = '/dashboard/personal';
$config['navigation']['dashboard']['items']['dashboard_personal']['order'] = 1;
$config['navigation']['dashboard']['items']['dashboard_personal']['credential'] = true;

$config['navigation']['dashboard']['items']['dashboard_orgchart']['title'] = lang('Organization Chart');
$config['navigation']['dashboard']['items']['dashboard_orgchart']['link'] = '/dashboard/org_chart';
$config['navigation']['dashboard']['items']['dashboard_orgchart']['order'] = 2;
$config['navigation']['dashboard']['items']['dashboard_orgchart']['credential'] = true;

$config['navigation']['dashboard']['items']['dashboard_setup']['title'] = lang('General Info');
$config['navigation']['dashboard']['items']['dashboard_setup']['link'] = '/setup';
$config['navigation']['dashboard']['items']['dashboard_setup']['order'] = 3;
$config['navigation']['dashboard']['items']['dashboard_setup']['credential'] = true;

// Accreditation Block
$config['navigation']['accreditation']['title'] = lang('Accreditation');
$config['navigation']['accreditation']['icon'] = 'fa fa-sitemap';
$config['navigation']['accreditation']['order'] = 2;

$config['navigation']['accreditation']['items']['doc_repo']['title'] = lang('File Repository');
$config['navigation']['accreditation']['items']['doc_repo']['link'] = '/doc_repo/file_manager';
$config['navigation']['accreditation']['items']['doc_repo']['order'] = 7;
$config['navigation']['accreditation']['items']['doc_repo']['credential'] = Orm_User::check_credential_or(array(Orm_User::USER_FACULTY, Orm_User::USER_STAFF), false, ['doc_repo-manage', 'doc_repo-list', 'accreditation-list']);

//Manual & Settings Blocks
$config['navigation']['settings']['title'] = lang('Settings');
$config['navigation']['settings']['icon'] = 'fa fa-cogs';
$config['navigation']['settings']['link'] = '/settings';
$config['navigation']['settings']['order'] = 7;
$config['navigation']['settings']['credential'] = Orm_User::check_credential(array(Orm_User::USER_FACULTY, Orm_User::USER_STAFF), false, 'settings-manage');

$config['navigation']['manual']['title'] = lang('Manual');
$config['navigation']['manual']['icon'] = 'fa fa-medkit';
$config['navigation']['manual']['link'] = '/Manual';
$config['navigation']['manual']['order'] = 8;
$config['navigation']['manual']['extra_class'] = 'bg-success text-white';
$config['navigation']['manual']['credential'] = true;

foreach (scandir(APPPATH . 'modules') as $module) {

    $navigation_file = APPPATH . "modules/{$module}/config/nav.php";

    if(file_exists($navigation_file) && License::get_instance()->check_module($module)) {
        include_once $navigation_file;
    }
}