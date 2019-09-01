<?php
/**
 * Created by PhpStorm.
 * User: basel
 * Date: 10/20/15
 * Time: 11:53 PM
 */
/** @var Orm_Sp_Activity[] $activities */
/** @var Orm_Sp_Perspective $perspective */
?>
<div class="table-primary table-responsive">
    <div class="table-header">
        <span class="table-caption"><?php echo lang('Activity'); ?></span>
    </div>
    <table class="table table-striped table-bordered">
        <thead>
        <tr>
            <th class="col-md-4"><?php echo lang('Title'); ?></th>
            <th class="col-md-2 text-center"><?php echo lang('Date'); ?></th>
            <th class="col-md-2 text-center"><?php echo lang('Status'); ?></th>
            <th class="col-md-2 text-center"><?php echo lang('Trend'); ?></th>
            <th class="col-md-2 text-center"><?php echo lang('Performance'); ?></th>
        </tr>
        </thead>
        <tbody>
        <?php if($activities) { ?>
            <?php foreach ($activities as $activity) { ?>
                <tr>
                    <td><?php echo htmlfilter($activity->get_title()); ?></td>
                    <td class="text-center valign-middle">
                        <div>
                            <label><?php echo lang('Start'); ?> : </label>
                            <?php echo $activity->get_start_date(); ?>
                        </div>
                        <div>
                            <label><?php echo lang('End'); ?> : </label>
                            <?php echo $activity->get_end_date(); ?>
                        </div>
                    </td>
                    <td class="text-center valign-middle"><?php echo $activity->get_status_lead(); ?></td>
                    <td class="text-center valign-middle"><?php echo $activity->get_trend_lead(); ?></td>
                    <td class="text-center valign-middle"><?php echo $activity->draw_gauge_lead(); ?></td>
                </tr>
            <?php } ?>
        <?php } else { ?>
            <tr>
                <td colspan="10">
                    <div class="well well-sm m-a-0" >
                        <h3 class="text-center m-a-0" ><?php echo lang('There are no') . ' ' . lang('Activity'); ?></h3>
                    </div>
                </td>
            </tr>
        <?php } ?>
        </tbody>
    </table>
</div>