<?php defined('BASEPATH') OR exit('No direct script access allowed');

$config['navigation']['team_formation']['title'] = lang('Team Formation').'*';
$config['navigation']['team_formation']['icon'] = 'fa fa-comments';
$config['navigation']['team_formation']['order'] = 3;
$config['navigation']['team_formation']['link'] = '/team_formation';
$config['navigation']['team_formation']['credential'] = Orm_User::check_credential(array(Orm_User::USER_STAFF, Orm_User::USER_FACULTY),false,'team_formation-list')|| Orm_User::check_credential(array(Orm_User::USER_STUDENT),true);

