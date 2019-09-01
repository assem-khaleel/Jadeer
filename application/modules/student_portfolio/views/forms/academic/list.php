<?php
/** @var int $user_id */
?>
<div class="box p-a-1 clearfix">
    <div class="pull-left">
        <b><?php echo lang('Links'); ?></b>
    </div>
    <?php if($user_id == Orm_User::get_logged_user_id()) { ?>
        <div class="pull-right">
            <a href="/student_portfolio/academic_manage" data-toggle="ajaxModal" class="btn btn-sm "><i class="btn-label-icon left fa fa-edit"></i><?php echo lang('Manage')?></a>
        </div>
    <?php } ?>
</div>

<ul class="list-group ">
    <li class="list-group-item">
        <label class="control-label"><?php echo lang('Academic Advising'); ?>: </label>
        <?php echo xssfilter($student_academic->get_student_academic_advicing())?: '-'; ?>
    </li>
</ul>

