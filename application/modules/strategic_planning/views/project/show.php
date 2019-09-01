<?php
/**
 * Created by PhpStorm.
 * User: basel
 * Date: 10/20/15
 * Time: 11:53 PM
 */
/** @var Orm_Sp_Project[] $projects */
/** @var array $perspective */
/** @var int $strategy_id */
?>
<div class="table-primary table-responsive">
    <div class="table-header">
        <span class="table-caption"><?php echo lang('Project'); ?></span>
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
        <?php if($projects) { ?>
            <?php foreach ($projects as $project) { ?>
                <tr>
                    <td>
                        <a href="javascript:void(0);" onclick="show_activity(<?php echo $project->get_id(); ?>, '<?php echo $type ?>')"
                           style="display: block; width: 100%;"><?php echo htmlfilter($project->get_title()); ?></a>
                    </td>
                    <td class="text-center valign-middle">
                        <div>
                            <label><?php echo lang('Start'); ?> : </label>
                            <?php echo $project->get_start_date(); ?>
                        </div>
                        <div>
                            <label><?php echo lang('End'); ?> : </label>
                            <?php echo $project->get_end_date(); ?>
                        </div>
                    </td>
                    <td class="text-center valign-middle"><?php echo $project->get_status_lead(); ?></td>
                    <td class="text-center valign-middle"><?php echo $project->get_trend_lead(); ?></td>
                    <td class="text-center valign-middle"><?php echo $project->draw_gauge_lead(); ?></td>
                </tr>
            <?php } ?>
        <?php } else { ?>
            <tr>
                <td colspan="10">
                    <div class="well well-sm m-a-0" >
                        <h3 class="text-center m-a-0" ><?php echo lang('There are no') . ' ' . lang('Project'); ?></h3>
                    </div>
                </td>
            </tr>
        <?php } ?>
        </tbody>
    </table>
</div>
<div id="activity-container">
    <script>
        if (active_blocks['project']) {
            show_activity(active_blocks['project'], '<?php echo $type ?>');
        }
    </script>
</div>
<script>
    function show_activity(project_id, perspective) {

        active_blocks['project'] = project_id;

        $('#activity-container').html('<div class="progress progress-striped active m-a-0" >' +
            '   <div class="progress-bar" style="width: 100%;"><span class="btn-label-icon left"><i class="fa fa-spinner fa-spin"></i></span> <?php echo lang('Loading'); ?></div>' +
            '</div>');

        var period_mode = period.getMode();
        var period_value = period.getSelectionValue();
        var period_year = period.getSelectionYear();
        var strategy_id = $('#strategy_id').val();

        $('#activity-container').load('/strategic_planning/activity/show/' + project_id + '/' + perspective + '?strategy_id=' + strategy_id + '&period_mode=' + period_mode + '&period_value=' + period_value + '&period_year=' + period_year);
    }
</script>