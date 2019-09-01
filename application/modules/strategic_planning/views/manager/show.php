<?php
/** @var Orm_Sp_Strategy $strategy */
?>
<div class="row">

    <div class="col-md-6">
        <div class="panel panel-body-colorful box">
            <div class="box-row">
                <div class="box-container">
                    <div class="box-cell p-a-1 bg-primary dark">
                        <?php echo $strategy->get_title(); ?> (<?php echo lang('Lead') ?>)
                    </div>
                </div>
            </div>
            <div class="box-row">
                <div class="box-container valign-middle text-xs-center">
                    <div class="box-cell p-y-1 b-r-1 font-size-52">
                        <?php echo $strategy->get_status_lead(); ?><br>
                        <div class="font-size-11"><?php echo lang('Status') ?></div>
                    </div>
                    <div class="box-cell p-y-1 b-r-1 font-size-52">
                        <?php echo $strategy->get_trend_lead(); ?><br>
                        <div class="font-size-11"><?php echo lang('Trend') ?></div>
                    </div>
                    <div class="box-cell p-y-1">
                        <?php echo $strategy->draw_gauge_lead(); ?>
                        <div class="font-size-11"><?php echo lang('Performance') ?></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="panel panel-body-colorful box">
            <div class="box-row">
                <div class="box-container">
                    <div class="box-cell p-a-1 bg-primary darken">
                        <?php echo $strategy->get_title(); ?> (<?php echo lang('Lag') ?>)
                    </div>
                </div>
            </div>
            <div class="box-row">
                <div class="box-container valign-middle text-xs-center">
                    <div class="box-cell p-y-1 b-r-1 font-size-52">
                        <?php echo $strategy->get_status_lag(); ?><br>
                        <div class="font-size-11"><?php echo lang('Status') ?></div>
                    </div>
                    <div class="box-cell p-y-1 b-r-1 font-size-52">
                        <?php echo $strategy->get_trend_lag(); ?><br>
                        <div class="font-size-11"><?php echo lang('Trend') ?></div>
                    </div>
                    <div class="box-cell p-y-1">
                        <?php echo $strategy->draw_gauge_lag(); ?>
                        <div class="font-size-11"><?php echo lang('Performance') ?></div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
<div class="row">
    <div class="col-md-12">
        <div class="table-primary">
            <div class="table-header">
                <div class="table-caption"><?php echo lang('Goals'); ?></div>
            </div>
            <?php if ($strategy->get_goals()) { ?>
            <table class="table table-bordered">
                <tbody>
                <?php foreach ($strategy->get_goals() as $goal) { ?>
                    <tr>
                        <td class="valign-middle" colspan="6">
                            <span class="label label-primary"><?php echo $goal->get_code(); ?></span>
                            <?php echo htmlfilter($goal->get_title()); ?>
                        </td>
                    </tr>
                    <tr>
                        <td class="text-center valign-middle">
                            <span class="font-size-52"><?php echo $goal->get_status_lead(); ?></span>
                            <br>
                            <span class="text-xs text-muted"><?php echo lang('Status'); ?>
                                &nbsp;&nbsp;(<?php echo lang('Lead'); ?>)</span>
                        </td>
                        <td class="text-center valign-middle">
                             <span class="font-size-52"><?php echo $goal->get_trend_lead(); ?></span>
                            <br>
                            <span class="text-xs text-muted"><?php echo lang('Trend'); ?>
                                &nbsp;&nbsp;(<?php echo lang('Lead'); ?>)</span>
                        </td>
                        <td class="text-center valign-middle">
                            <?php echo $goal->draw_gauge_lead(); ?>
                            <span class="text-xs text-muted"><?php echo lang('Performance'); ?>
                                &nbsp;&nbsp;(<?php echo lang('Lead'); ?>)</span>
                        </td>
                        <td class="text-center valign-middle">
                            <span class="font-size-52"> <?php echo $goal->get_status_lag(); ?></span>
                            <br>
                            <span class="text-xs text-muted"><?php echo lang('Status'); ?>
                                &nbsp;&nbsp;(<?php echo lang('Lag'); ?>)</span>
                        </td>
                        <td class="text-center valign-middle">
                            <span class="font-size-52"> <?php echo $goal->get_trend_lag(); ?></span>
                            <br>
                            <span class="text-xs text-muted"><?php echo lang('Trend'); ?>
                                &nbsp;&nbsp;(<?php echo lang('Lag'); ?>)</span>
                        </td>
                        <td class="text-center valign-middle">
                            <?php echo $goal->draw_gauge_lag(); ?>
                            <span class="text-xs text-muted"><?php echo lang('Performance'); ?>
                                &nbsp;&nbsp;(<?php echo lang('Lag'); ?>)</span>
                        </td>
                    </tr>
                <?php } ?>
                </tbody>
                <?php } else { ?>
                    <div class="well well-sm m-a-0">
                        <h4 class="m-a-0">
                            <?php echo lang('No Goals'); ?>
                        </h4>
                    </div>
                <?php } ?>
            </table>
        </div>
    </div>
