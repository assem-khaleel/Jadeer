<?php
/** @var $action_plan Orm_Acc_Pre_Visit_Reviewer_Action_Plan */
?>
<div class="modal-dialog modal-lg">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            <h4 class="modal-title"><?php echo lang('Action Plan Description'); ?></h4>
        </div>
        <div class="modal-body">
            <?php echo nl2br(htmlfilter($action_plan)); ?>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn pull-left" data-dismiss="modal">
                <span class="btn-label-icon left fa fa-times"></span><?php echo lang('Close'); ?>
            </button>
            <div class="clearfix"></div>
        </div>
    </div>
    <!-- /.modal-content -->
</div> <!-- /.modal-dialog -->