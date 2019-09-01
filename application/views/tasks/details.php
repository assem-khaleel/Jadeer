<?php
/**
 * Created by PhpStorm.
 * User: Abdelqader Osama
 * Date: 1/26/17
 * Time: 11:51 AM
 */

/** @var $task Orm_Tasks */
?>
<div class="modal-dialog modal-lg">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            <h4 class="modal-title"><?php echo htmlfilter($task->get_title()); ?></h4>
        </div>
        <div class="modal-body">
            <div class="form-group">
                <label class="control-label col-md-3"><?php echo lang('Assigned From') ?> :</label>
                <div class="col-md-9"><?php echo htmlfilter($task->get_from(true)->get_full_name()) ?></div>
            </div>
            <div class="clearfix"></div>
            <div class="form-group">
                <label class="control-label col-md-3"><?php echo lang('Assigned To') ?> :</label>
                <div class="col-md-9"><?php echo htmlfilter($task->get_to(true)->get_full_name()) ?></div>
            </div>
            <div class="clearfix"></div>
            <div class="form-group">
                <label class="control-label col-md-3"><?php echo lang('Assigned Date') ?> :</label>
                <div class="col-md-9"><?php echo $task->get_time() == '0000-00-00' ? lang('N/A') : date('Y-m-d', strtotime($task->get_time())); ?></div>
            </div>
            <div class="clearfix"></div>
            <br>
            <div class="form-group">
                <pre><?php echo xssfilter($task->get_text()); ?></pre>
            </div>
            <div class="clearfix"></div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn pull-right" data-dismiss="modal"><span class="btn-label-icon left"><i
                            class="fa fa-times"></i></span><?php echo lang('Close'); ?></button>
        </div>
    </div>
</div>