</div>
<div class="row">
    <?php foreach ($strategy->get_perspectives() as $perspective) { ?>
        <div class="col-md-3">
            <div class="panel dark panel-body-colorful box">
                <div class="box-row">
                    <div class="box-container">
                        <a href="javascript:void(0);"
                           class="box-cell p-a-1 bg-primary padding-sm text-xs text-semibold"
                           onclick="show_objectives('<?php echo $perspective ?>');">
                            <?php echo htmlfilter(Orm_Sp_Perspective::get_instance($perspective)->get_name()); ?>
                        </a>
                    </div>
                </div>
                <div class="box-row">
                    <div class="box-container valign-middle text-xs-center">
                        <div class="box-cell p-y-1 b-r-1">
                            <?php echo $strategy->draw_gauge_lead($perspective); ?>
                            <span class="text-xs text-muted"><?php echo lang('Performance') ?>
                                &nbsp;&nbsp;(<?php echo lang('Lead') ?>)</span>
                        </div>
                        <div class="box-cell p-y-1 b-r-1">
                            <?php echo $strategy->draw_gauge_lag($perspective); ?>
                            <span class="text-xs text-muted"><?php echo lang('Performance') ?>
                                &nbsp;&nbsp;(<?php echo lang('Lag') ?>)</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <?php } ?>
</div>

<div id="details-container" class="hidden">
    <input type="hidden" id="strategy_id" value="<?php echo $strategy->get_id(); ?>"/>

    <div class="row">
        <div class="col-md-12" id="perspective-container">
            <script>
                if (active_blocks['type']) {
                    show_objectives(active_blocks['type']);
                }
            </script>
        </div>
    </div>
</div>

<script>
    function show_objectives(type) {

        if (active_blocks['type'] != type) {
            active_blocks['objective'] = 0;
            active_blocks['initiative'] = 0;
            active_blocks['action_plan'] = 0;
            active_blocks['project'] = 0;
        }

        active_blocks['type'] = type;

        $('#perspective-container').html('<div class="progress progress-striped active m-a-0" >' +
            '   <div class="progress-bar" style="width: 100%;"><span class="btn-label-icon left"><i class="fa fa-spinner fa-spin"></i></span> <?php echo lang('Loading'); ?></div>' +
            '</div>');

        var period_mode = period.getMode();
        var period_value = period.getSelectionValue();
        var period_year = period.getSelectionYear();
        var strategy_id = $('#strategy_id').val();

        $('#perspective-container').load('/strategic_planning/objective/show/' + type + '?strategy_id=' + strategy_id + '&period_mode=' + period_mode + '&period_value=' + period_value + '&period_year=' + period_year, function () {
            $('#perspective-container').append('<input type="hidden" id="perspective-type" value="' + type + '" />');
        });

        $('#details-container').removeClass('hidden');
    }
</script>