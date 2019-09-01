<?php
/* @var $notification Orm_Notification */
?>
<div class="modal-dialog modal-lg">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            <h4 class="modal-title"><?php echo lang('Notification') . ' : ' . htmlfilter($notification->get_subject()); ?></h4>
            <br>
            <h5 class="modal-title"><?php echo htmlfilter($notification->get_date_added()); ?></h5>
        </div>
        <div class="modal-body">
            <?php echo xssfilter($notification->get_body()); ?>
            <div class="clearfix"></div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn pull-left"
                    data-dismiss="modal"><?php echo lang('Close'); ?></button>
        </div>
    </div> <!-- /.modal-content -->
</div> <!-- /.modal-dialog -->