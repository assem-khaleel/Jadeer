<?php
/**
 * Created by PhpStorm.
 * User: duaa
 * Date: 1/4/16
 * Time: 6:49 PM
 */
/** @var string $type */
$type = isset($type) ? $type : '';
?>
<ul class="nav nav-tabs nav-tabs-simple nav-sm page-block m-b-0">
    <?php if (Orm_User::check_credential(array(Orm_User::USER_FACULTY,Orm_User::USER_STAFF), true, 'advisory-list')):?>
    <li <?php echo($type == 'topic' ? 'class="active"' : ''); ?>>
        <a href="/advisory" class="p-y-1" title="<?php echo lang('Topics'); ?>">
            <?php echo lang('Topics'); ?>
        </a>
    </li>
    <?php endif ?>
<!--    if(Orm_User::get_logged_user()->get_class_type() == Orm_User_Faculty::class && $this->logged_user->has_role_type(Orm_Role::ROLE_PROGRAM_ADMIN)){-->
    <?php if (!Orm_User::get_logged_user()->has_role_type(Orm_Role::ROLE_NOT_ADMIN) && Orm_User::get_logged_user()->get_class_type() != Orm_User_Student::class):?>
        <li <?php echo($type == 'manage' ? 'class="active"' : ''); ?>>
            <a href="/advisory/manage" class="p-y-1" title="<?php echo lang('Manage'); ?>">
                <?php echo lang('Manage'); ?>
            </a>
        </li>
    <?php endif ?>

<!--    --><?php //if (Orm_User::check_credential(array(Orm_User::USER_FACULTY), true, 'advisory-list')):?>
<!--        <li --><?php //echo($type == 'manageFaculty' ? 'class="active"' : ''); ?><!-->
<!--            <a href="/advisory/manage_meeting" class="p-y-1" title="--><?php //echo lang('Manage'); ?><!--">-->
<!--                --><?php //echo lang('Manage'); ?>
<!--            </a>-->
<!--        </li>-->
<!--    --><?php //endif ?>
    <?php if (Orm_User::check_credential(array(Orm_User::USER_FACULTY, Orm_User::USER_STAFF,Orm_User::USER_STUDENT), true, 'advisory-list')):?>
        <?php if(Orm_Ad_Faculty_Program::map_survey()){ ?>
            <li <?php echo($type == 'survey' ? 'class="active"' : ''); ?>>
                <a href="/advisory/Ad_Survey" class="p-y-1" title="<?php echo lang('Survey'); ?>">
                    <?php echo lang('Survey'); ?>
                </a>
            </li>
        <?php } ?>

    <?php endif ?>
    <?php if (Orm_User::check_credential(array(Orm_User::USER_FACULTY, Orm_User::USER_STAFF), true, 'advisory-list')):?>
        <li <?php echo($type == 'report' ? 'class="active"' : ''); ?>>
            <a href="/advisory/report" class="p-y-1" title="<?php echo lang('Report'); ?>">
                <?php echo lang('Report'); ?>
            </a>
        </li>
    <?php endif ?>
    <?php if (Orm_User::check_credential(array(Orm_User::USER_FACULTY), true, 'advisory-list')):?>
        <li <?php echo($type == 'student' ? 'class="active"' : ''); ?>>
            <a href="/advisory/student" class="p-y-1" title="<?php echo lang('Student'); ?>">
                <?php echo lang('Student'); ?>
            </a>
        </li>
    <?php endif ?>
    <?php if (Orm_User::check_credential(array(Orm_User::USER_FACULTY, Orm_User::USER_STAFF), true, 'advisory-list') && License::get_instance()->check_module('meeting_minutes')):?>
        <li <?php echo($type == 'meeting' ? 'class="active"' : ''); ?>>
            <a href="/advisory/meeting" class="p-y-1" title="<?php echo lang('Meeting'); ?>">
                <?php echo lang('Meeting'); ?>
            </a>
        </li>
    <?php endif ?>
    <?php if (Orm_User::check_credential(array(Orm_User::USER_STUDENT), true, 'advisory-list')):?>
        <li <?php echo($type == 'summary' ? 'class="active"' : ''); ?>>
            <a href="/advisory/summary" class="p-y-1" title="<?php echo lang('summary'); ?>">
                <?php echo lang('Summary'); ?>
            </a>
        </li>
    <?php endif ?>
</ul>