<?php
/** @var $meeting Orm_Mm_Meeting */
?>
<div class="row">
    <div class="col-lg-12 col-md-12">
        <div class="panel  panel-primary">
            <div class="panel-heading">
                <span class="panel-title"><?php echo lang('Objectives'); ?></span>
                <?php if ($meeting->check_if_can_edit()) :?>
                <div class="panel-heading-controls">
                    <a href="/meeting_minutes/objective_edit/<?php echo intval($meeting->get_id()); ?>" data-toggle="ajaxModal" class="btn btn-sm" >
                        <span class="btn-label-icon left fa fa-edit"></span><?php echo  $meeting->get_objective() == '' ? lang('Add').' '.lang('Objectives') :lang('Edit').' '.lang('Objectives'); ?>
                    </a>
                </div>
                <?php endif; ?>
            </div>
            <?php if($meeting->get_objective()): ?>
            <div class="panel-body">
                <span><?php echo xssfilter($meeting->get_objective()); ?></span>
            </div>
            <?php else: ?>
            <div class="alert alert-default m-b-0">
                <div class="m-b-1">
                    <?php echo  lang("There is no").' '.lang('Objective to be displayed.')?>
                </div>
            </div>
            <?php endif; ?>
        </div>
    </div>
</div>