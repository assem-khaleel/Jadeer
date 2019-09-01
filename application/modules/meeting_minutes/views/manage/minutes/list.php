<?php
/** @var $meeting Orm_Mm_Meeting */
?>
<div class="row">
    <div class="col-lg-12 col-md-12">
        <div class="panel  panel-primary">
            <div class="panel-heading">
                <span class="panel-title"><?php echo lang('Meeting Minutes'); ?></span>
                <div class="panel-heading-controls">
                    <?php if(Orm_Mm_Meeting::check_if_can_generate_report() &&  $meeting->get_meeting_minutes_attachment()): ?>
                    <a href="<?php echo base_url($meeting->get_meeting_minutes_attachment()); ?>" class="btn btn-sm" >
                        <span class="btn-label-icon left fa fa-download"></span><?php echo lang('Download Attachment'); ?>
                    </a>
                    <?php endif; ?>

                    <?php if ($meeting->check_if_can_edit()) :?>
                    <a href="/meeting_minutes/minutes_edit/<?php echo intval($meeting->get_id()); ?>" data-toggle="ajaxModal" class="btn btn-sm" >
                        <span class="btn-label-icon left fa fa-edit"></span><?php echo $meeting->get_meeting_minutes() == '' ? lang('Add').' '.lang('Meeting Minutes') :lang('Edit').' '.lang('Meeting Minutes'); ?>
                    </a>
                    <?php endif; ?>
                </div>
            </div>
            <?php if($meeting->get_meeting_minutes()): ?>
            <div class="panel-body">
                <span><?php echo xssfilter($meeting->get_meeting_minutes()); ?></span>
            </div>
            <?php else: ?>
            <div class="alert alert-default m-b-0">
                <div class="m-b-1">
                    <?php echo  lang("There is no").' '.lang('Data to be displayed.')?>
                </div>
            </div>
            <?php endif; ?>
        </div>
    </div>
</div>