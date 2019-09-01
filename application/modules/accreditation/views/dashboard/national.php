<?php
/** @var Orm_User_Faculty|Orm_User_Staff $user */
$user = Orm_User::get_logged_user();

$view_params = $this->_ci_cached_vars;

switch ($user->get_institution_role()) {

    case Orm_Role::ROLE_INSTITUTION_ADMIN:
        ?>
        <div id="university_container">
            <?php $this->load->view('/dashboard/national/university'); ?>
        </div>
        <?php
        break;

    case Orm_Role::ROLE_COLLEGE_ADMIN:
        $view_params['college_id'] = (int) $user->get_college_id();
        ?>
        <div id="colleges_container">
            <?php $this->load->view('/dashboard/national/colleges', $view_params); ?>
        </div>
        <?php
        break;

    case Orm_Role::ROLE_PROGRAM_ADMIN:
        $view_params['program_id'] = (int) $user->get_program_id();
        $view_params['college_id'] = (int) $user->get_college_id();
        ?>
        <div id="programs_container">
            <?php $this->load->view('/dashboard/national/programs', $view_params); ?>
        </div>
        <?php
        break;

    default :
        $view_params['program_id'] = (int) $user->get_program_id();
        $view_params['college_id'] = (int) $user->get_college_id();
        $view_params['teacher_id'] = (int) $user->get_id();
        ?>
        <div id="sections_container">
            <?php $this->load->view('/dashboard/national/sections', $view_params); ?>
        </div>
        <?php
        break;
}
?>