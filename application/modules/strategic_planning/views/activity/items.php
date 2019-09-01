<?php
/**
 * Created by PhpStorm.
 * User: appleuser
 * Date: 9/21/15
 * Time: 9:49 AM
 */
/* @var Orm_Sp_Activity[] $activities */
/* @var Orm_Sp_Strategy $item */
/** @var string $pager */
?>
<div class="table-primary table-responsive p-a-2">
    <div class="table-header">
        <span class="table-caption"><?php echo lang('Activity'); ?></span>

        <div class="panel-heading-controls col-sm-4">
            <a class="btn btn-sm pull-right" data-toggle="ajaxModal"
               href="/strategic_planning/activity/add_edit?strategy_id=<?php echo urlencode($strategy->get_id()); ?>"><span
                    class="btn-label-icon left"><i
                        class="fa fa-plus"></i> </span>&nbsp;&nbsp;<?php echo lang('Create').' '.lang('Activity'); ?></a>
        </div>
    </div>
    <table class="table table-striped table-bordered">
        <thead>
        <tr>
            <th class="col-lg-3"><?php echo lang('Project'); ?></th>
            <th class="col-lg-3"><?php echo lang('Title'); ?></th>
            <th class="col-lg-2"><?php echo lang('Status'); ?></th>
            <th class="col-lg-2"><?php echo lang('Date period'); ?></th>
            <th class="col-lg-2 text-center"><?php echo lang('Actions'); ?></th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($activities as $activity) { ?>
            <tr class="odd gradeX">
                <td><?php echo htmlfilter($activity->get_project_obj()->get_title()); ?></td>
                <td><?php echo htmlfilter($activity->get_title()); ?></td>
                <td>
                    <?php
                    $progress = $activity->get_lead();
                    ?>
                    <div id="c3-gauge-<?php echo  $activity->get_id() ?>" style="height: 100px"></div>
                    <script>
                        pxInit.push(function () {
                            $(function () {
                                var data = {
                                    columns: [
                                        ['<?php echo lang('Progress') ?>', <?php echo $progress ?>]
                                    ],
                                    type: 'gauge'
                                };

                                c3.generate({
                                    bindto: '#c3-gauge-<?php echo  $activity->get_id() ?>',
                                    color: {pattern: ['<?php echo  get_chart_color($progress)?>']},
                                    data: data
                                });
                            });
                        });
                    </script>
                </td>
                <td>
                    <?php echo $activity->get_start_date() ? htmlfilter(date('Y-m-d', strtotime($activity->get_start_date()))) : ''; ?>
                    <?php echo ' ' . lang('to')?>
                    <?php echo $activity->get_end_date() ? htmlfilter(date('Y-m-d', strtotime($activity->get_end_date()))) : ''; ?>
                </td>
                <td class="text-center">
                    <a class="btn btn-sm btn-block"
                       href="/strategic_planning/activity/add_edit?strategy_id=<?php echo urlencode($strategy->get_id()); ?>&id=<?php echo urlencode($activity->get_id()); ?>"
                       data-toggle="ajaxModal"><span class="btn-label-icon left"><i
                                class="fa fa-edit"></i></span><?php echo lang('Edit'); ?></a>
                    <a class="btn btn-sm btn-block"
                       href="/strategic_planning/activity/delete?strategy_id=<?php echo urlencode($strategy->get_id()); ?>&id=<?php echo urlencode($activity->get_id()); ?>"
                       message="<?php echo lang('Are you sure ?')?>" data-toggle="deleteAction"><span class="btn-label-icon left"><i
                                class="fa fa-trash-o"></i></span><?php echo lang('Delete'); ?></a>
                    <a class="btn btn-sm btn-block"
                       href="/strategic_planning/risk_tab/add_edit?strategy_id=<?php echo urlencode($strategy->get_id()); ?>&id=<?php echo urlencode($activity->get_id()); ?>&type=Orm_Sp_Activity"
                       data-toggle="ajaxModal"><span class="btn-label-icon left"><i
                                class="fa fa-bug"></i></span><?php echo lang('Risk'); ?></a>
                    <a class="btn btn-sm btn-block"
                       href="/strategic_planning/activity/history?strategy_id=<?php echo urlencode($strategy->get_id()); ?>&id=<?php echo urlencode($activity->get_id()); ?>"
                       data-toggle="ajaxModal"><span class="btn-label-icon left"><i
                                class="fa fa-history"></i></span><?php echo lang('Activity Log'); ?></a>
                </td>
            </tr>
        <?php } ?>
        <?php if (empty($activities)) { ?>
            <tr>
                <td colspan="12">
                    <div class="alert m-a-0">
                        <?php echo lang('There are no') . ' ' . lang('Activities'); ?>
                    </div>
                </td>
            </tr>
        <?php } ?>
        </tbody>
    </table>
    <?php if (!empty($pager)) { ?>
        <div class="table-footer">
            <?php echo $pager; ?>
        </div>
    <?php } ?>
</div>
<script>
    function after_modal() {
        init_data_toggle();
    }
</script>