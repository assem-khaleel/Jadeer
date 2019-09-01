<?php
/** @var $visit_reviewer Orm_Acc_Visit_Reviewer */
?>
<div class="modal-dialog modal-lg">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            <h4 class="modal-title"><?php echo lang('Recommendation'); ?></h4>
        </div>
        <div class="modal-body">
            <?php echo xssfilter($recommendation); ?>
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