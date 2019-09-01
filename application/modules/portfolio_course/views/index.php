<?php
/** @var courses Orm_Course[] */
?>
<div class="table-primary">
    <div class="table-header">
        <div class="table-caption m-b-1">
            <?php echo lang('Courses') ?>
            <span class="pull-right">
                <a class="btn btn-sm  lecture" href="/portfolio_course/pc_settings/?level=course_evaluation" >
                    <span class="btn-label-icon left"><i class="fa fa-gear"></i></span>
                    <?php echo lang('Settings') ?>
                </a>
            </span>
        </div>
        <?php if (!(Orm_User::has_role_teacher() && Orm_User::has_role_type(Orm_Role::ROLE_NOT_ADMIN))) { ?>
            <?php echo filter_block('/portfolio_course/filter', '/portfolio_course', [Orm_Campus::class, Orm_College::class, Orm_Department::class, Orm_Program::class, 'keyword']); ?>
        <?php } ?>
    </div>

    <div id="ajax_block">
        <?php $this->load->view('course_list'); ?>
    </div>
</div>

