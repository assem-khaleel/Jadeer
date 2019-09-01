<?php
/**
 * Created by PhpStorm.
 * User: Abdelqader Osama
 * Date: 1/22/17
 * Time: 11:32 AM
 */

$settings_blocks = array(
    'License Info' => array(
        'visible' => Orm_User::check_credential([Orm_User_Staff::class, Orm_User_Faculty::class], false, 'settings-institution'),
        'icon' => 'info-circle',
        'name' => lang('License Info'),
        'url' => '/settings'
    ),
    'institution' => array(
        'visible' => Orm_User::check_credential([Orm_User_Staff::class, Orm_User_Faculty::class], false, 'settings-institution'),
        'icon' => 'university',
        'name' => lang('Institution'),
        'url' => '/settings/institution'
    ),
    'semester' => array(
        'visible' => Orm_User::check_credential([Orm_User_Staff::class, Orm_User_Faculty::class], false, 'settings-semester'),
        'icon' => 'calendar',
        'name' => lang('Semesters'),
        'url' => '/semester'
    ),
    'unit' => array(
        'visible' => Orm_User::check_credential([Orm_User_Staff::class, Orm_User_Faculty::class], false, 'settings-unit'),
        'icon' => 'university',
        'name' => lang('Units'),
        'url' => '/unit'
    ),
    'campus' => array(
        'visible' => Orm_User::check_credential([Orm_User_Staff::class, Orm_User_Faculty::class], false, 'settings-campus'),
        'icon' => 'building-o',
        'name' => lang('Campuses'),
        'url' => '/campus'
    ),
    'college' => array(
        'visible' => Orm_User::check_credential([Orm_User_Staff::class, Orm_User_Faculty::class], false, 'settings-college'),
        'icon' => 'suitcase',
        'name' => lang('Colleges'),
        'url' => '/college'
    ),
    'department' => array(
        'visible' => Orm_User::check_credential([Orm_User_Staff::class, Orm_User_Faculty::class], false, 'settings-department'),
        'icon' => 'table',
        'name' => lang('Departments'),
        'url' => '/department'
    ),
    'program' => array(
        'visible' => Orm_User::check_credential([Orm_User_Staff::class, Orm_User_Faculty::class], false, 'settings-program'),
        'icon' => 'gears',
        'name' => lang('Programs'),
        'url' => '/program'
    ),
    'degree' => array(
        'visible' => Orm_User::check_credential([Orm_User_Staff::class, Orm_User_Faculty::class], false, 'settings-degree'),
        'icon' => 'superscript',
        'name' => lang('Degrees'),
        'url' => '/degree'
    ),
    'major' => array(
        'visible' => Orm_User::check_credential([Orm_User_Staff::class, Orm_User_Faculty::class], false, 'settings-major'),
        'icon' => 'shield',
        'name' => lang('Majors') . ' (' . lang('Tracks') . ')',
        'url' => '/major'
    ),
    'course' => array(
        'visible' => Orm_User::check_credential([Orm_User_Staff::class, Orm_User_Faculty::class], false, 'settings-course'),
        'icon' => 'flask',
        'name' => lang('Courses'),
        'url' => '/course'
    ),
    'agencies' => array(
        'visible' => Orm_User::check_credential([Orm_User_Staff::class, Orm_User_Faculty::class], false, 'settings-accreditation_status'),
        'icon' => 'registered',
        'name' => lang('Agencies'),
        'url' => '/accreditation/status_settings/agencies'
    ),
    'standard' => array(
        'visible' => Orm_User::check_credential([Orm_User_Staff::class, Orm_User_Faculty::class], false, 'settings-standard'),
        'icon' => 'th-large',
        'name' => lang('Standards'),
        'url' => '/standard'
    ),
    'criteria' => array(
        'visible' => Orm_User::check_credential([Orm_User_Staff::class, Orm_User_Faculty::class], false, 'settings-criteria'),
        'icon' => 'tasks',
        'name' => lang('Criterias'),
        'url' => '/criteria'
    ),
    'item' => array(
        'visible' => Orm_User::check_credential([Orm_User_Staff::class, Orm_User_Faculty::class], false, 'settings-item'),
        'icon' => 'th-list',
        'name' => lang('Items'),
        'url' => '/item'
    ),
    'role' => array(
        'visible' => Orm_User::check_credential([Orm_User_Staff::class, Orm_User_Faculty::class], false, 'settings-role'),
        'icon' => 'key',
        'name' => lang('Roles'),
        'url' => '/role'
    ),
    'user' => array(
        'visible' => Orm_User::check_credential([Orm_User_Staff::class, Orm_User_Faculty::class], false, 'settings-user'),
        'icon' => 'user',
        'name' => lang('Users'),
        'url' => '/user'
    ),
    'student_status' => array(
        'visible' => Orm_User::check_credential([Orm_User_Staff::class, Orm_User_Faculty::class], false, 'settings-user'),
        'icon' => 'user',
        'name' => lang('Student Statuses'),
        'url' => '/student_status'
    ),
    'scripts' => array(
        'visible' => true,
        'icon' => 'database',
        'name' => lang('Scheduled Tasks'),
        'url' => '/settings/jobs'
    ),
    'notification' => array(
        'visible' => Orm_User::check_credential([Orm_User_Staff::class, Orm_User_Faculty::class], false, 'settings-notification'),
        'icon' => 'bullhorn',
        'name' => lang('Notifications'),
        'url' => '/notification'
    ),
    'language' => array(
        'visible' => Orm_User::check_credential([Orm_User_Staff::class, Orm_User_Faculty::class], false, 'settings-translation'),
        'icon' => 'language',
        'name' => lang('Translations'),
        'url' => '/language'
    ),

);
?>

<div class="col-md-3 col-lg-2">
    <ul class="nav nav-sm nav-pills nav-stacked m-b-3">
        <?php foreach ($settings_blocks as $name => $block) { ?>
            <?php if ($block['visible']) { ?>
                <?php $active = (isset($sub_tab) && $sub_tab == $name ? ' active' : ''); ?>
                <li class="b-a-1 border-default <?php echo $active ?>">
                    <a href="<?php echo $block['url'] ?>" title="<?php echo $block['name'] ?>">
                        <i class="fa fa-<?php echo $block['icon'] ?>"></i> <?php echo $block['name'] ?>
                    </a>
                </li>
            <?php } ?>
        <?php } ?>
    </ul>
</div>