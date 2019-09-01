<?php
/** @var Orm_Fp_Forms_Type $type */
?>


<ul class="nav nav-tabs nav-tabs-simple nav-sm page-block m-b-0">
    <?php if (Orm_User::get_logged_user()->has_role_type(Orm_Role::ROLE_NOT_ADMIN)) { ?>
        <li <?php if ($type_id == 0): ?>class="active"<?php endif; ?>>
            <a class="p-y-1" href="/faculty_performance/faculty_report?type_id=0"
               title=""><?php echo lang('General Report'); ?></a>
        </li>
    <?php } else { ?>
        <li <?php if ($type_id == 0): ?>class="active"<?php endif; ?>>
            <a class="p-y-1" href="/faculty_performance/faculty_report?type_id=0"
               title=""><?php echo lang('Faculty Report'); ?></a>
        </li>
        <li <?php if ($type_id == 6): ?>class="active"<?php endif; ?>>
            <a class="p-y-1" href="/faculty_performance/faculty_report?type_id=6"
               title=""><?php echo lang("Faculty Didn't Submit Form"); ?></a>
        </li>
        <li <?php if ($type_id == 4): ?>class="active"<?php endif; ?>>
            <a class="p-y-1" href="/faculty_performance/faculty_report/program_report"
               title=""><?php echo lang('Program Report'); ?></a>
        </li>
        <?php if (!Orm_User::get_logged_user()->has_role_type(Orm_Role::ROLE_PROGRAM_ADMIN)) { ?>
            <li <?php if ($type_id == 1): ?>class="active"<?php endif; ?>>
                <a class="p-y-1" href="/faculty_performance/faculty_report/department_report"
                   title=""><?php echo lang('Department Report'); ?></a>
            </li>
            <li <?php if ($type_id == 2): ?>class="active"<?php endif; ?>>
                <a class="p-y-1" href="/faculty_performance/faculty_report/college_report"
                   title=""><?php echo lang('College Report'); ?></a>
            </li>
            <?php if (Orm_User::get_logged_user()->has_role_type(Orm_Role::ROLE_INSTITUTION_ADMIN)) { ?>
                <li <?php if ($type_id == 3): ?>class="active"<?php endif; ?>>
                    <a class="p-y-1" href="/faculty_performance/faculty_report?type_id=3"
                       title=""><?php echo lang('University Report'); ?></a>
                </li>
            <?php } ?>

        <?php } ?>
    <?php } ?>
</ul>


