<?php
/** @var $meeting_id int */
/** @var $attendances Orm_Mm_Attendance [] */
/** @var $meeting Orm_Mm_Meeting */
?>
<div class="table-primary table-responsive">
    <div class="table-header">
        <div class="table-caption m-b-1">
            <?php echo lang('Attendance') ?>
            <?php if(Orm_Mm_Meeting::check_if_can_add()) : ?>
            <div class="panel-heading-controls">
                <a href="/meeting_minutes/attendance_add/<?php echo intval($meeting->get_id()); ?>" data-toggle="ajaxModal" class="btn btn-sm" >
                    <span class="btn-label-icon left fa fa-edit"></span><?php echo lang('Add').' '.lang('New Member'); ?>
                </a>
            </div>
            <?php endif;?>
        </div>
    </div>
    <?php if (empty($attendances)) { ?>
        <div class="alert alert-default">
            <div class="m-b-1">
                <?php echo  lang("There is no").' '.lang('Data to be displayed.')?>
            </div>
        <?php if (Orm_Mm_Meeting::check_if_can_add()) :?>
            <a href="/meeting_minutes/attendance_add/<?php echo (int) $meeting->get_id() ?>" data-toggle="ajaxModal" class="btn  btn-block" >
                <span class="btn-label-icon left fa fa-plus"></span><?php echo lang('Add').' '.lang('New Member'); ?>
            </a>
            <?php endif;?>
        </div>
    <?php } else { ?>
        <table class="table table-bordered">
            <thead>
            <tr>
                <th class="col-lg-5"><?php echo lang('Name'); ?></th>
                <th class="col-lg-5"><?php echo lang('Attendance'); ?></th>
                <th class="col-lg-2 text-center"><?php echo lang('Actions'); ?></th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($attendances as $attendance) { ?>
                <tr>
                    <td>
                        <span><?php echo $attendance->get_user_id() ? htmlfilter($attendance->get_user_id(true)->get_full_name()) : htmlfilter($attendance->get_external_user_name()); ?></span>
                    </td>
                    <td>
                        <span><?php echo htmlfilter($attendance->get_attended(true)) ?></span>
                    </td>
                    <td class="td last_column_border text-center">
                        <?php if($meeting->check_if_can_edit()) : ?>
                        <a class="btn btn-block" data-toggle="ajaxModal" href="/meeting_minutes/attendance_edit/<?php echo (int) $attendance->get_id(); ?>"><span class="btn-label-icon left fa fa-edit"></span> <?php echo lang('Edit'); ?></a>
                        <?php endif ?>
                        <?php if($meeting->check_if_can_delete()) : ?>
                        <a class="btn btn-block"  message="<?php echo lang('Are you sure ?') ?>" data-toggle="deleteAction" href="/meeting_minutes/attendance_delete/<?php echo (int) $attendance->get_id(); ?>"><span class="btn-label-icon left fa fa-remove"></span> <?php echo lang('Delete'); ?></a>
                        <?php endif ?>
                    </td>
                </tr>
            <?php } ?>
            </tbody>
        </table>
        <?php echo $pager ?>
    <?php } ?>
</div>