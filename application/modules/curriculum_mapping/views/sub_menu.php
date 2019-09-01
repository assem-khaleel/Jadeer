<?php
/**
 * Created by PhpStorm.
 * User: mazen
 * Date: 1/4/16
 * Time: 6:49 PM
 */
/** @var string $type */
$type = isset($type) ? $type : '';
?>
<ul class="nav nav-tabs nav-tabs-simple nav-sm page-block m-b-0">
    <?php if (!Orm_User::has_role_type(Orm_Role::ROLE_NOT_ADMIN)) { ?>
        <li <?php echo ($type == 'program' ? 'class="active"' : ''); ?>>
            <a href="/curriculum_mapping/program" class="p-y-1" title="<?php echo lang('Program Management'); ?>">
                <?php echo lang('Program Management'); ?>
            </a>
        </li>
    <?php } ?>
    <li <?php echo ($type == 'course' ? 'class="active"' : ''); ?>>
        <a href="/curriculum_mapping/course" class="p-y-1" title="<?php echo lang('Course Management'); ?>">
            <?php echo lang('Course Management'); ?>
        </a>
    </li>
    <li <?php echo ($type == 'reporting' ? 'class="active"' : ''); ?>>
        <a href="/curriculum_mapping/reporting" class="p-y-1" title="<?php echo lang('Reporting'); ?>">
            <?php echo lang('Reporting'); ?>
        </a>
    </li>
    <?php if (Orm_User::check_credential(array(Orm_User::USER_FACULTY,Orm_User::USER_STAFF),false,'curriculum_mapping-settings')) { ?>
        <li <?php echo ($type == 'settings' ? 'class="active"' : ''); ?>>
            <a href="/curriculum_mapping/settings" class="p-y-1" title="<?php echo lang('Settings'); ?>">
                <?php echo lang('Settings'); ?>
            </a>
        </li>
    <?php } ?>
</ul>