<?php
/** @var $meeting Orm_Mm_Meeting */
?>
<h2 class="m-t-1"><?php echo lang('Attendance at Meeting') ?></h2>

<table class="table table-bordered">
    <thead>
    <tr>
        <th class="col-sm-10"><?php echo lang('Name'); ?></th>
        <th class="col-sm-2 text-center"><?php echo lang('Attendance'); ?></th>
    </tr>
    </thead>
    <tbody>
    <?php foreach ($meeting->get_attendances() as $attendance) { ?>
        <tr>
            <td>
                <span><?php echo $attendance->get_user_id()? htmlfilter($attendance->get_user_id(true)->get_full_name()) :  htmlfilter($attendance->get_external_user_name()); ?></span>
            </td>
            <td>
                <span class="text-center"><?php echo $attendance->get_attended()? lang('Attended'): lang('Absent'); ?></span>
            </td>
        </tr>
    <?php } ?>
    </tbody>
</table>

<hr/>

<h2 class="m-t-1"><?php echo lang('Agenda') ?></h2>

<table class="table table-bordered">
    <thead>
    <tr>
        <th class="col-sm-7"><?php echo lang('Topic'); ?></th>
        <th class="col-sm-4"><?php echo lang('Owner'); ?></th>
    </tr>
    </thead>
    <tbody>
    <?php foreach ($meeting->get_agenda() as $agenda) { ?>
        <tr>
            <td>
                <span><?php echo htmlfilter($agenda->get_topic()); ?></span>
            </td>
            <td>
                <span><?php echo htmlfilter($agenda->get_user_id(true)->get_full_name()); ?></span>
            </td>
        </tr>
    <?php } ?>
    </tbody>
</table>