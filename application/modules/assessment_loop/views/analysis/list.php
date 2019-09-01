<?php
/** @var $analysis Orm_Al_Analysis[] */
?>
<div class="row">
    <div class="col-lg-12 col-md-12">
        <?php if ($analysis->get_id()) { ?>

            <div class="panel  panel-primary">
                <div class="panel-heading">
                    <span class="panel-title"><?php echo lang('Analysis'); ?></span>
                    <?php if ($assessment_loop->can_manage()) :?>
                    <div class="panel-heading-controls">
                        <a href="/assessment_loop/analysis/add_edit/<?php echo intval($analysis->get_id()); ?>?assessment_loop_id=<?php echo $assessment_loop_id; ?>" data-toggle="ajaxModal" class="btn btn-sm" >
                            <span class="btn-label-icon left fa fa-edit"></span><?php echo lang('Edit').' '.lang('Analysis'); ?>
                        </a>
                    </div>
                    <?php endif; ?>
                </div>
                <div class="panel-body">
                    <span><?php echo xssfilter($analysis->get_text()); ?></span>
                </div>
            </div>

        <?php } else { ?>
            <div class="panel  panel-primary">
                <div class="panel-heading">
                    <span class="panel-title"><?php echo lang('Analysis'); ?></span>
                <?php if ($assessment_loop->can_manage()) :?>
                    <div class="panel-heading-controls">
                        <a href="/assessment_loop/analysis/add_edit?assessment_loop_id=<?php echo $assessment_loop_id; ?>"
                           data-toggle="ajaxModal" class="btn btn-sm">
                            <span class="btn-label-icon left fa fa-plus"></span><?php echo lang('Add').' '.lang('Analysis'); ?>
                        </a>
                    </div>
                <?php endif; ?>
                </div>
                <div class="alert alert-default m-b-0">
                    <div class="m-b-1">
                        <?php echo lang('There are no') . ' ' . lang('analysis has Entered'); ?>
                    </div>
                </div>
            </div>
        <?php } ?>
    </div>
</div>