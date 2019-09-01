<?php
/**
 * Created by PhpStorm.
 * User: basel
 * Date: 10/20/15
 * Time: 11:53 PM
 */
/** @var Orm_Sp_Initiative[] $initiatives */
/** @var Orm_Sp_Perspective $perspective */
?>
<div class="table-primary ?> table-responsive">
    <div class="table-header">
        <span class="table-caption"><?php echo lang('Initiative'); ?></span>
    </div>
    <table class="table table-bordered" id="initiative-table" >
        <thead>
        <tr>
            <th class="col-md-4 valign-middle" rowspan="2"><?php echo lang('Title'); ?></th>
            <th class="col-md-2 valign-middle" rowspan="2"><?php echo lang('Date'); ?></th>
            <th class="col-md-2 text-center" colspan="3"><?php echo lang('Lead'); ?></th>
            <th class="col-md-2 text-center" colspan="3"><?php echo lang('Lag'); ?></th>
        </tr>
        <tr>
            <th class="col-md-1 text-center"><?php echo lang('Status'); ?></th>
            <th class="col-md-1 text-center"><?php echo lang('Trend'); ?></th>
            <th class="col-md-1 text-center"><?php echo lang('Performance'); ?></th>
            <th class="col-md-1 text-center"><?php echo lang('Status'); ?></th>
            <th class="col-md-1 text-center"><?php echo lang('Trend'); ?></th>
            <th class="col-md-1 text-center"><?php echo lang('Performance'); ?></th>
        </tr>
        </thead>
        <tbody>
        <?php if($initiatives) { ?>
            <?php foreach ($initiatives as $initiative) { ?>
                <tr>
                    <td>
                        <a href="javascript:void(0);" onclick="show_action_plans(<?php echo $initiative->get_id(); ?>,'<?php echo $type ?>')" style="display: block; width: 100%;">
                            <span class="label label-primary; ?>" title="<?php echo $initiative->get_code(); ?>"><?php echo htmlfilter($initiative->get_code()); ?></span>
                            <?php echo htmlfilter($initiative->get_title()); ?>
                        </a>
                        <?php if($initiative->get_kpis()) { ?>
                            <br>
                            <a href="javascript:void(0);"
                               onclick="show_initiative_kpis(<?php echo $initiative->get_id(); ?>, this);"
                               class="btn "><span
                                        class="btn-label-icon left icon fa fa-key"></span><?php echo lang('KPIs'); ?></a>
                        <?php } ?>
                    </td>
                    <td class="text-center valign-middle">
                        <div>
                            <label><?php echo lang('Start'); ?> : </label>
                            <?php echo $initiative->get_start_date(); ?>
                        </div>
                        <div>
                            <label><?php echo lang('End'); ?> : </label>
                            <?php echo $initiative->get_end_date(); ?>
                        </div>
                    </td>
                    <td class="text-center valign-middle"><?php echo $initiative->get_status_lead(); ?></td>
                    <td class="text-center valign-middle"><?php echo $initiative->get_trend_lead(); ?></td>
                    <td class="text-center valign-middle"><?php echo $initiative->draw_gauge_lead(); ?></td>
                    <td class="text-center valign-middle"><?php echo $initiative->get_status_lag(); ?></td>
                    <td class="text-center valign-middle"><?php echo $initiative->get_trend_lag(); ?></td>
                    <td class="text-center valign-middle"><?php echo $initiative->draw_gauge_lag(); ?></td>
                </tr>
            <?php } ?>
        <?php } else { ?>
            <tr>
                <td colspan="10">
                    <div class="well well-sm m-a-0" >
                        <h3 class="text-center m-a-0" ><?php echo lang('There are no') . ' ' . lang('Objective'); ?></h3>
                    </div>
                </td>
            </tr>
        <?php } ?>
        </tbody>
    </table>
</div>
<div id="action_plan-container">
    <script>
        if (active_blocks['initiative']) {
            show_action_plans(active_blocks['initiative'],'<?php echo $type ?>');
        }
    </script>
</div>
<script>
    function show_action_plans(initiative_id, perspective) {

        if (active_blocks['initiative'] != initiative_id) {
            active_blocks['action_plan'] = 0;
            active_blocks['project'] = 0;
        }

        active_blocks['initiative'] = initiative_id;

        $('#action_plan-container').html('<div class="progress progress-striped active m-a-0" >' +
            '   <div class="progress-bar" style="width: 100%;"><span class="btn-label-icon left"><i class="fa fa-spinner fa-spin"></i></span> <?php echo lang('Loading'); ?></div>' +
            '</div>');

        var period_mode = period.getMode();
        var period_value = period.getSelectionValue();
        var period_year = period.getSelectionYear();
        var strategy_id = $('#strategy_id').val();

        $('#action_plan-container').load('/strategic_planning/action_plan/show/' + initiative_id + '/' + perspective + '?strategy_id=' + strategy_id + '&period_mode=' + period_mode + '&period_value=' + period_value + '&period_year=' + period_year);
    }

    function show_initiative_kpis(initiative_id, elem) {

        if ($('#initiative-table').find('tr.kpi-init-' + initiative_id).length == 0) {
            var period_mode = period.getMode();
            var period_value = period.getSelectionValue();
            var period_year = period.getSelectionYear();
            var strategy_id = $('#strategy_id').val();

            $.ajax('/strategic_planning/lag_kpi/indicators/Orm_Sp_Initiative/' + initiative_id + '?strategy_id=' + strategy_id + '&period_mode=' + period_mode + '&period_value=' + period_value + '&period_year=' + period_year).done(function (data) {
                $(elem).parents('tr').first().after(data);
            });
        }

        $('#initiative-table').find('tr.kpi-init-' + initiative_id).remove();
    }
</script>