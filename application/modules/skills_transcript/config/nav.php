<?php defined('BASEPATH') OR exit('No direct script access allowed');
if (License::get_instance()->check_module('rubrics')) {

    $config['navigation']['skills_transcript']['title'] = lang('Skills Transcript') . '*';
    $config['navigation']['skills_transcript']['icon'] = 'fa fa-leaf';
    $config['navigation']['skills_transcript']['link'] = '/skills_transcript';
    $config['navigation']['skills_transcript']['order'] = 5;
    $config['navigation']['skills_transcript']['credential'] = Orm_User::check_credential(array(Orm_User::USER_STAFF,Orm_User::USER_FACULTY), false, 'skills_transcript-list') || Orm_User::check_credential(array(Orm_User::USER_STUDENT), true);
}