<?php
/**
 * Created by PhpStorm.
 * User: appleuser
 * Date: 9/21/15
 * Time: 9:49 AM
 */
/* @var $lag_kpis Orm_Sp_Lag_Kpi */
?>
<div class="table-primary table-responsive">
    <div class="table-header">
        <span class="table-caption"><?php echo lang('Lag Kpi'); ?></span>
    </div>
    <div class="table-header">
        <span class="table-caption">&nbsp;</span>

        <div class="panel-heading-controls col-sm-4">
            <form method="GET">
                <div class="input-group input-group-sm">
                    <input type="text" name="s" placeholder="<?php echo lang('Search'); ?>" class="form-control"
                           value="<?php echo isset($keyword) && $keyword ? $keyword : ''; ?>">
                    <input type="hidden" name="id" value="<?php echo $lag_kpis->get_id(); ?>">
                    <span class="input-group-btn">
                        <button type="submit" class="btn">
                            <span class="fa fa-search"></span>
                        </button>
                    </span>
                </div>
                <!-- / .input-group -->
            </form>
            <a class="btn" data-toggle="ajaxModal"
               href="/strategic_planning/lag_kpi/add_edit"><span class="btn-label-icon left"><i
                        class="fa fa-plus"></i> </span>&nbsp;&nbsp;<?php echo lang('Create').' '.lang('Lag Kpi'); ?></a>
        </div>
    </div>
    <table class="table table-striped table-bordered">
        <thead>
        <tr>
            <th class="col-lg-3"><?php echo lang('Kpi'); ?></th>
            <th class="col-lg-3"><?php echo lang('Initiative'); ?></th>
            <th class="col-lg-3"><?php echo lang('Objective'); ?></th>
            <th class="col-lg-3 text-center"><?php echo lang('Actions'); ?></th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($lag_kpis as $lag_kpi) { ?>
            <tr class="odd gradeX">
                <td><?php echo htmlfilter($lag_kpi->get_kpi_id()); ?></td>
                <td><?php echo htmlfilter($lag_kpi->get_initiative_obj()->get_title()); ?></td>
                <td><?php echo htmlfilter($lag_kpi->get_objective_obj()->get_title()); ?></td>
                <td class="text-center">
                    <a class="btn btn-sm btn-block"
                       href="/strategic_planning/lag_kpi/add_edit?id=<?php echo urlencode($lag_kpi->get_id()); ?>"><span
                            class="btn-label-icon left"><i class="fa fa-edit"></i></span><?php echo lang('Edit'); ?></a> |
                    <a class="btn btn-sm btn-block"
                       href="/strategic_planning/lag_kpi/delete?id=<?php echo urlencode($lag_kpi->get_id()); ?>"
                       message="<?php echo lang('Are you sure ?')?>" data-toggle="deleteAction"><span class="btn-label-icon left"><i
                                class="fa fa-trash-o"></i></span><?php echo lang('Delete'); ?></a>
                </td>
            </tr>
        <?php } ?>
        <?php if (empty($lag_kpis)) { ?>
            <tr>
                <td colspan="12">
                    <div class="alert m-a-0">
                        <?php echo lang('There are no') . ' ' . lang('Lag KPIs'); ?>
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