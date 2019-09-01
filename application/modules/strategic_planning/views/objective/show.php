<?php
/**
 * Created by PhpStorm.
 * User: mazen
 * Date: 10/20/15
 * Time: 7:38 PM
 */
/** @var Orm_Sp_Perspective $perspective */
/** @var Orm_Sp_Objective[] $objectives */
/** @var int $type */
?>

<div class="table-primary table-responsive">
    <div class="table-header">
        <span class="table-caption">
            <?php echo htmlfilter($perspective->get_name()); ?>
        </span>
    </div>
    <table class="table table-bordered" id="objective-table" >
        <thead>
        <tr>
            <th class="col-md-4 valign-middle" rowspan="2"><?php echo lang('Title'); ?></th>
            <th class="col-md-2 text-center" colspan="3"><?php echo lang('Lead'); ?></th>
            <th class="col-md-2 text-center" colspan="3"><?php echo lang('Lag'); ?></th>
        </tr>
        <tr>
            <th class="col-md-1 text-center"><?php echo lang('Status'); ?></th>
            <th class="col-md-1 text-center"><?php echo lang('Trend'); ?></th>
            <th class="col-md-2 text-center"><?php echo lang('Performance'); ?></th>
            <th class="col-md-1 text-center"><?php echo lang('Status'); ?></th>
            <th class="col-md-1 text-center"><?php echo lang('Trend'); ?></th>
            <th class="col-md-2 text-center"><?php echo lang('Performance'); ?></th>
        </tr>
        </thead>
        <tbody>
        <?php if($objectives) { ?>
            <?php foreach ($objectives as $objective) { ?>
                <tr>
                    <td>
                        <a href="javascript:void(0);" onclick="show_initiatives(<?php echo $objective->get_id(); ?>,'<?php echo $type ?>');"
                           class="btn-block">
                            <span class="label label-primary ?>" title="<?php echo $objective->get_code(); ?>"><?php echo htmlfilter($objective->get_code()); ?></span>
                            <?php echo htmlfilter($objective->get_title()); ?>
                        </a>
                        <?php if($objective->get_kpis()) { ?>
                            <br>
                            <a href="javascript:void(0);"
                               onclick="show_objective_kpis(<?php echo $objective->get_id(); ?>, this);"
                               class="btn "><span
                                        class="btn-label-icon left icon fa fa-key"></span><?php echo lang('KPIs'); ?></a>
                        <?php } ?>
                    </td>
                    <td class="text-center valign-middle"><?php echo $objective->get_status_lead(); ?></td>
                    <td class="text-center valign-middle"><?php echo $objective->get_trend_lead(); ?></td>
                    <td class="text-center valign-middle"><?php echo $objective->draw_gauge_lead(); ?></td>
                    <td class="text-center valign-middle"><?php echo $objective->get_status_lag(); ?></td>
                    <td class="text-center valign-middle"><?php echo $objective->get_trend_lag(); ?></td>
                    <td class="text-center valign-middle"><?php echo $objective->draw_gauge_lag(); ?></td>
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
<div id="initiatives-container">
    <script>
        if (active_blocks['objective']) {
            show_initiatives(active_blocks['objective'], '<?php echo $type ?>');
        }
    </script>
</div>

<script>
    function show_initiatives(objective_id, type) {

        if (active_blocks['objective'] != objective_id) {
            active_blocks['initiative'] = 0;
            active_blocks['action_plan'] = 0;
            active_blocks['project'] = 0;
        }

        active_blocks['objective'] = objective_id;

        $('#initiatives-container').html('<div class="progress progress-striped active m-a-0" >' +
            '   <div class="progress-bar" style="width: 100%;"><span class="btn-label-icon left"><i class="fa fa-spinner fa-spin"></i></span> <?php echo lang('Loading'); ?></div>' +
            '</div>');

        var period_mode = period.getMode();
        var period_value = period.getSelectionValue();
        var period_year = period.getSelectionYear();
        var strategy_id = $('#strategy_id').val();

        $('#initiatives-container').load('/strategic_planning/initiative/show/' + objective_id + '/'+ type +'?strategy_id=' + strategy_id + '&period_mode=' + period_mode + '&period_value=' + period_value + '&period_year=' + period_year);
    }

    function show_objective_kpis(objective_id, elem) {

        if ($('#objective-table').find('tr.kpi-obj-' + objective_id).length == 0) {
            var period_mode = period.getMode();
            var period_value = period.getSelectionValue();
            var period_year = period.getSelectionYear();
            var strategy_id = $('#strategy_id').val();

            $.ajax('/strategic_planning/lag_kpi/indicators/Orm_Sp_Objective/' + objective_id + '?strategy_id=' + strategy_id + '&period_mode=' + period_mode + '&period_value=' + period_value + '&period_year=' + period_year).done(function (data) {
                $(elem).parents('tr').first().after(data);
            });
        }

        $('#objective-table').find('tr.kpi-obj-' + objective_id).remove();
    }
</script>