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
            <a href="/report/program_report" class="p-y-1" title="<?php echo lang('Program Reports'); ?>">
                <?php echo lang('Program Reports'); ?>
            </a>
        </li>
    <?php } ?>
    <li <?php echo ($type == 'course' ? 'class="active"' : ''); ?>>
        <a href="/report/course_report" class="p-y-1" title="<?php echo lang('Course Reports'); ?>">
            <?php echo lang('Course Reports'); ?>
        </a>
    </li>

</ul>