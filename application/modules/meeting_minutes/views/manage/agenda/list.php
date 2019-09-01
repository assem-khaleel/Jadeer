<?php
/** @var $meeting_id int */
/** @var $agendas Orm_Mm_Agenda[] */
/** @var $meeting Orm_Mm_Meeting */

$attendance_ids=[];

foreach($meeting->get_attendances() as $attendance){
    $attendance_ids[] = $attendance->get_id();
}
?>
<div class="alert">
    <strong><?php echo lang('Note') ?>:</strong> <?php echo lang('Agenda topics that do not show a corresponding "Edit" button have had their owner deleted from the attendance.') ?>
</div>

<div class="table-primary table-responsive">
    <div class="table-header">
        <div class="table-caption m-b-1">
            <?php echo lang('Agenda') ?>

            <div class="panel-heading-controls">
                <?php if(Orm_Mm_Meeting::check_if_can_generate_report() && $meeting->get_agenda_attachment()): ?>
                    <a href="<?php echo base_url($meeting->get_agenda_attachment()); ?>" class="btn btn-sm">
                        <span class="btn-label-icon left fa fa-download"></span><?php echo lang('Download Attachment'); ?>
                    </a>
                <?php endif; ?>

                <?php if ($meeting->check_if_can_edit()) :?>
                <a href="/meeting_minutes/agenda_attachment/<?php echo intval($meeting->get_id()); ?>" data-toggle="ajaxModal" class="btn btn-sm" >
                    <span class="btn-label-icon left fa fa-upload"></span><?php echo lang('Upload Attachment'); ?>
                </a>

                <a href="/meeting_minutes/agenda_add_edit/<?php echo intval($meeting->get_id()); ?>" data-toggle="ajaxModal" class="btn btn-sm" >
                    <span class="btn-label-icon left fa fa-edit"></span><?php echo lang('Add').' '.lang('Topic'); ?>
                </a>
                <?php endif; ?>
            </div>
        </div>
    </div>
    <?php if (empty($agendas)) { ?>
        <div class="alert alert-default">
            <div class="m-b-1">
                <?php echo  lang("There is no").' '.lang('Data to be displayed.')?>
            </div>
        <?php if (Orm_Mm_Meeting::check_if_can_add()) :?>
            <a href="/meeting_minutes/agenda_add_edit/<?php echo (int) $meeting->get_id() ?>" data-toggle="ajaxModal" class="btn  btn-block" >
                <span class="btn-label-icon left fa fa-plus"></span><?php echo lang('Add').' '.lang('Topic'); ?>
            </a>
        <?php endif; ?>
        </div>
    <?php } else { ?>
        <table class="table table-bordered">
            <thead>
            <tr>
                <th class="col-lg-5"><?php echo lang('Topic'); ?></th>
                <th class="col-lg-5"><?php echo lang('Owner'); ?></th>
                <th class="col-lg-2 text-center"><?php echo lang('Actions'); ?></th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($agendas as $agenda) { ?>
                <tr>
                    <td>
                        <span><?php echo htmlfilter($agenda->get_topic()); ?></span>
                    </td>
                    <td>
                        <span><?php echo htmlfilter($agenda->get_user_id(true)->get_full_name()); ?></span>
                    </td>
                    <td class="td last_column_border text-center">
                        <?php if($meeting->check_if_can_edit()) : ?>
                        <?php if(in_array($agenda->get_user_id(), $attendance_ids)): ?>
                        <a class="btn btn-block" data-toggle="ajaxModal" href="/meeting_minutes/agenda_add_edit/<?php echo (int) $meeting->get_id().'/'.(int) $agenda->get_id(); ?>"><span class="btn-label-icon left fa fa-edit"></span> <?php echo lang('Edit'); ?></a>
                        <?php endif; ?>
                        <?php endif; ?>
                        <?php if($meeting->check_if_can_delete()) : ?>
                        <a class="btn btn-block"  message="<?php echo lang('Are you sure ?') ?>" data-toggle="deleteAction" href="/meeting_minutes/agenda_delete/<?php echo (int) $agenda->get_id(); ?>"><span class="btn-label-icon left fa fa-remove"></span> <?php echo lang('Delete'); ?></a>
                        <?php endif ?>
                    </td>
                </tr>
            <?php } ?>
            </tbody>
        </table>
        <?php echo $pager ?>
    <?php } ?>
</div>