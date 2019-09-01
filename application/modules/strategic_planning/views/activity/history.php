<?php
/**
 * Created by PhpStorm.
 * User: mazen
 * Date: 10/28/15
 * Time: 1:24 PM
 */
/** @var Orm_Sp_Activity_Milestone[] $histories */
/** @var Orm_Sp_Activity $activity */
?>
<div class="modal-dialog modal-lg">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            <?php echo lang('Activity Log'); ?>
        </div>
        <div class="modal-body">
            <div class="table-primary">
                <div class="table-header">
                    <div class="table-caption"><?php echo htmlfilter($activity->get_title()); ?></div>
                </div>
                <table class="table table-bordered">
                    <thead>
                    <tr>
                        <th><?php echo lang('Activity'); ?></th>
                        <th><?php echo lang('History Date'); ?></th>
                        <th><?php echo lang('Performance'); ?></th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($histories as $log) { ?>
                        <tr>
                            <td><?php echo htmlfilter(Orm_Sp_Activity::get_instance($log->get_activity_id())->get_title()); ?></td>
                            <td><?php echo date('Y-m-d', strtotime($log->get_date())); ?></td>
                            <td><?php echo $log->get_value(); ?></td>
                        </tr>
                    <?php } ?>
                    <?php if(empty($histories)) { ?>
                        <tr>
                            <td colspan="12">
                                <div class="alert m-a-0">
                                    <?php echo  lang("There is no").' '.lang('Data to be displayed.')?>
                                </div>
                            </td>
                        </tr>
                    <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-sm pull-left "
                    data-dismiss="modal"><span class="btn-label-icon left"><i class="fa fa-times"></i></span><?php echo lang('Close'); ?></button>
        </div>
    </div>
</div>