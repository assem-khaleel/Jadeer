<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Created by PhpStorm.
 * User: Abdelqader Osama
 * Date: 10/3/17
 * Time: 11:23 AM
 */

$config['navigation']['quality']['title'] = lang('Quality');
$config['navigation']['quality']['icon']  = 'fa fa-quora';
$config['navigation']['quality']['order'] = 3;

$config['navigation']['quality']['items']['assessment_metric']['title'] = lang('Assessment Metric').'*';
$config['navigation']['quality']['items']['assessment_metric']['link']  = '/assessment_metric';
$config['navigation']['quality']['items']['assessment_metric']['order'] = 3;
$config['navigation']['quality']['items']['assessment_metric']['credential'] = Orm_User::check_credential(array(Orm_User::USER_FACULTY, Orm_User::USER_STAFF), false, 'assessment_metric-list');
