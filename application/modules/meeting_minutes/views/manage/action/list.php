<?php
/** @var $meeting_id int */
/** @var $actions Orm_Mm_Action[] */
/** @var $meeting Orm_Mm_Meeting */
?>
<div class="table-primary table-responsive">
    <div class="table-header">
        <div class="table-caption m-b-1">
            <?php echo lang('Action') ?>

            <div class="panel-heading-controls">
                <?php if(Orm_Mm_Meeting::check_if_can_generate_report() && $meeting->get_action_attachment()): ?>
                    <a href="<?php echo base_url($meeting->get_action_attachment()); ?>" class="btn btn-sm">
                        <span class="btn-label-icon left fa fa-download"></span><?php echo lang('Download Attachment'); ?>
                    </a>
                <?php endif; ?>

                <?php if ($meeting->check_if_can_edit()) :?>
                <a href="/meeting_minutes/action_attachment/<?php echo intval($meeting->get_id()); ?>" data-toggle="ajaxModal" class="btn btn-sm" >
                    <span class="btn-label-icon left fa fa-upload"></span><?php echo lang('Upload Attachment'); ?>
                </a>

                <a href="/meeting_minutes/action_add_edit/<?php echo intval($meeting->get_id()); ?>" data-toggle="ajaxModal" class="btn btn-sm" >
                    <span class="btn-label-icon left fa fa-edit"></span><?php echo lang('Add').' '.lang('Action'); ?>
                </a>
                <?php endif; ?>
            </div>
        </div>
    </div>
    <?php if (empty($actions)) { ?>
        <div class="alert alert-default">
            <div class="m-b-1">
                <?php echo  lang("There is no").' '.lang('Data to be displayed.')?>
            </div>
        <?php if (Orm_Mm_Meeting::check_if_can_add()) :?>
            <a href="/meeting_minutes/action_add_edit/<?php echo (int) $meeting->get_id() ?>" data-toggle="ajaxModal" class="btn  btn-block" >
                <span class="btn-label-icon left fa fa-plus"></span><?php echo lang('Add').' '.lang('Action'); ?>
            </a>
        <?php endif; ?>
        </div>
    <?php } else { ?>
        <table class="table table-bordered">
            <thead>
            <tr>
                <th class="col-lg-3"><?php echo lang('Owner Name'); ?></th>
                <th class="col-lg-5"><?php echo lang('Action'); ?></th>
                <th class="col-lg-2"><?php echo lang('Due Date'); ?></th>
                <th class="col-lg-2 text-center"><?php echo lang('Actions'); ?></th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($actions as $action) { ?>
                <tr>
                    <td>
                        <span><?php echo htmlfilter(Orm_User::get_instance($action->get_owner_name())->get_full_name()); ?></span>
                    </td>
                    <td>
                        <span><?php echo xssfilter($action->get_action()); ?></span>
                    </td>
                    <td>
                        <span><?php echo htmlfilter($action->get_due()); ?></span>
                    </td>
                    <td class="td last_column_border text-center">
                        <?php if($meeting->check_if_can_edit()) : ?>
                        <a class="btn btn-block" data-toggle="ajaxModal" href="/meeting_minutes/action_add_edit/<?php echo (int) $meeting->get_id().'/'.(int) $action->get_id(); ?>"><span class="btn-label-icon left fa fa-edit"></span> <?php echo lang('Edit'); ?></a>
                        <?php endif ?>
                        <?php if($meeting->check_if_can_delete()) : ?>
                            <a class="btn btn-block"  message="<?php echo lang('Are you sure ?') ?>" data-toggle="deleteAction"
                               href="/meeting_minutes/action_delete/<?php echo (int)$action->get_id(); ?>"><span
                                    class="btn-label-icon left fa fa-remove"></span> <?php echo lang('Delete'); ?></a>
                        <?php endif ?>
                    </td>
                </tr>
            <?php } ?>
            </tbody>
        </table>
        <?php echo $pager ?>
    <?php } ?>
</div>