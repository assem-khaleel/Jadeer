<?php
/**
 * Created by PhpStorm.
 * User: appleuser
 * Date: 9/21/15
 * Time: 9:49 AM
 */
/** @var Orm_Sp_Initiative[] $initiatives */
/** @var Orm_Sp_Strategy $strategy */
/** @var string $pager */
?>
<div class="table-primary table-responsive p-a-2">
    <div class="table-header">
        <span class="table-caption"><?php echo lang('Initiative'); ?></span>

        <div class="panel-heading-controls col-sm-4">
            <a class="btn btn-sm pull-right" data-toggle="ajaxModal"
               href="/strategic_planning/initiative/add_edit?strategy_id=<?php echo urlencode($strategy->get_id()); ?>"><span
                    class="btn-label-icon left"><i
                        class="fa fa-plus"></i> </span>&nbsp;&nbsp;<?php echo lang('Create').' '.lang('Initiative'); ?></a>
        </div>
    </div>
    <table class="table table-striped table-bordered">
        <thead>
        <tr>
            <th class="col-lg-3"><?php echo lang('Objective'); ?></th>
            <th class="col-lg-4"><?php echo lang('Title'); ?></th>
            <th class="col-lg-1"><?php echo lang('Start Date'); ?></th>
            <th class="col-lg-1"><?php echo lang('End Date'); ?></th>
            <th class="col-lg-3 text-center"><?php echo lang('Actions'); ?></th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($initiatives as $initiative) { ?>
            <tr>
                <td><span
                        class="label label-primary"><?php echo htmlfilter($initiative->get_objective_obj()->get_code()); ?></span> <?php echo htmlfilter($initiative->get_objective_obj()->get_title()); ?>
                </td>
                <td><span
                        class="label label-primary"><?php echo htmlfilter($initiative->get_code()); ?></span> <?php echo htmlfilter($initiative->get_title()); ?>
                </td>
                <td><?php echo htmlfilter(date('d-m-Y', strtotime($initiative->get_start_date()))); ?></td>
                <td><?php echo htmlfilter(date('d-m-Y', strtotime($initiative->get_end_date()))); ?></td>
                <td class="text-center">
                    <a class="btn btn-sm btn-no-width"
                       href="/strategic_planning/initiative/add_edit?strategy_id=<?php echo urlencode($strategy->get_id()); ?>&id=<?php echo urlencode($initiative->get_id()); ?>"
                       data-toggle="ajaxModal" title="<?php echo lang('Edit'); ?>"><i class="fa fa-edit"></i></a>
                    <a class="btn btn-sm btn-no-width"
                       href="/strategic_planning/initiative/delete?strategy_id=<?php echo urlencode($strategy->get_id()); ?>&id=<?php echo urlencode($initiative->get_id()); ?>"
                       message="<?php echo lang('Are you sure ?')?>" data-toggle="deleteAction" title="<?php echo lang('Delete'); ?>"><i class="fa fa-trash-o"></i></a>
                    <a class="btn btn-sm btn-no-width"
                       href="/strategic_planning/risk_tab/add_edit?strategy_id=<?php echo urlencode($strategy->get_id()); ?>&id=<?php echo urlencode($initiative->get_id()); ?>&type=Orm_Sp_Initiative"
                       data-toggle="ajaxModal" title="<?php echo lang('Risk'); ?>"><i class="fa fa-bug"></i></a>
                    <a class="btn btn-sm btn-no-width"
                       href="/strategic_planning/lag_kpi/add_edit_kpi?strategy_id=<?php echo urlencode($strategy->get_id()); ?>&type_id=<?php echo $initiative->get_id(); ?>&class_type=Orm_Sp_Initiative"
                       data-toggle="ajaxModal"><i class="fa fa-bar-chart-o" title="Kpi"></i></a>
                    <a class="btn btn-sm btn-no-width"
                       href="/strategic_planning/initiative/milestone?id=<?php echo urlencode($initiative->get_id()); ?>&strategy_id=<?php echo urlencode($strategy->get_id()); ?>"
                       data-toggle="ajaxModal"><i class="fa fa-arrows" title="Milestone"></i></a>
                </td>
            </tr>
            <?php foreach (Orm_Sp_Kpi::get_all(array('class_type' => 'Orm_Sp_Initiative', 'type_id' => $initiative->get_id())) as $kpi) { ?>
                <tr class="alert alert-primary">
                    <td colspan="4">
                        <div class="media">
                            <div class="pull-left"><i class="comment-avatar fa fa-key"></i></div>
                            <div
                                class="media-body"><?php echo htmlfilter(Orm_Kpi::get_instance($kpi->get_kpi_id())->get_title()); ?></div>
                        </div>
                    </td>
                    <td class="text-center">
                        <a class="btn btn-sm btn-no-width"
                           href="/strategic_planning/lag_kpi/add_edit_kpi?strategy_id=<?php echo urlencode($strategy->get_id()); ?>&type_id=<?php echo $initiative->get_id(); ?>&id=<?php echo $kpi->get_id(); ?>"
                           data-toggle="ajaxModal"><span class="btn-label-icon left"><i
                                    class="fa fa-edit"></i></span><?php echo lang('Edit'); ?></a>
                        <a class="btn btn-sm btn-no-width"
                           href="/strategic_planning/lag_kpi/remove_kpi?strategy_id=<?php echo urlencode($strategy->get_id()); ?>&id=<?php echo $kpi->get_id(); ?>"
                           message="<?php echo lang('Are you sure ?')?>" data-toggle="deleteAction"><span class="btn-label-icon left"><i
                                    class="fa fa-trash-o"></i></span><?php echo lang('Delete'); ?></a>
                    </td>
                </tr>
            <?php } ?>
        <?php } ?>
        <?php if (empty($initiatives)) { ?>
            <tr>
                <td colspan="12">
                    <div class="alert m-a-0">
                        <?php echo lang('There are no') . ' ' . lang('Initiatives'); ?>
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