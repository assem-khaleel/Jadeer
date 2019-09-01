<?php defined('BASEPATH') OR exit('No direct script access allowed');
if (License::get_instance()->check_module('rubrics')) {
    $config['navigation']['quality']['title'] = lang('Quality');
    $config['navigation']['quality']['icon'] = 'fa fa-quora';
    $config['navigation']['quality']['order'] = 3;

    $config['navigation']['quality']['items']['industrial_skills']['title'] = lang('Industrial Skills') . '*';
    $config['navigation']['quality']['items']['industrial_skills']['link'] = '/industrial_skills';
    $config['navigation']['quality']['items']['industrial_skills']['order'] = 4;
    $config['navigation']['quality']['items']['industrial_skills']['credential'] = Orm_User::check_credential(array(Orm_User::USER_FACULTY, Orm_User::USER_STAFF), false, 'industrial_skills-list') || Orm_User::check_credential(array(Orm_User::USER_STUDENT), true);
}